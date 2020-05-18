require('./bootstrap');

window.Vue = require('vue');
window.axios = require('axios');
window.toastr = require('toastr');

Vue.component('tienda-component', require('./components/Tienda.vue').default);
Vue.component('ctienda-component', require('./components/CrearTienda.vue').default);

const app = new Vue({
    el: '#app',
});
