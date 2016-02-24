/* 
* @Author: Administrator
* @Date:   2016-01-26 22:19:18
* @Last Modified by:   Administrator
* @Last Modified time: 2016-02-20 11:48:27
*/

$(function() { 
       //教练信息
       $.ajaxSetup({
            headers: {
                'api_key': '123',
            },
        });
        $.ajax({
              type: 'GET',
              url: 'http://120.27.194.121/index.php/api/wx/1/coach/detail',
              data:{
                  'coach_id':""
              }
          })
          .done(function(data) {
              console.log(data.code);
              console.log(data.msg);
              console.log(data.data);
              $(".coachId").html(data.coach_id);
              $(".pic img").attr('src', avatar);
              $(".type span").html(data.name);
              $(".type i").html(data.type);
              $(".coachAge span").html(data.exp);
              $(".address").html(data.place);
              $(".distance i").html(data.dist);
              $(".distance b").html(data.price);
          });   
       //报名界面缺少接口，无法上传学员信息
      $(".information-03 button").click(function(event) {
            $(this).css({
              'background': '#666',
              'border-radius': '0.1rem'
            });
            var phone = $(".information-03 input").val();
            //调用短信验证接口
             $.ajax({
                 type: 'POST',
                 url: 'http://120.27.194.121/index.php/api/wx/1/common/request_captcha_code',
                 data:{
                      'phone':phone
                 }
              })
             .done(function(data) {
                 console.log(data.code);
                 console.log(data.msg);
                 console.log(data.data);
             });
      });
      $(".color").click(function(event) {
            var b = $(this).parent();
            var x = b.index();
            $(".color ").toggleClass('changeColor');
      });
      $(".submit").click(function(event) {
            //如果复选框为选中则执行支付
            var type = $(".type i").html();
            var coachId = $(".coachId").html();
            var userName = $(".userName").val();
            var userPhone = $(".userPhone").val();
          if ($(".box").prop("checked")==true) {
                $.ajax({    //预支付
                      type: 'POST',
                      url: 'http://120.27.194.121/index.php/api/wx/1/pay/pre_deal',
                      data:{
                          'type':type,
                          'coach_id':coachId
                      }
                })
                .done(function(data) {
                      console.log(data.code);
                      console.log(data.msg);
                      console.log(data.data);
                      var price = $(".distance b").html();
                      $.ajax({
                          type: 'POST',
                          url: 'https://api.mch.weixin.qq.com/pay/unifiedorder',
                          data:{
                                'openid':wx96e6b1df252e6b82,
                                'mch_id':"商户号",
                                'nonce_str':"随机字符串",
                                'sign':"签名",
                                'body':"商品描述",
                                'out_trade_no':"商户订单号",
                                'total_fee':price,
                                'spbill_create_ip':"终端IP",
                                'notify_url':"http://120.27.194.121:5000/wx1/html/enroll.html",  //能直接访问的支付地址
                                'trade_type':"JSAPI"
                          }
                      })
                      .done(function(data) {
                                if (return_code=="SUCCESS"&&result_code=="SUCCESS") {
                                     //向后台传送prepay_id和sign
                                     //发起支付请求
                                      wx.chooseWXPay({
                                          timestamp: 0, // 支付签名时间戳，注意微信jssdk中的所有使用timestamp字段均为小写。但最新版的支付后台生成签名使用的timeStamp字段名需大写其中的S字符
                                          nonceStr: '', // 支付签名随机串，不长于 32 位
                                          package: '', // 统一支付接口返回的prepay_id参数值，提交格式如：prepay_id=***）
                                          signType: '', // 签名方式，默认为'SHA1'，使用新版支付需传入'MD5'
                                          paySign: '', // 支付签名
                                          success: function (res) {
                                              // 支付成功后的回调函数
                                          }
                                      });
                                } else{};
                      });
                });
                                             
          }else{
                $(".inAgreement a").css("color","red");
          };
      });
});
	     
     
	
	
	
      
	
