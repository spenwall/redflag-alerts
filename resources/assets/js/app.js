require('./bootstrap');

window.Vue = require('vue');
import Alert from './components/Alert.vue'
import Modal from './components/Modal.vue'
import CreateAlert from './components/CreateAlert.vue'


Vue.component('alert', Alert)
Vue.component('modal', Modal)
Vue.component('create-alert', CreateAlert)

const app = new Vue({
    el: '#app',
    components: { Alert, Modal, CreateAlert },
});
