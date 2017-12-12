<style lang="scss" scoped>
#homeContent {
    @mixin flex($justify) {
        display: flex;
        display: -webkit-flex;
        justify-content: $justify;
        -webkit-justify-content: $justify;
        align-items: center;
        -webkit-align-items: center;
    }
    @mixin title() {
        letter-spacing: 3px;
        vertical-align: middle;
        text-align: center;
        font-size: 26px;
        font-weight: 600;
        font-style: normal;
        font-stretch: normal;
        color: #000000;
        margin-right: 40px;
    }
    position: relative;
    user-select: none;
    // 轮播部分
    .swipe-container {
        width: 100vw;
        height: 300px;
        margin-top: 68px;
        position: fixed;
        // position: relative;
        z-index: 3;
        text-align: center;
        overflow: hidden;
    }
    .imgStyle {
        position: absolute;
        width: 100vw;
        transition: all 0.5s linear;
        left: 0;
        top: 0;
    }
    .fade-enter-active,
    .fade-leave-active {
        transition: all 1s;
        opacity: 1;
    }
    .fade-enter,
    .fade-leave-to {
        // height: 0px;
        opacity: 0;
    }
    // 轮播部分
    .bodyContent {
        width: calc(100vw - 17px);
        position: absolute;
        top: 367px;
        left: 0;
        background-color: #fff;
        // height: 500px;
        z-index: 4;
        .pagenation {
            width: 16%;
            position: absolute;
            top: -50px;
            z-index: 4;
            margin-left: 72%;
            padding: 13px 0;
            background-color: rgba($color: #000000, $alpha: 0.3);
            border-radius: 25px;
            @include flex(center);
            .list {
                width: 12px;
                height: 12px;
                border-radius: 50%;
                background-color: #f0f0f0;
                margin-left: 20px;
                &:hover {
                    cursor: pointer;
                    background-color: rgb(59, 172, 161);
                }
                &:first-child {
                    margin-left: 0;
                }
            }
            .currLi {
                background-color: rgb(59, 172, 161) !important;
            }
        }
        //内容-----推荐
        .category {
            margin: 80px 85px 120px;
            .categoryTitle {
                @include flex(space-between);
                margin-bottom: 40px;
                padding-bottom: 5px;
                border-bottom: 1px solid #ddd;
                p {
                    span {
                        &:first-child {
                            @include title();
                        }
                        &:last-child {
                            color: #003569;
                            &:hover {
                                cursor: pointer;
                            }
                        }
                    }
                }
                .kinds {
                    @mixin defaultStyle() {
                        cursor: pointer;
                        border: 1px solid #ddd;
                        border-bottom: 1px solid #fff;
                        background-color: #fff;
                    }
                    @include flex(center);
                    div {
                        width: 100px;
                        height: 43px;
                        line-height: 43px;
                        margin-left: 20px;
                        text-align: center;
                        font-size: 18px;
                        font-weight: 500;
                        font-style: normal;
                        font-stretch: normal;
                        letter-spacing: 2px;
                        color: #000000;
                        border: 1px solid RGBA(255, 255, 255, 0);
                        margin-bottom: -6px;
                        &:first-child {
                            @include defaultStyle();
                        }
                        &:hover {
                            @include defaultStyle();
                        }
                    }
                }
            }
            .categoryImgs {
                @include flex(space-between);
                $w: 280px;
                .categoryItem {
                    width: $w;
                    height: 400px;
                    background-color: #fff;
                    overflow: hidden;
                    box-shadow: 0 1px 20px 0 rgba(0, 0, 0, 0.1);
                    .imgBox {
                        width: $w;
                        height: $w;
                        overflow: hidden;
                        position: relative;
                        img {
                            width: 100%;
                            height: 100%;
                            position: absolute;
                            top: 0;
                            left: 0;
                            transition: all 0.5s;
                            &:hover {
                                cursor: pointer;
                                transform: scale(1.1, 1.1);
                            }
                        }
                    }
                    .intro {
                        padding: 20px;
                        font-size: 12px;
                        line-height: 18px;
                        .artist,
                        .price {
                            color: #000;
                            font-weight: 600;
                        }
                        .goodInfo {
                            font-weight: 500;
                            color: #666;
                        }
                    }
                }
            }
        }
    }
}
</style>
<template>
  <div id="homeContent">
    <div class="swipe-container">
      <transition name="fade">
        <img v-show="showImg" :src="front" class="imgStyle">
      </transition>
      <transition name="fade">
        <img v-show="!showImg" :src="end" class="imgStyle">
      </transition>
    </div>
    <div class="bodyContent">
      <!-- //翻页 -->
      <div class="pagenation" ref="pages">
        <div class="list" :class="{currLi:i==imgIndex}" v-for="i in 6" :key="i" @click="changeImg(i)"></div>
      </div>
      <!-- 推荐 -->
      <div class="category">
        <div class="categoryTitle">
          <p>
            <span>推荐 / CATEGORY</span>
            <span>更多</span>
          </p>
          <div class="kinds">
            <div>油画</div>
            <div>版画</div>
            <div>水墨</div>
            <div>水彩</div>
          </div>
        </div>
        <div class="categoryImgs">
          <div class="categoryItem" v-for="item in categories" :key="item.artist">
            <div class="imgBox">
              <img :src="'/static/img/'+item.images+'.jpg'">
            </div>
            <div class="intro">
              <p class="artist">{{item.artist}}</p>
              <p class="goodInfo">{{item.name}}，{{item.time}}</p>
              <p class="goodInfo">{{item.classify}}&nbsp;&nbsp;{{item.size.x}}x{{item.size.y}}cm</p>
              <p class="price">￥{{Math.floor((item.price/1000))}},{{item.price%1000}}</p>
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
            front: "",
            end: "",
            imgArr: [],
            imgIndex: 1,
            showImg: true,
            timer: null,
            //推荐
            categories: []
        };
    },
    methods: {
        changeImg(index) {
            clearInterval(this.timer);
            if (this.imgIndex != index) {
                this.showImg = !this.showImg;
                this.showImg
                    ? (this.front = this.imgArr[index - 1].img)
                    : (this.end = this.imgArr[index - 1].img);
                this.imgIndex = index;
            }
            this.timerFun();
        },
        timerFun() {
            this.timer = setInterval(() => {
                let oIndex = this.imgIndex;
                oIndex++ == 6 && (oIndex = 1);
                this.changeImg(oIndex);
            }, 4000);
        }
    },
    mounted() {
        this.$http
            .get("/api/index/swiperBg")
            .then(data => {
                this.front = data.data[0].img;
                this.end = data.data[1].img;
                this.imgArr = data.data;
                this.timerFun();
            })
            .catch(err => {
                alert(err + "请刷新页面！");
            });
        this.$http
            .get("/api/getGoods", {
                params: {
                    pos: "category"
                }
            })
            .then(data => {
                console.log(data);
                this.categories = data.data;
            });
    }
};
</script>


