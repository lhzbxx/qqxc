/* 
* @Author: Administrator
* @Date:   2016-02-04 22:37:10
* @Last Modified by:   Administrator
* @Last Modified time: 2016-02-20 10:20:49
*/

$(function() {
	$.ajaxSetup({
                headers: {
                    'api_key': '123',
                },
           });
    	$.ajax({
            type: 'GET',
            url: 'http://120.27.194.121/index.php/api/wx/1/coach/detail',
            data:{
                'coach_id':"coachid"
                //少coachId
            }

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
             $(".coachId").html(data.coach_id);
        });
        $.ajax({
            type: 'GET',
            url: 'http://120.27.194.121/index.php/api/wx/1/coach/photo',
            data:{
                'coach_id':"coachid"
            }

         })
        .done(function(data) {
            console.log(data.code);
            console.log(data.msg);
            console.log(data.data);
            
            
        });
});