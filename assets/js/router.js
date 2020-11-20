import VueRouter from "vue-router";
import Vue from "vue";
import App from "./components/App";
import PackageComponent from "./components/PackageComponent";
import LevelComponent from "./components/LevelComponent";

Vue.use(VueRouter);

const routes = [
    {
        path: "/",
        name: "home",
        component: App
    },
    {
        path: "/package/:id",
        name: "package",
        component: PackageComponent
    },
    {
        path: "/level",
        name: "level",
        component: LevelComponent
    }
];

const router = new VueRouter({
    mode: "history",
    // base: process.env.BASE_URL,
    routes
});

export default router;
