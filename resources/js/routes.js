import Home from './components/Home.vue';
import Register from './components/Register.vue';
import Login from './components/Login.vue';
import Dashboard from './components/Dashboard.vue';
import About from './components/About.vue';
import Contact from './components/Contact.vue';
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
        path: '/dashboard',
        name: 'dashboard',
        component: Dashboard,
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