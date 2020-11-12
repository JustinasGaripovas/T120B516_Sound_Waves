import VueRouter from "vue-router";
import Vue from "vue";
import App from "./components/App";
import LevelComponent from "./components/LevelComponent";
import PackageComponent from "./components/PackageComponent";

Vue.use(VueRouter);

const routes = [
    {
        path: "/package/:id",
        name: "package",
        component: PackageComponent
    }
];

const router = new VueRouter({
    mode: "history",
    // base: process.env.BASE_URL,
    routes
});

export default router;
