<style lang="scss" scoped>
@mixin flex($justify) {
    display: flex;
    display: -webkit-flex;
    justify-content: $justify;
    -webkit-justify-content: $justify;
    align-items: center;
    -webkit-align-items: center;
}
@mixin changeColor($cl,$bg) {
    &:hover {
        cursor: pointer;
        color: $cl;
        background-color: $bg;
    }
}
$white: #fff;
$black: #000;
$height: 68px;
header {
    @mixin hoverStyle($weight) {
        &:hover {
            border-bottom: 5px solid $white;
            box-sizing: border-box;
            font-weight: $weight;
        }
    }
    $min-width: 100px;
    position: relative;
    z-index: 6;
    height: $height;
    line-height: $height;
    padding: 0 20px;
    color: $white;
    background-color: rgb(36, 41, 46);
    user-select: none;
    text-align: center;
    box-shadow: 0px 2px 5px #3c3c3c;
    @include flex(flex-start);
    .first {
        margin-left: 80px;
    }
    .icon-logo {
        // @include hoverStyle(0);
        @include changeColor(#81c0c0,transprant);
        font-size: 30px;
        transition: color 0.3s linear;
        width: $min-width;
        height: $height;
        cursor: pointer;
    }
    .nav {
        height: $height;
        min-width: $min-width;
        margin-right: 60px;
        cursor: pointer;
        @include hoverStyle(900);
    }
    .search {
        cursor: pointer;
        font-size: 20px;
        color: $white;
    }
    .login {
        @include flex(center);
        height: 40px;
        margin-left: 25vw;
        padding: 0 8px;
        background-color: $white;
        border-radius: 4px;
        color: $black;
        transition: all 0.3s linear;
        @include changeColor($white,#81c0c0 );
    }
    .changeAnimation {
        transform: rotate(90deg);
        transition: all 0.5s ease;
    }
    .backAnimation {
        transform: rotate(-45deg);
        transition: all 0.5s ease;
    }
}
.searchInput {
    width: 100%;
    position: absolute;
    left: 0;
    top: 68px;
    z-index: 5;
    @include flex(center);
    height: $height;
    background-color: #fff;
    input {
        // width: 42%;
        border: none;
        background-color: transparent;
        outline: none;
        color: $black;
        font-size: 24px;
        &::-webkit-input-placeholder {
            color: $black;
        }
    }
}
.fade-enter-active,
.fade-leave-active {
    transition: all 0.5s;
}
.fade-enter,
.fade-leave-to {
    // height: 0px;
    transform: translateY(-68px);
}
.isFixed {
    width: 100%;
    position: fixed;
    top: 0;
    left: 0;
    z-index: 5;
}
</style>

<template>
    <div id="header">
        <div :class="{isFixed:fixed}">
            <header>
                <router-link tag="i" to="/Home/HomeContent" class="iconfont icon-logo"></router-link>
                <router-link tag="div" to="/Home/Goods" class="nav first">原创艺术</router-link>
                <div class="nav">造艺</div>
                <div class="nav">藏艺术</div>
                <div class="nav">我的珍藏</div>
                <i class="search iconfont" :class="search" @click="openSearchInput"></i>
                <router-link tag="div" to="/login" class="login">Push to Start</router-link>
            </header>
            <transition name="fade">
                <div class="searchInput" v-show="searched">
                    <input type="text" ref="searchInput" @blur="searched=false;" placeholder="Search Artist or Works?">
                </div>
            </transition>
        </div>
        <router-view />
    </div>
</template>

<script>
export default {
    data() {
        return {
            fixed: true,
            search: "icon-sousuo1",
            searched: false
        };
    },
    methods: {
        openSearchInput() {
            if (this.search == "icon-sousuo1") {
                this.searched = true;
                setTimeout(() => {
                    this.$refs.searchInput.focus();
                }, 10);
            } else {
                this.searched = false;
            }
        }
    },
    watch: {
        searched(val) {
            if (val) {
                this.search = "icon-icon changeAnimation";
            } else {
                this.search = "icon-icon backAnimation";
                setTimeout(() => {
                    this.search = "icon-sousuo1";
                }, 500);
            }
        }
    }
};
</script>
