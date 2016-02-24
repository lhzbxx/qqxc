/* 
* @Author: Administrator
* @Date:   2016-02-19 10:20:58
* @Last Modified by:   Administrator
* @Last Modified time: 2016-02-20 10:33:18
*/

var myOpenid = getCookie("openid");
//setCookie("openid", '123', 365);
if ( ! myOpenid) {
    // 没有openid，跳转至outh.html
    window.location.href = "https://open.weixin.qq.com/connect/oauth2/authorize?" +
        "appid=wx96e6b1df252e6b82&redirect_uri=http%3a%2f%2fwww.qqxueche.net%3a5000%2fhtml%2fouth.html" +
        "&response_type=code&scope=snsapi_userinfo&state=wechat#wechat_redirect";
} else {
    // 上传openid
    window.location.href="../../html/home.html";
}
