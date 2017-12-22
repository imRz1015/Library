<style lang="scss" scoped>
#goods {
    @mixin flex($justify) {
        display: flex;
        display: -webkit-flex;
        justify-content: $justify;
        -webkit-justify-content: $justify;
        align-items: center;
        -webkit-align-items: center;
    }
    padding-top: 68px;
    .screen {
        @include flex(space-between);
        .left {
            @extend .screen;
            .price,
            .size,
            .color,
            .shape {
                @include flex(space-between);
                margin-top: 60px;
                position: relative;
                padding-left: 100px;
                span {
                    font-size: 14px;
                    margin-right: 50px;
                    font-weight: bold;
                }
                div {
                    width: 74px;
                    height: 16px;
                    position: relative;
                    cursor: pointer;
                    background-color: #ddd;
                    margin-left: 2px;
                    &:hover {
                        background-color: #b0b0b0;
                    }
                    &:first-of-type {
                        i {
                            left: -5px;
                        }
                    }
                    &:last-child {
                        width: 0;
                        i {
                            left: -15px;
                        }
                    }
                    i {
                        position: absolute;
                        top: 18px;
                        left: -25px;
                        font-size: 12px;
                        color: #666;
                        font-style: inherit;
                        width: 0;
                        height: 0;
                    }
                }
                &:first-child {
                    margin-top: 30px;
                }
            }

            .color {
                @include flex(flex-start);
                div {
                    border: 2px solid transparent !important;
                    box-sizing: border-box;
                    &:last-child {
                        width: 74px;
                    }
                    &:hover {
                        opacity: 0.7 !important;
                    }
                }
                .red {
                    background-color: #e73233 !important;
                }
                .yellow {
                    background-color: #ffea03 !important;
                }
                .green {
                    background-color: #32cc66 !important;
                }
                .blue {
                    background-color: #0099ff !important;
                }
                .gray {
                    overflow: hidden;
                    background-color: #fff;
                    background-image: url(/static/img/B_W_G.png);
                    background-repeat: no-repeat;
                    background-position: center;
                    background-size: 74px 16px;
                }
            }
        }
    }
    .goodsContainer {
        width: 1176px;
        margin: 100px auto 0;
        position: relative;
        .good {
            width: 300px;
            min-height: 100px;
            float: left;
            padding: 0 46px 80px;
            img {
                width: 100%;
                cursor: pointer;
                &:hover {
                    box-shadow: 0 0 10px #8e8e8e;
                }
            }
            .intro {
                padding: 10px 20px;
                font-size: 12px;
                line-height: 18px;
                .artist,
                .price {
                    color: #000;
                    font-weight: 600;
                }
                .artist {
                    margin-bottom: 8px;
                }
                .goodInfo {
                    font-weight: 500;
                    color: #666;
                }
                .price {
                    margin: 10px 0 20px;
                }
            }
        }
    }
}
</style>

<template>
    <div id="goods">
        <div class="screen">
            <div class="left">
                <div class="params">
                    <div class="price">
                        <span>价格</span>
                        <div v-for="(i,index) in prices">
                            <i>{{i | changePrice}}</i>
                        </div>
                    </div>
                    <div class="size">
                        <span>尺寸</span>
                        <div v-for="(i,index) in size">
                            <i>{{i | changeSize}}</i>
                        </div>
                    </div>
                    <div class="color">
                        <span>颜色</span>
                        <div v-for="i in color" :class="[i]"></div>
                    </div>
                    <div class="shape">
                        <span>形状</span>
                    </div>
                </div>
                <div class="classify">
                </div>
            </div>
        </div>
        <div class="goodsContainer" v-if="lists.length" ref="parentBox">
            <div class="good" v-for="(i,index) in lists">
                <img :src="'/static/img/'+i.images+'.jpg'" @load="over++,waterFall()">
                <div class="intro ">
                    <p class="artist ">{{i.artist}}</p>
                    <p class="goodInfo ">{{i.name}}，{{i.time}}</p>
                    <p class="goodInfo ">{{i.classify}}&nbsp;&nbsp;{{i.size.x}}x{{i.size.y}}cm</p>
                    <p class="price ">￥{{Math.floor((i.price/1000))}},{{i.price%1000}}</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            over: 0,
            lists: [],
            prices: [0, 2000, 8000, 15000, 30000, "max"],
            size: [0, 50, 100, 150, 200, "max"],
            color: ["red", "yellow", "green", "blue", "gray"]
        };
    },
    filters: {
        changePrice(val) {
            if (typeof val === "number") {
                if (!val) {
                    return 0;
                } else {
                    return `￥${val / 1000},000`;
                }
            } else {
                return "max";
            }
        },
        changeSize(val) {
            if (typeof val === "number") {
                if (!val) {
                    return 0;
                } else {
                    return `${val}cm`;
                }
            } else {
                return "max";
            }
        }
    },
    methods: {
        waterFall() {
            if (this.over == this.lists.length - 1) {
                var boxHeight = []; //用来装第一行高度的数组
                var cols = 3; //每行的个数
                var childArr = document.querySelectorAll(".good");
                for (var n = 0; n < childArr.length; n++) {
                    if (n < cols) {
                        boxHeight.push(childArr[n].offsetHeight);
                    } else {
                        var minHeight = Math.min.apply(null, boxHeight);
                        var minIndex = null;
                        for (var i = 0; i < boxHeight.length; i++) {
                            if (boxHeight[i] == minHeight) {
                                minIndex = i;
                                break;
                            }
                        }
                        childArr[n].style.position = "absolute";
                        childArr[n].style.top = minHeight + "px";
                        childArr[n].style.left =
                            childArr[minIndex].offsetLeft + "px";
                        boxHeight[minIndex] =
                            boxHeight[minIndex] + childArr[n].offsetHeight;
                    }
                }
            }
        }
    },
    mounted() {
        this.$http.get("/api/getList").then(data => {
            this.lists = data.data.data;
        });
    }
};
</script>


