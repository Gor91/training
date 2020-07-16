require('./bootstrap');
import Vue from 'vue';
import VueRouter from 'vue-router';
import Vuex from 'vuex';
import VeeValidate, {Validator} from 'vee-validate';
import am from "vee-validate/dist/locale/am";
import {routes} from './routes.js';
import storeData from './store.js';
import MainApp from './components/MainApp.vue';

Validator.localize({am: am});
const config = {
    locale: 'am'
};

Vue.use(VeeValidate, config);

// Vue.use(VeeValidate, {
//     i18nRootKey: "validations", // customize the root path for validation messages.
//     i18n,
//     dictionary: {
//         am
//     }
// });
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
