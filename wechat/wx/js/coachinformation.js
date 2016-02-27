/* 
 * @Author: zz
 * @Date:   2016-01-25 15:26:14
 * @Last Modified by:   Administrator
 * @Last Modified time: 2016-02-13 10:13:46
 */

'use strict';
$(function () {
    var h = $(window).height();
    var scrollTop = $(window).scrollTop();
    h = h + scrollTop;
    $.ajax({
            type: 'GET',
            url: 'http://120.27.194.121:8877/index.php/api/wx/1/coach/mine',
            data: {},
            headers: {
                'api_key': getCookie('openid')
            }
        })
        .done(function (data) {
            console.log(data.msg);
            var tmpl = $.templates("#tmpl");
            var op = tmpl.render(data.data);
            $("#content").html(op);
        });
});