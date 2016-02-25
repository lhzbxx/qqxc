/* 
 * @Author: Administrator
 * @Date:   2016-02-04 16:03:28
 * @Last Modified by:   Administrator
 * @Last Modified time: 2016-02-20 13:20:35
 */

$(function () {
    if (!getCookie('city')) {
        var h = $(window).height();
        $(".clicktext1").css('height', h);
        $(".clicktext1").addClass('current');
    }
    $.ajax({
            type: 'GET',
            url: 'http://120.27.194.121:8877/index.php/api/wx/1/wechat/config',
            data: {
                'url': window.location.href
            }
        })
        .done(function (r) {
            console.log(window.location.href);
            wx.config({
                debug: false, // 开启调试模式
                appId: 'wx96e6b1df252e6b82', // 必填，公众号的唯一标识
                timestamp: r.data.timestamp, // 必填，生成签名的时间戳
                nonceStr: r.data.noncestr, // 必填，生成签名的随机串
                signature: r.data.signature, // 必填，签名，见附录1
                jsApiList: ['getLocation'] // 必填，需要使用的JS接口列表，所有JS接口列表见附录2
            });
        });
    wx.ready(function () {
        if (!getCookie('city')) {
            wx.getLocation({
                type: 'wgs84', // 默认为wgs84的gps坐标，如果要返回直接给openLocation用的火星坐标，可传入'gcj02'
                success: function (res) {
                    var latitude = res.latitude; // 纬度，浮点数，范围为90 ~ -90
                    var longitude = res.longitude; // 经度，浮点数，范围为180 ~ -180。
                    setCookie('lat', latitude, 1);
                    setCookie('lng', longitude, 1);
                    console.log(latitude + ', ' + longitude);
                    $.ajax({
                            type: 'GET',
                            url: 'http://120.27.194.121:8877/index.php/api/wx/1/wechat/city',
                            data: {
                                'lat': latitude,
                                'lng': longitude
                            }
                        })
                        .done(function (r) {
                            console.log(r.data);
                            //弹出提示定位为止
                            setCookie('city', r.data, 1);
                            $(".tip1 p").text(r.data);
                            //点击关闭按钮
                            $(".tip1 .close").click(function (event) {
                                $(".clicktext1").removeClass('current');
                            });
                        });
                },
                fail: function (res) {
                    alert(res.errMsg);
                }
            });
        }
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
    $(".tip1 .close").click(function (event) {
        $(".clicktext1").removeClass('current');
    });
    $('.position').click(function () {
        var h = $(window).height();
        if (getCookie('lat') && getCookie('lng')) {
            if (!getCookie('city')) {
                $.ajax({
                        type: 'GET',
                        url: 'http://120.27.194.121:8877/index.php/api/wx/1/wechat/city',
                        data: {
                            'lat': getCookie('lat'),
                            'lng': getCookie('lng')
                        }
                    })
                    .done(function (r) {
                        console.log(r.data);
                        setCookie('city', r.data, 1);
                        //弹出提示定位为止
                        $(".tip1 p").text(r.data);
                        $(".clicktext1").css('height', h);
                        $(".clicktext1").addClass('current');
                        //点击关闭按钮
                    });
            }
            else {
                $(".tip1 p").text(getCookie('city'));
                $(".clicktext1").css('height', h);
                $(".clicktext1").addClass('current');
            }
        }
        else {
            wx.getLocation({
                type: 'wgs84', // 默认为wgs84的gps坐标，如果要返回直接给openLocation用的火星坐标，可传入'gcj02'
                success: function (res) {
                    var latitude = res.latitude; // 纬度，浮点数，范围为90 ~ -90
                    var longitude = res.longitude; // 经度，浮点数，范围为180 ~ -180。
                    setCookie('lat', latitude, 1);
                    setCookie('lng', longitude, 1);
                    console.log(latitude + ', ' + longitude);
                    $.ajax({
                            type: 'GET',
                            url: 'http://120.27.194.121:8877/index.php/api/wx/1/wechat/city',
                            data: {
                                'lat': latitude,
                                'lng': longitude
                            }
                        })
                        .done(function (r) {
                            console.log(r.data);
                            //弹出提示定位为止
                            setCookie('city', r.data, 1);
                            $(".tip1 p").text(r.data);
                            $(".clicktext1").css('height', h);
                            $(".clicktext1").addClass('current');
                            //点击关闭按钮
                            $(".tip1 .close").click(function (event) {
                                $(".clicktext1").removeClass('current');
                            });
                        });
                },
                fail: function (res) {
                    alert(res.errMsg);
                }
            });
        }
    });
});
