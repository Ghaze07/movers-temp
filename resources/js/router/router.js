import Vue from 'vue';
import VueRouter from 'vue-router';
import SignIn from '../components/SignIn';
import SignUp from '../components/SignUp';
import MobileVerification from '../components/MobileVerification';

Vue.use(VueRouter);

const routes = [
    {
        path: '/signin',
        name: 'signin',
        component: SignIn
    },
    {
        path: '/signup',
        name: 'signup',
        component: SignUp,
        props: true
    },
    {
        path: '/mobile_verification',
        name: 'mobile_verification',
        component: MobileVerification,
        props: true
    }
];

const router = new VueRouter(
    {
        routes,
    }
);

export default router;