/* 
* @Author: Administrator
* @Date:   2016-01-27 12:31:08
* @Last Modified by:   Administrator
* @Last Modified time: 2016-02-20 01:27:27
*/

'use strict';
$(function() {
	var h = $(window).height();
	$(".main").css('height',h);
	$(".inputBg").css('height',h);
	$(".clicktext").css('height', h);
	$(".inputBtn").click(function(event) {
		$(".inputBg").addClass('current');
	});
	$(".quit").click(function(event) {
		$(".inputBg").removeClass('current');
	});
	$(".confirmed").click(function(event) {
		var friend_code = $(".inputCode input").val();
		$.ajaxSetup({
    			headers: {
    				'api_key': '123',
    			},
		});
	    	$.ajax({
		            type: 'POST',
		            url: 'http://120.27.194.121/index.php/api/wx/1/coupon/submit_code',
		            data:{
		            	'code':friend_code
		            }
	        	})
	        .done(function(data) {
		            console.log(data.code);
		            console.log(data.msg);
		            console.log(data.data);
		            var systerm_code = data.data;
		            if (friend_code==systerm_code) {
		            	//验证成功，提示提交成功
		            	$(".tip p").html("提交成功");
		            	$(".clicktext").addClass('current2');
		            	$(".inputBg").removeClass('current');
		            } else{
		            	$(".clicktext").addClass('current2');
		            	$(".inputBg").removeClass('current');
		            	/*$(".inputCode input").val("输入好友优惠码");*/
		            };
	        });
	});
	
	$(".close").click(function(event) {
		$(".clicktext").removeClass('current2');
		$("body,html").css({"overflow":"auto"});
	});
		
});
