<style lang="scss" scoped>
#Login {
  background-image: url(/static/img/login-back-2.jpg);
  background-repeat: no-repeat;
  background-position: center center;
  background-size: cover;
  width: 100%;
  height: 100%;
  position: fixed;
  top: 0;
  left: 0;
  z-index: 1;
  .loginBox {
    width: 100%;
    height: 100%;
    position: fixed;
    top: 0;
    left: 0;
    z-index: 2;
    background-color: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: flex-start;
    align-items: center;
    flex-direction: column;
    .logo {
      padding: 50px 0;
      user-select: none;
      font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
      color: #fff;
      font-size: 40px;
      text-align: center;
      font-weight: 100;
      letter-spacing: 5px;
      i {
        font-size: 40px;
      }
    }
    .container {
      width: 300px;
      height: 340px;
      background-color: #fff;
      padding: 60px 30px 30px 30px;
      position: relative;
      .account {
        height: 50px;
        position: relative;
        text-align: left;
        .title {
          position: absolute;
          top: 0;
          left: 0;
          z-index: 1;
          line-height: 28px;
          font-size: 14px;
          color: #ddd;
          padding: 0;
          transition: all 0.5s;
        }
        .titleAnimate {
          top: -22px;
          font-size: 12px;
          color: #3c948b;
        }
        input[type="text"] {
          position: absolute;
          width: 100%;
          height: 28px;
          border: 0;
          border-bottom: 2px solid #ddd;
          top: 0;
          left: 0;
          z-index: 2;
          font-size: 18px !important;
          outline: none;
          margin: 0;
          background: none;
          -webkit-appearance: none;
          border-radius: 0;
        }
        .line {
          position: absolute;
          top: 28px;
          left: 0;
          right: 0;
          height: 2px;
          background-color: #3c948b;
          width: 0px;
          margin: 0 auto 0 auto;
          z-index: 3;
          transition: all 0.5s;
        }
        .lineAnimate {
          width: 300px;
        }
      }
    }
  }
}
</style>

<template>
    <div id="Login">
        <div class="loginBox">
            <p class="logo">
                <i class="iconfont icon-logo"></i>
                TANGiMING</p>
            <div class="container">
                <div class="account">
                    <p class="title" :class="{titleAnimate:isFocus}">请输入手机或邮箱</p>
                    <input type="text" autocomplete="off" @mouseover="showAnimate">
                    <div class="line" :class="{lineAnimate:isFocus}"></div>
                </div>
                <div class="account">
                    <p class="title" :class="{titleAnimate:isFocus}">请输入密码</p>
                    <input type="text" autocomplete="off" @mouseover="showAnimate">
                    <div class="line" :class="{lineAnimate:isFocus}"></div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
  data() {
    return {
      isFocus: false
    };
  },
  methods: {
    showAnimate() {
      this.isFocus = true;
    }
  }
};
</script>


