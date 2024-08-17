import './bootstrap';
import { createApp } from 'vue';
import ExampleComponent from './components/ExampleComponent.vue';

// Create Vue application instance
const app = createApp({});

// Register component globally
app.component('example-component', ExampleComponent);

// Mount Vue app to DOM
app.mount('#app');