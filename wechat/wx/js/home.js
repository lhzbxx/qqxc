/* 
* @Author: Administrator
* @Date:   2016-02-04 16:03:28
* @Last Modified by:   Administrator
* @Last Modified time: 2016-02-20 13:20:35
*/

$(function() {
    //判断是否已登录
    $.ajax({
        type: 'GET',
        url: 'http://120.27.194.121:8877/index.php/api/wx/1/wechat/is_binded',
        data: {
            'openid': getCookie("openid")
        }
    })
    .done(function(data) {
        returnCode = data.data;
        if (returnCode) {
            $(".myInformation").attr("href", "myaccounted.html");
            $(".footer a").attr('href', 'tel:4000916960');
        } else {
            $(".myInformation").attr("href", "myaccount.html");
            $(".footer a").attr('href', 'bind.html ');
        }
    });

});
