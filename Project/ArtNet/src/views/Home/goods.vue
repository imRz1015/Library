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
        @mixin flexList($justify,$items) {
            display: flex;
            display: -webkit-flex;
            flex-direction: column;
            -webkit-flex-direction: column;
            justify-content: $justify;
            -webkit-justify-content: $justify;
            align-items: $items;
            -wenkit-align-items: $items;
        }
        border-bottom: 1px solid #eee;

        .left {
            @include flex(space-between);
            .params {
                .isClick {
                    background-color: #000 !important;
                }
                .clickFont {
                    color: #000;
                }
                .clickColor {
                    border-color: #000 !important;
                }
            }
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
                        opacity: 0.6;
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
                    span {
                        font-size: 0;
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
            .shape {
                @include flex(space-between);
                @mixin shapeStyle() {
                    border: 1px solid #666;
                    margin-right: 5%;
                    background-color: #fff;
                }
                .f {
                    @include shapeStyle();
                    width: 24px;
                    height: 24px;
                }
                .h {
                    @include shapeStyle();
                    height: 16px;
                    width: 32px;
                }
                .s {
                    @include shapeStyle();
                    height: 32px;
                    width: 16px;
                }
                .y {
                    @include shapeStyle();
                    width: 24px !important;
                    height: 24px;
                    border-radius: 50%;
                    -webkit-border-radius: 50%;
                }
                .wjx {
                    width: 36px !important;
                    height: 36px;
                    text-align: center;
                    line-height: 36px;
                    background-color: #fff;
                    &:hover {
                        background-color: transparent !important;
                    }
                    i {
                        position: static !important;
                        font-size: 36px;
                    }
                }
            }
        }
        .middle {
            @include flex(space-between);
            padding: 0 0px 0 50px;
            .space,
            .kinds {
                @include flexList(center,flex-start);
                .title {
                    font-size: 14px;
                    font-weight: bold;
                    margin: 25px 50px 30px 0;
                }
                .items {
                    cursor: pointer;
                    line-height: 36px;
                    font-size: 14px;
                    color: #666;
                }
            }
        }
        .right {
            @include flex(space-between);
            border-left: 1px solid #eee;
            .options {
                @include flexList(center,center);
                margin: 20px 50px 0px 50px;
                span {
                    cursor: pointer;
                    line-height: 30px;
                    font-size: 14px;
                    color: #666;
                    &:nth-child(5) {
                        margin-top: 30px;
                    }
                }
            }
            .bg {
                margin-left: 10px;
                width: 306px;
                height: 310px;
                img {
                    height: 100%;
                }
            }
        }
    }
    .search {
        @include flex(flex-start);
        padding: 10px 7.5%;
        border-bottom: 1px solid #eee;
        .tags {
            margin-right: 5px;
            padding: 0 12px 0 12px;
            font-size: 14px;
            color: #fff;
            background-color: #666;
            border-radius: 14px;
            -webkit-border-radius: 14px;
            position: relative;
            line-height: 28px;
            i {
                cursor: pointer;
                font-size: 12px;
            }
        }
        .logo {
            width: 18px;
            height: 18px;
            i {
                font-size: 18px;
                color: #666;
            }
        }
        .inputPart {
            margin-left: 10px;
            input {
                outline: none;
                border: none;
                width: 30vw;
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
                        <div v-for="(i,index) in prices" @click="clickPrice=index,addCondition($event,index,0)" :class="{'isClick':clickPrice===index}">
                            <i :class="{'clickFont':clickPrice===index||(clickPrice+1)===index}">{{i | changePrice}}</i>
                        </div>
                    </div>
                    <div class="size">
                        <span>尺寸</span>
                        <div v-for="(i,index) in size" @click="clickSize=index,addCondition($event,index,1)" :class="{'isClick':clickSize===index}">
                            <i :class="{'clickFont':clickSize===index||(clickSize+1)===index}">{{i | changeSize}}</i>
                        </div>
                    </div>
                    <div class="color">
                        <span>颜色</span>
                        <div v-for="(i,index) in color" @click="clickedColor=index,addCondition($event,index,2)" :class="[i,{clickColor:clickedColor===index}]">
                            <span>{{colorC[index]}}</span>
                        </div>
                    </div>
                    <div class="shape">
                        <span>形状</span>
                        <div v-for="(i,index) in shape" :class="[i,{isClick:clickedShape===index}]" @click="clickedShape=index,addCondition($event,index,3)">
                            <span>{{shapeC[index]}}</span>
                        </div>
                        <div class="wjx" @click="addCondition($event,4,4)" @mouseover="flag && (isHover=0)" @mouseout="flag && (isHover=1)">
                            <i class="iconfont" ref="wjx" :class="{'icon-wujiaoxing':!isHover,'icon-kongxinwujiaoxing':isHover}"></i>
                        </div>
                    </div>
                </div>
                <div class="classify">
                </div>
            </div>
            <div class="middle">
                <div class="space">
                    <span class="title">摆放空间</span>
                    <span class="items" v-for="i in spaces">{{i}}</span>
                </div>
                <div class="kinds">
                    <span class="title">分类</span>
                    <span class="items" v-for="i in kinds">{{i}}</span>
                </div>
            </div>
            <div class="right">
                <div class="options">
                    <span v-for="(i,index) in classify" @mouseover="showBg=index">{{i}}</span>
                </div>
                <div class="bg">
                    <img :src="'../../../static/img/bg'+showBg+'.png'">
                </div>
            </div>
        </div>
        <div class="search">
            <div class="tags" v-for="(i,index) in goodsFilters" v-show="i">
                {{i}}
                <i class="iconfont icon-icon" @click="closeTag(index)"></i>
            </div>
            <div class="logo">
                <i class="iconfont icon-search"></i>
            </div>
            <div class="inputPart">
                <input type="text" placeholder="搜索艺术家或艺术品">
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
            color: ["red", "yellow", "green", "blue", "gray"],
            colorC: ["红", "黄", "绿", "蓝", "黑白灰"],
            shape: ["f", "h", "s", "y"],
            shapeC: ["方", "横", "竖", "圆"],
            flag: true,
            isHover: 1,
            spaces: ["办公", "客厅", "书房", "餐厅", "儿童房", "走廊/回廊"],
            kinds: ["油画", "版画", "水墨", "水彩(粉)", "雕塑", "摄影"],
            classify: ["抽象", "具象", "观念", "传统国画", "人物", "风景", "静物"],
            showBg: 0,
            clickPrice: -2,
            clickSize: -2,
            clickedColor: -2,
            clickedShape: -2,
            //筛选条件记录
            goodsFilters: {
                price: "",
                size: "",
                color: "",
                shape: "",
                space: "",
                classify: "",
                kinds: ""
            },
            goodsFilters2: {
                //用来查询的，单纯的数据
                price: [],
                size: [],
                color: [],
                shape: [],
                space: [],
                classify: [],
                kinds: []
            }
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
        },
        addCondition(e, index, model) {
            switch (model) {
                case 0:
                    this.goodsFilters.price = `￥${this.prices[index]}~${this
                        .prices[index + 1]}`;
                    this.goodsFilters2.price.splice(
                        0,
                        2,
                        this.prices[index],
                        this.prices[index + 1]
                    );
                    break;
                case 1:
                    this.goodsFilters.size = `${this.size[index]}~${this.size[
                        index + 1
                    ]}cm`;
                    this.goodsFilters2.size.splice(
                        0,
                        2,
                        this.size[index],
                        this.size[index + 1]
                    );
                    break;
                case 2:
                    this.goodsFilters.color = `${this.colorC[index]}色系`;
                    this.goodsFilters2.color.splice(0, 1, this.colorC[index]);
                    break;
                case 3:
                    this.goodsFilters.shape = this.shapeC[index];
                    this.goodsFilters2.shape.splice(0, 1, this.shape[index]);
                    //还原五角星颜色
                    this.clickedShape = index;
                    this.$refs.wjx.className =
                        "iconfont icon-kongxinwujiaoxing";
                    this.$refs.wjx.style.color = "#666";
                    break;
                case 4:
                    this.$refs.wjx.className = "iconfont icon-wujiaoxing";
                    this.$refs.wjx.style.color = "#000";
                    this.flag = false;
                    this.clickedShape = -2;
                    this.goodsFilters.shape = "不规则";
                    this.goodsFilters2.shape.splice(0, 1, "不规则");
                    break;
            }
            this.$http
                .get("/api/getList", {
                    params: this.goodsFilters2
                })
                .then(data => {
                    this.lists = data.data.data;
                });
            // console.log(e.target.innerText);
        },
        closeTag(index) {
            this.goodsFilters[index] = "";
        }
    },
    mounted() {
        this.$http.get("/api/getList").then(data => {
            this.lists = data.data.data;
        });
    }
};
</script>


