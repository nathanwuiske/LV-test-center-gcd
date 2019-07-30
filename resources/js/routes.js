import VueRouter from 'vue-router';
import Vue from 'vue';

window.Vue = require('vue');
Vue.use(VueRouter)

/* Establish application routes for nav links on admin side menu */
let routes = [
    { path: '/dashboard', component: require('./components/Dashboard.vue').default },
    { path: '/adminhome', component: require('./components/Dashboard.vue').default },
    { path: '/users', component: require('./components/Users.vue').default },
    { path: '/vouchers', component: require('./components/Vouchers.vue').default },
    { path: '/categories', component: require('./components/Categories.vue').default },
    { path: '/tags', component: require('./components/Tags.vue').default },
    { path: '/archived', component: require('./components/Archived.vue').default },
    { path: '/reports', component: require('./components/Reports.vue').default },
    { path: '/messages', component: require('./components/Messages.vue').default },
    { path: '/locations', component: require('./components/Locations.vue').default },
    { path: '/business', component: require('./components/Business.vue').default }
   // { path: '*', component: require('./components/NotFound.vue').default }
  ];

const router = new VueRouter({
    mode: 'hash', // mode: 'history'
    routes, 
    linkActiveClass: 'active'
})

export default router;
