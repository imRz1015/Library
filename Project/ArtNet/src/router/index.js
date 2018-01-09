import Vue from "vue";
import Router from "vue-router";
import index from "@/pages/index";
import originalart from "@/pages/originalart";
import goodsdetails from "@/pages/goodsdetails";
import login from "@/pages/login";
import shopcar from "@/pages/shopcar";
import goumai from "@/pages/goumai";
import xiadan from "@/pages/xiadan";
import zhifu from "@/pages/zhifu";
import demo from "@/pages/demo";

Vue.use(Router);

export default new Router({
    mode: "history",
    routes: [
        { path: "/", redirect: "/index" },
        {
            path: "/index",
            component: index
        },
        {
            path: "/originalart",
            component: originalart
        },
        {
            path: "/goodsdetails/:id/imgSrc/:img",
            component: goodsdetails
        },
        {
            path: "/login",
            component: login
        },
        {
            path: "/shopcar",
            component: shopcar
        },
        {
            path: "/demo",
            component: demo
        },
        {
            path: "/goumai/:status",
            component: goumai,
            children: [
                {
                    path: "xiadan",
                    component: xiadan
                },
                {
                    path: "zhifu",
                    component: zhifu
                }
            ]
        }
    ],
    scrollBehavior(to, from, savedPosition) {
        return { x: 0, y: 0 };
    }
});
