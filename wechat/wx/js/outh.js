/* 
 * @Author: Administrator
 * @Date:   2016-02-19 13:00:57
 * @Last Modified by:   Administrator
 * @Last Modified time: 2016-02-20 10:39:01
 */

$(function () {

    function getUrlParam (code) {
        var reg = new RegExp("(^|&)" + code + "=([^&]*)(&|$)");
        var r = window.location.search.substr(1).match(reg);
        if (r != null) return unescape(r[2]);
        return null;
    }

    $.ajax({
            type: 'GET',
            url: 'http://120.27.194.121:8877/index.php/api/wx/1/wechat/openid',
            data: {
                'code': getUrlParam('code')
            }
        })
        .done(function (data) {
            setCookie("openid", data.data.openid, 365);
            window.location.href="../../html/home.html";
        });

});