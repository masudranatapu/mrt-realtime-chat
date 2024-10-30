import './bootstrap'
import { createApp } from 'vue'

const app = createApp({})

import Chat from './components/Chat.vue'
app.component('chat-component', Chat)

app.mount('#app')
