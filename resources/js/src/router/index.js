import vue from 'vue'
import VueRouter from 'vue-router'
import routes from './routes'

vue.use(VueRouter)

const routerInstanci = new VueRouter({
  mode: 'history',
  base: 'lab-laravel-vue2',
  routes
})


routerInstanci.beforeEach((to, from, next) => {
  // if (!from.name && store.state.login == false) {
  //   return next('/login')
  // }
  
  // // redirect to login page if not logged in and trying to access a restricted page
  // const publicPages = ['/login', '/signup']
  // const authRequired = !publicPages.includes(to.path)
  // const loggedIn = localStorage.getItem('user')
  // if (authRequired && !loggedIn) {
  //   return next('/login')
  // }
  next()
})



export const router = routerInstanci