// src/router/index.js
import Vue from 'vue';
import VueRouter from 'vue-router';
import MainComponent from '../components/MainComponent.vue';
import AssistantComponent from '../components/AssistantComponent.vue';
import Diagnosis from '../components/DiagnosisComponent.vue';

Vue.use(VueRouter);

const routes = [
  {
    path: '/',
    name: 'MainComponent',
    component: MainComponent,
  },
  {
    path: '/diagnosis',
    name: 'Diagnosis',
    component: Diagnosis,
  },
];

const router = new VueRouter({
  mode: 'history', // Use history mode for clean URLs without hash (#)
  routes,
});

export default router;
