var jsApiList = [
    'onMenuShareTimeline', //分享到朋友圈
    'onMenuShareAppMessage',//分享到朋友
    'onMenuShareQQ',//分享到QQ
    'onMenuShareQZone'//分享到QQ空间
];
//微信分享
function getWXData(url,wxTitle,wxDetail,wxLink,wxImg) {
    //分享标题 wxTitle,分享描述 wxDetail,.分享链接 wxUrl,分享图标 wxImg
    var params = {};
    params.url = location.href.split('#')[0];
    $.ajax({
        type   : 'POST',
        url    : url,
        data   : params,
        success: function (data, textStatus) {
            if (data.errormsg) {
                //alert(data.errormsg);
                return;
            }
            // alert(JSON.stringify(data));
//                console.log(data);
            //这里的配置见jsapi_ticket机制
            wx.config({
//                    debug    : true, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
                appId    : data.appId, // 必填，公众号的唯一标识
                nonceStr : data.nonceStr, // 必填，生成签名的随机串
                timestamp: data.timestamp, // 必填，生成签名的时间戳
                signature: data.signature,// 必填，签名，见附录1
                jsApiList: jsApiList // 必填，需要使用的JS接口列表
            });

        }
    });
    wx.ready(function () {
        wx.checkJsApi({
            jsApiList: jsApiList,
            success  : function (res) {
                // alert(JSON.stringify(res));
                console.log(res);
            }
        });
        setShareUrl(wxTitle,wxDetail,wxLink,wxImg);
    });
    wx.error(function (res) {
        // config信息验证失败会执行error函数，如签名过期导致验证失败，具体错误信息可以打开config的debug模式查看，也可以在返回的res参数中查看，对于SPA可以在这里更新签名。
        // alert("网络繁忙，请重新打开页面~(jsapi)");
        //    alert(JSON.stringify(res));
    });
}
//微信分享
function setShareUrl(title, desc, link, imgUrl) {
    //获取“分享到朋友圈”按钮点击状态及自定义分享内容接口
    wx.onMenuShareTimeline({
        title  : title,
        link   : link,
        imgUrl : imgUrl,
        trigger: function (res) {
            // 不要尝试在trigger中使用ajax异步请求修改本次分享的内容，因为客户端分享操作是一个同步操作，这时候使用ajax的回包会还没有返回
//                alert('用户点击分享到朋友圈');
        },
        success: function (res) {
//                alert('分享成功');
            incrShareNum(2, link);
        },
        cancel : function (res) {
//                alert('已取消');
        },
        fail   : function (res) {
            alert(JSON.stringify(res));
        }
    });
    //获取“分享给朋友”按钮点击状态及自定义分享内容接口
    wx.onMenuShareAppMessage({
        title  : title, // 分享标题
        desc   : desc, // 分享描述
        link   : link, // 分享链接
        imgUrl : imgUrl, // 分享图标
        type   : 'link', // 分享类型,music、video或link，不填默认为link
        dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
        success: function () {
            // 用户确认分享后执行的回调函数
//                alert("分享成功");
            incrShareNum(1, link);
        },
        cancel : function () {
            // 用户取消分享后执行的回调函数
        }
    });
    //获取“分享到QQ”按钮点击状态及自定义分享内容接口
    wx.onMenuShareQQ({
        title  : title, // 分享标题
        desc   : desc, // 分享描述
        link   : link, // 分享链接
        imgUrl : imgUrl, // 分享图标
        success: function () {
            // 用户确认分享后执行的回调函数
//                alert("分享成功");
            incrShareNum(3, link);
        },
        cancel : function () {
            // 用户取消分享后执行的回调函数
        }
    });
    //获取“分享到腾讯微博”按钮点击状态及自定义分享内容接口
    wx.onMenuShareWeibo({
        title  : title, // 分享标题
        desc   : desc, // 分享描述
        link   : link, // 分享链接
        imgUrl : imgUrl, // 分享图标
        success: function () {
            // 用户确认分享后执行的回调函数
//                alert("分享成功");
            incrShareNum(4, link);
        },
        cancel : function () {
            // 用户取消分享后执行的回调函数
        }
    });
    //获取“分享到QQ空间”按钮点击状态及自定义分享内容接口
    wx.onMenuShareQZone({
        title  : title, // 分享标题
        desc   : desc, // 分享描述
        link   : link, // 分享链接
        imgUrl : imgUrl, // 分享图标
        success: function () {
            // 用户确认分享后执行的回调函数
//                alert("分享成功");
            incrShareNum(5, link);
        },
        cancel : function () {
            // 用户取消分享后执行的回调函数
        }
    });
}
//是否打开app
function openApp(a) {
    var u = navigator.userAgent;
    var ua = window.navigator.userAgent.toLowerCase();
    var isAndroid = u.indexOf('Android') > -1 || u.indexOf('Linux') > -1; //android终端或者uc浏览器
    var isiOS = !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/); //ios终端
    if(isAndroid) {
        if(ua.match(/MicroMessenger/i) == 'micromessenger'){
            window.location = "http://a.app.qq.com/o/simple.jsp?pkgname=com.imay.live&android_schema="+a;
            return true;
        }if(ua.match(/QQ/i) == 'qq'){
            window.location = "http://a.app.qq.com/o/simple.jsp?pkgname=com.imay.live&android_schema="+a;
            return true;
        }if(ua.match(/WeiBo/i) == 'weibo'){
            openMask();
            return true;
        }else{
            window.setTimeout(function() {
                window.location = "http://m.imay.com";
            },2000);
            window.location=a;
            return false;
        }
    }
    if(isiOS){
        if(ua.match(/MicroMessenger/i) == 'micromessenger'){
            openMask();
            window.location=a;
            return true;
        }if(ua.match(/QQ/i) == 'qq'){
            openMask();
            window.location=a;
            return true;
        }if(ua.match(/WeiBo/i) == 'weibo'){
            openMask();
            window.location=a;
            return true;
        }else{
            window.setTimeout(function() {
                    window.location = "https://itunes.apple.com/cn/app/imaylive/id1198166301?mt=8";
                },
                2000);
            window.location=a;
            return false;
        }
    }
}
function setImg(a,b,c ) {
    //a img类名
    //b 背景图片地址
    //c
    window.onload=function(){
        var img = new Image();
        img.src =$(a).attr("src") ;
        var imgWidth = img.width;
        var imgHeight = img.height;
        if(imgWidth=imgHeight||imgWidth>imgHeight){
            $(".z-loading").hide();
            $(c).show().attr("style",b).css("background-position"," 50% 0");
            $(".z-play").show();
        }else {
            $(c).show().attr("style",b);
        }
    }
}
function closeMask() {
    $(".z-wechat-mes").hide();
}
function openMask() {
    $(".z-wechat-mes").show();
}
$(function () {
    $(".z-wechat-mes").click(function () {
        closeMask();
    })
})