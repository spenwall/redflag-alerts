<template>
    <div>
        <div class="alert-list" @click="alertPosts"> 
            <div class="alert-item alert-name" v-text="alertName"></div>
            <div class="alert-item alert-keyword">
                <div v-text="keywords"></div>
                <i :class="status"></i>
            </div>
        </div>
        <div class="load-bar" v-if="isLoading">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
        </div>
        <div v-if="open" v-for="post in posts" :key="post.id" class="match">
            <div class="post">
                <dl class="post-elements">
                    <div class="post-title">
                        <dt>Post Link</dt> 
                        <dd><a :href="post.link" v-text="post.title" target="_blank"></a></dd>
                    </div>
                    <div>
                        <dt>Retailer</dt>
                        <dd><div v-text="post.retailer"></div></dd>
                    </div>
                    <div>
                        <dt>Savings</dt>
                        <dd><div v-text="post.savings"></div></dd>
                    </div>
                    <div>
                        <dt>Price</dt>
                        <dd><div v-text="post.price"></div></dd>
                    </div>
                    <div>
                        <dt>Deal Link</dt>
                        <dd><a :href="post.deal-link" target="_blank">Direct Link</a></dd>
                    </div>
                </dl>
            </div>
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
                status: '',
                add: 'ion-android-add',
                remove: 'ion-android-remove',
                open: false,
        }
    },

    mounted: function() {
        this.status = this.add
    },

    props: ['alertId', 'alertName', 'keywords'],

    methods: {

        alertPosts() {
            if (this.status === this.remove) {
                this.status = this.add
                this.open = false
                return
            }
            this.open = true
            this.status = this.remove
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
