/* 
* @Author: Administrator
* @Date:   2016-02-13 03:42:17
* @Last Modified by:   Administrator
* @Last Modified time: 2016-02-20 10:30:19
*/

$(function() {

            var h = $(window).height();
            $(".li-03 button").click(function(event) {
                     var phone = $(".li-01 input").val();                            
                    $(this).css({
                        'background': '#666',
                        'border-radius': '0.1rem'
                    });
                    $.ajax({
                        type: 'POST',
                        url: ' http://120.27.194.121/index.php/api/wx/1/common/request_captcha_code',
                        data:{
                            'phone':phone
                        }
                    })
                    .done(function(data) {
                       console.log("短信接口ok");
                    });  
            });
            var userName = $(".li-04 input").val(); 
             var phone = $(".li-01 input").val();   
            $.ajaxSetup({
                    headers: {
                        'api_key': '123',
                    },
            });
            //上传用户信息
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
            //点击.submit跳转至我的账户
            $(".submit").click(function(event) {
                if ($(".li-01 input").val()==""||$(".li-03 input").val()==""||$(".li-04 input").val()=="") {

                    $(".clicktext1").css('height', h);
                    $(".clicktext1").addClass('current');
                    //点击关闭，弹窗消失
                    $(".close").click(function(event) {
                        $(".clicktext1").removeClass('current');
                        
                    });
                } else{
                    $(".submit").attr('href', 'myaccounted.html');
                };
            });
    
});