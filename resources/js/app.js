require('./bootstrap');
import Vue from 'vue';
import VueRouter from 'vue-router';
import Vuex from 'vuex';
import VeeValidate, {Validator} from 'vee-validate';
import hy from "vee-validate/dist/locale/hy";
import {routes} from './routes.js';
import storeData from './stores/store.js';
import MainApp from './components/MainApp.vue';
import {getPromiseResult} from './partials/help';

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
router.afterEach((to, from) => {
    let currentUser = JSON.parse(localStorage.getItem('user'));
    if (currentUser) {
        let credentials = {
            id: currentUser.id,
            token: currentUser.token,
            url: 'getstatus',
            auth: true
        };
        getPromiseResult(credentials)
            .then(res => {
                if (res.status.status !== 'approved') {
                    localStorage.clear();
                    location.reload();
                }
            })
            .catch(error => {
                console.log(error)
            });
    }
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

