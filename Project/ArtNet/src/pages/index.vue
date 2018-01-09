<style lang="scss" scoped>
[v-cloak] {
    display: none;
}
@mixin flexUi($justify:flex-start,$align:center) {
    display: flex;
    display: -webkit-flex;
    justify-content: $justify;
    -webkit-justify-content: $justify;
    -webkit-align-items: $align;
    align-items: $align;
}
.main {
    // banner
    .banner {
        position: fixed;
        left: 0;
        top: 68px;
        width: 100%;
        height: 420px;
        background-image: url("/static/banner/banner1.jpg");
        background-position: center;
        background-repeat: no-repeat;
        transition: background-image 1s;
        //点
        ul {
            @include flexUi(space-between);
            position: absolute;
            right: 120px;
            bottom: 15px;
            width: 250px;
            height: 12px;
            padding: 10px 20px;
            background: rgba(0, 0, 0, 0.1);
            border-radius: 30px;
            li {
                width: 12px;
                height: 12px;
                border-radius: 50%;
                background-color: #fff;
                cursor: pointer;
                transition: background-color 1s;
            }
            .currLi {
                background-color: #3baca1;
            }
        }
    }
    // 下面所有的
    .others {
        position: relative;
        z-index: 100;
        margin-top: 488px;
        padding: 80px 0;
        background-color: #fff;
        .title {
            @include flexUi;
            h2 {
                letter-spacing: 2px;
            }
            span {
                cursor: pointer;
                user-select: none;
                color: #003569;
                margin-left: 50px;
                i {
                    font-size: 18px;
                }
            }
        }
        // 推荐
        .tuijian {
            width: 1180px;
            margin: 0 auto;
            .content {
                @include flexUi(space-between);
                position: relative;
                margin-top: 10px;
                padding-top: 40px;
                border-top: 1px solid #ddd;
                // 4个作品
                .item {
                    box-shadow: 0 1px 20px 0 rgba(0, 0, 0, 0.1);
                    .imgBox {
                        width: 280px;
                        height: 280px;
                        overflow: hidden;
                        cursor: pointer;
                        div {
                            width: 280px;
                            height: 280px;
                            background-image: url("/static/img/23.jpg");
                            background-position: center center;
                            background-repeat: no-repeat;
                            background-size: cover;
                            transition: transform 0.5s;
                        }
                        &:hover div {
                            transform: scale(1.1, 1.1);
                        }
                    }

                    .info {
                        padding: 20px;
                        li {
                            font-size: 12px;
                            color: #666;
                            margin-bottom: 3px;
                            &:first-child,
                            &:last-child {
                                color: #000;
                                font-weight: 600;
                                font-size: 13px;
                            }
                        }
                    }
                }
                //4个分类
                .classBox {
                    position: absolute;
                    top: -44px;
                    right: 0;
                    @include flexUi;
                    li {
                        width: 100px;
                        height: 42px;
                        text-align: center;
                        line-height: 42px;
                        border: 1px solid transparent;
                        margin-left: 20px;
                        cursor: pointer;
                        user-select: none;
                        transition: border 0.1s linear;
                        &:hover {
                            border-color: #ddd #ddd#fff #ddd;
                        }
                    }
                    .currClassify {
                        border-color: #ddd #ddd #fff #ddd;
                    }
                }
            }
        }
        // 最新上架
        .new {
            width: 1180px;
            margin: 80px auto;
            .title {
                span {
                    .rotateSpan {
                        transform: rotate(45deg);
                        // transition: transform 1s;
                    }
                }
            }
            .content {
                margin-top: 50px;
                @include flexUi;
                .item {
                    position: relative;
                    cursor: pointer;
                    .itemDiv {
                        position: absolute;
                        width: 100%;
                        height: 100%;
                        overflow: hidden;
                        backface-visibility: hidden;

                        &:first-child {
                            transform: rotateY(-180deg);
                        }
                        .imgBox {
                            height: 100%;
                            transition: transform 0.5s;
                            background-image: url("/static/img/23.jpg");
                            background-position: center center;
                            background-repeat: no-repeat;
                            background-size: cover;
                        }
                        &:hover .info {
                            opacity: 1;
                        }
                        &:hover .imgBox {
                            transform: scale(1.1, 1.1);
                        }
                        .info {
                            @include flexUi(center,center);
                            flex-direction: column;
                            position: absolute;
                            left: 0;
                            top: 0;
                            width: 100%;
                            height: 100%;
                            color: #fff;
                            font-size: 12px;
                            background: rgba(0, 0, 0, 0.5);
                            opacity: 0;
                            transition: opacity 0.3s;
                        }
                    }
                }

                .left {
                    @include flexUi(space-between);
                    perspective: 500;
                    transform-style: preserve-3d;
                    flex: 1;
                    .item {
                        width: 280px;
                        height: 280px;
                    }
                }
                .right {
                    @include flexUi(space-between);
                    perspective: 500;
                    transform-style: preserve-3d;
                    flex: 1;
                    margin-left: 20px;
                    flex-wrap: wrap;
                    .item {
                        width: 130px;
                        height: 130px;
                        &:nth-child(n + 5) {
                            margin-top: 20px;
                        }
                    }
                }
            }
        }
        // 探索全新的艺术世界
        .go {
            @include flexUi;
            height: 300px;
            color: #fff;

            .left {
                @include flexUi(space-between,flex-start);
                flex-direction: column;
                flex: 1;
                height: 100%;
                box-sizing: border-box;
                padding: 40px 0 40px 11.5%;
                background-color: #666;
                p {
                    font-size: 30px;
                }
                .selectBox {
                    width: 100%;
                    select {
                        margin-left: 20px;
                        padding: 0 20px;
                        font-size: 14px;
                        color: #333333;
                        width: 20%;
                        height: 44px;
                        border-radius: 4px;
                        outline: none;
                        background-color: #f8f8f8;
                        &:first-child {
                            margin-left: 0;
                        }
                    }
                }
                b {
                    cursor: pointer;
                }
            }
            .right {
                position: relative;
                @include flexUi(center);
                flex-direction: column;
                width: 27%;
                height: 100%;
                font-size: 40px;
                font-weight: bold;
                background-color: #000;
                cursor: pointer;
                p {
                    position: relative;
                    z-index: 2;
                    transform: translateX(0);
                    transition: transform 0.4s;
                }
                div {
                    position: absolute;
                    top: 0;
                    left: 0;
                    z-index: 0;
                    width: 0;
                    height: 100%;
                    transition: width 0.5s;
                    background-color: #3c948b;
                }
                &:hover div {
                    width: 100%;
                }
                &:hover p {
                    transform: translateX(40px);
                }
            }
        }
        // 专题
        .specialBox {
            .titleBox {
                @include flexUi(space-between);
                height: 100px;
                div {
                    width: 200px;
                    text-align: center;
                    font-size: 45px;
                    height: 100px;
                    line-height: 100px;
                    cursor: pointer;
                    &:hover {
                        background-color: #eee;
                    }
                }
                h2 {
                    letter-spacing: 3px;
                    font-size: 28px;
                }
            }
            .warp {
                width: 100%;
                overflow: hidden;
                .content {
                    @include flexUi(space-between);
                    transition: margin-left 1s;
                    width: 4870px;
                    .item {
                        position: relative;
                        left: 0;
                        right: 0;
                        margin: 0 auto;
                        width: 320px;
                        height: 380px;
                        background-image: url("/static/special/2017112818064833218c87b83.jpg");
                        background-size: 440px 100%;
                        background-position: center;
                        background-repeat: no-repeat;
                        transition: width 0.5s;
                        &:last-child {
                            margin-right: 0;
                        }
                        .info {
                            width: 320px;
                            transition: padding 0.5s;
                            height: 100%;
                            user-select: none;
                            background-color: rgba(0, 0, 0, 0.2);
                            p {
                                color: #fff;
                                padding: 30px;
                                font-size: 30px;
                                font-weight: bold;
                                &:last-child {
                                    font-size: 14px;
                                    padding: 0 70px 0 30px;
                                    font-weight: normal;
                                    line-height: 20px;
                                }
                            }
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
            }
        }
        // 艺术家
        .artist {
            width: 1180px;
            margin: 80px auto;
            .title {
                span {
                    display: inline-block;
                    width: 180px;
                    text-align: center;
                    line-height: 38px;
                    height: 40px;
                    border-radius: 20px;
                    border: solid 1px #3c948b;
                    box-sizing: border-box;
                    color: #3a8373;
                    font-size: 18px;
                    font-weight: 500;
                    &:hover {
                        background-color: #3c948b;
                        color: #ffffff;
                    }
                }
            }
            .content {
                @include flexUi;
                margin-top: 50px;
                .left {
                    position: relative;
                    width: 450px;
                    height: 320px;
                    overflow: hidden;
                    cursor: pointer;
                    user-select: none;
                    &:hover img {
                        transform: scale(1.05);
                    }
                    img {
                        width: 100%;
                        transition: transform 0.5s;
                    }
                    div {
                        position: absolute;
                        top: 0;
                        left: 0;
                        width: 100%;
                        height: 100%;
                        color: #fff;
                        padding-top: 180px;
                        box-sizing: border-box;
                        background-color: rgba(0, 0, 0, 0.2);
                        p {
                            font-size: 12px;
                            margin-left: 20px;
                            &:first-child {
                                font-size: 16px;
                                margin-bottom: 20px;
                            }
                        }
                    }
                }
                .right {
                    flex: 1;
                    @include flexUi(flex-start,flex-start);
                    flex-direction: column;
                    height: 320px;
                    margin-left: 25px;
                    padding-left: 24px;
                    border-left: 1px solid #d8d8d8;
                    .showImg {
                        width: 100%;
                        flex: 1;
                        @include flexUi(space-between,flex-start);
                        margin-top: 20px;
                        .item {
                            height: 100%;
                            @include flexUi(space-between);
                            flex-direction: column;
                            .imgBox {
                                width: 180px;
                                height: 180px;
                                position: relative;
                                cursor: pointer;
                                &:hover div:nth-child(2) {
                                    top: 15px;
                                    left: 15px;
                                }
                                &:hover div:last-child {
                                    top: 30px;
                                    left: 30px;
                                }
                                div {
                                    position: absolute;
                                    left: 0;
                                    top: 0;
                                    width: 180px;
                                    height: 180px;
                                    background-image: url("/static/img/7.jpg");
                                    background-size: cover;
                                    background-repeat: no-repeat;
                                    background-position: center;
                                    opacity: 0.2;
                                    transition: all 0.5s;
                                    &:nth-child(2) {
                                        opacity: 0.6;
                                    }
                                    &:last-child {
                                        top: 10px;
                                        left: 10px;
                                        opacity: 1;
                                        box-shadow: -4px 2px 6px 0
                                            rgba(0, 0, 0, 0.5);
                                    }
                                }
                            }

                            .name {
                                width: 50%;
                                margin: 0 auto;
                                text-align: center;
                                padding-top: 15px;
                                border-top: 1px solid #000;
                                div {
                                    &:last-child {
                                        font-size: 12px;
                                    }
                                }
                            }
                            &:nth-child(2) {
                                flex-direction: column-reverse;
                                .name {
                                    padding-top: 0;
                                    border-top: none;
                                    border-bottom: 1px solid #000;
                                    padding-bottom: 15px;
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}
</style>

<template>
    <div class="main" v-cloak>
        <!-- banner -->
        <div class="banner" :style="{backgroundImage:'url(static/banner/banner'+currIndex+'.jpg)'}">
            <ul>
                <li v-for="i in 6" :key="i" :class="{currLi:i===currIndex}" @click="clickLi(i)"></li>
            </ul>
        </div>
        <!-- 其他下面所有东西 -->
        <div class="others">
            <!-- 推荐 -->
            <div class="tuijian">
                <div class="title">
                    <h2>推荐 / CATEGORY</h2>
                    <router-link to="/originalart" tag="span">更多</router-link>
                </div>
                <div class="content">
                    <div class="item" v-for="i in tuiJianData[currClassify]" :key="i._id">
                        <router-link class="imgBox" tag="div" :to="'/goodsDetails/'+i._id+'/imgSrc/'+i.images">
                            <div :style="{backgroundImage:'url(static/goods/'+i.images+'.jpg)'}"></div>
                        </router-link>
                        <ul class="info">
                            <li>{{i.artist}}</li>
                            <li>{{i.name}}，{{i.time}}</li>
                            <li>{{i.classfiy}} {{i.size.x}}x{{i.size.y}} cm</li>
                            <li>{{i.price | formatMoney}}</li>
                        </ul>
                    </div>
                    <ul class="classBox">
                        <li v-for="(i,index) in classArr" :key="i" :class="{currClassify:index===currClassify}" @click="currClassify=index">{{i}}</li>
                    </ul>
                </div>
            </div>
            <!-- 最新上架 -->
            <div class="new">
                <div class="title">
                    <h2>最新上架 / NEW</h2>
                    <span @click="timer2 && huanFun()">
                        <i class="iconfont icon-weibiaoti--" :class="{rotateSpan:rotateClass}"></i> 换一换
                    </span>
                </div>
                <div class="content">
                    <div class="left">
                        <div class="item" v-for="(i,index) in 2" :key="i" ref="itemEl">
                            <router-link tag="div" :to="'/goodsDetails/'+newData0[index]._id+'/imgSrc/'+newData0[index].images" class="itemDiv" v-if="newData0.length">
                                <div class="imgBox" :style="{backgroundImage:'url(static/goods/'+newData0[index].images+'.jpg)'}"></div>
                                <ul class="info">
                                    <li>{{newData0[index].artist}}</li>
                                    <li>{{newData0[index].name}}，{{newData0[index].time}}</li>
                                    <li>{{newData0[index].classfiy}} {{newData0[index].size.x}}x{{newData0[index].size.y}} cm</li>
                                    <li>{{newData0[index].price | formatMoney}}</li>
                                </ul>
                            </router-link>
                            <router-link tag="div" :to="'/goodsDetails/'+newData1[index]._id+'/imgSrc/'+newData1[index].images" class="itemDiv" v-if="newData1.length">
                                <div class="imgBox" :style="{backgroundImage:'url(static/goods/'+newData1[index].images+'.jpg)'}"></div>
                                <ul class="info">
                                    <li>{{newData1[index].artist}}</li>
                                    <li>{{newData1[index].name}}，{{newData1[index].time}}</li>
                                    <li>{{newData1[index].classfiy}} {{newData1[index].size.x}}x{{newData1[index].size.y}} cm</li>
                                    <li>{{newData1[index].price | formatMoney}}</li>
                                </ul>
                            </router-link>
                        </div>
                    </div>
                    <div class="right">
                        <div class="item" v-for="i in 8" :key="i" ref="itemEl">
                            <router-link tag="div" :to="'/goodsDetails/'+newData0[i+1]._id+'/imgSrc/'+newData0[i+1].images" class="itemDiv" v-if="newData0.length">
                                <div class="imgBox" :style="{backgroundImage:'url(static/goods/'+newData0[i+1].images+'.jpg)'}"></div>
                                <ul class="info">
                                    <li>{{newData0[i+1].artist}}</li>
                                    <li>{{newData0[i+1].name}}</li>
                                    <!-- <li>{{newData0[i+1].time}}</li> -->
                                    <li>{{newData0[i+1].classfiy}} {{newData0[i+1].size.x}}x{{newData0[i+1].size.y}} cm</li>
                                    <li>{{newData0[i+1].price | formatMoney}}</li>
                                </ul>
                            </router-link>
                            <router-link tag="div" :to="'/goodsDetails/'+newData1[i+1]._id+'/imgSrc/'+newData1[i+1].images" class="itemDiv" v-if="newData1.length">
                                <div class="imgBox" :style="{backgroundImage:'url(static/goods/'+newData1[i+1].images+'.jpg)'}"></div>
                                <ul class="info">
                                    <li>{{newData1[i+1].artist}}</li>
                                    <li>{{newData1[i+1].name}}</li>
                                    <!-- <li>{{newData1[i+1].time}}</li> -->
                                    <li>{{newData1[i+1].classfiy}} {{newData1[i+1].size.x}}x{{newData1[i+1].size.y}} cm</li>
                                    <li>{{newData1[i+1].price | formatMoney}}</li>
                                </ul>
                            </router-link>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 探索全新的艺术世界 -->
            <div class="go">
                <div class="left">
                    <p>现在，去探索全新的艺术世界</p>
                    <div class="selectBox">
                        <select v-for="i in selectJSON" :key="i.code" v-model="i.model">
                            <option v-for="j in i.op" :key="j" :value="j">{{j}}</option>
                        </select>
                    </div>
                    <span>前往
                        <router-link to="/originalArt" tag="b">畅所艺言</router-link> 利用更强大的筛选引擎挑选作品 </span>
                </div>
                <div class="right" @click="goFun">
                    <p>开始</p>
                    <p>GO</p>
                    <div></div>
                </div>
            </div>
            <!-- 专题 -->
            <div class="specialBox">
                <div class="titleBox">
                    <div class="iconfont icon-icon2" @click="marginMove(1)"></div>
                    <h2>专题 / SPECIAL</h2>
                    <div class="iconfont icon-icon3" @click="marginMove(-1)"></div>
                </div>
                <div class="warp">
                    <div class="content" ref="content">
                        <div class="item" v-for="i in specialArr" :key="i.img" :style="{backgroundImage:'url(static/special/'+i.img+'.jpg)'}">
                            <div class="info">
                                <p v-html="i.title"></p>
                                <p>{{i.txt}}</p>
                            </div>
                            <div class="cover" @mouseover="zhankai" @mouseout="suohui"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 艺术家 -->
            <div class="artist">
                <div class="title">
                    <h2>艺术家 / ARTIST</h2>
                    <span>作品征集全面开放 </span>
                </div>
                <div class="content">
                    <div class="left">
                        <img src="/static/artist/wushuang.jpg" alt="">
                        <div>
                            <p>吴霜：做一个艺术的信徒</p>
                            <p>"艺术是信仰，你不信，它便什么也不是，你信，它就能给你所有。"</p>
                        </div>
                    </div>
                    <div class="right">
                        <p>更多艺术家</p>
                        <div class="showImg">
                            <div class="item" v-for="i in artistJSON" :key="i.name">
                                <div class="imgBox">
                                    <div v-for="j in i.art" :key="j._id" :style="{backgroundImage:'url(/static/goods/'+j.images+'.jpg)'}"></div>
                                </div>
                                <div class="name">
                                    <div>{{i.name}}</div>
                                    <div>{{i.count}}件</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            // banner 当前下标
            currIndex: 1,
            // banner 定时器
            timer: null,
            // 【推荐】【分类】
            classArr: ["油画", "版画", "水墨", "水彩"],
            // 当前分类
            currClassify: 0,
            // 【推荐】数据
            tuiJianData: [],
            // 【换一换】 是否旋转flag
            rotateClass: false,
            // 最新上架数据1
            newData0: [],
            // 最新上架数据2
            newData1: [],
            // 背后 div的下标
            back: 0,
            // 【换一换】 定时器
            timer2: 1,
            // 【换一换】 点击次数
            huanNum: 0,
            //四个下拉框
            selectJSON: [
                {
                    model: "类别",
                    op: ["类别", "油画", "版画", "水墨", "水彩(粉)", "雕塑", "摄影", "其他"],
                    code: "classfiy"
                },
                {
                    model: "价格",
                    op: [
                        "价格",
                        "¥2000以下",
                        "¥2000～8000",
                        "¥8000～15000",
                        "¥15000～30000",
                        "¥30000～max"
                    ],
                    code: "price"
                },
                {
                    model: "尺寸",
                    op: [
                        "尺寸",
                        "50cm以下",
                        "50cm～100cm",
                        "100cm～150cm",
                        "150cm～200cm",
                        "200cm～max"
                    ],
                    code: "size"
                },
                {
                    model: "风格",
                    op: ["风格", "抽象", "具象", "观念", "传统国画", "其他"],
                    code: "style"
                }
            ],
            // 专题数据
            specialArr: [
                {
                    img: "capricornus",
                    title: "周而复始 | 给摩羯的生日礼物",
                    txt: "黑色、墨绿色和咖啡色是摩羯的专属幸运色，这三种颜色大气沉稳，一定会俘获摩羯的心，给摩羯新的一年带来幸运。"
                },
                {
                    img: "20171222173115238937f619d",
                    title: "身体or心灵，总有一个要在路上",
                    txt:
                        "当看过了山和大海，穿过了人山人海，不管是停下脚步还是继续前行，都会对曾经看过的风景见过的人，有种放不下忘不了的情感，而这种旅行情结，或许可以靠画作来治愈。"
                },
                {
                    img: "20171222172816677ee714ab5",
                    title: "2018·心系这一刻的温暖",
                    txt: "双节来袭，必买爆款低至888元！"
                },
                {
                    img: "201712221734330325e0d83b6",
                    title: "红唇入画·性感不只裸露",
                    txt: "选择一幅“红唇”，让艺术给你一个爱的么么哒。"
                },
                {
                    img: "201712221735449688bafd0b4",
                    title: "城·事<br>一座城一个故事",
                    txt:
                        "每个人的记忆，或多或少都与一座城有关。万青在歌里唱到，住在我心里孤独的孤独的海怪，深海的光、停滞的海浪、站在能看到灯火的桥，描述的正是海滨之城。"
                },
                {
                    img: "notitle",
                    title: "这些作品都叫<br>《无题》",
                    txt:
                        "很多艺术家，都有那么几件作品叫「无题」灵感来了，由心而作，这种纯粹的艺术感觉没有条条框框去束缚，也许就差这么一个机会把它带回家，给它一个专属ID。"
                },
                {
                    img: "2017112818064833218c87b83",
                    title: "当星空遇上画笔|给你永恒的灿烂",
                    txt: "夜空中最亮的星，摘下来送给你。"
                },
                {
                    img: "art_and_design",
                    title: "当艺术遇到设计",
                    txt:
                        "当科学不耐烦，便产生了艺术。设计总与时间挂钩并不是偶然所得，在人类时间的长河里，艺术来源于生活，设计来源于艺术。"
                },
                {
                    img: "fashion",
                    title: "看艺术家如何大玩时尚元素",
                    txt: "秀场是时装精的舞台，画布就是艺术家的T台。"
                },
                {
                    img: "tiaowengezi",
                    title: "条纹X格子 | 强迫症的治愈良药",
                    txt:
                        "在众多强迫症中，艺术家是最奇妙的存在，他们将条纹和格子整齐的排列在画布之上，使整个画面都透露着工整严谨，让人看了，只觉舒服无比。"
                },
                {
                    img: "fengshui",
                    title: "风水配色帮您打造完美家居",
                    txt: "风水与颜色搭配的进阶阶段，是将自己渴望的色彩运用风水的力量带入你的家庭起居，使得“天地人合一”。 "
                },
                {
                    img: "hunger_and_love",
                    title: "饥饿与爱<br>都是不治之症",
                    txt: "爱情给人的安全感就像吃到好吃的食物一样，可以完全抵消掉焦虑情绪。 "
                },
                {
                    img: "rock",
                    title: "摇滚x艺术 | 是态度，更是风格，都会上瘾",
                    txt: "喜欢摇滚的你，除了买唱片，看现场，组band，还能如何让自己的生活更加摇滚呢~ "
                },
                {
                    img: "minimalist",
                    title: "认识极简主义，享受精致生活",
                    txt: "追求 minimalist life 的过程，就是深刻认识精致之美的过程。"
                }
            ],
            // 艺术家展示数据
            artistJSON: {
                count: 0,
                name: "",
                art: []
            }
        };
    },
    filters: {
        formatMoney(val) {
            return "￥" + String(val).replace(/\B(?=(?:\d{3})+$)/g, ",");
        }
    },
    methods: {
        // banner 小圆点点击事件
        clickLi(i) {
            clearInterval(this.timer);
            this.currIndex = i;
            this.autoplay();
        },
        // 自动轮播
        autoplay() {
            this.timer = setInterval(() => {
                this.currIndex < 6 ? this.currIndex++ : (this.currIndex = 1);
            }, 5000);
        },
        // 获取【推荐】数据，一次获取4个分类*4个
        getTuiJianData() {
            this.$http.get("/api/getTuiJianData").then(data => {
                this.tuiJianData = data.data;
            });
        },
        // 换一换 事件
        huanFun() {
            this.timer2 = 0;
            let back = this.back,
                front = Math.abs(this.back - 1);
            let itemEl = this.$refs.itemEl;
            itemEl.forEach((val, index) => {
                let time = index * 0.2;
                if (index >= 2) {
                    time = 0.4;
                }
                setTimeout(() => {
                    val.children[back].style.cssText =
                        "transform:rotateY(0deg);transition:transform 1.5s;";
                    val.children[front].style.cssText =
                        "transform:rotateY(180deg);transition:transform 1.5s;";
                    setTimeout(() => {
                        val.children[front].style.cssText =
                            "transform:rotateY(-180deg);transition:transform 0s;";
                        this.timer2 = 1;
                        if (index === 9) {
                            if (this.huanNum < 3) {
                                this.huanNum++;
                            } else this.huanNum = 0;
                            this.getNewData();
                        }
                        this.back = front;
                    }, 1400);
                }, time * 1000);
            });
        },
        // 获取 【最新上架】 10条数据
        getNewData(limit = 10) {
            let num = limit === 20 ? 0 : (this.huanNum + 1) * 10;
            this.$http.post("/api/getNewData", { num, limit }).then(data => {
                if (limit === 10) {
                    let i = "newData" + this.back;
                    this[i] = data.data;
                } else {
                    this.newData0 = data.data.slice(10, 20);
                    this.newData1 = data.data.slice(0, 10);
                }
            });
        },
        // Go事件
        goFun() {
            this.selectJSON.forEach(val => {
                sessionStorage[val.code] = val.model;
            });
            this.$router.push("/originalart");
        },
        // 专题 左右箭头事件
        marginMove(flag) {
            let content = this.$refs.content;
            content.style.marginLeft == "" && (content.style.marginLeft = "0");
            let ml = parseInt(content.style.marginLeft);
            if (flag === 1) {
                //向右移动
                if (ml < 0) content.style.marginLeft = ml + 838 + "px";
            } else {
                //向左移动
                if (ml > -3350) content.style.marginLeft = ml - 838 + "px";
            }
        },
        // 专题 item 移入展开效果
        zhankai(e) {
            e.target.parentNode.style.width = "440px";
            e.target.previousSibling.previousSibling.style.padding = "0 60px";
        },
        // 专题 item 移出缩回效果
        suohui(e) {
            e.target.parentNode.style.width = "320px";
            e.target.previousSibling.previousSibling.style.padding = "0 0";
        },
        // 获取艺术家数据
        getArtist() {
            this.$http.get("/api/getArtist").then(data => {
                this.artistJSON = data.data;
                console.log(this.artistJSON);
            });
        }
    },
    mounted() {
        this.autoplay();
        this.getTuiJianData();
        this.getNewData(20);
        this.getArtist();
    }
};
</script>

