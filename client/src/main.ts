import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import { createPinia } from 'pinia'
import egalWidgets from '@egalteam/widget-library'

import '@egalteam/widget-library/dist/style.css'
import '@/assets/style/global.scss'

const pinia = createPinia()

// @ts-ignore
createApp(App).use(router).use(pinia).use(egalWidgets).mount('#app')
