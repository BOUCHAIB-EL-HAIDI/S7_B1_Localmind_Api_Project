import { createRouter, createWebHistory } from 'vue-router';
import { useAuthStore } from '../stores/auth';
import Home from '../components/Home.vue';
import QuestionList from '../components/questions/QuestionList.vue';
import QuestionDetail from '../components/questions/QuestionDetail.vue';
import CreateQuestion from '../components/questions/CreateQuestion.vue';
import EditQuestion from '../components/questions/EditQuestion.vue';
import Login from '../components/auth/Login.vue';
import Register from '../components/auth/Register.vue';
import Favorites from '../components/user/Favorites.vue';
import Profile from '../components/user/Profile.vue';

const routes = [
    {
        path: '/',
        name: 'Home',
        component: Home
    },
    {
        path: '/questions',
        name: 'Questions',
        component: QuestionList
    },
    {
        path: '/questions/create',
        name: 'CreateQuestion',
        component: CreateQuestion
    },
    {
        path: '/questions/:id',
        name: 'QuestionDetail',
        component: QuestionDetail,
        props: true
    },
    {
        path: '/questions/edit/:id',
        name: 'EditQuestion',
        component: EditQuestion,
        props: true,
        meta: { requiresAuth: true }
    },
    {
        path: '/login',
        name: 'Login',
        component: Login
    },
    {
        path: '/register',
        name: 'Register',
        component: Register
    },
    {
        path: '/favorites',
        name: 'Favorites',
        component: Favorites,
        meta: { requiresAuth: true }
    },
    {
        path: '/profile',
        name: 'Profile',
        component: Profile,
        meta: { requiresAuth: true }
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

router.beforeEach((to, from, next) => {
    const auth = useAuthStore();
    if (to.meta.requiresAuth && !auth.isAuthenticated) {
        next('/login');
    } else {
        next();
    }
});

export default router;
