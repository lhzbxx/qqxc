/* 
* @Author: Administrator
* @Date:   2016-02-06 01:50:13
* @Last Modified by:   Administrator
* @Last Modified time: 2016-02-20 10:23:43
*/

$(function() {
	$.ajaxSetup({
    		headers: {
    			'api_key': '123',
    		},
	});
    	$.ajax({
            type: 'GET',
            url: 'http://120.27.194.121/index.php/api/wx/1/account/check_balance',
            data:{
                'api_key': '123'
            }
        })
        .done(function(data) {
            console.log(data.code);
            console.log(data.msg);
            console.log(data.data);
            $(".main span").html(data.data);
        });
});