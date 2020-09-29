import Vue from 'vue';
import VueRouter from 'vue-router';
import SignIn from '../components/SignIn';
import SignUp from '../components/SignUp';

Vue.use(VueRouter);

const routes = [
    {
        path: '/login',
        name: 'signin',
        component: SignIn
    },
    {
        path: '/register',
        name: 'signup',
        component: SignUp,
        props: true
    }
];

const router = new VueRouter(
    {
        routes,
    }
);

export default router;