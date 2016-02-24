/* 
* @Author: Administrator
* @Date:   2016-02-13 09:24:40
* @Last Modified by:   Administrator
* @Last Modified time: 2016-02-19 14:46:46
*/

$(function() {
	//调用微信头像
	$.ajax({
            type: 'GET',
            url: 'https://api.weixin.qq.com/sns/userinfo?access_token=ACCESS_TOKEN&openid=OPENID',
            //如何填写openid,ACCESS_TOKEN
        })
        .done(function(data) {
            console.log(expires_in);
            console.log(scope);
            console.log(access_token);
           	
           /*用户头像和微信头像一致*/
          $(".inPic img").attr('src', headimgurl);
        });
});