/* Dependencies */
require('./bootstrap');
import router from './routes.js';
import { Form, HasError, AlertError } from 'vform'
import moment from 'moment'
import swal from 'sweetalert2'
import { Datetime } from 'vue-datetime';
import 'vue-datetime/dist/vue-datetime.css'
import VueProgressBar from 'vue-progressbar'

/* Vue progress bar */
Vue.use(VueProgressBar, {
    color: 'rgb(143, 255, 199)',
    failedColor: 'red',
    height: '5px'
  })

/* Datetime formatter */
Vue.component('datetime', Datetime);

/* Sweetalert */
window.swal = swal;

/* Moment date formatter */
window.moment = require('moment');

/* Custom Vue event */
window.Fire = new Vue();

/* Pagination  */
Vue.component('pagination', require('laravel-vue-pagination'));

/* Get access to vform globally */
window.Form = Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

/* Vue filters */
/* Format the dates in the vouchers table to something more readable */
Vue.filter('formatDate', function(expiryDate){
    return moment(expiryDate).format('MMMM Do YYYY, h:mm:ss a');
});
/* Capitalize the first character */
Vue.filter('capitalize', function (text) {
    if (!text) return ''
    text = text.toString()
    return text.charAt(0).toUpperCase() + text.slice(1)
});

/* Create a fresh Vue application instance and attach it to the page. */
const app = new Vue({
    el: '#app',
    router
});
