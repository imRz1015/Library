//设置数据库相关
// Schema、Model、Entity或者Documents的关系请牢记，Schema生成Model，Model创造Entity，Model和Entity都可对数据库操作造成影响，但Model比Entity更具操作性。
const mongoose = require("mongoose");
// 连接数据库 如果不自己创建 默认test数据库会自动生成
mongoose.connect(
  "mongodb://localhost:27017/db",
  { useMongoClient: true },
  function(err) {
    if (err) {
      console.log("芒果连接失败");
    } else {
      console.log("芒果连接成功");
    }
  }
); // 地址跟第一步的地址对应。
/************** 定义模式loginSchema **************/
const loginSchema = new mongoose.Schema({
  username: String,
  password: String
});
/************** 定义模式SwiperSchema **************/
const swiperBg = new mongoose.Schema({
  img: String
});
/************** 定义模型Model **************/
const Models = {
  Login: mongoose.model("logins", loginSchema),
  swiperBg: mongoose.model("bgs", swiperBg)
};

module.exports = Models;
