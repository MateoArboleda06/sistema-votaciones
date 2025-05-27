// router/index.js
import { createRouter, createWebHistory } from 'vue-router';
import { useAuthStore } from '../store/index';

import Layout from '../views/layouts/Layout.vue';
import Login from '../views/Login.vue';
import Register from '../views/Register.vue';
import Home from '../views/Home.vue';
import Dashboard from '../views/Dashboard.vue';
import QuestionDetail from '../views/questions/QuestionDetail.vue';
import QuestionList from '../views/questions/QuestionList.vue';
import QuestionForm from '../views/questions/QuestionForm.vue';
import VoteResult from '../views/questions/VoteResult.vue';

const routes = [
    { path: '/', redirect: '/inicio' },
    { path: '/login', component: Login },
    { path: '/register', component: Register },
    {
        path: '/',
        component: Layout,
        children: [
            { path: '/inicio', component: Home, meta: { requiresAuth: true } },
            { path: '/admin/dashboard', component: Dashboard, meta: { requiresAuth: true, role: 'administrador' } },
            { path: '/questions', component: QuestionList, meta: { requiresAuth: true } },
            { path: '/questions/:id', component: QuestionDetail, meta: { requiresAuth: true } },
            { path: '/admin/questions/create', component: QuestionForm, meta: { requiresAuth: true, role: 'administrador' } },
            { path: '/admin/results/:id', component: VoteResult, meta: { requiresAuth: true, role: 'administrador' } },
        ]
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach(async (to, from, next) => {

    const auth = useAuthStore();
    
    if (to.meta.requiresAuth && !auth.token) {
        next('/login');
    }

    // redirigir si no tiene el rol requerido
    if (to.meta.role && !auth.user?.roles?.some(r => r.name === to.meta.role)) {
        return next('/');
    }

    next();
});

export default router;
