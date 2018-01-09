<style lang="scss" scoped>
@mixin flexUi($justify:flex-start) {
    display: flex;
    justify-content: $justify;
    align-items: center;
    display: -webkit-flex;
    -webkit-justify-content: $justify;
    -webkit-align-items: center;
}
//美术馆、生活场景 切换按钮
.tabBox {
    position: absolute;
    top: 110px;
    left: 50%;
    z-index: 999;
    margin-left: -90px;
    width: 180px;
    height: 30px;
    border: 1px solid;
    border-radius: 15px;
    cursor: pointer;
    box-sizing: border-box;
    overflow: hidden;
    background-color: rgba(255, 255, 255, 0.2);
    &:hover {
        background-color: rgba(255, 255, 255, 0.6);
    }
    div {
        position: absolute;
        width: 50%;
        height: 30px;
        line-height: 30px;
        text-align: center;
        box-sizing: border-box;
        border: 1px solid transparent;
        margin-top: -1px;
    }
    div:first-child {
        margin-left: -1px;
    }
    div:last-child {
        right: 0;
        margin-right: -1px;
    }
    .currTab {
        background-color: #fff;
        border-radius: 15px;
        border: 1px solid #000;
    }
}
// 第一屏 作品展示 美术馆
.goodsBox {
    position: relative;
    height: calc(100vh - 70px);
    overflow: hidden;
    background: url("/static/img/msg_bg.jpg") top center no-repeat;
    background-size: 100% 100%;

    // 中间 作品图片展示
    .goodsShow {
        position: relative;
        margin: 0 auto;
        img {
            display: block;
            margin: 0 auto;
            cursor: zoom-in;
            transform: scale(1, 1);
            filter: drop-shadow(0 5px 4px rgba(0, 0, 0, 0.6));
            transition: transform 0.5s;
        }
        div {
            @include flexUi(space-between);

            position: absolute;
            color: #aaa;
            text-align: center;
            font-size: 14px;
            border-left: 1px solid;
            border-right: 1px solid;
            hr {
                width: 35%;
            }
        }
        .top {
            width: 100%;
            height: 20px;
            top: -35px;
            left: 0;
        }
        .left {
            height: 20px;
            left: -35px;
            top: -10px;
            transform: rotateZ(90deg);
            transform-origin: left center;
        }
        .zoomClass {
            transform: scale(1.45, 1.45);
            cursor: zoom-out;
        }
    }
    //右边  购物车、作品详情 icon
    .rightBox {
        position: absolute;
        top: 130px;
        right: 82px;
        width: 56px;
        height: 112px;
        .icon-gouwuchekong,
        .icon-caidan {
            width: 100%;
            height: 55px;
            color: #000;
            font-size: 30px;
            cursor: pointer;
            line-height: 55px;
            text-align: center;
            background-color: #fff;
            border-bottom: 1px solid #ccc;
            box-shadow: 0 1px 4px 0 rgba(0, 0, 0, 0.15);
            &:hover {
                background-color: #f8f8f8;
            }
        }
        .moneyBox {
            position: absolute;
            top: 0;
            right: 115%;
            width: 320px;
            background-color: #fff;
            box-shadow: 0 3px 4px 0 rgba(0, 0, 0, 0.2);
            div {
                padding: 20px;
                @include flexUi(space-between);
            }
            .top {
                font-size: 24px;
                span:last-child {
                    font-size: 12px;
                    text-align: center;
                    width: 30px;
                    height: 18px;
                    color: #ccc;
                    background-color: #4a4a4a;
                }
            }
            .info {
                justify-content: flex-start;
                -webkit-justify-content: flex-start;
                padding-top: 0;
                font-style: italic;
                color: #666;
                font-size: 13px;
                span:first-child {
                    margin-right: 10px;
                }
            }
            .center {
                justify-content: flex-start;
                -webkit-justify-content: flex-start;
                padding-left: 0;
                padding-top: 0;
                color: #666;
                font-size: 14px;
                border-bottom: 1px solid #eeeeee;
                .iconfont {
                    color: #ff0f0f;
                    margin-left: 20px;
                    margin-right: 7px;
                }
            }
            .buy {
                user-select: none;
                span {
                    width: 48%;
                    height: 40px;
                    line-height: 40px;
                    color: #fff;
                    background-color: #ee403c;
                    text-align: center;
                    cursor: pointer;
                }
                span:first-child {
                    &:hover {
                        background-color: #d23835;
                    }
                }
                span:last-child {
                    background-color: #000;
                    &:hover {
                        background-color: #333;
                    }
                }
            }
        }
        .infoBox {
            position: absolute;
            top: 0;
            right: 115%;
            width: 320px;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 3px 4px 0 rgba(0, 0, 0, 0.2);
            box-sizing: border-box;
            div {
                @include flexUi;
                font-size: 14px;
                padding-bottom: 20px;
            }
            .artist {
                font-size: 20px;
                img {
                    width: 20px;
                    margin-left: 10px;
                }
            }
            .info {
                font-size: 12px;
                color: #666;
                border-bottom: 1px solid #eee;
                span {
                    margin-right: 15px;
                }
            }
            .bjtj {
                margin-top: 20px;
            }
            .bj_content {
                color: #666;
                line-height: 30px;
            }
            .bj_name {
                color: #666;
                padding-bottom: 0;
                flex-direction: row-reverse;
                -webkit-flex-direction: row-reverse;
            }
        }
    }
    .fade-enter,
    .fade-leave-to {
        opacity: 0;
    }
    .fade-enter-active,
    .fade-leave-active {
        transition: opacity 1s;
    }
    .fade-enter-to,
    .fade-leave {
        opacity: 1;
    }
}
// 第一屏 作品展示 生活场景
.shcj {
    position: relative;
    height: calc(100vh - 70px);
    background-color: #f8f8f8;
    overflow: hidden;
    text-align: center;
    .bg {
        height: 100%;
    }
    .artImg {
        position: absolute;
        left: 40%;
        top: 15%;
        cursor: move;
        background-image: url("/static/goods/0.jpg");
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        filter: drop-shadow(0 5px 4px rgba(0, 0, 0, 0.6));
    }
    .moreScene {
        @include flexUi(space-between);
        position: absolute;
        bottom: -130px;
        width: 100%;
        height: 140px;
        background-color: rgba(0, 0, 0, 0.65);
        transition: bottom 1s;
        &:hover {
            bottom: 0;
        }
        .moreTxt {
            position: absolute;
            left: 0;
            top: -30px;
            width: 100px;
            height: 30px;
            line-height: 35px;
            text-align: center;
            font-size: 18px;
            color: #fff;
            cursor: pointer;
            background-color: rgba(0, 0, 0, 0.65);
        }
        .iconfont {
            color: #fff;
            font-size: 60px;
            cursor: pointer;
            margin: 0 10px;
        }
        .center {
            width: 1360px;
            overflow: hidden;
            .sceneImg {
                @include flexUi;
                transition: margin-left 1s;
                img {
                    height: 120px;
                    margin-right: 10px;
                    cursor: pointer;
                    &::last-child {
                        margin-right: 0;
                    }
                    &:hover {
                        opacity: 0.8;
                    }
                }
            }
        }
    }
}
//第二屏 评析与作品信息
.moreInfo {
    width: 1000px;
    margin: 50px auto 80px;
    .infoTab {
        color: #a8a8a8;
        border-bottom: 1px solid #000;
        margin-bottom: 90px;
        span {
            position: relative;
            display: inline-block;
            width: 120px;
            text-align: center;
            line-height: 30px;
            cursor: pointer;
            margin-right: 20px;
            &:hover {
                color: #000;
            }
        }
        .spanCheck {
            color: #000;
        }
        .spanCheck::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: -2px;
            width: 100%;
            border-bottom: 4px solid;
        }
    }
    // 艺术评析
    .tabContent_px {
        margin: 0 90px;
        .yspx {
            position: relative;
            span {
                position: absolute;
                font-size: 210px;
                color: #f1f1f1;
                line-height: 30px;
                &:first-child {
                    right: 102%;
                    top: 40px;
                }
                &:last-child {
                    left: 102%;
                    bottom: -70px;
                }
            }
            div {
                font-size: 18px;
                line-height: 36px;
                font-style: italic;
                font-family: serif !important;
                p:last-child {
                    text-align: right;
                }
            }
        }
        .otherPx {
            @include flexUi(space-between);
            margin-top: 80px;

            .jubuImg {
                width: 300px;
                height: 300px;
            }
            .px {
                width: 50%;
                font-size: 14px;
                color: #666;
                line-height: 30px;
            }
        }
    }
    // 艺术品信息
    .tabContent_info {
        margin: 0 30px;
        .delaitInfo {
            @include flexUi;
            align-items: flex-start;
            -webkit-align-items: flex-start;
            font-size: 14px;
            color: #666;
            ul {
                li {
                    margin: 15px 0;
                    span {
                        display: inline-block;
                        margin-right: 50px;
                        &:first-child {
                            position: relative;
                            width: 70px;
                            text-align-last: justify;
                            &::after {
                                content: ":";
                                position: absolute;
                                top: 2px;
                                left: 102%;
                            }
                        }
                    }
                }
                &:first-child {
                    margin-right: 180px;
                }
            }
        }
        .tipBox {
            margin-top: 50px;
            font-size: 14px;
            .title {
                position: relative;
                .iconfont {
                    position: absolute;
                    left: -25px;
                    top: 4px;
                    font-size: 14px;
                }
            }
            .tipTxt {
                color: #666;
                div {
                    font-weight: bold;
                }
                .classify {
                    color: #000;
                    margin-top: 50px;
                }
                .title2 {
                    margin: 60px 0 30px;
                }
                ul {
                    li {
                        list-style: disc inside;
                        margin: 10px 0;
                    }
                }
                p {
                    margin-top: 30px;
                }
            }
        }
    }
}
//第三屏 作者与更多作品
.artistMoreArt {
    background-color: #eee;
    padding: 50px 0;
    ul {
        width: 1200px;
        margin: 0 auto;
        @include flexUi;
        li {
            width: 290px;
            height: 380px;
            margin-right: calc((1200px - 290px*4)/3);
            background-color: #fff;
            transition: box-shadow 0.5s;
            border-radius: 2px;
            &:hover {
                box-shadow: 0 1px 10px 0 rgba(0, 0, 0, 0.3);
            }
            &:last-child {
                margin-right: 0;
            }
        }
        .artist {
            text-align: center;
            .artist_img {
                width: 150px;
                margin: 40px 0;
                cursor: pointer;
            }
            .info {
                @include flexUi(center);
                justify-content: center;
                -webkit-justify-content: center;
                margin-bottom: 30px;
                img {
                    width: 20px;
                    margin-left: 5px;
                }
            }
            .gong {
                color: #aaa;
                font-size: 14px;
                span {
                    color: #000;
                }
            }
        }
        .art {
            .info {
                color: #666;
                font-size: 14px;
                margin: 30px 0 0 20px;
                p {
                    margin-bottom: 5px;
                }
                span {
                    margin-right: 15px;
                }
                .money {
                    color: #000;
                    margin-top: 20px;
                    font-size: 16px;
                }
            }
        }
    }
}
.cheng {
    height: 150px;
}
// 添加购物车提示
.gwcTips {
    @include flexUi(center);
    position: fixed;
    top: 0;
    z-index: 1000;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.3);
    .tips {
        width: 300px;
        box-shadow: rgb(153, 153, 153) 0px 0px 10px;
        border: 2px solid rgb(0, 0, 0);
        .top {
            @include flexUi(space-between);
            padding: 10px 20px;
            background-color: #f7f7f7;
            span:last-child {
                cursor: pointer;
            }
        }
        .bottom {
            padding: 20px;
            text-align: center;
            background-color: #fff;
        }
    }
}
</style>
<template>
    <div class="main" @click.self="shocarTips=''">
        <!-- 美术馆、生活场景 切换按钮 -->
        <div class="tabBox">
            <div :class="{currTab:tabIndex===1}" @click="tabFun(1)">美术馆</div>
            <div :class="{currTab:tabIndex===2}" @click="tabFun(2)">生活场景</div>
        </div>
        <!-- 第一屏 作品展示 美术馆-->
        <div class="goodsBox" v-show="tabIndex===1" @click.self="showBox(0)">
            <!-- 作品图片展示-->
            <div class="goodsShow" @mouseover="tabIndex===1 && sizeFun(1)" @mouseout="tabIndex===1 && sizeFun(0)">
                <transition name="fade">
                    <div class="top" v-if="showSize"><hr>{{(goodsInfo.size.x / 100).toFixed(2)}}m<hr></div>
                </transition>
                <img ref="imgEl" alt="图片" @click="isZoom=!isZoom,showSize=false" :class="{zoomClass:isZoom}" draggable="false">
                <transition name="fade">
                    <div ref="leftEl" v-show="showSize" class="left"><hr>
                        <span v-if="goodsInfo.size">{{(goodsInfo.size.y / 100).toFixed(2)}}m</span> <hr></div>
                </transition>
            </div>
            <!-- 购物车、详情 -->
            <div class="rightBox">
                <div class="iconfont icon-gouwuchekong" @mouseover="showBox(1,0,1)"></div>
                <div class="iconfont icon-caidan" @mouseover="showBox(1,1,0)"></div>
                <!-- 加入购物车 -->
                <transition name="fade">
                    <div class="moneyBox" v-if="showMoney">
                        <div class="top">
                            <span>¥7,700</span>
                            <span v-if="goodsInfo.status==='0'">已售</span>
                            <span v-else>未售</span>
                        </div>
                        <div class="info">
                            <span>{{goodsInfo.artist}}</span>
                            <span>{{goodsInfo.name}}</span>
                        </div>
                        <div class="center">
                            <span class="iconfont icon-gouquan"></span>原创
                            <span class="iconfont icon-gouquan"></span>无装裱
                        </div>
                        <div class="buy">
                            <span @click="addShopcar">加入购物车</span>
                            <span @click="nowBuy">立即购买</span>
                        </div>
                    </div>
                </transition>
                <!-- 详细信息 -->
                <transition name="fade">
                    <div class="infoBox" v-if="showInfo">
                        <div class="artist">
                            <span>{{goodsInfo.artist}}</span>
                            <img src="/static/img/artist_icon.png" alt="">
                        </div>
                        <div class="info">
                            <span>{{goodsInfo.name}}</span>
                            <span>{{goodsInfo.classify}}</span>
                            <span>{{goodsInfo.time}}</span>
                            <span>{{goodsInfo.size.x}}x{{goodsInfo.size.y}}cm</span>
                        </div>
                        <div class="bjtj">编辑推荐</div>
                        <div class="bj_content">
                            {{goodsInfo.appraiseArr && goodsInfo.appraiseArr[0].content}}
                        </div>
                        <div class="bj_name">——{{goodsInfo.appraiseArr && goodsInfo.appraiseArr[0].name}}</div>
                    </div>
                </transition>
            </div>
        </div>
        <!-- 第一屏 作品展示 生活场景-->
        <div class="shcj" v-show="tabIndex===2">
            <img class="bg" draggable="false" :src="'/static/img/scene'+imgIndex+'.jpg'" alt="生活场景图">
            <div class="artImg" ref="imgEl2"></div>
            <!-- 更多场景 -->
            <div class="moreScene">
                <div class="moreTxt">更多场景</div>
                <div class="iconfont icon-icon2" @click="moveFun(1)"></div>
                <div class="center">
                    <div class="sceneImg" ref="sceneImgEl">
                        <img v-for="i in 13" :key="i" :src="'/static/img/scene'+i+'.jpg'" alt="生活场景图片" @click="imgIndex=i">
                    </div>
                </div>
                <div class="iconfont icon-icon3" @click="moveFun(-1)"></div>
            </div>
        </div>
        <!-- 第二屏 评析与作品信息-->
        <div class="moreInfo">
            <div class="infoTab">
                <span :class="{spanCheck:tabIndex2===1}" @click="tabIndex2=1">艺术评析</span>
                <span :class="{spanCheck:tabIndex2===2}" @click="tabIndex2=2">艺术品信息</span>
            </div>
            <!-- 艺术评析 -->
            <div class="tabContent_px" v-if="tabIndex2===1">
                <!-- 艺术评析 -->
                <div class="yspx">
                    <span>“</span>
                    <div v-if="goodsInfo.appraiseArr">
                        <p>{{goodsInfo.appraiseArr[0].content}}</p>
                        <p>
                            <b v-if="goodsInfo.appraiseArr[0].name">——</b>{{goodsInfo.appraiseArr[0].name}}</p>
                    </div>
                    <span>”</span>
                </div>
                <!-- 局部图+评析 -->
                <div class="otherPx" v-for="i in bgImg.length" :key="i">
                    <div class="jubuImg" :style="bgImg[i-1]"></div>
                    <div class="px" v-if="goodsInfo.appraiseArr">
                        {{goodsInfo.appraiseArr[i].content}}
                        <span v-if="goodsInfo.appraiseArr[i].name">——</span> {{goodsInfo.appraiseArr[i].name}}
                    </div>
                </div>
            </div>
            <!-- 艺术品信息 -->
            <div class="tabContent_info" v-else>
                <!-- 详细信息 -->
                <div class="delaitInfo">
                    <ul class="left">
                        <li v-for="i in leftInfo" :key="i.name">
                            <span>{{i.name}}</span>
                            <span v-if="i.name==='尺寸'">{{goodsInfo[i.code].x}}x{{goodsInfo[i.code].y}}cm</span>
                            <span v-else>{{goodsInfo[i.code]}}</span>
                        </li>
                    </ul>
                    <ul class="right">
                        <li v-for="i in rightInfo" :key="i.name">
                            <span>{{i.name}}</span>
                            <span>{{goodsInfo[i.code]}}</span>
                        </li>
                    </ul>
                </div>
                <!-- 小贴士 -->
                <div class="tipBox">
                    <div class="title">
                        <i class="iconfont icon-qizhi"></i>艺言小贴士
                    </div>
                    <div class="tipTxt">
                        <div class="classify">绘画作品</div>
                        <div class="title2">◎存放</div>
                        <ul>
                            <li>放置画作的理想环境为室温14℃-18℃，相对湿度50%-60%；</li>
                            <li>避光、防潮请避免阳光长期直射画面，保持画作放置处的空气流通，并远离厨卫等湿气较重的地方，避免灰尘、油烟损害画作；</li>
                            <li>防风请勿在空调口、暖气扇旁放置画作，避免风力过大造成画作受损；</li>
                            <li>防损请勿过于频繁地搬动画作，并避免任何腐蚀性材料（如化学药剂、清洁剂等）接触画面；观赏画作时，请尽量避免肢体与画作的直接接触。</li>
                        </ul>
                        <div class="title2">◎清洁与保养</div>
                        <p>油画</p>
                        <ul>
                            <li>请使用干净、柔软的材料（擦布或黑貂豪笔）轻轻擦拭画上的灰尘；避免清洁剂、海绵或吸尘器接触画面；</li>
                            <li>若受潮，请先用净布吸去水渍，再进行阴干，切忌暴晒；</li>
                            <li>切勿将两张油画对贴放置，一旦画面粘连，会导致油彩脱坏。</li>
                        </ul>
                        <p>中国画</p>
                        <ul>
                            <li>请使用软质毛刷（如拂尘、羽毛掸子）清除灰尘，勿使用布类，并保证动作轻柔，避免损伤画纸；</li>
                            <li>若受潮，请用干布或纸巾吸水，再进行阴干，切忌暴晒；</li>
                        </ul>
                        <p>版画</p>
                        <ul>
                            <li>未装裱的版画，请平铺放于干燥处或卷入画筒内；若多张叠放，请在画作之间用软质白纸进行分隔；</li>
                            <li>已装裱的版画，定期用擦布或纸巾清洁画框即可。</li>
                        </ul>
                        <div class="classify">雕塑作品</div>
                        <div class="title2">◎存放</div>
                        <ul>
                            <li>放置雕塑品的理想温度为18℃-24℃，相对湿度为40%-50%。请勿将作品放于过高或过低的温度和湿度下，易引起作品变形损坏；</li>
                            <li>防损请将雕塑品放于平稳处，避免碰撞、叠压作品造成物理损伤。</li>
                        </ul>
                        <div class="title2">◎清洁与保养</div>
                        <ul>
                            <li>请用柔软的干布或软毛刷清洁雕塑品表面，切勿用湿布或化学试剂擦拭作品，避免作品受到腐蚀；</li>
                            <li>接触作品时，请尽量保持动作轻柔，避免损害作品。</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- 第三屏 作者与更多作品 -->
        <div class="artistMoreArt">
            <ul>
                <!-- 艺术家 信息 -->
                <li class="artist">
                    <img class="artist_img" :src="'/static/artist/'+artistObj.photo" alt="作者图片">
                    <div class="info">
                        <b>{{artistObj.ch_name}}</b>
                        <img src="/static/img/artist_icon.png" alt="">
                    </div>
                    <div class="gong">共
                        <span>{{artCount}}</span>
                        件作品</div>
                </li>
                <!-- 3个艺术品 -->
                <li class="art" v-for="i in artistArt" :key="i._id">
                    <!-- 作品图片 -->
                    <div @click="goFun(i)" :style="{height: '230px',cursor: 'pointer',background:'url(/static/goods/'+i.images+'.jpg) center center no-repeat',backgroundSize:'100%'}">
                    </div>
                    <div class="info">
                        <p>{{i.name}}</p>
                        <div>
                            <span>{{i.meterial}}</span>
                            <span>{{i.size.x}}x{{i.size.y}}cm</span>
                            <span>{{i.time}}</span>
                        </div>
                        <div class="money">{{i.price | formatMoney}}</div>
                    </div>
                </li>
            </ul>
        </div>
        <!-- 撑的 -->
        <div class="cheng"></div>
        <!-- 添加购物车提示 -->
        <div class="gwcTips" v-if="shocarTips" @click="shocarTips=''">
            <div class="tips">
                <div class="top">
                    <span>提示</span>
                    <span class="iconfont icon-icon"></span>
                </div>
                <div class="bottom">{{shocarTips}}</div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            //tab 美术馆、生活场景 当前显示
            tabIndex: 1,
            //艺术评析和艺术品信息 tab
            tabIndex2: 1,
            //生活场景 当前图片 下标
            imgIndex: 1,
            // 显示尺寸 线
            showSize: false,
            // 尺寸消失 延迟时间
            sizeTimer: null,
            //是否 放大图片
            isZoom: false,
            //移入 显示价格
            showMoney: false,
            //移入 显示信息
            showInfo: false,
            //定时器
            timer: null,
            //评析 局部图
            bgImg: [],
            // 艺术品信息 左边列表
            leftInfo: [
                {
                    name: "作品名称",
                    code: "name"
                },
                {
                    name: "艺术家",
                    code: "artist"
                },
                {
                    name: "材质",
                    code: "meterial"
                },
                {
                    name: "尺寸",
                    code: "size"
                },
                {
                    name: "创作时间",
                    code: "time"
                }
            ],
            // 艺术品信息 右边列表
            rightInfo: [
                {
                    name: "作品类型",
                    code: "classify"
                },
                {
                    name: "风格",
                    code: "style"
                },
                {
                    name: "题材",
                    code: "theme"
                },
                {
                    name: "摆放空间",
                    code: "position"
                }
            ],
            // 底部 作者的3个作品
            artistArt: [],
            // 作者信息
            artistObj: {},
            // 作者作品数量
            artCount: null,
            //作品信息
            goodsInfo: [],
            // 加入购物车提示
            shocarTips: ""
        };
    },
    //过滤器
    filters: {
        //金额格式化
        formatMoney(val) {
            return "￥" + String(val).replace(/\B(?=(?:\d{3})+$)/g, ",");
        }
    },
    methods: {
        // 移入显示 尺寸
        sizeFun(flag) {
            if (flag) {
                clearTimeout(this.sizeTimer);
                this.showSize = true;
            } else {
                this.sizeTimer = setTimeout(() => {
                    this.showSize = false;
                }, 2000);
            }
        },
        // 价格、作品信息 移入切换事件
        showBox(flag, si, hi) {
            let arr = ["showMoney", "showInfo"];
            if (flag) {
                //为真：显示当前，隐藏非当前
                this[arr[si]] = true;
                this[arr[hi]] = false;
            } else {
                this[arr[0]] = this[arr[1]] = false;
            }
        },
        // 重新刷新本页面，获取新点击的_id
        goFun(i) {
            this.$router.push({
                path: "/goodsDetails/" + i._id + "/imgSrc/" + i.images
            });
            this.getOneArt();
        },
        // 美术馆、生活场景切换 事件
        tabFun(flag) {
            this.tabIndex = flag;
            if (flag === 2) {
                let imgEl2 = this.$refs.imgEl2;
                imgEl2.onmousedown = function(ev) {
                    let oevent = ev || event,
                        distanceX = oevent.clientX - imgEl2.offsetLeft,
                        distanceY = oevent.clientY - imgEl2.offsetTop,
                        clientWidth = document.body.clientWidth,
                        clientHeight = window.screen.height,
                        width = imgEl2.offsetWidth,
                        height = imgEl2.offsetHeight;

                    document.onmousemove = function(ev) {
                        let oevent = ev || event;
                        imgEl2.style.left =
                            oevent.clientX <= distanceX
                                ? "0px"
                                : width - distanceX + oevent.clientX >=
                                  clientWidth
                                  ? clientWidth - width + "px"
                                  : oevent.clientX - distanceX + "px";

                        imgEl2.style.top =
                            oevent.clientY <= distanceY
                                ? "0px"
                                : oevent.clientY - distanceY + "px";
                    };
                    document.onmouseup = function() {
                        document.onmousemove = null;
                        document.onmouseup = null;
                    };
                };
            }
        },
        // 生活场景下面的 左右箭头点击，左右轮播滚动
        moveFun(flag) {
            let sceneImgEl = this.$refs.sceneImgEl;
            sceneImgEl.style.marginLeft == "" &&
                (sceneImgEl.style.marginLeft = "0");
            let ml = parseInt(sceneImgEl.style.marginLeft);
            if (flag === 1) {
                //向右移动
                if (ml < 0) sceneImgEl.style.marginLeft = ml + 700 + "px";
            } else {
                //向左移动
                if (ml > -1360) sceneImgEl.style.marginLeft = ml - 700 + "px";
            }
        },
        // 加入购物车
        addShopcar() {
            if (this.$store.state.login.loginID === null)
                this.$router.push("/login");
            else if (this.goodsInfo.status === "0") {
                this.shocarTips = "该作品已出售，请另选作品";
            } else {
                let time = new Date(),
                    year = time.getFullYear(),
                    month = time.getMonth() + 1,
                    day = time.getDate();
                this.$http
                    .post("/api/addShopcar", {
                        userid: this.$store.state.login.loginID,
                        goodid: this.$route.params.id,
                        time: `${year}-${month}-${day}`
                    })
                    .then(data => {
                        if (data.data) {
                            this.shocarTips = "添加购物车成功";
                        } else {
                            this.shocarTips = "购物车内已存在，请勿重复添加";
                        }
                    });
            }
        },
        // 立即购买
        nowBuy() {},
        // 获取 作品信息
        getOneArt() {
            let id = this.$route.params.id;
            //获取作品信息
            this.$http.post("/api/getGoodsById", { id }).then(data => {
                this.goodsInfo = data.data;
                //获取艺术家信息+3个作品
                this.$http
                    .post("/api/getArtistAndArt", {
                        artist: data.data.artist,
                        _id: id
                    })
                    .then(data => {
                        this.artCount = data.data.count;
                        this.artistObj = data.data.data[0][0];
                        this.artistArt = data.data.data[1];
                    });
                // 设置作品展示的图片和局部图片
                this.$nextTick(() => {
                    let imgObj = new Image(),
                        len = this.goodsInfo.appraiseArr.length - 1;
                    imgObj.src =
                        "/static/goods/" + this.goodsInfo.images + ".jpg";
                    for (let i = 0; i < len; i++) {
                        let y = parseInt(Math.random() * 100),
                            x = parseInt(Math.random() * 100);
                        this.bgImg.push({
                            background: `url(/static/goods/${this.goodsInfo
                                .images}.jpg) ${x}% ${y}% no-repeat`,
                            backgroundSize: "200%"
                        });
                    }
                    imgObj.onload = () => {
                        this.$refs.imgEl.src = imgObj.src;
                        this.$refs.imgEl.height = imgObj.height * 0.35;
                        this.$refs.imgEl.parentNode.style.width =
                            imgObj.width * 0.35 + "px";
                        this.$refs.imgEl2.style.backgroundImage =
                            "url(" + imgObj.src + ")";
                        this.$refs.imgEl2.style.height =
                            imgObj.height * 0.25 + "px";
                        this.$refs.imgEl2.style.width =
                            imgObj.width * 0.25 + "px";
                        this.$refs.leftEl.style.width =
                            this.$refs.imgEl.height - 2 + "px";
                        this.$refs.imgEl.parentNode.style.marginTop =
                            "calc((100vh - 70px - " +
                            this.$refs.imgEl.height +
                            "px)/2)";
                    };
                });
            });
            // 延迟5秒 关闭 金额显示
            setTimeout(() => {
                this.showMoney = false;
            }, 5000);
        }
    },
    mounted() {
        this.getOneArt();
    }
};
</script>


