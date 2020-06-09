import Home from './components/Home.vue';
import Register from './components/Register.vue';
import Login from './components/Login.vue';
import Account from './components/Account.vue';
import About from './components/About.vue';
import Contact from './components/Contact.vue';
import Edit from './components/Edit.vue';
import Pass from './components/Pass.vue';
export const routes = [
    {
        path: '/',
        name: 'home',
        component: Home
    },
    {
        path: '/register',
        name: 'register',
        component: Register,
    },
    {
        path: '/login',
        name: 'login',
        component: Login,
    },
    {
        path: '/account',
        name: 'account',
        component: Account,
        meta: {
            requiresAuth: true
        },
    },
    {
        path: '/edit/:id',
        name: 'edit',
        component: Edit,
        meta: {
            requiresAuth: true
        },
    },
    {
        path: '/changePassword/:id',
        name: 'changePassword',
        component: Pass,
        meta: {
            requiresAuth: true
        },
    },
    {
        path: '/about',
        name: 'about',
        component: About,
    },
    {
        path: '/contact',
        name: 'contact',
        component: Contact,
    },
];