<style lang="scss" scoped>
@mixin flexUi($justify:flex-start) {
    display: flex;
    display: -webkit-flex;
    -webkit-justify-content: $justify;
    justify-content: $justify;
    -webkit-align-items: center;
    align-items: center;
}
.main {
    max-width: 960px;
    margin: 0 auto;
    // 顶部 4个状态
    .topStatus {
        @include flexUi(center);
        margin-top: 70px;
        li {
            @include flexUi(center);
            position: relative;
            color: #fff;
            margin-left: 140px;
            span {
                width: 60px;
                height: 60px;
                font-size: 18px;
                text-align: center;
                line-height: 60px;
                background-color: #c0c0c0;
                border-radius: 50%;
            }
            &::after,
            &::before {
                content: "";
                position: absolute;
                top: 50%;
                left: -50px;
                margin-top: -6px;
                width: 12px;
                height: 12px;
                background-color: #c0c0c0;
                border-radius: 50%;
            }
            &::after {
                left: -90px;
            }
            &:first-child {
                margin-left: 0;
                &::after,
                &::before {
                    display: none;
                }
            }
        }
        .currStatus {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            border: 1px solid #000;
            span {
                background-color: #000;
            }
            &::after,
            &::before {
                background-color: #000;
            }
        }
    }
}
</style>
<template>
    <div class="main">
        <!-- 顶部 4个状态 -->
        <ul class="topStatus">
            <li v-for="(i,index) in topStatus" :class="{currStatus:index<$route.params.status[0]}" :key="i">
                <span>{{i}}</span>
            </li>
        </ul>
        <router-view/>
    </div>

</template>
<script>
export default {
    data() {
        return {
            // 顶部4个状态
            topStatus: ["下单", "支付", "寄送", "完成"]
        };
    },
    mounted() {
        console.log("mounted");
    }
};
</script>


