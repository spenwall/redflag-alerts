require('./bootstrap');

window.Vue = require('vue');
import AlertPosts from './components/AlertPosts.vue'
import Modal from './components/Modal.vue'
import CreateAlert from './components/CreateAlert.vue'


Vue.component('alert-posts', AlertPosts)
Vue.component('modal', Modal)
Vue.component('create-alert', CreateAlert)

const app = new Vue({
    el: '#app',
    components: { AlertPosts, Modal, CreateAlert },
});
