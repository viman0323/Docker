$(function () {
    //默认选中第一个充值价格
    // $('.g-rc-ul li:first-child').addClass('tc-checked');
    // $(".g-pay-b b").html($('.g-rc-ul li:first-child').find(".tc-m2 b").text());
    // $(".mei").html($('.g-rc-ul li:first-child').find(".tc-m1 b").text());

    //选择充值魅钻切换时加上类名
    $(".g-rc-ul li").click(function () {
        var c = $(".g-b-pay .rc-bg").find("span:first-child").attr("style");
        if(c == undefined || c =="display: block;"){
            $(".g-pay-i").slideUp();
        }
        $(".g-b-pay .rc-bg").removeClass("tc-checked");
        $(".g-rc-ul li").removeClass("tc-checked");
        $(".g-b-pay .rc-bg .tc-m2").find('font').attr('color', '#f85858');
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

    // 大额充值金额
    $('.g-pay-d').keyup(function () {
        var money = $(this).val();
        if (money >200000) {
            money = 200000;
            $("input[name='money']").val(money);
        }
        if (money < 1) {
            money = 0;
            $("input[name='money']").val("");
        }
        if (money > 0) { //当大额充值金额大于0的时候，将金额和魅钻显示在金额魅钻框和支付金额中
            $(this).parents().parent('.g-b-pay').find('.tc-m2').html("<font color='#f85858'>" + '￥' + money + "</font>");
            $(this).parents().parent('.g-b-pay').find('.tc-m1').html(money * 10 + ' 钻');
            $(this).parents().parent('.g-b-pay').find('.tip-message').hide();
            $(".g-pay-b b").html(money);
            $(".mei").html(money*10);
        } else { // 当大额充值金额为空时，删除金额和魅钻在金额魅钻框和支付金额中的显示
            $(this).parents().parent('.g-b-pay').find('.tc-m2').html("");
            $(this).parents().parent('.g-b-pay').find('.tc-m1').html("");
            $(this).parents().parent('.g-b-pay').find('.tip-message').css("display","block");
            $(".g-pay-b b").html('');
            $(".mei").html('');
        }

    });

    //大额支付
    $(".g-b-pay .rc-bg").click(function () {
        $(".g-rc-ul li").removeClass("tc-checked");
        $(this).addClass("tc-checked");
        $(this).parent().find(".g-pay-i").slideDown();
        var money = $('.g-pay-d').val();
        $(".g-pay-b b").html(money);
        $(".mei").html(money*10);
        $(".g-b-pay .rc-bg .tc-m2").find('font').attr('color', '#f8f658');
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

    //切换两个支付方式选择单选
    // $("#weChat").click(function () {
    //     $('.g-wechat').addClass("wechat-ckecked");
    //     $(".g-alipay").removeClass("alipay-ckecked")
    // });
    // $("#aliPay").click(function () {
    //     $('.g-alipay').addClass("alipay-ckecked");
    //     $(".g-wechat").removeClass("wechat-ckecked")
    // });
    $(".g-alipay").parent().find(".pay-ckecked").show();
    $(".g-alipay").parent().attr("id", "linkChecked").addClass("pay-default");
    $(".g-pay-set .pay-t-c").click(function () {
        $(".g-pay-set .pay-t-c").removeClass("pay-default");
        $(this).addClass("pay-default");
        $(".g-pay-set .pay-t-c").attr("id", "");
        $(".g-bank-ul li").attr("id", "");
        $(".pay-ckecked").hide();
        $(".g-bank-check").hide();
        $(this).find(".pay-ckecked").show();
        $(this).attr("id", "linkChecked");
    });
    
    //银行选中
    $(".g-bank-ul li").click(function () {
        $(".g-pay-set .pay-t-c").removeClass("pay-default");
        $(".pay-ckecked").hide();
        $(".g-bank-check").hide();
        $(".g-pay-set .pay-t-c").attr("id", "");
        $(".g-bank-ul li").attr("id", "");
        $(this).find(".g-bank-check").show();
        $(this).attr("id", "linkChecked");
    });
    
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

    // //自定义下拉框
    // $(".pop-s-val input").focus(function () {
    //     $(".pop-sel").slideDown();
    //     $(".a-val-s").removeClass("a-val-up");
    //     $(this).parent().addClass("pop-info-check");
    // });
    // $(".pop-sec-ul li").click(function () {
    //     $(".sc-val").val($(this).text()+$(this).attr('value'));
    //     $(".pop-sel").slideUp();
    //     $(".a-val-s").addClass("a-val-up");
    // });
    // $(".pop-info input").focus(function () {
    //     $(".pop-info").removeClass("pop-info-check");
    //     $(this).parent().addClass("pop-info-check");
    // }).blur(function () {
    //     $(this).parent().removeClass("pop-info-check");
    // });

    $('.pop-l-l a').click(function () {
        $(".pop-sec-ul").hide();
        $('.pop-l-l a').removeClass("pop-pouple");
        $(this).addClass("pop-pouple");
        var index = $(this).parent().children().index($(this));
        var obj = $(this).parent().parent().find(".pop-l-r").children();
        obj.hide();
        obj.eq(index).show();
    });
    //
    // // 国家手机区号搜索
    // $(".sc-val").keyup(function (e) {
    //     var  time = 1000;
    //     var value = $(this).val();
    //     var i = 0;
    //     if (i < 1) {
    //         pinyinOption(value, time);
    //         i++;
    //     }
    // });
    //
    // // 点击的时候国家手机区号搜索
    // $(".sc-val").click(function (e) {
    //     var  time = 0;
    //     var value = $(this).val();
    //     pinyinOption(value, time);
    // });

    //登录注册
    $(".pop-login").click(function () {
        $(".g-login-pop").show();
        $(".g-mask").show();
        $('.pop-l-l a').removeClass("pop-pouple");
        $('.h-l-r a').removeClass("pop-pouple");
        var a = $(this).attr("class");
        var b = a.replace(" pop-login","");
        if(b == "pop-reg-a"){
            $(".register-sc").val('中国86');
            $(".pop-reg-a").addClass("pop-pouple");
            $('.pop-tab-c:last-child').show();
            $('.pop-tab-c:first-child').hide();
            $(".pop-sec-ul").css('display', 'block');
        }else{
            $(".login-sc").val('中国86');
            $(".pop-reg-t").addClass("pop-pouple");
            $('.pop-tab-c:first-child').show();
            $('.pop-tab-c:last-child').hide();
            $(".pop-sec-ul").css('display', 'block');
        }
        $("body").bind("mousedown",onBodyDown);
    });

    //忘记密码
    $('.p-f-pass').click(function () {
        $(".forget-sc").val('中国86');
        $('.g-login-pop').hide();
        $('.forget-tab').show();
        $('.g-forgot-password').show();
    });

    //忘记密码登录注册按钮切换
    $('.pop-for-t').click(function () {
        $(".login-sc").val('中国86');
        $('.g-upload-pop').hide();
        $('.g-forgot-password').hide();
        $('.g-login-pop').show();
        $(".pop-reg-t").addClass("pop-pouple");
        $('.pop-tab-c:first-child').show();
        $('.pop-tab-c:last-child').hide();
    });
    $('.pop-for-a').click(function () {
        $(".register-sc").val('中国86');
        $('.g-upload-pop').hide();
        $('.g-forgot-password').hide();
        $(".pop-reg-a").addClass("pop-pouple");
        $('.pop-tab-c:last-child').show();
        $('.pop-tab-c:first-child').hide();
    });

   // $('.phone').val("输入手机号").addClass("p-i-no");
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
    
    //tab切换
    $(".charm-table tr:even").css("background-color", "#f7f7f7");
    $(".art-tri-table tr:even").css("background-color", "#f7f7f7");
    $(".tab-tri-ul li").on("click", function () {
        var index = $(this).parent().children().index($(this));
        var obj   = $(this).parent().parent().parent().find(".art-tri-con").children();
        $(".tab-tri-ul li").removeClass("tri-default");
        $(this).addClass("tri-default");
        obj.hide();
        obj.eq(index).show();
        $(".art-tri-table tr:even").css("background-color", "#f7f7f7");
    })
});

function indexAni() {
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

// 输入数据一秒后请求搜索值
function pinyinOption(value, time) {
    var t = setTimeout(function () {
        $.post(phoneCode, {'value': value}, function (data) {
            if (data) {
                $(".pop-sel").show();
                var page_html = '';
                for (var i = 0; i < data.length; i++) {
                    page_html += '<li value="' + data[i]['phone_code'] + '">';
                    page_html += data[i]['country'];
                    page_html += "</li>";
                }
                $(".pop-sec-ul").html(page_html);
                phoneChoose();
            }
        }, 'json');
    }, time);
}

// 下拉框数据选择
function phoneChoose() {
    $(".pop-sec-ul li").click(function () {
        $(".sc-val").val($(this).text()+$(this).attr('value'));
        $(".pop-sel").slideUp();
        $(".a-val-s").addClass("a-val-up");
    });
}
