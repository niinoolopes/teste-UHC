require('bootstrap/js/dist/modal.js')

import Vue from 'vue'
import App from './src/App.vue'

import { store } from './src/store'
import { router } from './src/router'


// https://github.com/Jebasuthan/Vue-Facebook-Google-oAuth
// import GoogleAuth from './src/config/authGoogle'
// const gauthOption = {
//   clientId: '1085217040510-u95lg3eg8so8hgtun4t0b56ni98mn828.apps.googleusercontent.com',
//   clientSecret: '1s1i8U3W80dXO6-KXbo_i_aN',
// }
// Vue.use(GoogleAuth, gauthOption)


new Vue({
  store,
  router,
  el: '#app',
  render: (h) => h(App),
});