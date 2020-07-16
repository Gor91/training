import Home from './components/Home.vue';
import Register from './components/Register.vue';
import Login from './components/Login.vue';
import Account from './components/Account.vue';
import About from './components/About.vue';
import Contact from './components/Contact.vue';
import Edit from './components/Edit.vue';
import ForgotPassword from './pages/ForgotPassword';
import ResetPasswordForm from './pages/ResetPasswordForm';
import Lesson from './components/Lesson.vue';

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
        path: '/about',
        name: 'about',
        component: About,
        meta: {
            breadCrumbs: [{
                to: '/about', // hyperlink
                text: 'ՄԵՐ ՄԱՍԻՆ' // crumb text
            }]
        },
    },
    {
        path: '/contact',
        name: 'contact',
        component: Contact,
        meta: {
            breadCrumbs: [{
                to: '/contact', // hyperlink
                text: 'ՀԵՏԱԴԱՐՁ ԿԱՊ' // crumb text
            }]
        },
    },
    {
        path: '/lesson',
        name: 'lesson',
        component: Lesson,
        meta: {
            breadCrumbs: [{
                to: '/lesson', // hyperlink
                text: 'ԴԱՍԸՆԹԱՑՆԵՐ' // crumb text
            }]
        },
    },
    {
        path: '/reset-password',
        name: 'reset-password',
        component: ForgotPassword,
        meta: {
            auth: false
        }
    },
    {
        path: '/reset-password/:token',
        name: 'reset-password-form',
        component: ResetPasswordForm,
        meta: {
            auth: false
        }
    }
];