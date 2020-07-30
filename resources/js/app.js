require('./bootstrap');
import Vue from 'vue';
import VueRouter from 'vue-router';
import Vuex from 'vuex';
import VeeValidate, {Validator} from 'vee-validate';
import hy from "vee-validate/dist/locale/hy";
import {routes} from './routes.js';
import storeData from './store.js';
import MainApp from './components/MainApp.vue';

Validator.localize({hy: hy});
const config = {
    locale: 'hy'
};

Vue.use(VeeValidate, config);


Vue.use(VueRouter);
Vue.use(Vuex);

const router = new VueRouter({
    routes,
    mode: 'history'
});

const store = new Vuex.Store(storeData);

const app = new Vue({
    el: '#app',
    router,
    store,
    components: {
        MainApp
    }
});
