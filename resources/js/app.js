import './bootstrap';

import Vue from 'vue';
import VueRouter from 'vue-router';

import Register from './components/Auth/register.vue';
import Login from './components/Auth/login.vue';
import IbanCreate from './components/IBAN/create.vue';
import AdminDashboard from './components/dashboard.vue';

Vue.use(VueRouter);

const routes = [
    { path: '/api/register', component: Register },
    { path: '/api/login', component: Login },
    { path: '/api/iban', component: IbanCreate, meta: { requiresAuth: true } },
    { path: '/api/iban', component: AdminDashboard, meta: { requiresAdmin: true } },
];

const router = new VueRouter({
    mode: 'history',
    routes
});

router.beforeEach((to, from, next) => {
    const requiresAuth = to.matched.some(record => record.meta.requiresAuth);
    const requiresAdmin = to.matched.some(record => record.meta.requiresAdmin);
    const isAuthenticated = !!localStorage.getItem('token');
    const isAdmin = !!localStorage.getItem('isAdmin');

    if (requiresAuth && !isAuthenticated) {
        next('/api/login');
    } else if (requiresAdmin && !isAdmin) {
        next('/api/login');
    } else {
        next();
    }
});

const app = new Vue({
    el: '#app',
    router,
    render: h => h({ template: '<router-view></router-view>' })
  });
