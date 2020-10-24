import Home from './components/Home.vue';
import Register from './components/Register.vue';
import Login from './components/Login.vue';
import Verify from './components/Verify.vue';
import Account from './components/Account.vue';
import About from './components/About.vue';
import Contact from './components/Contact.vue';
import Edit from './components/Edit.vue';
import ForgotPassword from './pages/ForgotPassword';
import ResetPasswordForm from './pages/ResetPasswordForm';
import Lesson from './components/Lesson.vue';
import Coursedetails from './components/Coursedetails.vue';
import Books from './components/Books.vue';
import Payment from './components/Payment.vue';
import Test from './components/Test.vue';


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
        path: '/verify/:id/:key',
        name: 'verify',
        component: Verify,
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
            requiresAuth: true,
            breadCrumbs: [{
                to: '/account', // hyperlink
                text: 'Օգտվողի պրոֆիլ' // crumb text
            }]
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
        path: '/coursedetails/:id',
        name: 'coursedetails',
        component: Coursedetails,
        meta: {
            breadCrumbs: [{
                to: '/coursedetails', // hyperlink
                text: 'ԴԱՍԸՆԹԱՑՆԵՐ' // crumb text
            }]
        },
    },
    {
        path: '/books/:id',
        name: 'books',
        component: Books,
        meta: {
            breadCrumbs: [{
                to: '/books', // hyperlink
                text: 'ԴԱՍԸՆԹԱՑՆԵՐ' // crumb text
            }]
        },
    },
    {
        path: '/test/:id',
        name: 'test',
        component: Test,
        meta: {
            requiresAuth: true,
            breadCrumbs: [{
                to: '/test', // hyperlink
                text: 'ԴԱՍԸՆԹԱՑԻ ՍՏՈՒԳՈՒՄ' // crumb text
            }]
        },
    },
    {
        path: '/reset-password',
        name: 'reset-password',
        component: ForgotPassword,
        meta: {
            auth: false,

        }
    },
    {
        path: '/reset-password/:token',
        name: 'reset-password-form',
        component: ResetPasswordForm,
        meta: {
            auth: false
        }
    },
    {
        path: '/payment',
        name: 'payment',
        component: Payment,
        meta: {
            requiresAuth: true,
            breadCrumbs: [{
                to: '/payment', // hyperlink
                text: 'Վճարում' // crumb text
            }]
        },
    },
];
