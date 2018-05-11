<template>
    <div>
        <div class="alert-list" @click="alertPosts"> 
            <div class="alert-item alert-name" v-text="alertName"></div>
            <div class="alert-item alert-keyword" v-text="keywords"></div>
        </div>
        <div class="load-bar" v-if="isLoading">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
        </div>
        <div v-for="post in posts" :key="post" class="match">
            <a :href="post.link" v-text="post.title" target="_blank"></a>
        </div>
        <div class="error" v-text="errors"></div>
    </div>
</template>

<script>
export default {
    data: function () {
            return { 
                posts: [],
                isLoading: false,
                errors: '',
        }
    },

    props: ['alertId', 'alertName', 'keywords'],

    methods: {

        alertPosts() {
            this.isLoading = true
            axios.get('/alerts/results/'+this.alertId)
                    .then(results => {
                        this.posts = results.data.results
                        this.isLoading = false
                    })
                    .catch(e => {
                        this.errors = 'Something went wrong please try again or contact the web admin'
                        this.isLoading = false
                    })
        }
    },
}
</script>
