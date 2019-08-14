/* Dependencies */
require('./bootstrap');
import router from './routes.js';
import { Form, HasError, AlertError } from 'vform'
import moment from 'moment'
import swal from 'sweetalert2'
import { Datetime } from 'vue-datetime';
import 'vue-datetime/dist/vue-datetime.css'
import VueProgressBar from 'vue-progressbar'
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css';

/* Loading animation for Admin Panel */
Vue.component('loading', Loading)

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
    return moment(expiryDate).format('Do MMMM YYYY');
});
/* Capitalize the first character */
Vue.filter('capitalize', function (text) {
    if (!text) return ''
    text = text.toString()
    return text.charAt(0).toUpperCase() + text.slice(1)
});

/* Remove https://, http:// and www. from the start of URLs */
Vue.filter('cleanURL', function (url) {
    if (!url) return ''
    url = url.replace(/^(?:https?:\/\/)?(?:www\.)?/i, "");
    return url
});

/* Create a fresh Vue application instance and attach it to the page. */
const app = new Vue({
    el: '#app',
    router
});
