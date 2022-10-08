import { createRouter, createWebHistory, RouteRecordRaw } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import TasksView from '../views/TasksView.vue'
import SignIn from '@/views/SignIn.vue'
import DepartmentStructure from '@/views/Admin/DepartmentStructure.vue'

const routes: Array<RouteRecordRaw> = [
  {
    path: '/',
    name: 'home',
    component: HomeView,
  },
  {
    path: '/sign-in',
    name: 'Sign In',
    component: SignIn,
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
