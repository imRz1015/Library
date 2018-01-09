<style lang="scss" scoped>
@mixin flexUi($justify:flex-start) {
    display: flex;
    display: -webkit-flex;
    -webkit-justify-content: $justify;
    justify-content: $justify;
    -webkit-align-items: center;
    align-items: center;
}
footer {
    width: 1200px;
    height: 90px;
    margin: 0 auto;
    padding-bottom: 20px;
    .line {
        @include flexUi(space-between);
        user-select: none;
        ul {
            flex: 1;
            @include flexUi;
            margin-left: 27px;
            li {
                margin-right: 7.5%;
                cursor: pointer;
            }
        }
        .logo {
            font-size: 26px;
            font-weight: 600;
        }
    }
    p {
        margin-top: 40px;
        font-size: 12px;
        color: #666;
        text-align: center;
    }
}
</style>
<template>
    <footer>
        <div class="line">
            <ul>
                <router-link v-for="i in footerList" :key="i.name" :to="i.toSrc" tag="li">{{i.name}}</router-link>
            </ul>
            <div class="logo">
                <i>艺言</i>
            </div>
        </div>
        <p>川HZQ备19941025号 Copyright © 1994-2117 艺言 LOCALHOST.COM 版权所有</p>
    </footer>
</template>
<script>
export default {
    data() {
        return {
            footerList: [
                {
                    name: "艺言",
                    toSrc: "/index"
                },
                {
                    name: "畅所艺言",
                    toSrc: "/originalart"
                },
                // {
                //     name: "造艺",
                //     toSrc: "/makeArt"
                // },
                // {
                //     name: "藏艺术",
                //     toSrc: "/hideArt"
                // },
                // {
                //     name: "我的珍藏",
                //     toSrc: "/myCollection"
                // }
            ]
        };
    }
};
</script>


