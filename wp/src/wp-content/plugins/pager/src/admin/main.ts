import { createApp } from 'vue'
import App from './App.vue'
import store from './store'

const app = createApp(App)

app.config.globalProperties.$pager = pager

app.use(store)

app.mount('#pager-admin-app')

