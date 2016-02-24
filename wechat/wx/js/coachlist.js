/* 
* @Author: zz
* @Date:   2016-01-23 13:47:43
* @Last Modified by:   Administrator
* @Last Modified time: 2016-02-13 14:48:27
*/


$(function() {
	var h = $(window).height();
	$(".intelligent").click(function(event) {
		$(".orderList ").toggleClass('current');
		/*$(".orderList ").toggle();*/
		$(".clickbg ").css("height",h);
		$(".clickbg ").toggleClass('bgin');
	});
	$(".orderList").click(function(event) {
		$(".orderList ").toggleClass('current');
		/*$(".orderList ").toggle();*/
		$(".clickbg ").css("height",h);
		$(".clickbg ").toggleClass('bgin');
	});
});	