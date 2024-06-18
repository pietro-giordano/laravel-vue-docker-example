import { createRouter, createWebHashHistory } from "vue-router";

import Homepage from './pages/Homepage.vue';
import ShowTask from './pages/ShowTask.vue';
import CreateTask from './pages/CreateTask.vue';
import UpdateTask from './pages/UpdateTask.vue';

const router = createRouter({
    history: createWebHashHistory(),
    routes: [
        {
            path: '/',
            name: 'homepage',
            component: Homepage
        }, {
            path: '/show/:id',
            name: 'show',
            component: ShowTask
        }, {
            path: '/create',
            name: 'create',
            component: CreateTask
        }, {
            path: '/update/:id',
            name: 'update',
            component: UpdateTask
        },
    ]
});

export { router };