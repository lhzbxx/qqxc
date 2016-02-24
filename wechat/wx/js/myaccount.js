/* 
* @Author: Administrator
* @Date:   2016-01-30 13:13:36
* @Last Modified by:   Administrator
* @Last Modified time: 2016-02-13 09:30:16
*/

$(function() {

	var h = $(window).height();
	$(".clickbg").css('height', h);
	$(".list1 a").click(function(event) {
		$(".clickbg").addClass('current');
	});
	$(".suggestion a").click(function(event) {
		$(".clickbg").addClass('current');
	});
	$(".quit").click(function(event) {
		$(".clickbg").removeClass('current');
	});
});