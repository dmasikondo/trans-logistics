require('./bootstrap');

window.Vue = require('vue');
import moment from 'moment';
import Swal from 'sweetalert2';
window.Swal = Swal;
window.moment =moment;

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
Vue.component('contact-component', require('./components/ContactComponent.vue').default);
Vue.component('buslocation-component', require('./components/BuslocationComponent.vue').default);
Vue.component('fleet-component', require('./components/FleetComponent.vue').default);
Vue.component('load-component', require('./components/LoadComponent.vue').default);
Vue.component('director-component', require('./components/DirectorComponent.vue').default);
Vue.component('traderef-component', require('./components/TraderefComponent.vue').default);
Vue.component('private-visibility-button', require('./components/load/PrivateVisibilityButton.vue').default);
Vue.component('public-visibility-button', require('./components/load/PublicVisibilityButton.vue').default);
Vue.component('distance-vehicletype', require('./components/load/DistanceVehicletype.vue').default);
Vue.component('delete-load', require('./components/load/DeleteLoad.vue').default);
Vue.component('vehicle-component', require('./components/vehicle/VehicleComponent.vue').default);
Vue.component('delete-vehicle', require('./components/vehicle/DeleteVehicle.vue').default);
Vue.component('vehicle-private-visibility', require('./components/vehicle/VehiclePrivateVisibility.vue').default);
Vue.component('vehicle-public-visibility', require('./components/vehicle/VehiclePublicVisibility.vue').default);
Vue.component('bid-component', require('./components/bid/BidComponent.vue').default);


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


Vue.filter('formatDate', function(date) {
    return moment(date).format('MM/DD/YYYY');
}); 
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
