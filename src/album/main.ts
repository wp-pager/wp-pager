import { createApp } from 'vue'
import App from '@album/App.vue'
import store from './store'
import 'toastify-js/src/toastify.css'

const app = createApp(App)

app.config.globalProperties.$pager = pager

app.use(store)

app.mount('#pager-album-app')