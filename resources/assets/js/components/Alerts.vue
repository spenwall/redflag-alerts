<template>
    <div>
        <div class="alerts">
            <alert-posts v-for="alert in alerts" :key="alert.id" 
                    @update="update"
                    :alert-id="alert.id" 
                    :alert-name="alert.name" 
                    :keywords="alert.keywords">
            </alert-posts>
        </div>
        <add-alert @update="update"></add-alert>
    </div>
</template>


<script>
import AlertPosts from './AlertPosts.vue'
import AddAlert from './AddAlert.vue'

export default {
    components: {
            'alert-posts': AlertPosts,
            'add-alert': AddAlert
    },

    data() {
        return {
            alerts: []
        }
    },

    mounted() {
        this.getAlerts() 
    },

    methods: {
        update() {
            this.getAlerts()
        },

        getAlerts() {
            axios.get('/alerts')
                .then(results => this.alerts = results.data)
                .catch(e => {
                    if (e.response.status === 401) {
                            window.location.replace('/');
                        }
                    this.errors = e;
                });
        }
    }
}
</script>

<style>
.alerts {
    display: grid;
    grid-gap: 1px;
}
</style>
