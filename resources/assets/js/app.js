
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import Vue from 'vue';

Vue.use(VeeValidate);

//bad practice, Why !? . Because https://vuejsdevelopers.com/2017/04/22/vue-js-libraries-plugins/
//Vue.prototype._ = _;

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import timestamp from './components/timestamp/index.vue';



const app = new Vue({
    el: '#app',
    components: { timestamp }
});
