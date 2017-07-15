$(function () {
    //默认选中第一个充值价格
    $('.g-rc-ul li:first-child').addClass('tc-checked');
    $(".g-pay-b b").html($('.g-rc-ul li:first-child').find(".tc-m2 b").text());
    $(".mei").html($('.g-rc-ul li:first-child').find(".tc-m1 b").text());

    //选择充值魅钻切换时加上类名
    $(".g-rc-ul li").click(function () {
        $(".g-b-pay .rc-bg").removeClass("tc-checked");
        $(".g-pay-i").slideUp();
        $(".g-rc-ul li").removeClass("tc-checked");
        var index = $(".g-rc-ul li");
        var a, b;
        for( var i=0;i<index.length;i++){
            $(this).addClass("tc-checked");
            a = $(this).find(".tc-m2 b").text();
            b = $(this).find(".tc-m1 b").text();
            $(".g-pay-b b").html(a);
            $(".mei").html(b);
        }
    });

    //切换两个支付方式
    // $(".g-wechat").click(function () {
    //     $(this).addClass("wechat-ckecked");
    //     $(".g-alipay").removeClass("alipay-ckecked")
    // });
    // $(".g-alipay").click(function () {
    //     $(this).addClass("alipay-ckecked");
    //     $(".g-wechat").removeClass("wechat-ckecked")
    // });

    //关闭弹出框
    $(".pop-close").click(function () {
        $(this).parent().hide();
        $(".g-mask").hide();
    });

    //点击魅号充值弹出魅号充值框
    $(".imay-rc").click(function () {
        $(".g-rc-pop").show();
        $(".g-mask").show();
    });

    //自定义下拉框
    $(".pop-s-val input").focus(function () {
        $(".pop-sel").slideDown();
        $(".a-val-s").removeClass("a-val-up");
        $(this).parent().addClass("pop-info-check");
    });

    $(".pop-s-val input").keyup(function () {
        var a = $(this).val()
        var list = $(this).parent().parent().find(".pop-sel ul").children();
        for(var i=0;i<list.length;i++){
            var b=list[i].innerText
            if(b.eq(a)>0){
                alert("true")
            }
        }

    })

    $(".pop-sec-ul li").click(function () {
        $(".sc-val").val($(this).text());
        $(".sc-val").append("<b>"+$(this).attr('value')+"</b>");
        $(".pop-sel").slideUp();
        $(".a-val-s").addClass("a-val-up");
    });
    $(".pop-info input").focus(function () {
        $(".pop-info").removeClass("pop-info-check");
        $(this).parent().addClass("pop-info-check");
    }).blur(function () {
        $(this).parent().removeClass("pop-info-check");
    });

    $(".g-b-pay .rc-bg").click(function () {
        $(".g-rc-ul li").removeClass("tc-checked");
        $(this).addClass("tc-checked");
        $(this).parent().find(".g-pay-i").slideDown();
    });
    // $(".g-pay-d").keyup(function () {
    //     $(this).parent().parent().find(".rc-bg");
    // })


    //登录注册
    $(".pop-login").click(function () {
        $(".g-login-pop").show();
        $(".g-mask").show();
        $('.pop-l-l a').removeClass("pop-pouple");
        $('.h-l-r a').removeClass("pop-pouple");
        var a = $(this).attr("class");
        var b = a.replace(" pop-login","");
        if(b == "pop-reg-a"){
            $(".pop-reg-a").addClass("pop-pouple");
            $('.pop-tab-c:last-child').show();
            $('.pop-tab-c:first-child').hide();
        }else{
            $(".pop-reg-t").addClass("pop-pouple");
            $('.pop-tab-c:first-child').show();
            $('.pop-tab-c:last-child').hide();
        }
        $("body").bind("mousedown",onBodyDown);
    });

    $('.pop-l-l a').click(function () {
        $(".pop-sec-ul").hide();
        $('.pop-l-l a').removeClass("pop-pouple");
        $(this).addClass("pop-pouple");
        var index = $(this).parent().children().index($(this));
        var obj = $(this).parent().parent().find(".pop-l-r").children();
        obj.hide();
        obj.eq(index).show();
    });

    //忘记密码
    $('.p-f-pass').click(function () {
        $('.g-login-pop').hide();
        $('.forget-tab').show();
        $('.g-forgot-password').show();
    });

    //忘记密码登录注册按钮切换
    $('.pop-for-t').click(function () {
        $('.g-upload-pop').hide();
        $('.g-forgot-password').hide();
        $('.g-login-pop').show();
        $(".pop-reg-t").addClass("pop-pouple");
        $('.pop-tab-c:first-child').show();
        $('.pop-tab-c:last-child').hide();
    });
    $('.pop-for-a').click(function () {
        $('.g-upload-pop').hide();
        $('.g-forgot-password').hide();
        $(".pop-reg-a").addClass("pop-pouple");
        $('.pop-tab-c:last-child').show();
        $('.pop-tab-c:first-child').hide();
    });

    //$('.phone').val("输入手机号").addClass("p-i-no");
   // $(".password").attr("type","text").val("输入密码").addClass("p-i-no");

    //js验证input
    $(".pop-info input").focus(function () {
        // var a = $(this).attr("class").split(" ")[1];
        // if(a=="p-i-no"){
        //     $(this).val("").removeClass("p-i-no");
        // }
        if($(this).attr("class")=="password"){
            $(this).attr("type","password");
        }


    }).blur(function () {
        var a = $(this).val();
        if(a.length==0){
            $(this).parent().find(".info-mes").css("display","block");
        } else {
            $(this).parent().find(".info-mes").css("display","none");
        }
    });
    // $(".g-r-i").mouseover(function () {
    //     $(".i-exit").fadeIn()
    // })
    // $(".i-exit").mouseleave(function () {
    //     $(".i-exit").fadeOut()
    // });
    //首页动画

    $(window).scroll(function () {
        indexAni();
    });

    window.onload=function () {
        getInA();
    }
    $('.pop-tab-c:first-child').show();
    popClose(".imay-sw-ac",".g-rc-pop");
});

function indexAni() {
    var scrollTop = document.documentElement.scrollTop||document.body.scrollTop;
    var scrollTop = document.documentElement.scrollTop||document.body.scrollTop;
    if ((navigator.userAgent.match(/(phone|pad|pod|iPhone|iPod|ios|iPad|Android|Mobile|BlackBerry|IEMobile|MQQBrowser|JUC|Fennec|wOSBrowser|BrowserNG|WebOS|Symbian|Windows Phone)/i))) {
        if(scrollTop>200&&scrollTop<500){
            getInA();
        }
        if(scrollTop>600){
            getInB();
        }
    }
    else {
        if(scrollTop>700&&scrollTop<1200){
            getInA();
        }
        if(scrollTop>1600){
            getInB();
        }
    }
}


function getInA() {
    $(".i-t-i03").addClass("aniInLeft");
    $(".i-t-i03").css("display","block");
    $(".i-t-i04").addClass("twinkling3");
    $(".i-t-i04").css("display","block");
    $(".i-w-fly").css("display","block");
    $(".i-w-fly").addClass("flyIn");
}
function getInB() {
    $(".i-t-i06").css("display","block");
    $(".i-t-i05").addClass("i-scroll");
    $(".i-t-i06").addClass("aniInRight");
    $(".i-t-i08").addClass("twinkling");
    $(".i-t-i09").addClass("twinkling1");
    $(".i-t-i10").addClass("twinkling2");
    $(".i-t-i11").addClass("twinkling2");
}

function onBodyDown(event) {
    if (!( event.target.id == "secHide" || $(event.target).parents(".secHide").length > 0)) {
        $(".pop-sel").slideUp();
        $(".pop-info").removeClass("pop-info-check");
    }
}

function popClose(a,b) {
    //点击切换账号弹出魅号充值框
    $(a).click(function () {
        $(b).show();
        $(".g-mask").show();
    });
}