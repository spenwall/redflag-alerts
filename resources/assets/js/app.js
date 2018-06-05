require('bulma');
require('animate.css');

window.axios = require('axios');
window.Vue = require('vue');

import Alerts from './components/Alerts.vue';
import Modal from './components/Modal.vue';
import CreateAlert from './components/CreateAlert.vue';
import AddAlert from './components/AddAlert.vue';


Vue.component('alerts-view', Alerts);
Vue.component('modal', Modal);
Vue.component('create-alert', CreateAlert);
Vue.component('add-alert', AddAlert);


const app = new Vue({
    el: '#app',

    data: {
    
        showBurger: false

    }

});
