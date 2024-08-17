import './bootstrap';
import { createApp } from 'vue';
import AssistantComponent from './components/AssistantComponent.vue';

// Create Vue application instance
const app = createApp({});

// Register component globally
app.component('assistant-component', AssistantComponent);

// Mount Vue app to DOM
app.mount('#app');
