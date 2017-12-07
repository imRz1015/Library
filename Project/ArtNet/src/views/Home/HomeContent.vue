<style lang="scss" scoped>
#homeContent {
    @mixin flex($justify) {
        display: flex;
        display: -webkit-flex;
        justify-content: $justify;
        -webkit-justify-content: $justify;
        align-items: center;
        -webkit-align-items: center;
    }
    position: relative;
    // 轮播部分
    .swipe-container {
        width: 100vw;
        height: 300px;
        margin-top: 68px;
        position: fixed;
        // position: relative;
        z-index: 3;
        text-align: center;
        overflow: hidden;
    }
    .imgStyle {
        position: absolute;
        width: 100vw;
        transition: all 0.5s linear;
        left: 0;
        top: 0;
    }
    .fade-enter-active,
    .fade-leave-active {
        transition: all 1s;
        opacity: 1;
    }
    .fade-enter,
    .fade-leave-to {
        // height: 0px;
        opacity: 0;
    }
    // 轮播部分
    .bodyContent {
        width: 100vw;
        position: absolute;
        top: 310px;
        left: 0;
        // background-color: #2e5f4a;
        z-index: 5;
        .pagenation {
            width: 16%;
            margin-left: 74%;
            padding: 13px 0;
            background-color: rgba($color: #000000, $alpha: 0.3);
            border-radius: 25px;
            @include flex(center);
            .list {
                width: 12px;
                height: 12px;
                border-radius: 50%;
                background-color: #f0f0f0;
                margin-left: 20px;
                &:hover {
                    cursor: pointer;
                    background-color: rgb(59, 172, 161);
                }
                &:first-child {
                    margin-left: 0;
                }
            }
            .currLi {
                background-color: rgb(59, 172, 161) !important;
            }
        }
    }
}
</style>
<template>
    <div id="homeContent">
        <div class="swipe-container">
            <transition name="fade">
                <img v-show="showImg" :src="front" class="imgStyle">
            </transition>
            <transition name="fade">
                <img v-show="!showImg" :src="end" class="imgStyle">
            </transition>
        </div>
        <div class="bodyContent">
            <div class="pagenation" ref="pages">
                <div class="list" :class="{currLi:i==imgIndex}" v-for="i in 6" :key="i" @click="changeImg(i)"></div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            front: "/static/img/bg1.jpg",
            end: "/static/img/bg2.jpg",
            imgIndex: 1,
            showImg: true,
            timer: null
        };
    },
    methods: {
        changeImg(index) {
            clearInterval(this.timer);
            //重复点击判断
            if (this.imgIndex != index) {
                this.showImg = !this.showImg;
                this.showImg
                    ? (this.front = `/static/img/bg${index}.jpg`)
                    : (this.end = `/static/img/bg${index}.jpg`);
                this.imgIndex = index;
            }
            this.timerFun();
        },
        timerFun() {
            this.timer = setInterval(() => {
                let oIndex = this.imgIndex;
                oIndex++ == 6 && (oIndex = 1);
                this.changeImg(oIndex);
            }, 4000);
        }
    },
    mounted() {
        this.timerFun();
    }
};
</script>


