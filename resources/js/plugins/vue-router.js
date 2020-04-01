import store from '../store/index';

import Vue from 'vue';
import VueRouter from 'vue-router';

import Home from '../pages/Home';
import Register from '../pages/Register';
import Login from '../pages/Login';
import RegisterUser from '../pages/RegisterUser';
import Profile from '../pages/Profile';
import Person from '../pages/Person';
import Help from '../pages/Help';
import Inquiries from '../pages/Inquiries';
import AGB from '../pages/AGB';
import Impressum from '../pages/Impressum';
import Datenschutz from '../pages/Datenschutz';

Vue.use(VueRouter);

const router = new VueRouter({
    routes: [
        {
            path: '*',
            redirect: 'home',
        }, {
            path: '/home',
            component: Home,
            name: 'home',
        }, {
            path: '/agb',
            component: AGB,
            name: 'agb',
        },{
            path: '/impressum',
            component: Impressum,
            name: 'impressum',
        }, {
            path: '/datenschutz',
            component: Datenschutz,
            name: 'datenschutz',
        }, {
            path: '/login',
            component: Login,
            name: 'login',
        }, {
            path: '/register-user',
            component: RegisterUser,
            name: 'register-user',
        }, {
            path: '/register',
            component: Register,
            name: 'register',
            meta: {
                authUser: true,
            }
        }, {
            path: '/help',
            component: Help,
            name: 'help',
        }, {
            path: '/profile',
            component: Profile,
            children: [
                {
                    path: '',
                    component: Person,
                    meta: {
                        authUser: true,
                    }
                }, {
                    path: 'inquiries',
                    component: Inquiries,
                    name: 'profile.inquiries',
                    meta: {
                        authUser: true,
                    }
                }, {
                    path: 'person',
                    component: Person,
                    name: 'profile.person',
                    meta: {
                        authUser: true,
                    }
                }
            ],
        },
    ],
});

router.beforeEach((to, from, next) => {
    if (_.has(to, 'meta.authUser')) {
        if (to.meta.authUser === true && store.getters['user/isLoggedIn'] === true) {
            next();
        }
        else {
            next({name: 'login'});
        }
    }
    else {
        next();
    }
});

export default router;
