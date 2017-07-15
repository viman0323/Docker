$(function () {
    $(".tx-but-y").on("touchstart", function () {
        $(".tx-pop").show();
    });

    //实名验证
    $("#noRealName").on("click", function () {
        $(".g-mask").show();
        $("#realName").show();
    });

    //未绑定
    $("#noBound").on("click", function () {
        $(".g-mask").show();
        $("#bound").show();
    });
    //结算方式
    $("#noSettle").on("click",function () {
        $(".g-mask").show();
        $("#settle").show();
    });

    $(".m-pay-ul1 li").on("touchstart", function () {
        var c = $(".m-z-bg").attr("style");
        //var d = $(".m-z-t1 .tc-m2").find("b").html();
        if(c == undefined || c =="display: block;"){
            $(".m-z-t2").slideUp();
        }
        var a = $(this).attr("class");
        if (a != "m-li-check") {
            $(".m-pay-z").removeClass("m-li-check");
            $(".m-li-i3").attr("src",ThinkPHP.IMG + "/pay01.png");
            $(".m-pay-ul1 li").removeClass("m-li-check");
            $(".m-pay-ul1 li").find(".m-li-i2").attr("src", ThinkPHP.IMG + "/pay01.png");
            $(this).find(".m-li-i2").attr("src", ThinkPHP.IMG + "/pay02.png");
            $(this).addClass("m-li-check");
        }
    })

    $(".m-pay-z").on("touchstart",function () {
        var a = $(this).attr("class");
        if(a!="m-li-check"){
            $(".m-pay-ul1 li").removeClass("m-li-check");
            $(".m-pay-ul1 li").find(".m-li-i2").attr("src",ThinkPHP.IMG+"/pay01.png");
            $(this).find(".m-li-i3").attr("src",ThinkPHP.IMG+"/pay02.png");
            $(this).addClass("m-li-check");
            $(".m-z-t2").slideDown();
        }
    });


    $(".m-pay-card .m-card-wechat").on("touchstart", function () {
        var a        = $(this).children().children().find("img").attr("src");
        var index    = $(this).parent().children().index($(this));
        var obj      = $(this).parent().find(".m-card-wechat").children();
        var checkObj = $(this).parent().children();
        var b = $(this).children().find("img").attr("src");
        $(".m-pay-card .m-card-wechat").attr("id", "");
        if (a == ThinkPHP.IMG + "/w-icon02.png") {
            obj.children().children().attr("src", ThinkPHP.IMG + "/w-icon02.png");
            obj.eq(index).children().children().attr("src", ThinkPHP.IMG + "/w-icon01.png");
            checkObj.eq(index).attr("id", "linkChecked");
        }
        if(b==ThinkPHP.IMG +"/wechat01.jpg"){
            var ua = navigator.userAgent.toLowerCase();
            if (ua.match(/MicroMessenger/i) == "micromessenger") {
                $(".m-card-mes").slideUp();
                return true;
            } else {
                $(".m-card-mes").slideDown();
                return false;
            }
        }else {
            $(".m-card-mes").slideUp();
        }


    });
    $(".m-wechat-mes").on("click", function () {
        $(".m-wechat-mes").hide();
        $(".g-mask").hide();
    });

    $(".m-i-a").on("touchstart", function () {
        is_pc();
        isIos();
    });
    closePop(".pop-c-d");
    closePop(".m-r-but");
    closePop(".mes-close");
})

//关闭弹出框
function closePop(a) {
    $(a).on("click", function () {
        $(this).parent().hide();
        $(".g-mask").hide();
    });
}


//判断是否为pc
function is_pc() {
    if ((navigator.userAgent.match(/(phone|pad|pod|iPhone|iPod|ios|iPad|Android|Mobile|BlackBerry|IEMobile|MQQBrowser|JUC|Fennec|wOSBrowser|BrowserNG|WebOS|Symbian|Windows Phone)/i))) {
    }
    else {
        //pc地址
        //window.location.href=""
    }
}
//判断是否为微信
function is_weixn() {
    var ua = navigator.userAgent.toLowerCase();
    if (ua.match(/MicroMessenger/i) == "micromessenger") {
        $(".m-wechat-mes").show();
        $(".g-mask").show();
        return true;
    } else {
        $(".m-wechat-mes").hide();
        $(".g-mask").hide();
        return false;
    }
}

function isIos() {
    var ua = navigator.userAgent.toLowerCase();
    if (/iphone|ipad|ipod/.test(ua)) {
        //ios
        //window.location.href=""
    } else if (/android/.test(ua)) {
        //  android
        window.location.href = "http://img.imay.com/imay_live.apk";
    }
}
function openMask() {
    $(".m-wechat-mes").show();
    $("#iMask").show();
}
function closeMask() {
    $(".m-wechat-mes").hide();
    $("#iMask").hide();
}

//是否打开QQ
function openAQQ(a) {
    var u = navigator.userAgent;
    var ua = window.navigator.userAgent.toLowerCase();
    var isAndroid = u.indexOf('Android') > -1 || u.indexOf('Linux') > -1; //android终端或者uc浏览器
    var isiOS = !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/); //ios终端
    if(isAndroid) {
        window.open(a);
    }
    if(isiOS){
        if(ua.match(/MicroMessenger/i) == 'micromessenger'){
            openMask();
            return true;
        }if(ua.match(/QQ/i) == 'qq'){
            window.open(a);
            return true;
        }if(ua.match(/WeiBo/i) == 'weibo'){
            openMask();
            return true;
        }else{
            window.open(a);
            return false;
        }
    }else{
        window.open(a);
    }
}