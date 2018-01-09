<style lang="scss" scoped>
@mixin flexUi($justify:flex-start) {
    display: flex;
    display: -webkit-flex;
    -webkit-align-items: center;
    align-items: center;
    -webkit-justify-content: $justify;
    justify-content: $justify;
}
.main {
    position: absolute;
    width: 100%;
    padding: 80px 0 200px;
    background-color: #fff;
    .all {
        max-width: 960px;
        margin: 0 auto;
        // 我的购物车
        h2 {
            padding-bottom: 10px;
            border-bottom: 1px solid #ccc;
            text-align: right;
        }
        // 公共css
        // 结算
        .jiesuanBox {
            @include flexUi(space-between);
            // 左边
            .left {
                @include flexUi;
                cursor: pointer;
                color: #666;
                font-size: 12px;
                user-select: none;
                .iconfont {
                    margin-right: 8px;
                }
                .icon-kuangxuan-copy {
                    color: #000;
                    font-weight: bold;
                }
            }
            // 右边
            .right {
                @include flexUi;
                .left {
                    @include flexUi;
                    b {
                        color: #000;
                        margin: 0 2px;
                    }
                    span {
                        color: #ee403c;
                        font-weight: bold;
                        font-size: 18px;
                        margin-left: 20px;
                    }
                }
                .btn {
                    color: #fff;
                    background: #ccc;
                    width: 140px;
                    line-height: 36px;
                    text-align: center;
                    user-select: none;
                    font-size: 16px;
                    margin-left: 30px;
                }
                .canJieSuan {
                    background-color: #000;
                    cursor: pointer;
                }
            }
        }
        // 内容
        .content {
            padding: 30px 20px;
            // 作品列表
            .goodList {
                // 时间
                .time {
                    text-align: center;
                    font-size: 14px;
                    font-weight: 400;
                    color: #000;
                    font-weight: bold;
                    margin: 40px 0 20px;
                }
                // 作品列表包裹层
                ul {
                    li {
                        display: flex;
                        justify-content: space-between;
                        padding: 20px;
                        border: 2px solid #c0c0c0;
                        margin-bottom: 20px;
                        &:hover .right .remove {
                            display: block;
                        }
                        // 左侧
                        .left {
                            display: flex;
                            align-items: flex-start;
                            // 选中框
                            .kuang {
                                cursor: pointer;
                                .iconfont {
                                    color: #979797;
                                }
                                .icon-kuangxuan-copy {
                                    color: #000;
                                    font-weight: bold;
                                }
                            }
                            // 作品图片
                            .imgBox {
                                width: 120px;
                                height: 120px;
                                margin-left: 20px;
                                margin-right: 50px;
                                cursor: pointer;
                                background-image: url("/static/goods/0.jpg");
                                background-size: cover;
                                background-repeat: no-repeat;                                
                            }
                            // 作品详细信息
                            .info {
                                h4 {
                                    padding-bottom: 8px;
                                    font-size: 16px;
                                    font-weight: normal;
                                }
                                p {
                                    color: #a8a8a8;
                                    font-size: 12px;
                                    margin: 5px 0;
                                }
                                .artist {
                                    cursor: pointer;
                                }
                            }
                        }
                        // 右侧
                        .right {
                            display: flex;
                            flex-direction: column;
                            justify-content: space-between;
                            text-align: right;
                            .remove {
                                font-size: 13px;
                                color: #333;
                                cursor: pointer;
                                display: none;
                            }
                        }
                    }
                    .choosedLi {
                        border-color: #000;
                    }
                }
            }
        }
        // fixed的结算框
        .fixed {
            position: fixed;
            bottom: 0;
            width: 920px;
            padding: 0 20px;
            background-color: #f8f8f8;
            .btn {
                padding: 4px 0;
            }
        }
        // 删除确认框
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
    // 空空如也
    .kong {
        position: fixed;
        top: 60%;
        left: 50%;
        width: 120px;
        margin-left: -60px;
        line-height: 30px;
        color: #777777;
        font-size: 20px;
        letter-spacing: 1px;
    }
}
</style>
<template>
    <div class="main">
        <div class="all">
            <h2>我的购物车 ({{totalNum}})</h2>
            <!-- 内容 -->
            <div class="content">
                <!-- 结算 -->
                <div class="jiesuanBox">
                    <div class="left" @click="allChoosedFun">
                        <span v-if="allChoosed" class="iconfont icon-kuangxuan-copy"></span>
                        <span v-else class="iconfont icon-kuang"></span>
                        全选
                    </div>
                    <div class="right">
                        <div class="left">
                            已选商品
                            <b>{{choosedNum}}</b> 件（无运费、装裱费）
                            <span>{{totalMoney | formatMoney}}</span>
                        </div>
                        <div class="btn" :class="{canJieSuan:choosedNum}" @click="jieSuanFun">结算</div>
                    </div>
                </div>
                <!-- 商品列表 -->
                <div class="goodList" v-if="shopcar.length" v-for="(i,iIndex) in shopcar" :key="i.time">
                    <p class="time" v-if="i.goods.length">{{i.time}}</p>
                    <ul>
                        <li v-for="(j,jIndex) in i.goods" :key="j._id" :class="{choosedLi:i.choosed[jIndex]}">
                            <div class="left">
                                <div class="kuang" @click="oneChoosed(i,jIndex)">
                                    <span v-if="i.choosed[jIndex]" class="iconfont icon-kuangxuan-copy"></span>
                                    <span v-else class="iconfont icon-kuang"></span>
                                </div>
                                <router-link :to="'/goodsDetails/'+j._id+'/imgSrc/'+j.images" tag="div" class="imgBox" :style="{backgroundImage:`url(/static/goods/${j.images}.jpg`}"></router-link>
                                <div class="info">
                                    <h4>{{j.name}}</h4>
                                    <router-link to="/index" tag="p" class="artist">{{j.artist}}</router-link>
                                    <p>{{j.size.x}}x{{j.size.y}}cm</p>
                                </div>
                            </div>
                            <div class="right">
                                <span>{{j.price | formatMoney}}</span>
                                <span class="remove" @click="removeFun(i,iIndex,jIndex,j._id)">移除</span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- fixed的结算框 -->
            <div class="fixed">
                <!-- 结算 -->
                <div class="jiesuanBox">
                    <div class="left" @click="allChoosedFun">
                        <span v-if="allChoosed" class="iconfont icon-kuangxuan-copy"></span>
                        <span v-else class="iconfont icon-kuang"></span>
                        全选
                    </div>
                    <div class="right">
                        <div class="left">
                            已选商品
                            <b>{{choosedNum}}</b> 件（无运费、装裱费）
                            <span>{{totalMoney | formatMoney}}</span>
                        </div>
                        <div class="btn" :class="{canJieSuan:choosedNum}" @click="jieSuanFun">结算
                            <span v-if="choosedNum">({{choosedNum}})</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 删除确认框 -->
            <div class="gwcTips" v-if="isDel" @click="isDel=false">
                <div class="tips">
                    <div class="top">
                        <span>提示</span>
                        <span class="iconfont icon-icon"></span>
                    </div>
                    <div class="center">你确定要删除吗？</div>
                    <div class="bottom">
                        <span class="queding" @click="doDel">确定</span>
                        <span>取消</span>
                    </div>
                </div>
            </div>
            <!-- 空空如也哦 -->
            <div class="kong" v-if="!shopcar.length">空空如也哦~</div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            // 全选变量
            allChoosed: false,
            // 购物车数据
            shopcar: [],
            // 已选中作品数量
            choosedNum: 0,
            // 总价格
            totalMoney: 0,
            // 总数量
            totalNum: 0,
            // 删除确认
            isDel: false,
            // 删除的数据
            delObj: {
                i: "",
                iIndex: "",
                jIndex: "",
                goodid: ""
            }
        };
    },
    methods: {
        // 全选
        allChoosedFun() {
            this.allChoosed = !this.allChoosed;
            let allChoosed = this.allChoosed;
            this.shopcar.forEach(val1 => {
                val1.choosed.forEach((val2, index) => {
                    this.oneChoosed(val1, index, allChoosed);
                });
            });
        },
        // 单选
        oneChoosed(i, index, flag = !i.choosed[index]) {
            i.choosed[index] = flag;
            this.doMore();

            // 修改数据库里面的choosed数组
            // this.$http.post("/api/updateChoosed",{})
        },
        // 计算选中数量、价格；判断是否全选了
        doMore() {
            this.totalMoney = this.choosedNum = 0;
            this.shopcar.forEach(val1 => {
                val1.choosed.forEach((val2, index) => {
                    if (val2) {
                        // 计算选中数量、价格
                        this.choosedNum++;
                        this.totalMoney += val1.goods[index].price;
                    }
                });
            });
            //判断是否全选了
            this.allChoosed =
                this.totalNum && this.choosedNum === this.totalNum;
        },
        // 移除
        removeFun(i, iIndex, jIndex, goodid) {
            this.isDel = true;
            this.delObj.i = i;
            this.delObj.iIndex = iIndex;
            this.delObj.jIndex = jIndex;
            this.delObj.goodid = goodid;
        },
        // 删除确认框 里面的确认函数 doDel
        doDel() {
            let { i, iIndex, jIndex, goodid } = this.delObj;
            this.shopcar[iIndex].goods.splice(jIndex, 1);
            this.shopcar[iIndex].choosed.splice(jIndex, 1);
            this.shopcar[iIndex].goods.length || this.shopcar.splice(iIndex, 1);
            this.totalNum--;
            this.$nextTick(this.doMore());
            this.$http.post("/api/delShopcar", {
                userid: this.$store.state.login.loginID,
                time: i.time,
                goodid
            });
        },
        // 结算方法
        jieSuanFun() {
            if (this.choosedNum) {
                this.shopcar.forEach(val => {
                    // 更新choosed数组
                    this.$http
                        .post("/api/updateChoosed", {
                            userid: this.$store.state.login.loginID,
                            time: val.time,
                            choosed: val.choosed
                        })
                        .then(data => {
                            data.data &&
                                this.$router.push({ path: '/goumai/1/xiadan' });
                        });
                });
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
        this.$http
            .post("/api/getGoodsByShopcar", {
                userid: this.$store.state.login.loginID
            })
            .then(data => {
                let len = data.data.length;
                if (len) {
                    data.data.forEach(val => {
                        this.totalNum += val.goods.length;
                        val.choosed = new Array(val.goods.length).fill(false);
                    });
                    this.shopcar = data.data;
                    console.log("购物车数据获取成功啦", this.shopcar);
                    this.allChoosedFun();
                } else {
                    console.log("购物车数据获取失败");
                }
            });
    }
};
</script>