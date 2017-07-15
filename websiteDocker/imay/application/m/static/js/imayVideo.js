var imeiId = document.getElementById("videoPlayer");
var clientHeight = document.documentElement.clientHeight||document.body.clientHeight;
var clientWidth = document.documentElement.clientWidth||document.body.clientWidth;
var jsApiList = [
    'onMenuShareTimeline', //分享到朋友圈
    'onMenuShareAppMessage',//分享到朋友
    'onMenuShareQQ',//分享到QQ
    'onMenuShareQZone'//分享到QQ空间
];
function is_weixn(){
    var ua = navigator.userAgent.toLowerCase();
    if(navigator.userAgent.match(/MicroMessenger/i)){
        changeFloat();
    }
    if(navigator.userAgent.match(/QQ\//i)){
        changeFloat();
    }
    if(navigator.userAgent.match(/Weibo/i)) {
        changeFloat();
    }
}
function is_pc() {
    if ((navigator.userAgent.match(/(phone|pad|pod|iPhone|iPod|ios|iPad|Android|Mobile|BlackBerry|IEMobile|MQQBrowser|JUC|Fennec|wOSBrowser|BrowserNG|WebOS|Symbian|Windows Phone)/i))) {
    }
    else {
        $(".s-v-i img").css("width","100%");
        //changeFloat();
    }
}
function setIMayHeight(){
    $("#top").css("height",clientHeight);
    $("#videoPlayer").css("height",clientHeight);
    $(".s-v-bg").css("height",clientHeight);
    $(".s-v-bg").css("width",clientWidth);
}
function imeiPlay() {
    imeiId.play();
    is_weixn();

}
function changeFloat() {
    $(".play-btn").hide();
    $(".imvideo").show().addClass("im-show");
}
function closeMask() {
    $("#imay-mask").hide();
    $(".imei-shadow").css("z-index","10");
    $(".w-mes").css("z-index","9");
}
function openMask() {
    $("#imay-mask").show();
    $(".imei-shadow").css("z-index","16");
    $(".w-mes").css("z-index","17");
}

//是否打开app
function openApp(a) {
    var u = navigator.userAgent;
    var ua = window.navigator.userAgent.toLowerCase();
    var isAndroid = u.indexOf('Android') > -1 || u.indexOf('Linux') > -1; //android终端或者uc浏览器
    var isiOS = !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/); //ios终端
    if(isAndroid) {
        if(ua.match(/MicroMessenger/i) == 'micromessenger'){
            window.location = "http://a.app.qq.com/o/simple.jsp?pkgname=com.imay.live";
            return true;
        }if(ua.match(/QQ/i) == 'qq'){
            window.location = "http://a.app.qq.com/o/simple.jsp?pkgname=com.imay.live";
            return true;
        }if(ua.match(/WeiBo/i) == 'weibo'){
            openMask();
            return true;
        }else{
            window.setTimeout(function() {
                    window.location = "http://a.app.qq.com/o/simple.jsp?pkgname=com.imay.live";
                },
                2000);
            window.location=a;
            return false;
        }
    }
    if(isiOS){
        if(ua.match(/MicroMessenger/i) == 'micromessenger'){
            window.location = "http://a.app.qq.com/o/simple.jsp?pkgname=com.imay.live";
            return true;
        }if(ua.match(/MicroMessenger/i) == 'QQ'){
            window.location = "http://a.app.qq.com/o/simple.jsp?pkgname=com.imay.live";
            return true;
        }if(ua.match(/MicroMessenger/i) == 'weibo'){
            openMask();
            return true;
        }else{
            window.setTimeout(function() {
                    window.location = "https://itunes.apple.com/cn/app/imay-zhi-bo/id1144832626?mt=8";
                },
                2000);
            window.location=a;
            return false;
        }


    }

}
$(function(){
    setIMayHeight();
    is_pc();
    // $('.play-video').on('click',function () {
    //     imeiPlay();
    //     changeFloat();
    // });
    $("#imay-mask").on('click',function () {
        closeMask();
    });

    //微信QQ分享
    var params = {};
    params.url = location.href.split('#')[0];
    $.ajax({
        type   : 'POST',
        url    : wxURL,
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
        setShareUrl(nick,desc,url+val,imgURL);
    });
    wx.error(function (res) {
        // config信息验证失败会执行error函数，如签名过期导致验证失败，具体错误信息可以打开config的debug模式查看，也可以在返回的res参数中查看，对于SPA可以在这里更新签名。
        alert("网络繁忙，请重新打开页面~(jsapi)");
//            alert(JSON.stringify(res));
    });

});

//微信QQ分享
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

window.onload=function(){
    var img = new Image();
    img.src =$('.s-i-d').attr("src") ;
    var imgWidth = img.width;
    var imgHeight = img.height;
    if(imgWidth=imgHeight){
        $(".s-loadng").hide();
        $(".s-v-i").show();
        $(".s-v-bg").addClass("s-v-ver");
    }else {
        $(".s-loadng").hide();
        $(".s-v-i").show()
    }
}