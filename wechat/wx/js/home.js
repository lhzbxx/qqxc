/* 
* @Author: Administrator
* @Date:   2016-02-04 16:03:28
* @Last Modified by:   Administrator
* @Last Modified time: 2016-02-20 13:20:35
*/

$(function() {
        //判断是否已登录
        $.ajax({
            type: '方法',
            url: '接口地址',
            //上传openid？
        })
        .done(function(data) {
               if (returnCode==1/*返回1为已登录*/ ) {
                    $(".myInformation").attr("href","myaccounted.html");
                    $(".footer a").attr('href', 'tel:4000916960');
               } else{
                    $(".myInformation").attr("href","myaccount.html");
                    $(".footer a").attr('href', 'bind.html ');
               };
            
        });
	$.ajax({
                type: 'GET',
                url: 'https://api.weixin.qq.com/sns/userinfo?access_token=ACCESS_TOKEN&openid=OPENID',
            //是否不需要获取地理位置接口了？
        })
        .done(function(data) {
            console.log(sex);
            console.log(province);
            console.log(city);
           //将位置信息发送至后台，接口还未写
        });
	    
});
