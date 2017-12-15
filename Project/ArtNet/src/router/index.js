import Vue from "vue";
import Router from "vue-router";
import Home from "@/views/Home";
import HomeContent from "@/views/Home/HomeContent";
import Login from "@/views/Login";


Vue.use(Router);

export default new Router({
    routes: [
        { path: "/", redirect: "/Login" },
        {
            path: "/Home",
            component: Home,
            children: [{ path: "HomeContent", component: HomeContent }]
        },
        { path: "/Login", component: Login }
    ]
});
