import { createApp } from 'vue'
import App from './App.vue'

const app = createApp(App)

app.config.globalProperties.$pager = pager

app.mount('#pager-admin-app')

