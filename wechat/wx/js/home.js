/* 
 * @Author: Administrator
 * @Date:   2016-02-04 16:03:28
 * @Last Modified by:   Administrator
 * @Last Modified time: 2016-02-20 13:20:35
 */

$(function () {
    wx.config({
        debug: true, // 开启调试模式
        appId: '', // 必填，公众号的唯一标识
        timestamp: '', // 必填，生成签名的时间戳
        nonceStr: '', // 必填，生成签名的随机串
        signature: '',// 必填，签名，见附录1
        jsApiList: [] // 必填，需要使用的JS接口列表，所有JS接口列表见附录2
    });
    wx.ready(function () {
        wx.getLocation({
            type: 'wgs84', // 默认为wgs84的gps坐标，如果要返回直接给openLocation用的火星坐标，可传入'gcj02'
            success: function (res) {
                var latitude = res.latitude; // 纬度，浮点数，范围为90 ~ -90
                var longitude = res.longitude; // 经度，浮点数，范围为180 ~ -180。
                console.log(latitude + ', ' + longitude);
            }
        });
    });
    wx.error(function (res) {
        console.log(res);
    });
    //判断是否已登录
    $.ajax({
            type: 'GET',
            url: 'http://120.27.194.121:8877/index.php/api/wx/1/wechat/is_binded',
            data: {
                'openid': getCookie("openid")
            }
        })
        .done(function (data) {
            returnCode = data.data;
            if (returnCode) {
                $(".myInformation").attr("href", "myaccounted.html");
                $(".footer a").attr('href', 'tel:4000916960');
            } else {
                $(".myInformation").attr("href", "myaccount.html");
                $(".footer a").attr('href', 'bind.html ');
            }
        });

});
