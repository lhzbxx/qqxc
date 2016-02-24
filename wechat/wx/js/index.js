/* 
* @Author: Administrator
* @Date:   2016-02-19 10:20:58
* @Last Modified by:   Administrator
* @Last Modified time: 2016-02-20 10:33:18
*/

$(function() {

    var myOpenid= $.cookie("openid");
    if (myOpenid == null) {
        // 没有openid，跳转至outh.html
        window.location.href="../../html/outh.html";
        alert("openid为空");
    } else {
        // 上传openid
        window.location.href="../../html/home.html";
    }
	
});

/*$.cookie('the_cookie'); // 读取 cookie
	$.cookie('the_cookie', 'the_value'); // 存储 cookie 
	$.cookie('the_cookie', 'the_value', { expires: 7 }); // 存储一个带7天期限的 cookie 
	$.cookie('the_cookie', '', { expires: -1 }); // 删除 cookie*/
