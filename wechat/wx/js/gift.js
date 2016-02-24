/* 
* @Author: Administrator
* @Date:   2016-01-27 18:51:23
* @Last Modified by:   Administrator
* @Last Modified time: 2016-02-13 14:52:05
*/

$(function() {  
	
           var h = $(window).height();
           $(".bg").css('height', h);
	$(".code p").html("");
            $.ajaxSetup({
                headers: {
                    'api_key': '123',
                },
            });
    	$.ajax({
            type: 'GET',
            url: 'http://120.27.194.121/index.php/api/wx/1/coupon/check_code'
          
         })
        .done(function(data) {
            console.log(data.code);
            console.log(data.msg);
            console.log(data.data);
            var inviteCode = data.invite_code;
            $(".code p").html(inviteCode);
        });
	

});