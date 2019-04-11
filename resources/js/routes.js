import VueRouter from 'vue-router';
import Vue from 'vue';

window.Vue = require('vue');
Vue.use(VueRouter)

let routes = [
    { path: '/dashboard', component: require('./components/Dashboard.vue').default },
    { path: '/users', component: require('./components/Users.vue').default },
    { path: '/vouchers', component: require('./components/Vouchers.vue').default }
  ];

const router = new VueRouter({
    routes, // short for `routes: routes`
    linkActiveClass: 'active'
})

export default router;