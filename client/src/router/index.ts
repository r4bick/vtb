import { createRouter, createWebHistory, RouteRecordRaw } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import TasksView from '../views/TasksView.vue'
import SignIn from '@/views/SignIn.vue'
import ShopView from '@/views/ShopView.vue'

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
  {
    path: '/shop',
    name: 'Shop',
    component: ShopView,
  },
  {
    path: '/team',
    name: 'Team',
    component: () => import('@/views/TeamView.vue'),
  },

  //  admin routes
  {
    path: '/admin',
    name: 'Admin Profile',
    component: () => import('@/views/Admin/AdminMain.vue'),
    meta: {
      layout: 'admin',
    },
  },
  {
    path: '/departments',
    name: 'Admin Departments',
    component: () => import('@/views/Admin/DepartmentStructure.vue'),
    meta: {
      layout: 'admin',
    },
  },
  {
    path: '/admin-tasks',
    name: 'Admin Tasks',
    component: () => import('@/views/Admin/AdminTasks.vue'),
    meta: {
      layout: 'admin',
    },
  },
  // {
  //   path: '/admin-shop',
  //   name: 'Admin Shop',
  //   component: () => import('@/views/Admin/AdminShop.vue'),
  //   meta: {
  //     layout: 'admin',
  //   },
  // },
  {
    path: '/coins',
    name: 'Admin Coins',
    component: () => import('@/views/Admin/AdminCoins.vue'),
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
