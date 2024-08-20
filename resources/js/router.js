import { createRouter, createWebHistory } from "vue-router";

const routes = [
    {
        path: "/diagnosis",
        component: () => import("./components/DiagnosisComponent.vue"),
    },
    {
        path: "/assessment",
        component: () => import("./components/AssessmentComponent.vue"),
    },
];

export default createRouter({
    history: createWebHistory(),
    routes,
});
