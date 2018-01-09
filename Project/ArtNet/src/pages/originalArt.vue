<style lang="scss" scoped>
// flex布局函数；使用方式：@include flexUi;
@mixin flexUi($justify:flex-start) {
    display: flex;
    display: -webkit-flex;
    -webkit-justify-content: $justify;
    justify-content: $justify;
    -webkit-align-items: center;
    align-items: center;
}
input {
    outline: none;
    border: none;
}
#main {
    margin-bottom: 150px;
    //条件 部分
    .filterBox {
        display: flex;
        height: 310px;
        border-bottom: 1px solid #eee;
        padding-left: 7.5%;
        .filter-left {
            .filterItem {
                @include flexUi;
                margin: 30px 0 60px;
                b {
                    font-size: 14px;
                    margin-right: 50px;
                }
                .rangeBox {
                    position: relative;
                    height: 16px;
                    width: 85px;
                    box-sizing: border-box;
                    background-color: #ddd;
                    margin-right: 2px;
                    cursor: pointer;
                    color: #666;
                    &:hover {
                        background-color: #b0b0b0;
                        opacity: 0.7;
                    }
                    .spanValue {
                        position: absolute;
                        top: 20px;
                        left: -25px;
                        font-size: 12px;
                    }
                }
                .rangeBox:nth-child(2) {
                    span {
                        left: -5px;
                    }
                }
                .rangeBox:last-child {
                    width: 0;
                    span {
                        left: -15px;
                    }
                }
                .shapes {
                    height: 32px;
                    width: 85px;
                    @include flexUi;
                    margin-right: 2px;
                    div {
                        margin-left: 5px;
                        box-sizing: border-box;
                        border: 1px solid #000;
                        cursor: pointer;
                        &:hover {
                            background-color: #b0b0b0;
                        }
                    }
                    .iconfont {
                        font-size: 30px;
                        cursor: pointer;
                    }
                    .icon-wujiaoxing-copy2 {
                        color: #b0b0b0;
                    }
                }
            }
            .filterItem:last-child {
                margin: 30px 0 15px;
            }
        }
        .filter-center {
            margin-left: 140px;
            display: flex;
            .one:first-child {
                margin-right: 110px;
            }
            .one {
                font-size: 14px;
                margin-top: 28px;
                ul:nth-child(2) {
                    margin-top: 30px;
                }
                li {
                    height: 36px;
                    line-height: 36px;
                    margin-bottom: 1px;
                    font-size: 14px;
                    color: #666;
                    cursor: pointer;
                }
            }
        }
        .filter-right {
            display: flex;
            flex: 1;
            margin-left: 50px;
            border-left: 1px solid #eee;
            .filter-right-left {
                flex: 3;
                display: flex;
                justify-content: center;
                flex-direction: column;
                ul:first-child {
                    margin-bottom: 30px;
                }
                ul {
                    text-align: center;
                }
                li {
                    height: 30px;
                    line-height: 30px;
                    font-size: 14px;
                    color: #666;
                    cursor: pointer;
                }
            }
            .filter-right-right {
                flex: 7;
                background-image: url('');
                background-size: cover;
                background-repeat: no-repeat;
                background-position: center;
                .img_content {
                    @include flexUi(center);
                    flex-direction: column;
                    height: 100%;
                    color: #fff;
                    background: url("/static/img/line-bg.png") repeat-x;
                    h2:first-child {
                        margin-bottom: 2px;
                    }
                    h2 {
                        font-size: 24px;
                        font-weight: 500;
                    }
                    .line {
                        width: 30%;
                        height: 1px;
                        margin: 20px 0;
                        background-color: #fff;
                    }
                    p {
                        font-size: 14px;
                        padding: 0 20px;
                        letter-spacing: 1px;
                        line-height: 26px;
                    }
                }
            }
        }
        .choosedBg {
            background-color: #000 !important;
        }
        .fontColor {
            color: #000 !important;
            font-weight: 600;
        }
        .choosedBd {
            border: 2px solid #000;
        }
        .choosedFont {
            color: #000 !important;
            font-weight: bold;
        }
    }
    //选中的条件显示
    .choosedTxtBox {
        @include flexUi;
        height: 50px;
        border-bottom: 1px solid #eee;
        padding-left: 7.5%;
        //条件 tag
        .choosed_items {
            @include flexUi;
            li {
                @include flexUi;
                position: relative;
                height: 28px;
                padding: 0 12px;
                letter-spacing: 1px;
                font-size: 14px;
                color: #fff;
                background-color: #666;
                border-radius: 14px;
                margin-right: 10px;
                &::after {
                    content: "";
                    position: absolute;
                    right: 19px;
                    height: 28px;
                    width: 1px;
                    background-color: rgba(255, 255, 255, 0.2);
                }
                .iconfont {
                    position: relative;
                    right: -7px;
                    font-size: 10px;
                    cursor: pointer;
                }
            }
        }
        //重置
        .resetSpan {
            position: relative;
            color: #666;
            font-size: 14px;
            cursor: pointer;
            margin: 0 50px 0 10px;
            &::after {
                content: "";
                position: absolute;
                right: -25px;
                top: 50%;
                height: 28px;
                border-left: 2px solid #ddd;
                margin-top: -14px;
            }
        }
        //搜索icon
        .icon-search {
            font-size: 20px;
            color: #9f9f9f;
            margin-right: 10px;
            cursor: pointer;
        }
        input {
            font-size: 14px;
        }
    }
    //高级筛选
    .highFilter {
        @include flexUi(center);
        width: 140px;
        height: 30px;
        margin: 0 auto;
        color: #333;
        font-size: 14px;
        border: 1px solid #eee;
        border-top: none;
        cursor: pointer;
        user-select: none;
        .iconfont {
            margin-left: 7px;
            margin-top: 2px;
            font-size: 12px;
            font-weight: bold;
        }
    }
    //商品列表
    .goodsBox {
        //第一行
        .lineOne {
            @include flexUi(space-between);
            margin: 0 210px 30px 7.5%;
            .left {
                font-size: 12px;
                color: #666;
            }
            .right {
                @include flexUi;
                .span_selectBox {
                    position: relative;
                    width: 105px;
                    height: 30px;
                    border: 1px solid #eee;
                    border-radius: 4px;
                    font-size: 12px;
                    color: #666;
                    text-align: center;
                    margin-left: 10px;
                    &::after {
                        content: "";
                        position: absolute;
                        top: 50%;
                        right: 5px;
                        margin-top: -2.5px;
                        border-top: 5px solid #999;
                        border-left: 4px solid transparent;
                        border-right: 4px solid transparent;
                    }
                }
                span {
                    display: inline-block;
                    width: 100%;
                    line-height: 30px;
                }
                select {
                    position: absolute;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 30px;
                    opacity: 0;
                    cursor: pointer;
                }
                select:last-child {
                    margin-right: 0;
                }
            }
        }
        .goods {
            position: relative;
            width: 1200px;
            margin: 0 auto;
            .goods_box {
                position: relative;
                float: left;
                padding: 120px 50px 0 50px;
                .pic {
                    transition: box-shadow 0.2s;
                    &:hover {
                        cursor: pointer;
                        box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
                    }
                    img {
                        display: block;
                        width: 300px;
                    }
                }
                .info {
                    margin-left: 20px;
                    font-size: 12px;
                    color: #000;
                    .title {
                        font-weight: 600;
                        margin: 10px 0;
                        cursor: pointer;
                    }
                    .twoI {
                        color: #666;
                        margin: 5px 0;
                        // letter-spacing: 1px;
                        .nameHover:hover {
                            color: #000;
                            cursor: pointer;
                        }
                    }
                    .price {
                        font-size: 14px;
                        font-weight: 500;
                        margin-top: 10px;
                    }
                }
                .sealStatus {
                    position: absolute;
                    top: 120px;
                    right: 50px;
                    color: #fff;
                    font-size: 14px;
                    height: 24px;
                    width: 42px;
                    line-height: 24px;
                    text-align: center;
                    background: #373b37;
                }
            }
            .noGoods {
                text-align: center;
                font-size: 20px;
                color: #666;
                margin: 70px 0;
            }
        }
    }
    //分页部分
    .pageBox {
        $height: 50px;
        width: 1200px;
        height: $height;
        margin: 100px auto 50px;
        @include flexUi;
        .pageNumBox {
            flex: 1;
            @include flexUi;
            li {
                margin-right: 5px;
                a {
                    display: block;
                    line-height: $height;
                    width: 80px;
                    text-decoration: none;
                    color: #000;
                    font-size: 20px;
                    text-align: center;
                    cursor: pointer;
                    user-select: none;
                    &:hover {
                        background-color: #ccc;
                    }
                }
                .currPage {
                    color: #fff;
                    background-color: #000 !important;
                }
            }
        }
        .nextPage {
            text-align: center;
            background-color: #000;
            font-size: 20px;
            cursor: pointer;
            flex: 1;
            user-select: none;
            a {
                display: block;
                line-height: $height;
                color: #fff;
                text-decoration: none;
            }
        }
        .noNextPage {
            background-color: #ccc;
        }
    }
}
</style>

<template>
    <div id="main">
        <!-- 筛选条件部分 -->
        <div class="filterBox">
            <!-- 价格、尺寸、颜色、形状 部分 -->
            <div class="filter-left">
                <!-- 价格 -->
                <div class="filterItem">
                    <b>价格</b>
                    <div v-for="(i,index) in price.range" :key="i" class="rangeBox" @click="filterChoosed(i,'price',index)" :class="[{choosedBg:price.choosed===index},{fontColor:price.choosed===index || price.choosed===index-1}]">
                        <span class="spanValue">
                            <span v-if="i!=0 && i!=='max'">¥</span>{{i}}</span>
                    </div>
                </div>
                <!-- 尺寸 -->
                <div class="filterItem">
                    <b>尺寸</b>
                    <div v-for="(i,index) in size.range" :key="i" class="rangeBox" @click="filterChoosed(i,'size',index)" :class="[{choosedBg:size.choosed===index},{fontColor:size.choosed===index || size.choosed===index-1}]">
                        <span class="spanValue">{{i}}
                            <span v-if="i!=0 && i!=='max'">cm</span>
                        </span>
                    </div>
                </div>
                <!-- 颜色 -->
                <div class="filterItem">
                    <b>颜色</b>
                    <div v-for="(i,index) in colorful.range" :key="i.name" class="rangeBox" :style="{backgroundColor:i.color}" @click="spanTagBg=i.color,filterChoosed(i,'colorful',index)" :class="{choosedBd:colorful.choosed===index}"></div>
                </div>
                <!-- 形状 -->
                <div class="filterItem">
                    <b>形状</b>
                    <div class="shapes" v-for="(i,index) in shape.range" :key="i.name">
                        <div v-if="i.name!=='不规则'" :style="i.styles" @click="filterChoosed(i,'shape',index),fiveStar='icon-kongxinwujiaoxing'" :class="{choosedBg:shape.choosed===index}"></div>
                        <span v-else class="iconfont" :class="fiveStar" @mousemove="fiveStar==='icon-wujiaoxing'?'':fiveStar='icon-wujiaoxing-copy2'" @mouseout="fiveStar==='icon-wujiaoxing'?'':fiveStar='icon-kongxinwujiaoxing'" @click="fiveStar='icon-wujiaoxing',filterChoosed(i,'shape',index)"></span>
                    </div>
                </div>
            </div>
            <!-- 摆放空间、分类 -->
            <div class="filter-center">
                <!-- 摆放空间 -->
                <div class="one">
                    <b>摆放空间</b>
                    <ul>
                        <li v-for="(i,index) in position.range" :key="i" :class="{choosedFont:position.choosed===index}" @click="filterChoosed(i,'position',index)">{{i}}</li>
                    </ul>
                </div>
                <!-- 分类 -->
                <div class="one">
                    <b>分类</b>
                    <ul>
                        <li v-for="(i,index) in classify.range" :key="i" :class="{choosedFont:classify.choosed===index}" @click="filterChoosed(i,'classify',index)">{{i}}</li>
                    </ul>
                </div>
            </div>
            <!-- 风格、题材、对应的图片 -->
            <div class="filter-right">
                <!-- 风格、题材文字 -->
                <div class="filter-right-left">
                    <!-- 风格 -->
                    <ul>
                        <li v-for="(i,index) in style.range" :key="i" @mouseover="hoverFun(i)" :class="{choosedFont:style.choosed===index}" @click="filterChoosed(i,'style',index)">{{i}}</li>
                    </ul>
                    <!-- 题材 -->
                    <ul>
                        <li v-for="(i,index) in theme.range" :key="i" @mouseover="hoverFun(i)" :class="{choosedFont:theme.choosed===index}" @click="filterChoosed(i,'theme',index)">{{i}}</li>
                    </ul>
                </div>
                <!-- 对应的图片 -->
                <div class="filter-right-right" :style="{backgroundImage: `url(${commonImg})`}">
                    <div class="img_content">
                        <h2>{{imgContent.cn_name}}</h2>
                        <h2>{{imgContent.en_name}}</h2>
                        <div class="line"></div>
                        <p>{{imgContent.content}}</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- 筛选标签+重置+查询 -->
        <div class="choosedTxtBox">
            <!-- 筛选标签 -->
            <ul class="choosed_items">
                <li v-for="(i,key) in choosedTxt" :key="i" v-if="i" :style="{backgroundColor:key==='colorful'?spanTagBg:''}">
                    <span>{{i}}</span>
                    <span v-if="key==='colorful' && i!=='黑白灰'">色系</span>
                    <i class="iconfont icon-icon" @click="deleteTag(key)"></i>
                </li>
            </ul>
            <!-- 重置 -->
            <span class="resetSpan" @click="resetTag()" v-if="showReset">重置</span>
            <!-- 搜索icon -->
            <i class="iconfont icon-search" @click="pageData.choosed = 1,getGoodsByParmas()"></i>
            <input type="text" placeholder="搜索艺术家或艺术品" autofocus v-model="searchValue" @keyup.enter="pageData.choosed = 1,getGoodsByParmas()">
        </div>
        <!-- 高级筛选 按钮 -->
        <div class="highFilter" @click="openHF=!openHF">
            <div v-if="openHF">快速筛选
                <i class="iconfont icon-icon1"></i>
            </div>
            <div v-else>高级筛选
                <i class="iconfont icon-arrow"></i>
            </div>
        </div>
        <!-- 商品列表 -->
        <div class="goodsBox" v-cloak>
            <!-- 商品列表 第一行的3个下拉框 -->
            <div class="lineOne">
                <div class="left">
                    艺网 > 原创艺术
                </div>
                <div class="right">
                    <div v-for="i in selectData" :key="i.name" class="span_selectBox">
                        <span>{{i.sevaule[i.seleced]}}</span>
                        <select v-model="i.seleced" @change="selectByOther(i)">
                            <option v-for="(op,key) in i.sevaule" :key="op.cn_value" :value="key">{{op}}</option>
                        </select>
                    </div>
                </div>
            </div>
            <!-- 商品部分 -->
            <ul class="goods" ref="goodsUl">
                <li v-for="(i,index) in goods" :key="index" class="goods_box" ref="goodsLi">
                    <!-- 商品图片div -->
                    <router-link class="pic" :to="'/goodsDetails/'+i._id+'/imgSrc/'+i.images" tag="div">
                        <img ref="goodsImg" :key="index" :src="'/static/goods/'+i.images+'.jpg'" alt="图片">
                    </router-link>
                    <!-- 商品信息div -->
                    <div class="info">
                        <div class="title">{{i.artist}}</div>
                        <div class="twoI">
                            <i class="nameHover">{{i.name}}</i>
                            <i> ，{{i.time}}</i>
                        </div>
                        <div class="twoI">
                            <i>{{i.meterial}} ，{{i.size.x}}x{{i.size.y}}cm</i>
                        </div>
                        <div class="price">{{i.price | formatMoney}}</div>
                    </div>
                    <!-- 售卖状态 -->
                    <div class="sealStatus" v-if="i.status==='0'">已售</div>
                </li>
                <li v-if="goods.length===0" class="noGoods">对不起，没有查询到符合要求的内容，请重新选择</li>
            </ul>
        </div>
        <!-- 分页 部分 -->
        <div class="pageBox" v-if="goods.length">
            <ul class="pageNumBox">
                <li v-for="i in pageData.number" :key="i" @click="clickPageNum(i)">
                    <a :class="{currPage:i===pageData.choosed}" href="#main">{{i}}</a>
                </li>
            </ul>
            <div class="nextPage" :class="{noNextPage:pageData.choosed===pageData.totalPage}" @click="clickNextPage">
                <a href="#main" v-if="pageData.choosed!==pageData.totalPage">下一页</a>
                <a v-else>下一页</a>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            price: {
                choosed: null,
                range: ["0", "2,000", "8,000", "15,000", "30,000", "max"]
            },
            size: {
                choosed: null,
                range: ["0", "50", "100", "150", "200", "max"]
            },
            colorful: {
                choosed: null,
                range: [
                    {
                        name: "红",
                        color: "#e73233"
                    },
                    {
                        name: "黄",
                        color: "#ffea03"
                    },
                    {
                        name: "绿",
                        color: "#32cc66"
                    },
                    {
                        name: "蓝",
                        color: "#0099ff"
                    },
                    {
                        name: "黑白灰",
                        color: "#808080"
                    },
                    {
                        name: "",
                        color: ""
                    }
                ]
            },
            shape: {
                choosed: null,
                range: [
                    {
                        name: "方",
                        styles: {
                            width: "24px",
                            height: "24px"
                        }
                    },
                    {
                        name: "横",
                        styles: {
                            width: "32px",
                            height: "16px"
                        }
                    },
                    {
                        name: "竖",
                        styles: {
                            width: "16px",
                            height: "32px"
                        }
                    },
                    {
                        name: "圆",
                        styles: {
                            width: "24px",
                            height: "24px",
                            borderRadius: "50%"
                        }
                    },
                    {
                        name: "不规则"
                    }
                ]
            },
            position: {
                choosed: null,
                range: ["商业空间", "客厅", "书房", "餐厅", "儿童房", "走廊/回廊"]
            },
            classify: {
                choosed: null,
                range: ["油画", "版画", "水墨", "水彩(粉)", "雕塑", "摄影"]
            },
            style: {
                choosed: null,
                range: ["抽象", "具象", "观念", "传统国画"]
            },
            theme: {
                choosed: null,
                range: ["人物", "风景", "静物"]
            },
            //形状->五角星icon
            fiveStar: "icon-kongxinwujiaoxing",
            //右侧【所有】图片、文字 数据
            styleAndthame_img: [],
            //右侧 【要渲染】的图片、文字 数据
            imgContent: {},
            //右侧 图片路径
            commonImg: "/static/rightImg/02.jpg",
            //选中的筛选条件 数据
            choosedTxt: {
                price: "",
                size: "",
                colorful: "",
                shape: "",
                position: "",
                classify: "",
                style: "",
                theme: ""
            },
            //span 标签的背景颜色
            spanTagBg: "",
            //是否显示重置按钮
            showReset: false,
            //搜索框输入的值
            searchValue: "",
            //显示高级搜索
            openHF: false,
            //商品列表 3个下拉框数据
            selectData: [
                {
                    name: "time",
                    seleced: "0",
                    sevaule: {
                        "0": "上架时间",
                        "-1": "上架时间最新",
                        "1": "上架时间最早"
                    }
                },
                {
                    name: "price2",
                    seleced: "0",
                    sevaule: {
                        "0": "价格",
                        "-1": "价格从高到低",
                        "1": "价格从低到高"
                    }
                },
                {
                    name: "status",
                    seleced: "0",
                    sevaule: {
                        "0": "全部作品",
                        "1": "未售作品"
                    }
                }
            ],
            //商品数据
            goods: [],
            //页码数据
            pageData: {
                choosed: 1,
                onePageNum: 10,
                totalPage: null,
                number: []
            },
            //下拉框 change事件保存要查询的值
            selectQueryData: {
                time: "",
                price2: "",
                status: ""
            }
        };
    },
    methods: {
        //鼠标移入 更换图片事件
        hoverFun(i) {
            for (let val of this.styleAndthame_img) {
                if (val.cn_name.match(i)) {
                    this.commonImg = `/static/rightImg/${val.imgSrc}.jpg`;
                    this.imgContent = val;
                    return;
                }
            }
        },
        //筛选条件被选中时的操作
        filterChoosed(i, keyname, index) {
            this.showReset = true;
            this[keyname].choosed = index;
            this.pageData.choosed = 1;
            let _val = i;
            if (keyname === "price") {
                _val = `¥${i}～${this[keyname].range[index + 1]}`;
            } else if (keyname === "size") {
                if (this[keyname].range[index + 1] !== "max") {
                    _val = `${i}～${this[keyname].range[index + 1]}cm`;
                } else {
                    _val = `${i}～${this[keyname].range[index + 1]}`;
                }
            } else if (keyname === "colorful") {
                _val = i.name;
            } else if (keyname === "shape") {
                _val = i.name;
            }
            this.choosedTxt[keyname] = _val;
            this.getGoodsByParmas();
        },
        //搜索框 查询事件
        searchByInput() {},
        //根据筛选条件查询商品
        getGoodsByParmas() {
            let parmas = {},
                choosedTxt = this.choosedTxt, //筛选条件选中的值
                selectQueryData = this.selectQueryData; //下拉框选中的值
            for (let keyname in choosedTxt) {
                if (choosedTxt[keyname]) {
                    parmas[keyname] = choosedTxt[keyname];
                }
            }
            for (let keyname in selectQueryData) {
                if (selectQueryData[keyname]) {
                    parmas[keyname] = selectQueryData[keyname];
                }
            }
            //如果输入框有值，表明需要 模糊匹配 艺术家or作品名
            if (this.searchValue.trim()) {
                parmas.searchValue = this.searchValue.trim();
            } else {
                this.searchValue = "";
            }
            this.getGoods(parmas);
        },
        //下拉框 改变，触发查询事件
        selectByOther(i) {
            if (i.name !== "status") {
                this.selectQueryData[i.name] =
                    i.seleced != 0
                        ? i.seleced == 1 ? i.name : "-" + i.name
                        : "0";
            } else {
                this.selectQueryData[i.name] = i.seleced;
            }
            this.pageData.choosed = 1;
            this.getGoodsByParmas();
        },
        //删除单个标签
        deleteTag(key) {
            this.choosedTxt[key] = "";
            this.getGoodsByParmas();
            this[key].choosed = null;
            let isShow = false;
            for (let key in this.choosedTxt) {
                if (this.choosedTxt[key]) {
                    isShow = true;
                    return;
                }
            }
            this.showReset = isShow;
        },
        //重置标签
        resetTag() {
            for (var key in this.choosedTxt) {
                this.choosedTxt[key] = "";
                this[key].choosed = null;
            }
            for (var key of this.selectData) {
                key.seleced = "0";
            }
            this.searchValue = "";
            this.showReset = false;
            this.fiveStar = "icon-kongxinwujiaoxing";
            this.pageData.choosed = 1;
            this.getGoods();
        },
        //获取商品数据
        getGoods(parmas = {}) {
            this.$http
                .post("/api/orginalArt/getGoods", {
                    page: this.pageData.choosed,
                    onePageNum: this.pageData.onePageNum,
                    parmas
                })
                .then(data => {
                    this.goods = [];
                    if (data.data.data.length) {
                        //data.data.data：后台返回的商品数据，JSON格式
                        this.goods = data.data.data;
                        let len = data.data.data.length - 1,
                            count = 0;
                        this.myload(len, count);
                        //设置页码
                        this.pageData.choosed === 1 &&
                            this.countPageNumber(data.data.count);
                    } else {
                        this.$refs.goodsUl.style.height = "auto";
                        console.log("没有获取到【商品】数据");
                    }
                });
        },
        // 图片预加载事件
        myload(len, count) {
            let imgObj = new Image();
            imgObj.src = "/static/goods/" + this.goods[count].images + ".jpg";
            imgObj.addEventListener("load", () => {
                if (count >= len) {
                    this.$nextTick(() => {
                        this.waterFall();
                    });
                } else {
                    this.myload(len, ++count);
                }
            });
        },
        //瀑布流定位
        waterFall() {
            let ul = this.$refs.goodsUl, //获取商品包裹层 ul 标签
                li = this.$refs.goodsLi, //获取每一个商品 li 标签
                len = li.length, // li 的数量
                liWidth = li[0].offsetWidth, // li 宽度
                ulWidth = 1200, //ul 的宽度
                col = Math.floor(ulWidth / liWidth); //商品显示的列数 = ul 的宽度 / li 宽度
            let boxHeight = [];
            for (let i = 0; i < len; i++) {
                if (i < col) {
                    boxHeight.push(li[i].offsetHeight);
                } else {
                    let minH = Math.min.apply(null, boxHeight),
                        minIndex = boxHeight.indexOf(minH);
                    li[i].style.cssText =
                        "position:absolute;top:" +
                        minH +
                        "px;left:" +
                        minIndex * liWidth +
                        "px;";
                    boxHeight[minIndex] += li[i].offsetHeight;
                }
            }
            ul.style.height = Math.max.apply(null, boxHeight) + "px";
        },
        //计算页码
        countPageNumber(totalNum) {
            this.pageData.number = [];
            let totalPage = Math.ceil(totalNum / this.pageData.onePageNum),
                len = totalPage > 5 ? 5 : totalPage;
            this.pageData.totalPage = totalPage;
            for (let i = 1; i <= len; i++) {
                this.pageData.number.push(i);
            }
        },
        //点击页码
        clickPageNum(i) {
            if (this.pageData.choosed !== i) {
                this.pageData.choosed = i;
                this.getGoodsByParmas();
            }
        },
        //点击下一页
        clickNextPage() {
            if (this.pageData.totalPage > this.pageData.choosed) {
                this.pageData.choosed++;
                this.getGoodsByParmas();
            }
        }
    },
    //过滤器
    filters: {
        //金额格式化
        formatMoney(val) {
            return "￥" + String(val).replace(/\B(?=(?:\d{3})+$)/g, ",");
        }
    },
    mounted() {
        //获取右边图片+文字
        this.$http.get("/api/orginalArt/getStyleAndthame_img").then(data => {
            if (data.data) {
                this.styleAndthame_img = data.data;
                this.imgContent = data.data[0];
            } else {
                console.log("没有获取到【右边图片+文字】");
            }
        });
        this.getGoods();
        // console.log()
        let sessionCode = ["classfiy", "price", "size", "style"];
        for (let i of sessionCode) {
            console.log(sessionStorage[i]);
        }
    }
};
</script>