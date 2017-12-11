//接口
// 可能是我的node版本问题，不用严格模式使用ES6语法会报错
"use strict";
const models = require("./db");
const express = require("express");
const router = express.Router();

/************** 创建(create) 读取(get) 更新(update) 删除(delete) **************/

// 创建账号接口
// router.post("/api/login/createAccount", (req, res) => {
//     // 这里的req.body能够使用就在index.js中引入了const bodyParser = require('body-parser')
//     let newAccount = new models.Login({
//         account: req.body.account,
//         password: req.body.password
//     });
//     // 保存数据newAccount数据进mongoDB
//     newAccount.save((err, data) => {
//         if (err) {
//             res.send(err);
//         } else {
//             res.send("createAccount successed");
//         }
//     });
// });
//创建一个登录验证的接口
router.post("/api/login/validateAccount", (req, res) => {
  let result = {
    username: req.body.username,
    password: req.body.password
  };
  models.Login.find(result, (err, odata) => {
    if (err) {
      res.send(err);
    } else {
      // console.log(result.username, result.password);
      // console.log(odata);
      if (odata.length) {
        var data = {
          data: odata[0]
        };
        res.send(data);
      } else {
        res.send("没有找到");
      }
    }
  });
});
//获取首页轮播图
router.get("/api/index/swiperBg", (req, res) => {
  models.swiperBg.find((err, data) => {
    if (err) {
      res.send(err);
    } else {
      console.log(data);
      res.send(data);
    }
  });
});
// 获取已有账号接口
// router.get("/api/login/getAccount", (req, res) => {
//     // 通过模型去查找数据库
//     models.Login.find((err, data) => {
//         if (err) {
//             res.send(err);
//         } else {
//             res.send(data);
//         }
//     });
// });

module.exports = router;
