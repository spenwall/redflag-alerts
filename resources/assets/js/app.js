require('./bootstrap');

window.Vue = require('vue');
import Alerts from './components/Alerts.vue'
import Modal from './components/Modal.vue'
import CreateAlert from './components/CreateAlert.vue'


Vue.component('alerts-view', Alerts)
Vue.component('modal', Modal)
Vue.component('create-alert', CreateAlert)

const app = new Vue({
    el: '#app',
});
