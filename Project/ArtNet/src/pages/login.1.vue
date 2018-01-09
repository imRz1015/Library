<style lang="scss" scoped>
#main {
    position: fixed;
    width: 100%;
    height: 100vh;
    background: url("/static/img/login1.jpg") center;
    background-size: cover;
    .loginBox {
        overflow: hidden;
        background-color: rgba(0, 0, 0, 0.5);
        height: 100%;
        .top {
            width: 360px;
            margin: 50px auto;
            color: #fff;
            text-align: center;
            h1 {
                font-style: italic;
                margin-bottom: 20px;
            }
        }
        .content {
            width: 360px;
            height: 400px;
            padding: 25px 35px;
            box-sizing: border-box;
            margin: 0 auto;
            background-color: #fff;
            // 公用 css
            .inputBox {
                position: relative;
                margin-top: 40px;
                border-bottom: 2px solid #ddd;
                .tips {
                    position: absolute;
                    top: 0;
                    left: 0;
                    color: #ddd;
                    font-size: 14px;
                    z-index: 0;
                    line-height: 30px;
                    transform: scale(1.1, 1.1);
                    transform-origin: left top;
                }
                .focus_tips {
                    top: -20px;
                    transform: scale(0.9, 0.9);
                    transition: all 0.7s;
                    color: rgb(60, 148, 139);
                }
                input {
                    position: relative;
                    z-index: 1;
                    display: block;
                    width: 100%;
                    height: 30px;
                    font-size: 20px;
                    letter-spacing: 1px;
                }
                .line {
                    position: absolute;
                    bottom: -2px;
                    width: 100%;
                    height: 3px;
                    transform: scaleX(0);
                    transform-origin: center center;
                    transition: transform 0.7s, background-color 0.2s;
                }
                .greyLine {
                    background-color: rgb(60, 148, 139);
                }
                .redLine {
                    background-color: red;
                }
            }
            // 按钮
            .btn {
                height: 44px;
                background-color: #3c948b;
                color: #fff;
                font-size: 16px;
                line-height: 44px;
                text-align: center;
                cursor: pointer;
            }
            // 请注册、返回登录
            .bottomTips {
                font-size: 12px;
                margin-top: 40px;
                text-align: center;
                span {
                    color: #3c948b;
                    cursor: pointer;
                }
            }
            // 登录 css
            .login_forgetPwd {
                display: flex;
                justify-content: space-between;
                font-size: 12px;
                color: #666666;
                margin: 25px 0;
                span:last-child {
                    cursor: pointer;
                }
                span:first-child {
                    color: red;
                }
            }
            // 图片验证码css
            .vercode {
                position: relative;
                display: flex;
                justify-content: space-between;
                height: 40px;
                margin: 40px 0 58px;
                input {
                    width: calc(100% - 150px);
                    margin-right: 20px;
                    padding-left: 10px;
                    font-size: 16px;
                    background-color: #f8f8f8;
                }
                div:nth-child(2) {
                    cursor: pointer;
                }
                .errcode {
                    position: absolute;
                    bottom: -30px;
                    left: 10px;
                    font-size: 13px;
                    color: red;
                }
            }
            // 成功css
            .threeStep {
                .success {
                    margin: 100px auto 89px;
                    text-align: center;
                    font-size: 16px;
                    color: #666;
                }
            }
            // 注册 css
            .register {
                .vercode {
                    margin-bottom: 45px;
                }
                .bottomTips {
                    margin-top: 20px;
                }
            }
            // 忘记密码 css
            .forgetPwd {
                .scendStep {
                    .vercode {
                        margin-bottom: 50px;
                    }
                    .messcode {
                        width: 130px;
                        background-color: #000;
                        color: #fff;
                        text-align: center;
                        line-height: 40px;
                        font-size: 14px;
                    }
                    .againGet {
                        background-color: grey;
                        cursor: wait !important;
                    }
                    .bottomTips {
                        margin-top: 20px;
                    }
                }
            }
            .fade-enter,
            .fade-leave-to {
                opacity: 0;
            }
            .fade-enter-active,
            .fade-leave-active {
                transition: opacity 0.5s;
            }
            .fade-enter-to,
            .fade-leave {
                opacity: 1;
            }
        }
    }
}
</style>
<template>
    <div id="main">
        <div class="loginBox">
            <div class="top">
                <h1>艺言</h1>
                <span>HZQ.COM</span>
                <span>ART.YAN</span>
            </div>
            <div class="content">
                <!-- 登录 -->
                <div class="login" v-show="status==='login'">
                    <!-- 一个 输入框 模板 -->
                    <!-- username -->
                    <div class="inputBox" key="1">
                        <div class="tips">请输入手机号</div>
                        <input type="text" @focus="teXiao" @keyup.enter="loginFun('.login')" v-model="login.username">
                        <div class="line greyLine"></div>
                        <div class="line redLine"></div>
                    </div>
                    <!-- password -->
                    <div class="inputBox" key="2">
                        <div class="tips">请输入密码</div>
                        <input type="password" @focus="teXiao" @keyup.enter="loginFun('.login')" v-model="login.password">
                        <div class="line greyLine"></div>
                        <div class="line redLine"></div>
                    </div>
                    <!-- 忘记密码 提示 -->
                    <div class="login_forgetPwd">
                        <span class="errtips" if="loginErrTxt">{{loginErrTxt}}</span>
                        <span @click="status='forgetPwd',getVerCode('svgBox')">忘记密码</span>
                    </div>
                    <!-- 登录按钮 -->
                    <div class="btn" @click="loginFun('.login')">登录</div>
                    <!-- 请注册 提示 -->
                    <div class="bottomTips">还没有账号？
                        <span @click="status='register',getVerCode('regsvgBox')">请注册</span>
                    </div>
                </div>
                <!-- 注册 -->
                <div class="register" v-show="status==='register'">
                    <div class="regFirstStep" v-show="registerStep===1">
                        <!-- username -->
                        <div class="inputBox" key="6">
                            <div class="tips">请输入手机号</div>
                            <input type="text" @keyup.enter="registerFun('.register')" @focus="teXiao" @blur="checkUserName('register')" v-model="register.username">
                            <div class="line greyLine"></div>
                            <div class="line redLine"></div>
                        </div>
                        <!-- 输入密码 -->
                        <div class="inputBox" key="7">
                            <div class="tips">请输入6-16位密码</div>
                            <input type="password" @keyup.enter="registerFun('.register')" @focus="teXiao" v-model="register.password">
                            <div class="line greyLine"></div>
                            <div class="line redLine"></div>
                        </div>
                        <!-- 图片验证码 -->
                        <div class="vercode" key="regvercode">
                            <input v-model="regvercode" type="text" @keyup.enter="registerFun('.register')" placeholder="请输入验证码" @input="registerErrImg=false">
                            <div ref="regsvgBox" @click="getVerCode('regsvgBox')"></div>
                            <transition name="fade">
                                <div class="errcode" v-if="registerErrImg">{{registerErrImg}}</div>
                            </transition>
                        </div>
                        <!-- 注册按钮 -->
                        <div class="btn" @click="registerFun('.register')">注册</div>
                        <!-- 请注册 提示 -->
                        <div class="bottomTips">已有账号？
                            <span @click="status='login'">请登录</span>
                        </div>
                    </div>
                    <!-- 第二步 注册成功，重新登陆 -->
                    <div class="threeStep" v-show="registerStep===2">
                        <div class="success">注册成功，请重新登录</div>
                        <div class="btn" @click="toLogin">返回登录</div>
                    </div>
                </div>
                <!-- 忘记密码 -->
                <div class="forgetPwd" v-show="status==='forgetPwd'">
                    <!-- 第一步 输入用户名和完成图片验证-->
                    <div class="firstStep" v-show="forgetStep===1">
                        <!-- username -->
                        <div class="inputBox" key="3">
                            <div class="tips">请输入手机号</div>
                            <input type="text" @keyup.enter="firstStepFun('.firstStep')" @focus="teXiao" v-model="forget.username">
                            <div class="line greyLine"></div>
                            <div class="line redLine"></div>
                        </div>
                        <!-- 图片验证码 -->
                        <div class="vercode" key="vercode">
                            <input v-model="vercode" type="text" @keyup.enter="firstStepFun('.firstStep')" placeholder="请输入验证码" @input="fogetErrTipImg=false">
                            <div ref="svgBox" @click="getVerCode('svgBox')"></div>
                            <transition name="fade">
                                <div class="errcode" v-if="fogetErrTipImg">{{fogetErrTipImg}}</div>
                            </transition>
                        </div>
                        <!-- 下一步 -->
                        <div class="btn" @click="firstStepFun('.firstStep')">下一步</div>
                        <!-- 返回登录 -->
                        <div class="bottomTips">
                            <span @click="status='login'">返回登录</span>
                        </div>
                    </div>
                    <!-- 第二步 输入2次密码和完成短信验证-->
                    <div class="scendStep" v-show="forgetStep===2">
                        <!-- 设置您的登录密码 -->
                        <div class="inputBox" key="4">
                            <div class="tips">设置您的登录密码</div>
                            <input type="password" @keyup.enter="resetPwd('.scendStep')" @focus="teXiao" v-model="forget.password">
                            <div class="line greyLine"></div>
                            <div class="line redLine"></div>
                        </div>
                        <!-- 确认密码 -->
                        <div class="inputBox" key="5">
                            <div class="tips">确认密码</div>
                            <input type="password" @keyup.enter="resetPwd('.scendStep')" @focus="teXiao" v-model="forget.password2">
                            <div class="line greyLine"></div>
                            <div class="line redLine"></div>
                        </div>
                        <!-- 短信验证码 -->
                        <div class="vercode" key="messcode">
                            <input v-model="messcode" @keyup.enter="resetPwd('.scendStep')" type="text" placeholder="短信验证码" @input="fogetErrTipMess=false">
                            <div v-if="showTime===-1" class="messcode" @click="getMessCode">获取短信验证码</div>
                            <div v-else class="messcode againGet">{{showTime}}s后重新获取</div>
                            <transition name="fade">
                                <div class="errcode" v-if="fogetErrTipMess">{{fogetErrTipMess}}</div>
                            </transition>
                        </div>
                        <!-- 重置密码 -->
                        <div class="btn" @click="resetPwd('.scendStep')">重置密码</div>
                        <!-- 上一步 -->
                        <div class="bottomTips">
                            <span @click="forgetStep=1">上一步</span>
                        </div>
                    </div>
                    <!-- 第三步 密码重置成功，重新登陆 -->
                    <div class="threeStep" v-show="forgetStep===3">
                        <div class="success">密码重置成功，请重新登录</div>
                        <div class="btn" @click="toLogin">返回登录</div>
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
            // 当前显示：登录(login)、注册(register)、忘记密码(forgetPwd)
            status: "login",
            /******************* 【登录】数据*******************/
            // 【登录】数据
            login: {
                username: "",
                password: ""
            },
            // 【登录】错误信息提示
            loginErrTxt: "",
            /******************* 【忘记密码】数据*******************/

            // 【忘记密码】数据
            forget: {
                username: "",
                password: "",
                password2: ""
            },
            // 【忘记密码】步骤：1、2、3
            forgetStep: 1,
            // 【忘记密码】用户输入的图片验证码
            vercode: "",
            // 【忘记密码】图片验证码下面的错误提示，默认为空
            fogetErrTipImg: "",
            // 【忘记密码】用户输入的短信验证码
            messcode: "",
            // 【忘记密码】短信验证码下面的错误提示，默认为空
            fogetErrTipMess: "",
            // 【忘记密码】秒数 默认为-1，点击【获取短信验证码】后，赋值为60
            showTime: -1,
            // 【忘记密码】秒数重复执行定时器
            timer: null,
            /******************* 【注册】数据*******************/
            // 【注册】数据
            register: {
                username: "",
                password: ""
            },
            // 【注册】错误信息提示
            registerErrImg: "",
            // 【注册】输入的图片验证码
            regvercode: "",
            // 注册 步骤 1、2
            registerStep: 1
        };
    },
    methods: {
        // 一个输入框 获取焦点时的特效
        teXiao(e) {
            let line = e.target.nextSibling.nextSibling,
                tips = e.target.previousSibling.previousSibling,
                inputBox = e.target.parentNode.parentNode.querySelectorAll(
                    ".inputBox"
                );
            tips.className = "tips focus_tips";
            line.style.transform = "scaleX(1)";
            // 输入时，执行无错误时的特效
            e.currentTarget.addEventListener("input", () => {
                this.noErrTeXiao(inputBox);
            });
        },
        // 2个输入框，当有错误时的特效：红线展开
        errTeXiao(inputBox, index) {
            inputBox[index].querySelector("input").select();
            inputBox[index].lastChild.style.transform = "scaleX(1)";
        },
        // 2个输入框，都无错误时的特效：错误信息清空、所有红线缩回，输入框输入时调用
        noErrTeXiao(inputBox) {
            // 错误信息清空
            this.loginErrTxt = this.fogetErrTipImg = this.fogetErrTipMess = this.registerErrImg =
                "";
            // 红线缩回特效
            for (let i = 0; i < inputBox.length; i++) {
                inputBox[i].lastChild.style.transform = "scaleX(0)";
            }
        },
        // 判断是否为手机号
        isPhone(value) {
            return /^1[34578]\d{9}$/.test(value);
        },
        // 判断密码长度 6-16
        checkPwdLength(value) {
            if (value.length <= 5) {
                return 5; //长度不够6位
            } else if (value.length >= 17) {
                return 4; //长度超过16位
            } else {
                return 0; //长度符合要求
            }
        },
        // 登录按钮事件
        loginFun(flag) {
            let i = 0,
                { username, password } = this.login,
                e = document.querySelector(flag),
                inputBox = e.querySelectorAll(".inputBox");
            // 用户名、密码都不为空
            if (username && password) {
                let txt = [
                    "用户名不存在，请注册",
                    "密码错误",
                    "您输入的不是手机号"
                ];
                // 1、判断是否为手机号
                if (this.isPhone(username)) {
                    this.$http.post("/api/login", this.login).then(data => {
                        // data.data：0：用户名错误；1：密码错误；object：登录成功
                        if (typeof data.data === "object") {
                            // 1、登录/注册 变为用户头像；2、显示购物车图标
                            this.$store.dispatch("changeLoginIDAc", data.data);
                            this.$router.push("/index");
                        } else {
                            this.loginErrTxt = txt[data.data];
                            this.errTeXiao(inputBox, data.data);
                        }
                    });
                } else {
                    // 不是手机号
                    this.loginErrTxt = txt[2];
                    this.errTeXiao(inputBox, i);
                }
            } else {
                // 用户名、密码有空值
                if (username !== "") i = 1;
                inputBox[i].querySelector("input").focus();
            }
        },
        /******************* 【忘记密码】方法*******************/
        // 获取 图片验证码
        getVerCode(flag) {
            this.$http.get("/api/getVerCode").then(data => {
                this.$refs[flag].innerHTML = data.data;
            });
        },
        // 验证 图片验证码
        checkVerCode(vercode, callback) {
            this.$http.post("/api/checkVerCode", { vercode }).then(data => {
                callback(data);
            });
        },
        // 点击【下一步】
        firstStepFun(flag) {
            let { username } = this.forget,
                e = document.querySelector(flag),
                inputBox = e.querySelectorAll(".inputBox"),
                userInputEl = inputBox[0].querySelector("input"),
                imgcodeEL = e.querySelector(".vercode").firstChild,
                txt = [
                    "验证码错误",
                    "用户名不存在，请注册",
                    "您输入的不是手机号",
                    "请输入验证码"
                ];
            //1、判断 账号、验证码 是否为空
            //2、判断输入的验证码是否正确
            //3、验证码正确，查找用户名是否存在
            if (this.vercode && username) {
                // 用户名、验证码都不为空
                // 1、判断是否为手机号
                if (this.isPhone(username)) {
                    // 2、判断验证码是否正确
                    this.checkVerCode(this.vercode, data => {
                        //data.data 1：验证码正确；0：验证码错误
                        if (data.data) {
                            // 用户名是否存在
                            this.$http
                                .post("/api/login", this.forget)
                                .then(data => {
                                    // data.data 0：无用户名；1：有用户名
                                    if (data.data) {
                                        //有用户名，显示第二步
                                        this.forgetStep = 2;
                                    } else {
                                        //无用户名，显示错误信息：【无该户名，请注册】
                                        this.errTeXiao(inputBox, 0);
                                        this.fogetErrTipImg = txt[1];
                                    }
                                });
                        } else {
                            // 验证码错误
                            imgcodeEL.select();
                            this.fogetErrTipImg = txt[0];
                        }
                    });
                } else {
                    // 您输入的不是手机号
                    this.errTeXiao(inputBox, 0);
                    this.fogetErrTipImg = txt[2];
                }
            } else {
                if (username) {
                    // 验证码为空
                    imgcodeEL.select();
                    this.fogetErrTipImg = txt[3];
                } else {
                    // 用户名为空
                    userInputEl.focus();
                }
            }
        },
        // 重置密码 resetPwd
        resetPwd(flag) {
            let i = 0,
                { password, password2 } = this.forget,
                e = document.querySelector(flag),
                inputBox = e.querySelectorAll(".inputBox"),
                messcodeEL = e.querySelector(".vercode").firstChild,
                txt = [
                    "请输入密码", //0
                    "确认密码不能为空", //1
                    "验证码不能为空", //2
                    "验证码错误", //3
                    "密码长度超过16位", //4
                    "密码长度不够6位", //5
                    "两次密码不一致" //6
                ];
            if (password && password2 && this.messcode) {
                // 1、判断第一个密码长度
                let len1 = this.checkPwdLength(password);
                // len1：0 长度符合；4：长度超过；5 长度不够
                if (len1) {
                    // 长度不符合
                    this.errTeXiao(inputBox, 0);
                    this.fogetErrTipMess = txt[len1];
                } else {
                    //2、判断两次密码是否一致
                    if (password === password2) {
                        // 3、验证短信验证码是否正确
                        this.$http
                            .post("/api/checkMessCode", {
                                messcode: this.messcode
                            })
                            .then(data => {
                                // data.data：1 短信验证码正确；0 短信验证码错误
                                if (data.data) {
                                    // 修改密码
                                    this.$http
                                        .post("/api/updatePwd", this.forget)
                                        .then(data => {
                                            if (data.data) {
                                                console.log("密码重置成功");
                                                this.forgetStep = 3;
                                            }
                                        });
                                } else {
                                    // 短信验证码错误
                                    messcodeEL.select();
                                    this.fogetErrTipMess = txt[3];
                                }
                            });
                    } else {
                        // 两次密码不一致
                        this.errTeXiao(inputBox, 1);
                        this.fogetErrTipMess = txt[6];
                    }
                }
            } else {
                // 存在空值
                if (password) {
                    if (password2) {
                        i = 2;
                        messcodeEL.select();
                    } else i = 1;
                }
                this.fogetErrTipMess = txt[i];
                if (i !== 2) inputBox[i].querySelector("input").focus();
            }
        },
        // 获取短信验证码
        getMessCode() {
            console.log("【准备】发送短信...");
            clearInterval(this.timer);
            this.showTime = 6;
            this.timer = setInterval(() => {
                if (this.showTime !== -1) {
                    this.showTime--;
                } else {
                    clearInterval(this.timer);
                    this.showTime = -1;
                }
            }, 1000);
            this.$http.get("/api/createMessCode").then(data => {
                if (data.data) console.log("【已经】发送短信...");
                else console.log("发送短信出错！");
            });
        },
        // 返回登录
        toLogin() {
            this.status = "login";
            this.forgetStep = 1;
            this.showTime = -1;
            // 除了登录所需的用户名、密码，其他全部变为默认值
            // 用户相关数据重置
            this.login.password = this.forget.username = this.forget.password = this.forget.password2 = this.vercode = this.messcode =
                "";
        },
        // 检查用户名是否存在
        checkUserName(flag) {
            let e = document.querySelector("." + flag),
                inputBox = e.querySelectorAll(".inputBox"),
                { username } = this[flag];
            if (this.isPhone(username)) {
                this.$http.post("/api/login", { username }).then(data => {
                    // data.data： 0 未注册；1 已注册
                    if (data.data) {
                        this[flag + "ErrImg"] = "该手机号已注册";
                        this.errTeXiao(inputBox, 0);
                    }
                });
            } else {
                // 不是手机号
                this[flag + "ErrImg"] = "您输入的不是手机号";
                this.errTeXiao(inputBox, 0);
            }
        },
        /******************* 【注册】方法*******************/
        // 注册 事件
        registerFun(flag) {
            let i = 0,
                { username, password } = this.register,
                e = document.querySelector(flag),
                inputBox = e.querySelectorAll(".inputBox"),
                imgcodeEL = e.querySelector(".vercode").firstChild,
                txt = [
                    "请输入用户名",
                    "请输入密码",
                    "验证码不能为空",
                    "该手机号已注册",
                    "密码长度超过16位",
                    "密码长度不够6位"
                ];
            if (username && password && this.regvercode) {
                // 无空值
                // 1、判断用户名是否为手机号 isPhone()
                // if (this.isPhone(username)) {
                // 2、判断 是否存在用户名
                // this.$http.post("/api/login", { username }).then(data => {
                // data.data： 0 未注册；1 已注册
                // if (data.data) {
                //     this.registerErrImg = txt[3];
                //     this.errTeXiao(inputBox, 0);
                // } else {
                let len = this.checkPwdLength(password);
                // 3、判断密码长度是否符合标准
                if (len) {
                    this.errTeXiao(inputBox, 1);
                    this.registerErrImg = txt[len];
                } else {
                    // 4、判断验证码是否正确
                    this.checkVerCode(this.regvercode, data => {
                        // data.data：0 验证码错误；1 验证码正确
                        if (data.data) {
                            // 调用注册接口，完成注册
                            this.$http
                                .post("/api/register", this.register)
                                .then(data => {
                                    if (data.data) this.registerStep = 2;
                                    else console.log("注册接口出错！");
                                });
                        } else {
                            imgcodeEL.select();
                            this.registerErrImg = "验证码错误";
                        }
                    });
                }
                // }
                // });
                // }
                // else {
                //     // 不是手机号
                //     this.registerErrImg = "您输入的不是手机号";
                //     this.errTeXiao(inputBox, 0);
                // }
            } else {
                // 有空值
                // 存在空值
                if (username) {
                    if (password) {
                        i = 2;
                        imgcodeEL.select();
                    } else i = 1;
                }
                this.registerErrImg = txt[i];
                if (i !== 2) inputBox[i].querySelector("input").focus();
            }
        }
    }
};
</script>


