/* Dependacies */
require('./bootstrap');
import router from './routes.js';
import { Form, HasError, AlertError } from 'vform'
import moment from 'moment'
import swal from 'sweetalert2'

/* Sweetalert */
window.swal = swal;

/* Custom Vue event */
window.Fire = new Vue();

/* Pagination for vouchers table */
Vue.component('pagination', require('laravel-vue-pagination'));

/* Get access to vform globally */
window.Form = Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

/* Vue filters */
/* Format the dates in the vouchers table to something more readable */
Vue.filter('formatDate', function(expiryDate){
    return moment(expiryDate).format('MMMM Do YYYY, h:mm a');
});

/* Create a fresh Vue application instance and attach it to the page. */
const app = new Vue({
    el: '#app',
    router
});


//Vue.component('test-component', require('./components/Vouchers.vue').default);
