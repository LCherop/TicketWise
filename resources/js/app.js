import './bootstrap';
import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import { createPinia } from 'pinia';
import Toast from "vue-toastification";

const app = createApp(App);
const pinia = createPinia();

app.use(router);
app.use(Toast);
// app.use(DataTables);
app.use(pinia);
// app.use(Multiselect)

app.mount('#app');