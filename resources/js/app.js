
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
//09054772564

require('./bootstrap');
import Vue from 'vue/dist/vue.common.js'
window.Vue = Vue;

import VueRouter from 'vue-router';
import { Form, HasError, AlertError } from 'vform';
import VueSweetalert2 from 'vue-sweetalert2';
 
 //import Datetime from 'vue-datetime';
//import 'vue-datetime/dist/vue-datetime.css';
 import datePicker from 'vue-bootstrap-datetimepicker';
  import 'pc-bootstrap4-datetimepicker/build/css/bootstrap-datetimepicker.css';
  Vue.use(datePicker);
window.datePicker = datePicker;


// Vue.use(Datetime);
// window.Datetime = Datetime;
const options = {
  confirmButtonColor: '#41b882',
  cancelButtonColor: '#ff7674'
}
 
Vue.use(VueSweetalert2, options);

window.axios = require('axios');
window.swal = VueSweetalert2;
window.Form = Form;
window.email = "";
window.username = "";

// window.Fire = Fire;
Vue.use(VueRouter)
// Vue.config.devtools = false;

let Fire = new Vue();
window.Fire = Fire;



let routes = [
  { path: '/dashboard', component: require('./components/dashboard.vue').default },
  { path: '/queue', component: require('./components/queue.vue').default },
  { path: '/assigncard', component: require('./components/assigncard.vue').default },
  { path: '/medicalhistory', component: require('./components/medicalhistory.vue').default },
  { path: '/profiles', component: require('./components/profiles.vue').default },
  { path: '/doctors', component: require('./components/doctors.vue').default },
  { path: '/users', component: require('./components/users.vue').default },
  { path: '/patientrecord/:user_id', name: 'patientrecord', component: require('./components/patientrecord.vue').default },
  { path: '/recorddetails/:record_id', name: 'recorddetails', component: require('./components/recorddetails.vue').default },
  { path: '/logout', component: require('./components/logout.vue').default }
  
]

const router = new VueRouter({
	mode: 'history',
  routes // short for `routes: routes`
})
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue').default
);
// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))



/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({

    el: '#app',
    router
});
