//Dependacies
require('./bootstrap');
import VueRouter from 'vue-router'
window.Vue = require('vue');

Vue.use(VueRouter)


/* TODO: seperate into different routes file */
let routes = [
  { path: '/dashboard', component: require('./components/Dashboard.vue').default },
  { path: '/users', component: require('./components/Users.vue').default },
  { path: '/vouchers', component: require('./components/Vouchers.vue').default }
];

const router = new VueRouter({
  routes, // short for `routes: routes`
  linkActiveClass: 'active'
})

//Vue.component('example-component', require('./components/Dashboard.vue').default);
//Vue.component('test-component', require('./components/Vouchers.vue').default);

// Create a fresh Vue application instance and attach it to the page.
const app = new Vue({
    el: '#app',
    router
});
