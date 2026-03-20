import { createApp } from 'vue'
import router from './router'
import App from './App.vue'
import '../css/app.css'

if ('scrollRestoration' in window.history) {
  window.history.scrollRestoration = 'manual'
}

const app = createApp(App)

app.use(router)
app.mount('#app')
