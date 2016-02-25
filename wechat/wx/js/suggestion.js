/* 
 * @Author: zz
 * @Date:   2016-01-25 17:14:02
 * @Last Modified by:   Administrator
 * @Last Modified time: 2016-02-20 10:21:12
 */

'use strict';
$(function () {

    var h = $(window).height();
    $(".submit").click(function (event) {
        var content = $(".suggestion textarea").val();
        var contact = $(".telephone input").val();
        if ($("textarea").val() == "" || $("input").val() == "") {
            //评论为空时，弹出内容不能为空
            $(".clicktext1").css('height', h);
            $(".clicktext1").addClass('current');
            //点击关闭按钮，回到评论页面
            $(".tip1 .close").click(function (event) {
                $(".clicktext1").removeClass('current');
            });
        } else {		//上传评论
            $.ajax({
                type: 'POST',
                url: 'http://120.27.194.121:8877/index.php/api/wx/1/feedback/send',
                data: {
                    'content': content,
                    'contact': contact,
                    'type': 'U',
                    'destination': 'A'
                }
            })
            .done(function (data) {
                console.log(data.msg);
                //将位置信息发送至后台，接口还未写
            });
            $(".clicktext").css('height', h);
            $(".clicktext").addClass('current');
            //点击关闭按钮，跳转至首页
            $(".tip em").click(function (event) {
                $(".clicktext").removeClass('current');
                $(".submit").attr('href', 'home.html');
            });
        }
    });
    $(".suggestion p").click(function (event) {
        $(".suggestion p").addClass('current');
        $(".suggestion textarea").focus(function (event) {

        });
    });
});
