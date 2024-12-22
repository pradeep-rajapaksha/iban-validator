import './bootstrap';

import { createApp } from 'vue';
import router from './router';
import store from './store';

import App from './App.vue';

router.beforeEach((to, from, next) => {
    const requiresAuth = to.matched.some(record => record.meta.requiresAuth);
    const isAuthenticated = !!localStorage.getItem('access_token');
    // const isAdmin = localStorage.getItem('is_admin') == 'true';	

    if (requiresAuth && !isAuthenticated) {
        next('/login');
    } else {
        next();
    }
});

const app = createApp(App);
      app.use(router);
      app.use(store);
      app.mount('#app');
