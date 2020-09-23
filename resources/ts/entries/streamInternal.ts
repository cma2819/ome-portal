/* eslint no-new: off, @typescript-eslint/explicit-function-return-type: off */

import Vue from 'vue';
import vuetify from '../plugins/vuetify';
import store from '../plugins/store';
import router from '../plugins/router';
import i18n from '../plugins/i18n';
import App from '../app/OmeApp.vue';
import StreamInternalApp from '../app/StreamInternalApp.vue';

import 'vuetify/dist/vuetify.min.css';
import '@fortawesome/fontawesome-free/css/all.css';

Vue.component('ome-app', App);
Vue.component('stream-internal-app', StreamInternalApp);

new Vue({
  vuetify,
  store,
  router,
  i18n,
  el: '#app'
});
