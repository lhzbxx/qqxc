/* 
 * @Author: Administrator
 * @Date:   2016-02-05 23:56:57
 * @Last Modified by:   Administrator
 * @Last Modified time: 2016-02-20 10:29:42
 */

$(function () {

    function valid_phone(phone) {
        var pattern=/(^(([0\+]\d{2,3}-)?(0\d{2,3})-)(\d{7,8})(-(\d{3,}))?$)|(^0{0,1}1[3|4|5|6|7|8|9][0-9]{9}$)/;
        return pattern.test(phone);
    }

    var h = $(window).height();
    //点击获取验证码
    $(".li-03 button").click(function (event) {
        var phone = $(".phone").val();
        if ( ! valid_phone(phone)) {
            $(".tip1 p").text('手机号填写错误');
            $(".clicktext1").css('height', h);
            $(".clicktext1").addClass('current');
            return;
        }
        $(this).css({
            'background': '#666',
            'border-radius': '0.1rem'
        });
        //验证短信接口
        $.ajax({
                type: 'POST',
                url: 'http://120.27.194.121:8877/index.php/api/wx/1/common/request_captcha_code',
                data: {
                    'phone': phone
                }
            })
            .done(function (data) {
                console.log(data.msg);
                $(".tip1 p").text('验证码已发送');
                $(".clicktext1").css('height', h);
                $(".clicktext1").addClass('current');
            });
    });
    $(".password").keydown(function () {
        if ( ! valid_form())
            $(".submit").css("backgroundColor", '#03c9a9');
        else
            $(".submit").css("backgroundColor", '#d8d8d8');
    });
    $(".userName").keydown(function () {
        if ( ! valid_form())
            $(".submit").css("backgroundColor", '#03c9a9');
        else
            $(".submit").css("backgroundColor", '#d8d8d8');
    });
    $(".verifyCode").keydown(function () {
        if ( ! valid_form())
            $(".submit").css("backgroundColor", '#03c9a9');
        else
            $(".submit").css("backgroundColor", '#d8d8d8');
    });
    $(".phone").keydown(function () {
        if ( ! valid_form())
            $(".submit").css("backgroundColor", '#03c9a9');
        else
            $(".submit").css("backgroundColor", '#d8d8d8');
    });
    function valid_form() {
        return ($(".li-01 input").val() == "" || $(".li-03 input").val() == ""
        || $(".li-05 input").val() == "" || $(".li-04 input").val() == "");
    }

    //点击.submit跳转至首页
    $(".submit").click(function (event) {
        if ($(".li-01 input").val() == "" || $(".li-03 input").val() == ""
            || $(".li-05 input").val() == "" || $(".li-04 input").val() == "") {
            $(".tip1 p").text('内容不能为空');
            $(".clicktext1").css('height', h);
            $(".clicktext1").addClass('current');

        } else {
            var phone = $(".phone").val();
            var userName = $(".li-04 input").val();
            var captcha_code = $(".li-03 input").val();
            var password = $(".li-05 input").val();
            $.ajaxSetup({
                headers: {
                    'api_key': getCookie("openid")
                }
            });
            //上传用户电话姓名等信息
            $.ajax({
                type: 'POST',
                url: 'http://120.27.194.121:8877/index.php/api/wx/1/user/bind_wx',
                data: {
                    'phone': phone,
                    'captcha': captcha_code,
                    'password': md5(password),
                    'realname': userName
                }
            })
            .done(function (data) {
                console.log(data.msg);
                // window.location.href = '../../html/home.html';
            });
        }
    });
    //点击关闭，弹窗消失
    $(".close").click(function (event) {
        $(".clicktext1").removeClass('current');
    });

});