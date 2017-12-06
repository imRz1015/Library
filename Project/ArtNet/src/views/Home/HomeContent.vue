<style lang="scss" scoped>
.swiper-container {
    width: 100%;
    height: 420px;
    margin-top: 68px;
    position: relative;
    z-index: 0;
}
</style>
<template>
    <div id="homeContent">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <div class="swiper-slide" v-for="str in listImg" :key="str.url" :style="{ backgroundImage: 'url(' + str.url + ')' }"></div>
            </div>
            <div class="swiper-pagination swiper-pagination-white"></div>
        </div>
    </div>
</template>
<script>
import Swiper from "swiper";
import "swiper/dist/css/swiper.min.css";
export default {
    data() {
        return {
            listImg: [
                { url: "/static/img/bg1.jpg" },
                { url: "/static/img/bg2.jpg" },
                { url: "/static/img/bg3.jpg" },
                { url: "/static/img/bg4.jpg" }
            ]
        };
    },
    mounted() {
        var swiper = new Swiper(".swiper-container", {
            pagination: ".swiper-pagination",
            paginationClickable: true,
            loop: true,
            speed: 600,
            autoplay: 1000,
            onTouchEnd: function() {
                swiper.startAutoplay();
            }
        });
    }
};
</script>


