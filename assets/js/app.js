// assets/js/app.js
import Vue from 'vue';
import App from './components/App'
/**
 * Create a fresh Vue Application instance
 */
import VueRouter from "vue-router";
import router from "./router";

Vue.use(VueRouter);

new Vue({
    el: '#app',
    router,
    components: {App}
});