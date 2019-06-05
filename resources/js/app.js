
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

// require('./jquery-3.2.1.min.js');

window.Vue = require('vue');

window.axios = require('axios');


window.$ = require('jquery');
var dt = require('datatables.net-responsive-bs4');
window.$.DataTable = dt;
require('datatables.net-buttons')();
require( 'datatables.net-buttons/js/buttons.colVis.js' )();
require( 'datatables.net-buttons/js/buttons.html5.js' )(); 
require( 'datatables.net-buttons/js/buttons.flash.js' )(); 
require( 'datatables.net-buttons/js/buttons.print.js' )(); 
require( 'datatables.net-buttons/js/buttons.print.js' )(); 
//var $  = require( 'jquery' );
// var dt3 = require( 'datatables.net-bs4')();
//var dt = require( 'datatables.net-responsive-bs4')();
//var buttons = require( 'datatables.net-buttons-bs4')();


// var dt = require( 'datatables.net-buttons-bs4' )();


//window.$ = window.jQuery = require('jquery');

// window.$ = window.jQuery = require('jquery');

// import $ from 'jquery';

// window.$ = window.jQuery = $;

// var $ = require('jquery');
// var dt = require('datatables.net-bs4')(window, $);
// var buttons = require('datatables.net-buttons-bs4')(window, $);
//window.DataTable = require('datatables.net-bs4');

import BootstrapVue from 'bootstrap-vue'

Vue.use(BootstrapVue);
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('login-component', require('./components/auth/Login.vue').default);
Vue.component('encuesta-vendedor-cliente-edit-component', require('./components/encuestas.vendedor/cliente_edit.vue').default);
Vue.component('encuesta-existencia-edit-component', require('./components/encuesta.existencia/edit.vue').default);
Vue.component('encuesta-existencia-vendedor-store-component', require('./components/encuesta.existencia/vendedor/store.vue').default);
Vue.component('encuesta-existencia-vendedor-edit-component', require('./components/encuesta.existencia/vendedor/edit.vue').default);
Vue.component('encuesta-precio-vendedor-store-component', require('./components/encuesta.precio/vendedor/store.vue').default);
Vue.component('encuesta-precio-vendedor-edit-component', require('./components/encuesta.precio/vendedor/edit.vue').default);
Vue.component('encuesta-ambigua-vendedor-edit-component', require('./components/encuesta.ambigua/vendedor/edit.vue').default);
Vue.component('encuesta-ambigua-vendedor-store-component', require('./components/encuesta.ambigua/vendedor/store.vue').default);
Vue.component('cliente-index-component', require('./components/cliente/index.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app'
});
