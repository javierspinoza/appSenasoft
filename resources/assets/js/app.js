/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('roles', require('./components/roles.vue'));

Vue.component('tenan', require('./components/tenans.vue'));
Vue.component('persona', require('./components/Personas.vue'));
Vue.component('bodega', require('./components/Bodegas.vue'));
// Vue.component('user', require('./components/User.vue'));



Vue.component('producto', require('./components/Productos.vue'));
// Vue.component('sucursales', require('./components/Sucursales.vue'));

// Vue.component('personas', require('./components/Personas.vue'));
// Vue.component('productos', require('./components/Productos.vue'));
Vue.component('sucursales', require('./components/sucursales.vue'));
// Vue.component('tenans', require('./components/Tenans.vue'));
// Vue.component('bodage', require('./components/Bodage.vue'));
// Vue.component('facturas', require('./components/Facturas.vue'));
// Vue.component('entradas', require('./components/Entradas.vue'));



const app = new Vue({
    el: '#app',
    data: {
        menu: 0
    }
});