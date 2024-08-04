import { createRouter, createWebHistory } from "vue-router";

import home from '../components/HomePage.vue';
import login from '../components/Login.vue';
import register from '../components/Register.vue';
import courses from '../components/Courses.vue';
import Showcourse from '../components/Showcourse.vue';
import cart from '../components/Cart.vue';
import profile from '../components/Profile.vue';
import ProfileCertificates from '../components/ProfileCertificates.vue';
import ProfileCourses from '../components/ProfileCourses.vue';
import contact from '../components/Contact.vue';
import about from '../components/About.vue';
import notFoundPage from '../components/NotFoundPage.vue';
import checkOutSuccess from '../components/checkOutSuccess.vue';
import Search from '../components/Search.vue';

const routes = [
    {
        path: '/',
        component: home
    },
    {
        path: '/login',
        component: login
    },
    {
        path: '/register',
        component: register
    },
    {
        path: '/courses',
        component: courses
    },
    {
        path: "/courses/show-content/:id",
        component: Showcourse,
    },
    {
        path: '/cart',
        component: cart,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/profile',
        component: profile,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/profile/courses',
        component: ProfileCourses,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/profile/certificates',
        component: ProfileCertificates,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/about',
        component: about
    },
    {
        path: '/contact',
        component: contact
    },
    {
        path: '/success',
        component: checkOutSuccess,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/search/:word',
        component: Search,
    },
    {
        path: '/:pathMatch(.*)*',
        component: notFoundPage
    }
];



const router = createRouter({
    history:createWebHistory(),
    routes,
})

router.beforeEach((to, from) => {
    if(to.path != '/login' && to.meta.requiresAuth && !localStorage.token)
        router.push('/login')

    if(to.path == '/login' && localStorage.token)
        router.push('/')

    if(to.path == '/register' && localStorage.token)
        router.push('/')
})

export default router;
