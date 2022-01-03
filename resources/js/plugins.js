
import Vue from 'vue';
window.Fire=new Vue();

// SweetAlert 2
import Swal from "sweetalert2";
window.swal=Swal;
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})
window.toast=Toast;

//v-form
import Form from 'vform';
window.Form=Form;

// Bootstrap Vue

import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'

// Import Bootstrap an BootstrapVue CSS files (order is important)
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

// Make BootstrapVue available throughout your project
Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)


// Moment and create filter
import moment from "moment";
Vue.filter('myDate', function (date){
    return moment(date).format('MMMM Do YYYY');
});
