import Vue from 'vue';
import VueRouter from 'vue-router';
import Listing from '../views/Listing.vue';

Vue.use(VueRouter);

const routes = [{
    path: '/',
    name: 'Listing',
    component: Listing
}];

const router = new VueRouter({
    mode: 'history',
    base: process.env.BASE_URL,
    routes
});

export default router;
