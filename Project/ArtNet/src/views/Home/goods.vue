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
    .goodsContainer {
        height: 2000px;
        margin-top: 100px;
        position: relative;
        // padding: 0 100px;
        .good {
            width: 300px;
            min-height: 100px;
            float: left;
            // margin: 300px 46px 0 46px !important;
            // margin: 80px 50px 80px 0;
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
        <div class="goodsContainer" v-if="lists.length" ref="parentBox">
            <div class="good" v-for="(i,index) in lists">
                <img :src="i.images">
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
            lists: []
        };
    },
    methods: {},
    created() {
        var data = [
            {
                images: "/static/img/0.jpg",
                artist: "张三",
                name: "春天",
                time: "2017",
                classify: "油画",
                size: { x: 80, y: 40 },
                price: 27987
            },
            {
                images: "/static/img/1.jpg",
                artist: "张三",
                name: "春天",
                time: "2017",
                classify: "油画",
                size: { x: 80, y: 40 },
                price: 27987
            },
            {
                images: "/static/img/2.jpg",
                artist: "张三",
                name: "春天",
                time: "2017",
                classify: "油画",
                size: { x: 80, y: 40 },
                price: 27987
            },
            {
                images: "/static/img/3.jpg",
                artist: "张三",
                name: "春天",
                time: "2017",
                classify: "油画",
                size: { x: 80, y: 40 },
                price: 27987
            },
            {
                images: "/static/img/4.jpg",
                artist: "张三",
                name: "春天",
                time: "2017",
                classify: "油画",
                size: { x: 80, y: 40 },
                price: 27987
            },
            {
                images: "/static/img/5.jpg",
                artist: "张三",
                name: "春天",
                time: "2017",
                classify: "油画",
                size: { x: 80, y: 40 },
                price: 27987
            },
            {
                images: "/static/img/6.jpg",
                artist: "张三",
                name: "春天",
                time: "2017",
                classify: "油画",
                size: { x: 80, y: 40 },
                price: 27987
            },
            {
                images: "/static/img/7.jpg",
                artist: "张三",
                name: "春天",
                time: "2017",
                classify: "油画",
                size: { x: 80, y: 40 },
                price: 27987
            },
            {
                images: "/static/img/8.jpg",
                artist: "张三",
                name: "春天",
                time: "2017",
                classify: "油画",
                size: { x: 80, y: 40 },
                price: 27987
            },
            {
                images: "/static/img/2.jpg",
                artist: "张三",
                name: "春天",
                time: "2017",
                classify: "油画",
                size: { x: 80, y: 40 },
                price: 27987
            },
            {
                images: "/static/img/3.jpg",
                artist: "张三",
                name: "春天",
                time: "2017",
                classify: "油画",
                size: { x: 80, y: 40 },
                price: 27987
            },
            {
                images: "/static/img/4.jpg",
                artist: "张三",
                name: "春天",
                time: "2017",
                classify: "油画",
                size: { x: 80, y: 40 },
                price: 27987
            },
            {
                images: "/static/img/5.jpg",
                artist: "张三",
                name: "春天",
                time: "2017",
                classify: "油画",
                size: { x: 80, y: 40 },
                price: 27987
            },
            {
                images: "/static/img/6.jpg",
                artist: "张三",
                name: "春天",
                time: "2017",
                classify: "油画",
                size: { x: 80, y: 40 },
                price: 27987
            },
            {
                images: "/static/img/1.jpg",
                artist: "张三",
                name: "春天",
                time: "2017",
                classify: "油画",
                size: { x: 80, y: 40 },
                price: 27987
            }
        ];
        this.lists = data;
    },
    mounted() {
        var boxHeight = []; //用来装第一行高度的数组
        var cols = 3; //每行的个数
        // this.$nextTick(() => {
        setTimeout(() => {
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
                    childArr[n].style.top = minHeight + 80 + "px";
                    childArr[n].style.left =
                        childArr[minIndex].offsetLeft + "px";
                    boxHeight[minIndex] =
                        boxHeight[minIndex] + childArr[n].offsetHeight + 80;
                }
            }
        }, 100);
        // });
    }
};
</script>


