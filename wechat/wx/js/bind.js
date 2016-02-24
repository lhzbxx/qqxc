/* 
* @Author: Administrator
* @Date:   2016-02-05 23:56:57
* @Last Modified by:   Administrator
* @Last Modified time: 2016-02-20 10:29:42
*/

$(function() {

            var h = $(window).height();
            //点击获取验证码
	$(".li-03 button").click(function(event) {
                         
                    var phone = $(".phone").val();
		$(this).css({
			'background': '#666',
			'border-radius': '0.1rem'
		});
                    //验证短信接口
                    $.ajax({
                        type: 'POST',
                        url: 'http://120.27.194.121/index.php/api/wx/1/common/request_captcha_code',
                        data:{
                            'phone':phone
                        }
                    })
                    .done(function(data) {
                       console.log(phone);
                       console.log(data.msg);
                    });
               
                   
	});
            var phone = $(".phone").val();
            var userName = $(".li-04 input").val();
            var captcha_code = $(".li-03 input").val();
	$.ajaxSetup({
    		headers: {
    			'api_key': '123',
    		},
		});
            //上传用户电话姓名等信息
    	$.ajax({
            type: 'POST',
            url: 'http://120.27.194.121/index.php/api/wx/1/user/bind_phone',
            data:{
            	'phone': phone,
                     'verfy_code':captcha_code,
                     'password': " ",
                     'name':userName,
                     'openid':"openid"
                //缺openid和password
            }
        })
        .done(function(data) {
            console.log(data.code);
            console.log(data.msg);
            console.log(data.data);
        });
        //点击.submit跳转至首页
        $(".submit").click(function(event) {
            if ($(".li-01 input").val()==""||$(".li-03 input").val()==""||$(".li-04 input").val()=="") {

                $(".clicktext1").css('height', h);
                $(".clicktext1").addClass('current');
                //点击关闭，弹窗消失
                $(".close").click(function(event) {
                    $(".clicktext1").removeClass('current');
                    
                });
            } else{
                $(".submit").attr('href', 'home.html');
            };
        });
        
});