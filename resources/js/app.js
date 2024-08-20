import './bootstrap';
import { createApp } from 'vue';
import router from "./router";
import App from "./App.vue";

// Create Vue application instance
const app = createApp(App);

// Mount Vue app to DOM
app.use(router).mount('#app');
