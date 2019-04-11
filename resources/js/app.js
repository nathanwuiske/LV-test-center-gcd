//Dependacies
require('./bootstrap');
import router from './routes.js';


//Vue.component('example-component', require('./components/Dashboard.vue').default);
//Vue.component('test-component', require('./components/Vouchers.vue').default);

// Create a fresh Vue application instance and attach it to the page.
const app = new Vue({
    el: '#app',
    router
});
