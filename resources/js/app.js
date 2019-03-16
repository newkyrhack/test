require('./bootstrap');

window.Vue = require('vue');
window.swal = require('sweetalert2');
import VueRouter from 'vue-router'
import routes from './routes'

import es from 'vee-validate/dist/locale/es';
import VeeValidate, { Validator } from 'vee-validate';
Vue.use(VeeValidate);
Validator.localize('es', es);



Vue.use(VueRouter)
Vue.component('index', require('./components/IndexComponent.vue').default);
Vue.component('pagination', require('laravel-vue-pagination'));


const router = new VueRouter({
    routes,
    mode:'history'
  })

const app = new Vue({
    el: '#app',
    router
});
