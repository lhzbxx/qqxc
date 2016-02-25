/* 
* @Author: Administrator
* @Date:   2016-02-06 01:50:13
* @Last Modified by:   Administrator
* @Last Modified time: 2016-02-20 10:23:43
*/

$(function() {
	$.ajaxSetup({
    		headers: {
    			'api_key': getCookie('openid')
    		}
	});
    	$.ajax({
            type: 'GET',
            url: 'http://120.27.194.121:8877/index.php/api/wx/1/user/check_balance'
        })
        .done(function(data) {
            console.log(data.msg);
            $(".main span").html(data.data);
        });
});