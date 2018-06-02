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
        <div class="results">
            <div v-if="open" class="delete-alert">
                <button class="button is-danger is-outlined is-small" :data-target="alertId" @click="active = true">
                    <span>Delete</span>
                    <span class="icon is-small">
                        <i class="fas fa-times"></i>
                    </span>
                </button>
            </div>
            <transition-group name="fade"
                enter-active-class="animated fadeInRight"
                leave-active-class="animated fadeOutLeft">
                <div v-if="open" v-for="post in posts" :key="post.id" class="match card">
                    <div class="post">
                        <div class="post-elements">
                            <div class="post-title">
                                <a class="title-link" :href="post.link" v-text="post.title" target="_blank"></a>
                            </div>
                            <div class="post-item">
                                <span>Retailer:</span> {{ post.retailer }}
                            </div>
                            <div class="post-item">
                                <span>Savings:</span> {{ post.savings }}
                            </div>
                            <div class="post-item">
                                <span>Price:</span> {{ post.price }}
                            </div>
                            <div class="post-item" v-if="post.dealLink">
                                <span><a :href="post.dealLink" target="_blank">Deal Link</a></span>
                            </div>
                        </div>
                    </div>
                </div>
            </transition-group>
            <div class="no-results card" v-if="open && empty">
                <div class="is-danger">No Results Were Found</div>
            </div> 
            <div class="error" v-text="errors"></div>
        </div>
        <modal :id="alertId" title="Delete Alert" :active.sync="active"> 
            <div class="delete-confirmation">Are you sure you want to delete <span>{{ this.alertName }}</span> alert?</div>
            <div class="delete-button">
                <button @click="deleteAlert" class="button is-primary float-right">Delete</button>
            </div>
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
                empty: true,
        }
    },

    props: ['alertId', 'alertName', 'keywords'],

    methods: {

        getAlertPosts() {
            this.errors = ''
            if (this.open) {
                this.open = false
                return
            }
            this.empty = false
            this.open = true
            this.isLoading = true
            axios.get('/alerts/posts/'+this.alertId)
                    .then(results => {
                        this.posts = results.data
                        if (this.posts.length == 0) {
                            this.empty = true
                        }
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
                        this.active = false
                        this.$emit("update")
                    })
                    .catch(e => {
                        $this.errors = 'Something went wrong please try again'
                    })
        }
    },
}
</script>

<style lang="scss">
@import '~bulma/sass/utilities/_all';

.results {
    display: flex;
    flex-direction: column;
}

.no-results {
    padding: 10px;
    color: $red;
}

.post-title {
  grid-column: span 2;
  padding: 5px;
  background-color: $blue;

  a {
    color: white;
  }
}

.all-posts {
    float: left;
}

.title-link {
    width: 100%;
    justify-content: left;
}

.box {
    margin-bottom: .5em;
}

.match {
    float: left;
    width: 100%;
    margin-bottom: 10px;
}

.delete-alert {
    float: right;
}

.fade-enter-active {
    transition: opacity 1s;
}

.fade-enter {
    opacity: 0;
}

.delete-confirmation {
    margin-bottom: 5px;
}
</style>