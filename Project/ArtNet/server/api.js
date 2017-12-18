//接口
// 可能是我的node版本问题，不用严格模式使用ES6语法会报错
"use strict";
const models = require("./db");
const express = require("express");
const router = express.Router();
var svgCaptcha = require('svg-captcha');
/**
 * 注册接口部分
 */
//登录
router.post("/api/Login", (req, res) => {
    var username = req.body.data.account;
    var password = req.body.data.password;
    switch (req.body.kind) {
        case "log":
            var result = {};
            models.Login.find({ username }, (err, data) => {
                if (data.length) {
                    //账号存在
                    if (password == data[0].password) {
                        //是否密码错误
                        result.code = 0;
                        result.msg = "登录成功!"
                        res.send(result);
                    } else {
                        result.code = 1;
                        result.msg = "密码错误!"
                        res.send(result);
                    }
                } else {
                    //账号不存在
                    result.code = 2;
                    result.msg = "用户名不存在!";
                    res.send(result);
                }
            })
            break;
        case "reg":
            var result = {};
            models.Login.find({ username }, (err, data) => {
                if (data.length) {
                    result.code = 1;
                    result.msg = "该账号已被注册";
                    res.send(result);
                } else {
                    new models.Login({
                        username, password
                    }).save((err, data) => {
                        result.code = 0;
                        result.msg = "注册成功!";
                        res.send(result);
                    });
                }
            })
            break;

    }
})
//验证码
router.get("/api/Login/getPassCode", (req, res) => {
    var captcha = svgCaptcha.create({
        size: 4,
        ignoreChars: '0o1ig',
        noise: 1,
        color: true,
        width: 130,
        height: 40
    });
    res.type('svg');
    res.send(captcha.data);
})
//验证session
router.get("create", (req, res) => {
    console.log(req.session);
})
//获取首页轮播图
router.get("/api/index/swiperBg", (req, res) => {
    models.swiperBg.find((err, data) => {
        if (err) {
            res.send(err);
        } else {
            res.send(data);
        }
    });
});
/******
 * 获取商品信息接口
 * 该接口通过参数来判定调用的地方
 * params为String
 ***** */
router.get("/api/getGoods", (req, res) => {
    //获取推荐
    models.getGoods.find({ classify: req.query.pos }, (err, data) => {
        if (err) {
            res.send(err);
        } else {
            let result = [];
            for (let i = 0; i < 4; i++) {
                var randomNum = Math.round(Math.random() * (data.length - 1));
                result.push(data[randomNum]);
            }
            res.send(result);
        }
    });
});
router.get("/api/getLatest", (req, res) => {
    models.getGoods.find().sort({ time: -1 }).limit(10).exec((err, data) => {
        res.send(data)
    });
})
module.exports = router;
