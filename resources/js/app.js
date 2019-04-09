//Dependacies
require('./bootstrap');
import VueRouter from 'vue-router'
window.Vue = require('vue');

Vue.use(VueRouter)


/* TODO: seperate into different routes file */
let routes = [
  { path: '/example', component: require('./components/ExampleComponent.vue').default },
  { path: '/test', component: require('./components/Test.vue').default }
];

const router = new VueRouter({
  routes, // short for `routes: routes`
  linkActiveClass: 'active'
})

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('test-component', require('./components/Test.vue').default);

// Create a fresh Vue application instance and attach it to the page.
const app = new Vue({
    el: '#app',
    router
});
