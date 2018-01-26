/**
 * TANGIMING
 *2018.1.25
 *将数字转换为想要的日期格式
 * 2018-1-26 9:55
 */

Date.prototype.toLocaleString = function() {
  return (
    this.getFullYear() +
    '/' +
    (this.getMonth() + 1) +
    '/' +
    this.getDate() +
    '  ' +
    this.getHours() +
    ':' +
    this.getMinutes()
  );
};
