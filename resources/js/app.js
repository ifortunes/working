import './bootstrap';
import '../css/app.css';

// import { createStore } from 'vuex'

import store from "./store/advertisement"

import { Quasar } from 'quasar'
import quasarLang from 'quasar/lang/ru'

// Import icon libraries
import '@quasar/extras/material-icons/material-icons.css'

// Import Quasar css
import 'quasar/dist/quasar.css'

import { createApp } from 'vue/dist/vue.esm-bundler.js';

import App from "./components/layouts/app.vue"

const app = createApp({})

app.use(Quasar, {
    plugins: {}, // import Quasar plugins and add here
    lang: quasarLang,
})

// app.use(createStore)
app.use(store)

app.component('App', App)

app.mount('#app')
