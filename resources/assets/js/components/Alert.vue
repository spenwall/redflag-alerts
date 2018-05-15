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
        <div v-if="open" class="delete">
            <a data-toggle="modal" :data-target="alertModal">
                <button class="btn btn-outline-danger btn-sm">Delete</button>
            </a>
        </div>
        <div v-if="open" v-for="post in posts" :key="post.id" class="match">
            <div class="post">
                <div class="post-elements">
                    <div class="post-title">
                        <dd><a :href="post.link" v-text="post.title" target="_blank"></a></dd>
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
                        <span>Deal Link:</span> {{ post.deal-link }}
                    </div>
                </div>
            </div>
        </div>
        <div class="error" v-text="errors"></div>
        <modal :id="alertName" title="Delete Alert">
            <div class="delete-confirmation">Are you sure you want to delete <span>{{ this.alertName }}</span> alert?</div>
            <button @click="deleteAlert" class="btn btn-danger float-right">Delete</button>
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
                status: '',
                add: 'ion-android-add',
                remove: 'ion-android-remove',
                open: false,
        }
    },

    computed: {
        alertModal: function() {
            return '#' + this.alertName
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
