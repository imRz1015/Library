<style lang="scss" scoped>
$headerBg: #000;
$height: 68px;
$navWidth: 100px;
input {
    border: none;
    outline: none;
    background-color: transparent;
}
// flex布局函数；使用方式：@include flexUi;
@mixin flexUi($justify:flex-start) {
    display: flex;
    display: -webkit-flex;
    -webkit-justify-content: $justify;
    justify-content: $justify;
    -webkit-align-items: center;
    align-items: center;
}
//导航 移入 出现横线函数
@mixin navLine {
    width: $navWidth;
    height: $height;
    cursor: pointer;
    box-sizing: border-box;
    border-bottom: 5px solid transparent;
    @include flexUi(center);
    &:hover {
        font-weight: bold;
        border-bottom-color: currentColor;
    }
}
.main {
    position: relative;
    width: 100%;
}
.fixedClass {
    position: fixed;
    top: 0;
    left: 0;
    z-index: 500;
}
//头部 盒子样式
header {
    user-select: none;
    position: relative;
    z-index: 1000;
    @include flexUi;
    min-width: 1028px;
    height: $height;
    background-color: $headerBg;
    padding-left: 40px;
    box-shadow: 0 -1px 8px 1px #333;
    //logo盒子
    .logo {
        color: #fff;
        @include navLine;
        font-size: 22px;
        letter-spacing: 1px;
    }
    //导航
    nav {
        color: #fff;
        margin: 0 80px;
        @include flexUi;
        div {
            @include navLine;
            margin-right: 50px;
            letter-spacing: 1px;
        }
        div:last-child {
            margin-right: 0px;
        }
    }
    //当前页面与导航的对应样式
    .actived {
        font-weight: bold;
        border-bottom-color: currentColor;
    }
    //搜索 icon
    .search_iconBox {
        padding: 5px;
        cursor: pointer;
        .iconfont {
            color: #fff;
            font-size: 22px;
        }
    }
    // 购物车 icon
    .icon-gouwuche-01 {
        color: #fff;
        font-size: 22px;
        margin-left: 150px;
        cursor: pointer;
    }

    //登陆、注册
    .login_res {
        position: absolute;
        right: 10px;
        width: 100px;
        height: 36px;
        color: #000;
        text-align: center;
        line-height: 36px;
        background-color: #fff;
        border-radius: 4px;
        letter-spacing: 3px;
        cursor: pointer;
    }
    .logined {
        position: absolute;
        right: 50px;
        width: 30px;
        padding: 30px 10px;
        color: #000;
        cursor: pointer;
        &:hover .caidan {
            // display: block;
        }
        img {
            width: 30px;
            display: block;
            border-radius: 50%;
        }
        .caidan {
            display: none;
            position: absolute;
            top: 80px;
            left: -60px;
            width: 140px;
            border-radius: 5px;
            border: 1px solid #d8d8d8;
            background-color: #fff;
            &:hover {
                display: block;
            }
            &::before {
                content: "";
                position: absolute;
                top: -9px;
                left: 55%;
                width: 15px;
                height: 15px;
                border-left: 1px solid #d8d8d8;
                border-top: 1px solid #d8d8d8;
                transform: rotateZ(45deg);
                background-color: #fff;
            }
            li {
                padding-left: 20px;
                border-bottom: 1px solid #eee;
                font-size: 16px;
                color: #666;
                line-height: 50px;
                &:last-child {
                    border-bottom: 1px solid transparent;
                }
                &:hover {
                    color: #3c948b;
                    font-weight: bold;
                }
            }
        }
    }
}
//搜索框
.searchBox {
    position: absolute;
    z-index: 100;
    width: 100%;
    height: $height;
    left: 0;
    text-align: center;
    background-color: rgba(255, 255, 255, 0.95);
    box-shadow: 0 1px 1px 1px #eee;
    input {
        display: block;
        width: 400px;
        height: $height;
        margin: 0 auto;
        font-size: 20px;
        color: #000;
        letter-spacing: 2px;
        &::-webkit-input-placeholder {
            font-size: 18px;
            color: inherit;
            letter-spacing: inherit;
            padding-left: 15px;
        }
    }
}

//切换 搜索icon的过渡效果
.icon-fade-enter-active,
.icon-fade-leave-active {
    transition: all 0.25s;
}
.icon-fade-enter,
.icon-fade-leave-to {
    opacity: 0;
    transform: translateX(5px);
}
//切换 搜索框的过渡效果
.search-fade-enter-active,
.search-fade-leave-active {
    transition: transform 0.5s;
}
.search-fade-enter,
.search-fade-leave-to {
    transform: translateY(-$height - 2px);
}
</style>
<template>
    <div class="main" :class="{fixedClass:this.$route.path==='/index'}">
        <header>
            <router-link to="/index" tag="div" class="logo" active-class="actived">艺言</router-link>
            <nav>
                <router-link v-for="i in navList" :key="i.name" :to="i.toSrc" tag="div" active-class="actived">{{i.name}}</router-link>
            </nav>
            <!-- 搜索icon 框 -->
            <!-- <div class="search_iconBox" @click="isSearch=!isSearch">
                <transition name="icon-fade" mode="out-in">
                    <div key="search" v-if="isSearch">
                        <i class="iconfont icon-search"></i>
                    </div>
                    <div key="close" v-else>
                        <i class="iconfont icon-icon"></i>
                    </div>
                </transition>
            </div> -->
            <!-- 购物车icon -->
            <router-link to="/shopcar" tag="div" class="iconfont icon-gouwuche-01" v-if="$store.state.login.loginID"></router-link>
            <!-- 登录/注册 -->
            <router-link v-if="$store.state.login.loginID===null" to="/login" tag="div" class="login_res">登录/注册</router-link>
            <!-- 用户登录了，显示头像，移入显示菜单 -->
            <div class="logined" v-else>
                <img :src="'/static/userimg/'+$store.state.login.userimg+'.png'" alt="用户头像">
                <ul class="caidan">
                    <li v-for="i in txList" :key="i.name">{{i.name}}</li>
                    <li @click="tuichu">退出</li>
                </ul>
            </div>
        </header>
        <!-- 搜索框 -->
        <transition name="search-fade">
            <div class="searchBox" v-if="!isSearch">
                <input @keydown.enter="searchFun" type="text" autofocus placeholder="搜索艺术家或艺术品" v-model="searchValue">
            </div>
        </transition>
    </div>
</template>
<script>
export default {
    data() {
        return {
            //导航数据
            navList: [
                {
                    name: "畅所艺言",
                    toSrc: "/originalart"
                },
                // {
                //     name: "DEMO",
                //     toSrc: "/demo"
                // },
                // {
                //     name: "藏艺术",
                //     toSrc: "/hideart"
                // },
                // {
                //     name: "我的珍藏",
                //     toSrc: "/mycollection"
                // }
            ],
            //是否显示搜索框
            isSearch: true,
            //搜索框的值
            searchValue: "",
            // 头像上的菜单
            txList: [
                {
                    name: "会员中心"
                },
                {
                    name: "我的订单"
                },
                {
                    name: "我的购物车"
                }
            ]
        };
    },
    methods: {
        //输入框查询
        searchFun() {
            let val = this.searchValue.trim();
            if (val) {
                console.log(val);
                this.searchValue = "";
            } else {
                console.log("请输入something");
            }
        },
        // 退出
        tuichu() {
            this.$store.state.login.loginID = null;
            this.$store.state.login.userimg = null;
            this.$router.push("/index");
        }
    }
};
</script>



