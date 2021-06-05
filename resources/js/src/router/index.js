import vue from 'vue'
import VueRouter from 'vue-router'

import routes from './routes'

vue.use(VueRouter)

export const router = new VueRouter({
  mode: 'history',
  base: 'lab-laravel-vue2',
  routes
})