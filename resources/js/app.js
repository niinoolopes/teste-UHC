// require('./bootstrap');

import Vue from 'vue'
import App from './src/App.vue'

import { store } from './src/store'
import { router } from './src/router'

new Vue({
  store,
  router,
  el: '#app',
  render: (h) => h(App),
});