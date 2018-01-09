<style lang="scss" scoped>
.content {
    display: flex;
    justify-content: space-between;
    width: 5000px;
    transition: margin-left 1s;
    .item {
        position: relative;
        left: 0;
        right: 0;
        margin: 0 auto;
        width: 320px;
        height: 380px;
        background-image: url("/static/special/art_and_design.jpg");
        background-size: 440px 100%;
        background-position: center;
        background-repeat: no-repeat;
        transition: width 0.5s;
        .info {
            width: 320px;
            height: 100%;
            color: #fff;
            transition: padding 0.5s;
            background-color: rgba(0, 0, 0, 0.2);
        }
        .cover {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }
    }
}
</style>
<template>
    <div class="main">
        <div class="content" ref="content">
            <div class="item" v-for="i in 14" :key="i">
                <div class="info">
                    <p>周而复始 | 给摩羯的生日礼物</p>
                    <p>黑色、墨绿色和咖啡色是摩羯的专属幸运色，这三种颜色大气沉稳，一定会俘获摩羯的心，给摩羯新的一年带来幸运。</p>
                </div>
                <div class="cover" @mouseover="zhankai" @mouseout="suohui"></div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    methods: {
        zhankai(e) {
            // e.target.parentNode.style.width = "440px";
            e.target.previousSibling.previousSibling.style.padding = "0 60px";
            this.$refs.content.style.marginLeft="-60px";
        },
        suohui(e) {
            // e.target.parentNode.style.width = "320px";
            e.target.previousSibling.previousSibling.style.padding = "0 0";
            this.$refs.content.style.marginLeft="0";
            
        }
    }
};
</script>


