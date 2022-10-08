import { createRouter, createWebHistory, RouteRecordRaw } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import TasksView from '../views/TasksView.vue'
import SignIn from '@/views/SignIn.vue'
import DepartmentStructure from '@/views/Admin/DepartmentStructure.vue'
import AdminCoins from '@/views/Admin/AdminCoins.vue'

const routes: Array<RouteRecordRaw> = [
  // auth
  {
    path: '/sign-in',
    name: 'Sign In',
    component: SignIn,
    meta: {
      layout: 'auth',
    },
  },

  {
    path: '/',
    name: 'home',
    component: HomeView,
  },
  {
    path: '/tasks',
    name: 'Tasks',
    component: TasksView,
  },

  //  admin routes
  {
    path: '/departments',
    name: 'Admin Departments',
    component: DepartmentStructure,
    meta: {
      layout: 'admin',
    },
  },
  {
    path: '/coins',
    name: 'Admin Coins',
    component: AdminCoins,
    meta: {
      layout: 'admin',
    },
  },
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
})

// router.beforeEach((to) => {
//   if (
//     // !userStore.checkAuth() &&
//     to.name !== 'Sign In'
//   ) {
//     return { name: 'Login' }
//   }
// })

export default router
