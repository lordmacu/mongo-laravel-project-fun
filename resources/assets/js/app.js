
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import vSelect from 'vue-select'
import VueLazyLoad from 'vue-lazyload'
import VueTouch from 'vue-touch'

Vue.use(VueLazyLoad)
Vue.use(VueTouch, { name: 'v-touch' })
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('individual-site', require('./components/IndividualSite.vue'));
Vue.component('v-select', vSelect)
const app = new Vue({
    el: '#app'
});
