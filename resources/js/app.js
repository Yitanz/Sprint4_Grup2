require('./bootstrap');

window.Vue = require('vue');

Vue.component('example-component', require('./components/formulari.vue').default);

const app = new Vue({
    el: '#app'
});
