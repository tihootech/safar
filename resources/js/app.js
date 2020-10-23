/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('dashboard-manager', require('./components/DashboardManager.vue').default);

Vue.mixin({
  methods: {
    persianDate: enDateString => new Date(enDateString).toLocaleDateString('fa-IR'), // convert date to persian
    getTime: dateString => new Date(dateString).toLocaleTimeString(), // extract time in date string
    boolIcon : value => value ? '<i class="mdi mdi-check text-success">' : '<i class="mdi mdi-close text-danger">' // return check icon or close icon based on a boolean value
  }
})

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#vue-app',
});
