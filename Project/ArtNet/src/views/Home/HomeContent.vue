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
  @mixin scaleBigger() {
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
    @mixin titleStyle() {
      margin-bottom: 40px;
      padding-bottom: 5px;
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
    }
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
        @include titleStyle();
        border-bottom: 1px solid #ddd;
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
            // &:first-child {
            //   @include defaultStyle();
            // }
            &:hover {
              @include defaultStyle();
            }
          }
          .firstStyle {
            @include defaultStyle();
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
              @include scaleBigger();
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
    .latest {
      margin: 80px 85px 120px;
      .title {
        .rotation {
          display: inline-block;
          position: relative;
          animation: rote 1s infinite linear;
        }
        @keyframes rote {
          from {
            transform: rotate(0deg);
          }
          to {
            transform: rotate(360deg);
          }
        }
        @include titleStyle();
        .icon-weibiaoti-- {
          font-size: 20px;
          color: #003569;
          &:hover {
            cursor: pointer;
          }
        }
      }
      .container {
        @include flex(space-between);
        @mixin info() {
          @include flex(center);
          flex-direction: column;
          font-size: 12px;
          color: #fff;
        }
        @keyframes roteHide {
          0% {
            transform: rotateY(0deg);
            opacity: 1;
          }
          49% {
            opacity: 1;
          }
          50% {
            opacity: 0;
            z-index: -1;
          }
          100% {
            transform: rotateY(180deg);
            opacity: 0;
            z-index: -1;
          }
        }
        @keyframes roteShow {
          0% {
            opacity: 0;
            transform: rotateY(180deg);
          }
          49% {
            opacity: 0;
          }
          50% {
            opacity: 1;
          }
          100% {
            transform: rotateY(360deg);
            opacity: 1;
          }
        }
        .left {
          @include flex(space-between);
          .item {
            width: 280px;
            height: 280px;
            margin-right: 20px;
            position: relative;
            overflow: hidden;
            &:hover {
              img {
                transform: scale(1.1, 1.1);
              }
              .info {
                opacity: 1;
                background-color: rgba(0, 0, 0, 0.4);
              }
            }
            img {
              width: 100%;
              height: 100%;
              transition: all 0.5s;
              z-index: 4;
            }
            .info {
              @include info();
              width: 100%;
              height: 100%;
              position: absolute;
              left: 0;
              top: 0;
              z-index: 5;
              opacity: 0;
              cursor: pointer;
            }
          }
        }
        .right {
          @include flex(space-between);
          height: 280px;
          flex-wrap: wrap;
          align-content: space-between;
          .item {
            width: 130px;
            height: 130px;
            position: relative;
            overflow: hidden;
            &:hover {
              img {
                transform: scale(1.1, 1.1);
              }
              .info {
                opacity: 1;
                background-color: rgba(0, 0, 0, 0.4);
              }
            }
            img {
              width: 100%;
              height: 100%;
              transition: all 0.5s;
              z-index: 4;
            }
            .info {
              @include info();
              width: 100%;
              height: 100%;
              position: absolute;
              left: 0;
              top: 0;
              z-index: 5;
              opacity: 0;
              cursor: pointer;
            }
          }
        }
      }
    }
    .search {
      position: relative;
      .change {
        height: 300px;
        padding: 0 0 0 85px;
        background-color: #666666;
        .title {
          padding: 40px 0;
          line-height: 42px;
          font-size: 30px;
          font-weight: normal;
          font-style: normal;
          font-stretch: normal;
          color: #ffffff;
        }
        .selectBox {
          select {
            -webkit-appearance: none;
            padding: 0 20px;
            margin-right: 10px;
            font-size: 14px;
            font-weight: normal;
            font-style: normal;
            font-stretch: normal;
            color: #333333;
            width: 200px;
            height: 44px;
            border-radius: 4px;
            background-color: #f8f8f8;
            background: url(/static/img/select_bg.png) no-repeat right #fff;
          }
          option {
            margin: 0;
            padding: 0;
            outline: none;
            font-weight: normal;
            display: block;
            white-space: pre;
            min-height: 20px;
          }
        }
        .linkTo {
          margin-top: 48px;
          height: 42px;
          line-height: 42px;
          font-size: 14px;
          color: #eeeeee;
          span {
            color: #fff;
            margin: 0 20px;
            font-weight: 600;
            font-size: 14px;
            &:hover {
              cursor: pointer;
            }
          }
        }
      }
      .button {
        font-size: 40px;
        font-weight: 500;
        font-style: normal;
        font-stretch: normal;
        letter-spacing: 4px;
        text-align: center;
        color: #ffffff;
        background-color: #000;
        width: 27%;
        position: absolute;
        right: 0;
        top: 0;
        z-index: 2;
        height: 300px;
        cursor: pointer;
        &:hover {
          .getBlue {
            width: 100%;
          }
          .text {
            left: 80px;
          }
        }
        .getBlue {
          background-color: #3c948b;
          height: 300px;
          width: 0;
          transition: all, 0.4s;
        }
        .text {
          transition: all, 0.4s;
          text-align: right;
          width: 90px;
          height: 100px;
          display: inline-block;
          margin: auto;
          position: absolute;
          top: 0;
          left: 0;
          right: 0;
          bottom: 0;
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
                        <div :class="{firstStyle:categoriesItem==1}" @click="categoriesItem!=1 && (getGoods('油画'),categoriesItem=1)">油画</div>
                        <div :class="{firstStyle:categoriesItem==2}" @click="categoriesItem!=2 && getGoods('版画'),categoriesItem=2">版画</div>
                        <div :class="{firstStyle:categoriesItem==3}" @click="categoriesItem!=3 && getGoods('水墨'),categoriesItem=3">水墨</div>
                        <div :class="{firstStyle:categoriesItem==4}" @click="categoriesItem!=4 && getGoods('水彩'),categoriesItem=4">水彩</div>
                    </div>
                </div>
                <div class=" categoryImgs ">
                    <div class="categoryItem " v-for="(item,index) in categories " :key="index">
                        <div class="imgBox ">
                            <img :src=" '/static/img/'+item.images+ '.jpg' ">
                        </div>
                        <div class="intro ">
                            <p class="artist ">{{item.artist}}</p>
                            <p class="goodInfo ">{{item.name}}，{{item.time}}</p>
                            <p class="goodInfo ">{{item.classify}}&nbsp;&nbsp;{{item.size.x}}x{{item.size.y}}cm</p>
                            <p class="price ">￥{{Math.floor((item.price/1000))}},{{item.price%1000}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 最新 -->
            <div class="latest">
                <div class="title">
                    <p>
                        <span>最新上架 / NEW</span>
                        <span class="iconfont icon-weibiaoti--" @click="getNew" :class="{rotation:isRotation}"></span>
                        <span @click="getNew">换一换</span>
                    </p>
                </div>
                <div class=" container ">
                    <div class="left ">
                        <!-- front -->
                        <div class="item" :class="{}" v-for="(item,index) in leftPart " :key="index ">
                            <img :src=" '/static/img/'+item.images+ '.jpg' ">
                            <div class="info ">
                                <p class="artist ">{{item.artist}}</p>
                                <p class="goodInfo ">{{item.name}}，{{item.time}}</p>
                                <p class="goodInfo ">{{item.classify}}&nbsp;&nbsp;{{item.size.x}}x{{item.size.y}}cm</p>
                                <p class="price ">￥{{Math.floor((item.price/1000))}},{{item.price%1000}}</p>
                            </div>
                        </div>
                        <!-- back -->
                        <!-- <div class="item" v-for="(item,index) in leftPart " :key="index ">
                            <img :src=" '/static/img/'+item.images+ '.jpg' ">
                            <div class="info ">
                                <p class="artist ">{{item.artist}}</p>
                                <p class="goodInfo ">{{item.name}}，{{item.time}}</p>
                                <p class="goodInfo ">{{item.classify}}&nbsp;&nbsp;{{item.size.x}}x{{item.size.y}}cm</p>
                                <p class="price ">￥{{Math.floor((item.price/1000))}},{{item.price%1000}}</p>
                            </div>
                        </div> -->
                    </div>
                    <div class="right ">
                        <!-- front -->
                        <div class="item" v-for="(item,index) in rightPart " :key="index ">
                            <img :src=" '/static/img/'+item.images+ '.jpg' ">
                            <div class="info ">
                                <p class="artist ">{{item.artist}}</p>
                                <p class="goodInfo ">{{item.name}}，{{item.time}}</p>
                                <p class="goodInfo ">{{item.classify}}&nbsp;&nbsp;{{item.size.x}}x{{item.size.y}}cm</p>
                                <p class="price ">￥{{Math.floor((item.price/1000))}},{{item.price%1000}}</p>
                            </div>
                        </div>
                        <!-- back -->
                        <!-- <div class="item" v-for="(item,index) in rightPart " :key="index ">
                            <img :src=" '/static/img/'+item.images+ '.jpg' ">
                            <div class="info ">
                                <p class="artist ">{{item.artist}}</p>
                                <p class="goodInfo ">{{item.name}}，{{item.time}}</p>
                                <p class="goodInfo ">{{item.classify}}&nbsp;&nbsp;{{item.size.x}}x{{item.size.y}}cm</p>
                                <p class="price ">￥{{Math.floor((item.price/1000))}},{{item.price%1000}}</p>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
            <!-- 搜索 -->
            <div class="search">
                <div class="change">
                    <div class="title">现在，去探索全新的艺术世界</div>
                    <div class="selectBox">
                        <select>
                            <option value="1">类别</option>
                            <option value="1">2</option>
                            <option value="1">3</option>
                        </select>
                        <select>
                            <option value="1">价格</option>
                            <option value="1">2</option>
                            <option value="1">3</option>
                        </select>
                        <select>
                            <option value="1">尺寸</option>
                            <option value="1">2</option>
                            <option value="1">3</option>
                        </select>
                        <select>
                            <option value="1">风格</option>
                            <option value="1">2</option>
                            <option value="1">3</option>
                        </select>
                    </div>
                    <div class="linkTo">
                        前往
                        <span>原创艺术</span>利用更强大的筛选引擎挑选作品 ›
                    </div>
                </div>
                <div class="button">
                    <div class="getBlue"></div>
                    <div class="text">
                        开始<br> Go
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
      //getGoods接口返回的数据
      apiData: [],
      categories: [],
      //推荐
      categoriesItem: 1,
      //最新
      leftPart: [],
      rightPart: [],
      //换一换旋转
      isRotation: false
      //最新图片旋转
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
    },
    /**
     * 获取商品
     */
    getGoods(pos) {
      this.$http.get("/api/getGoods", { params: { pos } }).then(data => {
        this.categories = data.data;
      });
    },
    getLatest() {
      this.$http.get("/api/getLatest").then(data => {
        for (let i = 0; i < data.data.length; i++) {
          if (this.leftPart.length < 2) this.leftPart.push(data.data[i]);
          else this.rightPart.push(data.data[i]);
        }
      });
    },
    getNew() {
      this.isRoted = !this.isRoted;
    }
  },
  mounted() {
    this.getLatest();
    (async () => {
      //这个异步真的是坑了你大姨夫的爹了，回调也不行，写个方法专门来装Promise也不行，你说你还能干个啥
      //先只有堆在这儿将就用了
      //真滴是坑爹！
      var swiperbg = await this.$http.get("/api/index/swiperBg");
      this.front = swiperbg.data[0].img;
      this.end = swiperbg.data[1].img;
      this.imgArr = swiperbg.data;
      this.timerFun();
      var result = await this.$http.get("/api/getGoods", {
        params: {
          pos: "油画"
        }
      });
      this.categories = result.data;
    })();
  }
};
</script>


