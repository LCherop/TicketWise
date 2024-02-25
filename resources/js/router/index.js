import { createRouter, createWebHashHistory } from 'vue-router';
import App from '../App.vue';
const routes = [
    {
        path: '/',
        name: 'app',
        component: App
    },
    {
        path: '/login',
        name: 'login',
        component: ()=> import('../components/Login.vue')
    },
    {
        path: '/signup',
        name: 'signup',
        component: ()=> import('../components/Register.vue')
    },
    {
        path: '/forgot-password',
        name: 'forgot-password',
        component: () => import('../components/ForgotPassword.vue')
    },
    {
        path: '/profile',
        name: 'profile',
        component: () => import('../components/Profile.vue')
    },
]

const router = createRouter({
    history: createWebHashHistory(),
    routes
  })

export default router;