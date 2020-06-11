/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router';
import { BootstrapVue } from 'bootstrap-vue';
import { Form, HasError, AlertError } from 'vform';
import moment from "moment";
import VueProgressBar from 'vue-progressbar';
import Gate from "./Gate";

Vue.prototype.$gate = new Gate(window.user)
window.Form = Form;

import Swal from 'sweetalert2'
window.Swal = Swal;
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    onOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})
window.Toast =Toast;
// components
import Dashbord from "./components/Dashbord";
import Profile from "./components/Profile";
import Users from "./components/Users";
import Clients from "./components/passport/Clients";
import AuthorizedClients from "./components/passport/AuthorizedClients";
import PersonalAccessTokens from "./components/passport/PersonalAccessTokens";
import NotFound from "./components/NotFound";
import Home from "./components/Home";


// Install BootstrapVue
Vue.use(BootstrapVue)
Vue.use(VueRouter)
Vue.use(VueProgressBar, {
    color: 'rgb(29,243,8)',
    failedColor: 'red',
    height: '10px'
})
import SmartTable from 'vuejs-smart-table'

Vue.use(SmartTable)

Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

Vue.component('pagination', require('laravel-vue-pagination'));


let routes = [
    { path: '/Dashbord', component: Dashbord },
    { path: '/Users', component: Users },
    { path: '/Profile', component:Profile },
    { path: '/home', component:Home },
    { path: '*', component:NotFound },

]

const router = new VueRouter({
    mode: 'history',
    routes // short for `routes: routes`
})

Vue.filter('upText', function(text){
    return text.charAt(0).toUpperCase() + text.slice(1)
});

Vue.filter('myDate',function(created){
    return moment(created).format('MMMM Do YYYY');
});


window.Fire= new Vue();
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


Vue.component(
    'passport-clients',
    Clients.default
);

Vue.component(
    'passport-authorized-clients',
    AuthorizedClients.default
);

Vue.component(
    'passport-personal-access-tokens',
    PersonalAccessTokens.default
);
Vue.component(
    'not-found',
    NotFound
);

const app = new Vue({
    el: '#app',
    router,
    data:{
        search:''
    },
    methods:{
        searchit: _.debounce(() => {
            Fire.$emit('searching');
        } ,1000)


    }
});
