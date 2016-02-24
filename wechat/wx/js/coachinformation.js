/* 
* @Author: zz
* @Date:   2016-01-25 15:26:14
* @Last Modified by:   Administrator
* @Last Modified time: 2016-02-13 10:13:46
*/

'use strict';
$(function() {
	var h = $(window).height();
	var scrollTop=$(window).scrollTop();
	h = h+scrollTop;
	$.ajaxSetup({
                headers: {
                    'api_key': '123',
                },
           });
    	$.ajax({
            type: 'GET',
            url: 'http://120.27.194.121/index.php/api/wx/1/coach/detail'

         })
        .done(function(data) {
            console.log(data.code);
            console.log(data.msg);
            console.log(data.data);
            var src = data.avatar;
            $(".inPic img").attr("src",src);
            $(".coachName").html(data.name);
            $(".coachage").html(data.exp);
            $(".inDistance").html(data.dist);
            $(".type span").html(data.type);
            $(".schoolName span").html(data.school);
            $(".address span").html(data.place);
        });
        $.ajax({
            type: 'GET',
            url: 'http://120.27.194.121/index.php/api/wx/1/coach/photo'

         })
        .done(function(data) {
            console.log(data.code);
            console.log(data.msg);
            console.log(data.data);
            
        });
        //点击提交评论
	$(".commnetBtn").click(function(event) {
		if ($("textarea").val()=="") {
			//评论为空时，弹出内容不能为空
			$(".clicktext1").css('height', h);
			$(".clicktext1").addClass('current');
			$("body,html").css({"overflow":"hidden"});
			//点击关闭按钮，回到评论页面
			$(".tip1 .close").click(function(event) {
				$(".clicktext1").removeClass('current');
				$("body,html").css({"overflow":"auto"});
			});
		} else{   

                                $.ajax({
                                    type: 'POST',
                                    url: 'http://120.27.194.121/index.php/api/wx/1/coach/comment'
                                    //上传评论内容
                                    //data:
                                 })
                                .done(function(data) {
                                    console.log(data.code);
                                    console.log(data.msg);
                                    console.log(data.data);
                                    
                                });
			$(".clicktext").css('height', h);
			$(".clicktext").addClass('current');
			//点击关闭按钮，跳转至首页
			$(".tip em").click(function(event) {
				$(".clicktext").removeClass('current');
				
			});
		};
	});
});