<template>
    <div class="alerts">
        <alert-posts v-for="alert in alerts" :key="alert.id" 
                :alert-id="alert.id" 
                :alert-name="alert.name" 
                :keywords="alert.keywords">
        </alert-posts>
    </div>
</template>

<script>
import AlertPosts from './AlertPosts.vue'

export default {
    components: {
            'alert-posts': AlertPosts
    },

    data() {
        return {
            alerts: []
        }
    },

    mounted() {
       axios.get('/alerts/show')
            .then(results => this.alerts = results.data)
            .catch(e => this.errors = e) 
    }
}
</script>

<style>
.alerts {
    display: grid;
    grid-gap: 1px;
}
</style>
