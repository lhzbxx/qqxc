/* 
 * @Author: Administrator
 * @Date:   2016-02-19 13:00:57
 * @Last Modified by:   Administrator
 * @Last Modified time: 2016-02-20 10:39:01
 */

$(function () {

    window.location.href = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx96e6b1df252e6b82&redirect_uri=http%3a%2f%2f120.%0a27.194.121%3a5000%2fwx%2fwx1%2fhome.html&response_type=code&scope=snsapi_userinfo&state=wechat#wechat_redirect";
    function ($) {
        $.getUrlParam = function (code) {
            var reg = new RegExp("(^|&)" + code + "=([^&]*)(&|$)");
            var r = window.location.search.substr(1).match(reg);
            if (r != null) return unescape(r[2]);
            return null;
        };

    $.ajaxSetup({
        headers: {
            'api_key': '123'
        }
    });
    $.ajax({
            type: 'GET',
            url: 'http://120.27.194.121/index.php/api/wx/1/wechat/openid',
            data: {
                'code': getUrlParam('code')
            }
        })
        .done(function (data) {
            console.log(data.code);
            console.log(data.msg);
            console.log(data.data);
        });


    //上传code

});