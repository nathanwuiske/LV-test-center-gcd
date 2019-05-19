import VueRouter from 'vue-router';
import Vue from 'vue';

window.Vue = require('vue');
Vue.use(VueRouter)

/* Establish application routes for nav links on the side menu */
let routes = [
    { path: '/dashboard', component: require('./components/Dashboard.vue').default },
    { path: '/home', component: require('./components/Dashboard.vue').default },
    { path: '/users', component: require('./components/Users.vue').default },
    { path: '/vouchers', component: require('./components/Vouchers.vue').default },
    { path: '/categories', component: require('./components/Categories.vue').default },
    { path: '/tags', component: require('./components/Tags.vue').default },
    { path: '/archived', component: require('./components/Archived.vue').default },
    { path: '/reports', component: require('./components/Reports.vue').default },
    { path: '/messages', component: require('./components/Messages.vue').default },
    { path: '/locations', component: require('./components/Locations.vue').default },
    { path: '/business', component: require('./components/Business.vue').default },
    { path: '*', component: require('./components/NotFound.vue').default }
  ];

const router = new VueRouter({
    routes, 
    mode: 'history',
    linkActiveClass: 'active' /* If the nav link is selected, highlight it */
})

export default router;
