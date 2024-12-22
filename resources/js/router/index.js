import { createRouter, createWebHistory } from 'vue-router';

import Register from '../components/Auth/Register.vue';
import Login from '../components/Auth/Login.vue';
import IbanCreate from '../components/IBAN/Create.vue';
import Dashboard from '../components/Dashboard.vue';
import store from '../store';

const routes = [
    { path: '/', name: '/', component: Login },
    { path: '/login', name: 'login', component: Login },
    { path: '/register', name: 'register', component: Register },
    { path: '/iban', name: 'iban', component: IbanCreate, meta: { requiresAuth: true } },
    { path: '/dashboard', name: 'dashboard', component: Dashboard, meta: { requiresAuth: true } },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to, from, next) => {
    const requiresAuth = to.matched.some(record => record.meta.requiresAuth);
    const isAuthenticated = store.getters.isAuthenticated;
  
    if (requiresAuth && !isAuthenticated) {
      next('/login');
    } else {
      next();
    }
});

export default router;
