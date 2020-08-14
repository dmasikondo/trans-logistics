require('./bootstrap');

window.Vue = require('vue');
//import moment from 'moment';
//import swal from 'sweetalert';

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('user-component', require('./components/UserComponent.vue').default);
Vue.component('role-component', require('./components/RoleComponent.vue').default);
Vue.component('user-registration-component', require('./components/UserRegistrationComponent.vue').default);
Vue.component('user-registration-component', require('./components/UserRegistrationComponent.vue').default);
Vue.component('buslocation-component', require('./components/BuslocationComponent.vue').default);
Vue.component('fleet-component', require('./components/FleetComponent.vue').default);
Vue.component('director-component', require('./components/DirectorComponent.vue').default);
Vue.component('traderef-component', require('./components/TraderefComponent.vue').default);


Vue.component(
'passport-clients',
require('./components/passport/Clients.vue').default
);
Vue.component(
'passport-authorized-clients',
require('./components/passport/AuthorizedClients.vue').default
);
Vue.component(
'passport-personal-access-tokens',
require('./components/passport/PersonalAccessTokens.vue').default
);

window.Fire = new Vue();


/*Vue.filter('upText', function(text){
	return text.charAt(0).toUpperCase() + text.slice(1);
});

Vue.filter('myDate', function(created){
	return moment(created).format('MMMM Do YYYY, h:mm:ss a') + ' ' + moment(created).startOf('hour').fromNow();
});
Vue.filter('timeAgo', function(created){
	return  moment(created).startOf('hour').fromNow();
});*/

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
const app = new Vue({
    el: '#app'
});
