<style lang="scss" scoped>
#Login {
  user-select: none;
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
      font-family: "Microsoft Yahei Light", "Segoe UI", Tahoma, Geneva, Verdana,
        sans-serif;
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
      .toLogin,
      .toRegister,
      .foegetCode {
        .account,
        .password {
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
          input[type="text"],
          input[type="password"] {
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
            margin: 0 auto;
            z-index: 3;
            transition: all 0.5s;
          }
          .lineAnimate {
            width: 300px;
          }
        }
        .password {
          margin-top: 20px;
        }
        .forgetPassword {
          font-size: 12px;
          color: #666666;
          float: right;
          cursor: pointer;
        }
        .login {
          width: 100%;
          height: 44px;
          line-height: 44px;
          background-color: #3c948b;
          color: #fff;
          font-size: 16px;
          margin-top: 20px;
          text-align: center;
          cursor: pointer;
          border: 0;
          outline: none;
        }
        .register {
          font-size: 12px;
          margin-top: 10px;
          width: 100%;
          text-align: center;
          span {
            color: #3c948b;
            cursor: pointer;
          }
        }
        .or {
          width: 100%;
          height: 21px;
          line-height: 21px;
          font-size: 12px;
          margin-top: 30px;
          color: #a9a9a9;
          .leftLine,
          .rightLine {
            float: left;
            width: 120px;
            height: 1px;
            margin-top: 10px;
            background-color: #c0c0c0;
          }
          .word {
            float: left;
            width: 60px;
            text-align: center;
            line-height: 21px;
          }
        }
        .otherWays {
          width: 100%;
          height: 70px;
          line-height: 70px;
          text-align: center;
          i {
            font-size: 35px;
            color: #3a8373;
            margin: 0 10px;
            cursor: pointer;
          }
        }
      }
      .toRegister,
      .foegetCode {
        .passCode {
          display: flex;
          justify-content: space-between;
          align-items: center;
          margin-bottom: 40px;
          input {
            width: 160px;
            height: 40px;
            background-color: #f8f8f8;
            font-size: 16px !important;
            padding-left: 10px;
            font-size: 16px !important;
            padding-left: 10px;
            border: 0;
            outline: none;
            margin: 0;
          }
          .pasImg {
            width: 130px;
            height: 40px;
            cursor: pointer;
          }
        }
      }
      .foegetCode {
        .passCode {
          margin-bottom: 20px;
        }
        .register {
          margin-top: 30px;
          cursor: pointer;
        }
      }
      .error {
        color: red !important;
      }
      .errorLine {
        background-color: red !important;
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
                <!-- 登录部分 -->
                <div class="toLogin" v-show="showBox==1">
                    <div class="account">
                        <p class="title" :class="{titleAnimate:logA,error:logAError}">{{logPhone}}</p>
                        <input type="text" v-model="log.account" autocomplete="off" @focus="showAnimate('logA')">
                        <div class="line" :class="{lineAnimate:logA,errorLine:logAError}"></div>
                    </div>
                    <div class="password">
                        <p class="title" :class="{titleAnimate:logP,error:logPError}">{{logPwd}}</p>
                        <input type="password" v-model="log.password" autocomplete="off" @focus="showAnimate('logP')">
                        <div class="line" :class="{lineAnimate:logP,errorLine:logPError}"></div>
                    </div>
                    <p class="forgetPassword" @click="showBox=3,changeCode()">忘记密码</p>
                    <button class="login" @click="validateData('log')">登录</button>
                    <p class="register">还没有账号？
                        <span @click="showBox=2,changeCode()">请注册</span>
                    </p>
                    <div class="or">
                        <span class="leftLine"></span>
                        <span class="word">或</span>
                        <span class="rightLine"></span>
                    </div>
                    <div class="otherWays">
                        <i class="iconfont icon-weibo2"></i>
                        <i class="iconfont icon-weixin"></i>
                        <i class="iconfont icon-facebook-copy"></i>
                    </div>
                </div>
                <!-- 注册部分 -->
                <div class="toRegister" v-show="showBox==2">
                    <div class="account">
                        <p class="title" :class="{titleAnimate:regA,error:regAError}">{{regPhone}}</p>
                        <input type="text" v-model="reg.account" autocomplete="off" @focus="showAnimate('regA')">
                        <div class="line" :class="{lineAnimate:regA,errorLine:regAError}"></div>
                    </div>
                    <div class="passCode">
                        <input type="text" v-model="reg.passCode" placeholder="请输入验证码">
                        <div class="pasImg" ref="passCode1" @click="changeCode"></div>
                    </div>
                    <div class="password">
                        <p class="title" :class="{titleAnimate:regP,error:regPError}">{{regPwd}}</p>
                        <input type="password" v-model="reg.password" autocomplete="off" @focus="showAnimate('regP')">
                        <div class="line" :class="{lineAnimate:regP,errorLine:regPError}"></div>
                    </div>
                    <button class="login" @click="validateData('reg')">注册</button>
                    <p class="register">已有账号？
                        <span @click="showBox=1">请登录</span>
                    </p>
                </div>
                <!-- 忘记密码 -->
                <div class="foegetCode" v-show="showBox==3">
                    <div class="account">
                        <p class="title" :class="{titleAnimate:findA,error:findAError}">{{findPhone}}</p>
                        <input type="text" v-model="find.account" autocomplete="off" @focus="showAnimate('findA')">
                        <div class="line" :class="{lineAnimate:findA,errorLine:findAError}"></div>
                    </div>
                    <div class="passCode">
                        <input type="text" v-model="find.passCode" placeholder="请输入验证码">
                        <div class="pasImg" ref="passCode2" @click="changeCode"></div>
                    </div>
                    <button class="login" @click="validateData('find')">下一步</button>
                    <p class="register" @click="showBox=1">返回登录</p>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
export default {
  data() {
    return {
      //切换几个板块
      showBox: 1,
      //登录信息
      logPhone: "请输入手机号",
      logPwd: "请输入密码",
      logAError: false,
      logPError: false,
      logA: false,
      logP: false,
      log: {
        account: "",
        password: ""
      },
      //注册信息
      regPhone: "请输入手机号",
      regPwd: "请输入6-16位密码",
      regAError: false,
      regPError: false,
      regA: false,
      regP: false,
      reg: {
        account: "",
        passCode: "",
        password: ""
      },
      //找回密码
      findPhone: "请输入手机号",
      findAError: false,
      findA: false,
      find: {
        account: "",
        passCode: ""
      }
    };
  },
  methods: {
    showAnimate(which) {
      this[which] = true;
    },
    changeCode() {
      this.$http.get("/api/Login/getPassCode").then(data => {
        this.showBox == 2
          ? (this.$refs.passCode1.innerHTML = data.data)
          : (this.$refs.passCode2.innerHTML = data.data);
      });
    },
    validateData(kind) {
      var reg = /^[1][3,4,5,7,8][0-9]{9}$/;
      var phoneNum = this[kind].account;
      if (!reg.test(phoneNum)) {
        //手机号有误
        this[`${kind}AError`] = true;
        this[`${kind}Phone`] = "请输入正确的手机号!";
      } else {
        this[`${kind}AError`] = false;
        this[`${kind}Phone`] = "请输入手机号";
        if (this[kind].password.length < 7 || this[kind].password.length > 15) {
          //密码有误
          this[`${kind}PError`] = true;
          this[`${kind}Pwd`] = "密码为7-15位";
        } else {
          this[`${kind}PError`] = false;
          this[`${kind}Pwd`] = "请输入密码";
          this.$http
            .post("/api/Login", { kind, data: this[kind] })
            .then(data => {
              switch (kind) {
                case "log":
                  //登录验证
                  if (data.data.code == 1) {
                    this[`${kind}PError`] = true;
                    this[`${kind}Pwd`] = data.data.msg;
                  } else if (data.data.code == 2) {
                    this[`${kind}AError`] = true;
                    this[`${kind}Phone`] = data.data.msg;
                  } else {
                    //登录成功！
                  }
                  break;
                case "reg":
                  //注册账号
                  if (data.data.code) {
                    this[`${kind}AError`] = true;
                    this[`${kind}Phone`] = data.data.msg;
                  }
                  break;
                case "find":
                  //找回密码
                  break;
              }
            });
        }
      }
    }
  },
  mounted() {}
};
</script>


