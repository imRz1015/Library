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
    // h4 小标题 公用css
    h4 {
        text-indent: 20px;
        padding-bottom: 10px;
        margin: 70px 0 30px;
        border-bottom: 1px solid #ddd;
    }
    // 订单详情
    .orderDetails {
        margin: 0 20px;
        // 订单第一行
        .lienOne {
            @include flexUi(space-between);
            padding-bottom: 0;
            transition: padding-bottom 1s;
            .left {
                .red {
                    color: #f00;
                    margin-left: 40px;
                }
            }
            .right {
                cursor: pointer;
                user-select: none;
                .iconfont {
                    font-size: 14px;
                    margin-left: 5px;
                }
            }
        }
        .pb {
            padding-bottom: 40px;
        }
        // 订单更多信息 行
        .orderMore {
            height: 250px;
            font-size: 12px;
            box-sizing: border-box;
            li {
                @include flexUi;
                align-items: flex-start;
                margin-bottom: 20px;
                & > div:first-child {
                    width: 100px;
                }
                &:last-child {
                    margin-bottom: 0;
                }
                .mr10 {
                    span {
                        margin-right: 10px;
                    }
                }
                p {
                    margin-bottom: 10px;
                    &:last-child {
                        margin-bottom: 0;
                    }
                }
            }
        }
        .zhankai-enter,
        .zhankai-leave-to {
            height: 0;
            opacity: 0;
        }
        .zhankai-enter-active,
        .zhankai-leave-active {
            transition: all 1s;
        }
        .zhankai-enter-to,
        .zhankai-leave {
            height: 250px;
            opacity: 1;
        }
    }
    // 支付方式
    .payWay {
        margin: 0 20px;
        li {
            @include flexUi;
            width: 50%;
            margin-bottom: 20px;
            .yuan {
                @include flexUi(center);
                width: 22px;
                height: 22px;
                box-sizing: border-box;
                border: 1px solid #c0c0c0;
                border-radius: 50%;
                cursor: pointer;
                user-select: none;
                .liyuan {
                    width: 10px;
                    height: 10px;
                    background-color: #000;
                    border-radius: 100%;
                }
            }
            .payitem {
                @include flexUi;
                width: 140px;
                height: 40px;
                border: 1px solid #333;
                box-sizing: border-box;
                margin: 0 20px;
                border-radius: 4px;
                cursor: pointer;
                user-select: none;
                .icon {
                    font-size: 26px;
                    margin: 0 10px;
                }
            }
            .tips {
                color: #bbb;
                font-size: 12px;
            }
        }
        // 支付方式选中 css
        .payCheck {
            .yuan,
            .payitem {
                border: 2px solid #000;
            }
        }
    }
    // 支付按钮
    .btnBox {
        @include flexUi(flex-end);
        font-size: 16px;
        letter-spacing: 5px;
        margin: 30px 20px 120px;
        padding-top: 50px;
        border-top: 1px solid #ddd;
        div {
            width: 170px;
            height: 40px;
            background-color: #000;
            color: #fff;
            text-align: center;
            line-height: 40px;
            cursor: pointer;
        }
    }
    // 提示框
    .gwcTips {
        @include flexUi(center);
        position: fixed;
        top: 0;
        left: 0;
        z-index: 1000;
        width: 100vw;
        height: 100vh;
        background-color: rgba(0, 0, 0, 0.3);
        .tips {
            width: 300px;
            box-shadow: rgb(153, 153, 153) 0px 0px 10px;
            border: 2px solid rgb(0, 0, 0);
            background-color: #fff;
            div {
                padding: 20px;
            }
            .top {
                @include flexUi(space-between);
                padding: 10px 20px;
                background-color: #f7f7f7;
                span:last-child {
                    cursor: pointer;
                }
            }
            .center {
                text-align: center;
            }
            .bottom {
                padding-top: 0;
                @include flexUi(center);
                span {
                    width: 70px;
                    text-align: center;
                    height: 30px;
                    line-height: 30px;
                    cursor: pointer;
                    &:first-child {
                        margin-right: 20px;
                        background-color: #000;
                        color: #fff;
                    }
                    border: 1px solid;
                }
            }
        }
    }
}
</style>
<template>
    <div class="main">
        <h4>订单</h4>
        <!-- 订单详情 -->
        <div class="orderDetails">
            <div class="lienOne" :class="{pb:isopen}">
                <div class="left">
                    <span>订单金额：</span>
                    <span class="red">{{orderObj.totalPrice | formatMoney}}</span>
                </div>
                <div class="right" @click="isopen=!isopen">
                    订单详情
                    <i v-if="isopen" class="iconfont icon-jiantou-copy-copy"></i>
                    <i v-else class="iconfont icon-jiantou-copy"></i>
                </div>
            </div>
            <transition name="zhankai">
                <ul class="orderMore" v-if="isopen">
                    <li>
                        <div>订单号：</div>
                        <div>{{orderObj.sn}}</div>
                    </li>
                    <li>
                        <div>下单时间：</div>
                        <div>{{orderObj.time}}</div>
                    </li>
                    <li>
                        <div>送货信息：</div>
                        <div class="mr10">
                            <span v-for="i in orderObj.address" :key="i">{{i}}</span>
                        </div>
                    </li>
                    <li>
                        <div>商品信息：</div>
                        <div>
                            <p v-for="i in orderObj.goods" :key="i._id" class="mr10">
                                <span>{{i.name}}</span>
                                <span>{{i.artist}}</span>
                                <span>{{i.classfiy}}</span>
                                <span>{{i.size.x}}x{{i.size.y}}cm</span>
                                <span>{{i.price | formatMoney}}</span>
                            </p>
                        </div>
                    </li>
                    <li>
                        <div>已优惠：</div>
                        <div>{{orderObj.discount | formatMoney}}</div>
                    </li>
                    <li>
                        <div>备注：</div>
                        <div></div>
                    </li>
                </ul>
            </transition>
        </div>
        <h4>支付方式</h4>
        <!-- 支付方式 -->
        <ul class="payWay">
            <li v-for="(i,index) in payArr" :key="i.name" :class="{payCheck:payChoosed===index}">
                <div class="yuan" @click="payChoosed=index">
                    <div class="liyuan" v-if="payChoosed===index"></div>
                </div>
                <div class="payitem" @click="payChoosed=index">
                    <svg class="icon" aria-hidden="true">
                        <use :xlink:href="i.icon"></use>
                    </svg>{{i.name}}支付
                </div>
                <div class="tips"> {{i.tips}} </div>
            </li>
        </ul>
        <!-- 支付按钮 -->
        <div class="btnBox">
            <div @click="paymoney">去支付</div>
        </div>
        <!-- 提示框 -->
        <div class="gwcTips" v-if="msg!==''" @click="msg=''">
            <div class="tips">
                <div class="top">
                    <span>提示</span>
                    <span class="iconfont icon-icon"></span>
                </div>
                <div class="center">{{msg}}</div>
                <div class="bottom">
                    <span class="queding" @click="msg.match('删除') && doDel()">确定</span>
                    <span v-if="msg.match('删除')">取消</span>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            // 提示框 内容
            msg: "",
            // 是否展开订单详情栏
            isopen: false,
            // 订单详情数据
            orderObj: {},
            // 支付方式数据
            payArr: [
                {
                    name: "微信",
                    tips: "推荐微信用户使用，扫二维码在线支付",
                    icon: "#icon-weixinzhifu"
                },
                {
                    name: "支付宝",
                    tips: "推荐有支付宝账户的用户使用",
                    icon: "#icon-alipay"
                },
                {
                    name: "转账",
                    tips: "通过您的开户银行或相应的电子银行进行转账",
                    icon: "#icon-zhuanzhang"
                },
                {
                    name: "银联",
                    tips: "无需开通网银即可实现线上支付",
                    icon: "#icon-yinlian"
                }
            ],
            // 选中的支付方式
            payChoosed: null
        };
    },
    methods: {
        paymoney() {
            if (this.payChoosed === null) this.msg = "请选择支付方式";
            else this.msg = this.payArr[this.payChoosed].name + "支付";
        }
    },
    filters: {
        formatMoney(val) {
            return "￥" + String(val).replace(/\B(?=(?:\d{3})+$)/g, ",");
        }
    },
    mounted() {
        let _id = this.$route.params.status;
        _id = _id.slice(1, _id.length);
        this.$http.post("/api/selectOrders", { _id }).then(data => {
            this.orderObj = data.data[0];
        });
    }
};
</script>


