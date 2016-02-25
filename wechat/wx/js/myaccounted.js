/* 
 * @Author: Administrator
 * @Date:   2016-02-13 09:24:40
 * @Last Modified by:   Administrator
 * @Last Modified time: 2016-02-19 14:46:46
 */

$(function () {
    //调用微信头像
    $.ajax({
            type: 'GET',
            url: 'http://120.27.194.121:8877/index.php/api/wx/1/user/avatar',
            headers: {
                'api_key': getCookie("openid")
            }
        })
        .done(function (data) {
            $(".inPic img").attr('src', data.data);
        });
});