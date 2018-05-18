<template>
    <div>
        <div class="alert-list" @click="getAlertPosts"> 
            <div class="alert-item alert-name" v-text="alertName"></div>
            <div class="alert-item alert-keyword">
                <div v-text="keywords"></div>
                <i class="fas fa-plus" v-if="!open"></i>
                <i class="fas fa-minus" v-if="open"></i>
            </div>
        </div>
        <div class="load-bar" v-if="isLoading">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
        </div>
        <div v-if="open" class="delete-alert">
            <button class="button is-danger is-outlined is-small" :data-target="alertId" @click="active = true">
                <span>Delete</span>
                <span class="icon is-small">
                    <i class="fas fa-times"></i>
                </span>
            </button>
        </div>
        <transition-group name="fade">
            <div v-if="open" v-for="post in posts" :key="post.id" class="match box">
                <div class="post">
                    <div class="post-elements">
                        <div class="post-title">
                            <a class="title-link button is-primary" :href="post.link" v-text="post.title" target="_blank"></a>
                        </div>
                        <div class="post-item">
                            <span>Retailer:</span> {{ post.retailer }}
                        </div>
                        <div class="post-item">
                            <span>Savings:</span> {{ post.savings }}
                        </div>
                        <div class="post-item">
                            <span>Price:</span> ${{ post.price }}
                        </div>
                        <div class="post-item">
                            <span><a :href="post.dealLink" target="_blank">Deal Link</a></span>
                        </div>
                    </div>
                </div>
            </div>
        </transition-group>
        <div class="error" v-text="errors"></div>
        <modal :id="alertId" title="Delete Alert" :active.sync="active"> 
            <div class="delete-confirmation">Are you sure you want to delete <span>{{ this.alertName }}</span> alert?</div>
            <button @click="deleteAlert" class="button is-primary float-right">Delete</button>
        </modal>
    </div>
</template>

<script>
export default {
    data: function () {
            return { 
                posts: [],
                isLoading: false,
                errors: '',
                open: false,
                active: false,
        }
    },

    props: ['alertId', 'alertName', 'keywords'],

    methods: {

        getAlertPosts() {
            if (this.open) {
                this.open = false
                return
            }
            this.open = true
            this.isLoading = true
            axios.get('/alerts/results/'+this.alertId)
                    .then(results => {
                        this.posts = results.data
                        this.isLoading = false
                    })
                    .catch(e => {
                        this.errors = 'Something went wrong please try again or contact the web admin'
                        this.isLoading = false
                    })
        },

        deleteAlert() {
            axios.get('/alerts/delete/'+this.alertId)
                    .then(results => {
                        location.reload()
                    })
                    .catch(e => {
                        $this.errors = 'Something went wrong please try again'
                    })
        }
    },
}
</script>

<style>

.all-posts {
    float: left;
}

.title-link {

    width: 100%;

}

.box {

    margin-bottom: .5em;

}
.match {

    float: left;
    width: 100%;

}

.delete-alert {

    float: right;

}

.fade-enter-active {

    transition: opacity .5s;

}

.fade-enter {

    opacity: 0;

}

.delete-confirmation {

    margin-bottom: 5px;
    
}
</style>