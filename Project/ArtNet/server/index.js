//入口文件
// 引入编写好的api
const api = require("./api");
// 引入文件模块
const fs = require("fs");
// 引入处理路径的模块
const path = require("path");
// 引入处理post数据的模块
const bodyParser = require("body-parser");
// 引入Express
const express = require("express");
//启动一个web服务器
const app = express();

app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: false }));
app.use((req, res, next) => {
    console.log("66666666666666666666");
    next();
});
app.use("/", (req, res, next) => {
    console.log("77777777777777777");
    next();
});
app.use("*", (req, res, next) => {
    console.log("8888888888888888");
    next();
});
app.use(api);
// 访问静态资源文件 这里是访问所有dist目录下的静态资源文件
// app.use(express.static(path.resolve(__dirname, "../dist")));
// 因为是单页应用 所有请求都走/dist/index.html
// app.get("*", function(req, res) {
//     console.log("hello nodejs11111");
//     // const html = fs.readFileSync(
//     //     path.resolve(__dirname, "../dist/index.html"),
//     //     "utf-8"
//     // );
//     // res.send(html);
// });
// 监听8088端口
app.listen(8088);
console.log("监听端口8088");