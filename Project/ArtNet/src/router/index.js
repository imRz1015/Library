import Vue from "vue";
import Router from "vue-router";
import Home from "@/views/Home";
import HomeContent from "@/views/Home/HomeContent";
import Login from "@/views/Login";
import Goods from "@/views/Home/Goods";

Vue.use(Router);

export default new Router({
  routes: [
    { path: "/", redirect: "/Home/HomeContent" },
    {
      path: "/Home",
      component: Home,
      children: [
        { path: "HomeContent", component: HomeContent },
        { path: "Goods", component: Goods }
      ]
    },
    { path: "/Login", component: Login }
  ]
});
