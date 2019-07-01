import Vue from 'vue';
import Router from 'vue-router';
import Storage from '@/services/Storage';

// async components
const Home = () => import(/* webpackChunkName: "feed" */ './views/Home.vue');
const Cabinet = () => import('./views/Cabinet.vue');

// auth pages using same chunk name
const SignIn = () => import(/* webpackChunkName: "auth" */ './views/SignIn.vue');
const SignUp = () => import(/* webpackChunkName: "auth" */ './views/SignUp.vue');
const ForgotPassword = () => import('./views/ForgotPassword.vue');
const ResetPasswordForm = () => import('./views/ResetPasswordForm.vue');

Vue.use(Router);

const router = new Router({
    mode: 'history',
    base: process.env.BASE_URL,
    routes: [
        {
            path: '/',
            redirect: '/home',
            meta: { requiresAuth: false },
        },
        {
            path: '/home',
            name: 'home',
            component: Home,
            meta: { requiresAuth: false },
        },
        {
            path: '/cabinet',
            name: 'cabinet',
            component: Cabinet,
            meta: { requiresAuth: true },
        },
        {
            path: '/auth/sign-in',
            name: 'auth.signIn',
            component: SignIn,
            meta: { handleAuth: true },
        },
        {
            path: '/auth/sign-up',
            name: 'auth.signUp',
            component: SignUp,
            meta: { handleAuth: true },
        },
        { 
            path: '/reset-password', 
            name: 'reset-password', 
            component: ForgotPassword, 
            meta: { 
                handleAuth:false 
            } 
          },
          { 
            path: '/reset-password/:token', 
            name: 'reset-password-form', 
            component: ResetPasswordForm, 
            meta: { 
                handleAuth:false 
            } 
          }
    ],
    scrollBehavior: () => ({ x: 0, y: 0 }),
});

// check auth routes
router.beforeEach(
    (to, from, next) => {
        const isAuthenticatedRoute = to.matched.some(record => record.meta.requiresAuth);
        const isAuthSectionRoute = to.matched.some(record => record.meta.handleAuth);

        if (isAuthenticatedRoute && !Storage.hasToken()) {
            next({ name: 'auth.signIn' });
            return;
        }

        if (isAuthSectionRoute && Storage.hasToken()) {
            next({ path: '/' });
            return;
        }

        next({ path: to });
    },
);

export default router;
