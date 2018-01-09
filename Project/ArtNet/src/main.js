import Vue from "vue";
import App from "./app";
import router from "./router";
import Axios from "axios";
import VueAxios from "vue-axios";
import store from "./vuex/store";
Vue.use(VueAxios, Axios);
Vue.config.productionTip = false;

new Vue({
    el: "#app",
    router,
    store,
    template: "<App/>",
    components: { App }
});
