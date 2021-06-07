import Login from '../pages/Login'
import Home from '../pages/Home'
import Task from '../pages/Task'
import Perfil from '../pages/Perfil'

export default [
  {
    path: '/',
    name: 'Login',
    component: Login
  },
  {
    path: '/home',
    name: 'Home',
    component: Home
  },
  {
    path: '/task/:id?',
    name: 'Task',
    component: Task
  },,
  {
    path: '/perfil',
    name: 'Perfil',
    component: Perfil
  },
]