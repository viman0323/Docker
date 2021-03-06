<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:61:"/home/web/imay/application/m/view/login/toForgetPassword.html";i:1489720529;s:64:"/home/web/imay/application/m/view/statistics/baiduStatistcs.html";i:1486463787;}*/ ?>
<!DOCTYPE html>
<html lang="zh_CN">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>找回密码</title>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
    <meta content="telephone=no" name="format-detection">
    <meta name="viewport"
          content="width=device-width,initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no"/>
    <link type="text/css" rel="stylesheet" href="__CSS__/m-common.css">
    <link type="text/css" rel="stylesheet" href="__CSS__/m-default.css">
</head>
<body id="m-login">
<header>
    <h2 class="m-way-h2">短信验证码</h2>
</header>
<article>
    <section>
        <div class="m-c-way">
            <ul>
                <li>
                    <input name="phone" type="tel" class="m-w-i m-w-d" placeholder="输入手机号" maxlength=11 onkeypress="return WST.isNumberKey(event)">
                    <a class="m-h-y" id="get_verification_code">获取验证码</a>
                    <b class="m-h-t">2s</b>
                </li>
                <li>
                    <input name="phone_code" type="tel" class="m-w-i" placeholder="输入验证码" maxlength=6 onkeypress="return WST.isNumberKey(event)">
                </li>
                <li>
                    <input name="password" type="password" class="m-w-i" placeholder="输入登录密码" maxlength=20>
                </li>
                <div class="tx-but">
                    <a class="tx-but-a" id="btn-login">提交</a>
                </div>
            </ul>
        </div>
    </section>
</article>
</body>
<script type="text/javascript" src="__JS__/jquery.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/common.js"></script>
<script type="text/javascript" src="__PUBLIC__/plugins/plugins.js"></script>
<script>
    var getCode = false;
    /**
     * 倒计时
     * @param btn
     */
    function countDown(btn, sec) {
        var timeShow = $(btn).siblings("b");
        if (sec === 0) {
            timeShow.removeClass("m-h-y").hide().siblings("a").addClass("m-h-y").show();
        } else {
            timeShow.html(sec + "s");
            sec--;
            setTimeout(function () {
                countDown(btn, sec);
            }, 1000);
        }
    }
    function checkLoginBtn() {
        if ($('input[name="phone_code"]').val() != "" && $('input[name="password"]').val() != "" && getCode) {
            $("#btn-login").addClass("tx-but-y");
        } else {
            $("#btn-login").removeClass("tx-but-y");
        }
    }
    function btnVerificationCodeCallBack() {
        var phone = $('input[name="phone"]').val();
        
        if (phone.length < 11) {
            alert("请输入11位数的手机号码");
        }
        
        if (phone != "" && phone.length == 11) {
            var params = {
                type : 2,
                phone: phone
            };
            var _this  = this;
            $.ajax({
                type   : "POST",
                url    : "<?php echo url('login/wapVerificationCode'); ?>",
                data   : params,
                success: function (data, textStatus) {
                    var json = WST.toJson(data);
                    console.log(json);
                    if (json.errorcode == undefined) {
                        alert("发送成功!");
                        $(_this).removeClass("m-h-y").hide().siblings("b").addClass("m-h-y").show();
                        countDown(_this, 60);
                        getCode = true;
                    } else {
                        getCode = true;
                        if (json.errordesc) {
                            alert("发送失败," + WST.getErrorMsg(json.errordesc));
                        } else {
                            alert("发送失败");
                        }
                    }
                }
            });
        } else {
            //do nothing;
        }
    }
    
    function btnLoginCallBack() {
        if (!$(this).hasClass("tx-but-y")) {
            return;
        }
        var params = {
            phone     : $('input[name="phone"]').val(),
            phone_code: $('input[name="phone_code"]').val(),
            password  : $('input[name="password"]').val(),
        };
        $.post("<?php echo url('login/wapForgetPassword'); ?>", params, function (data, textStatus) {
            var json = WST.toJson(data);
            console.log(json);
            if (json.status == '1') {
                location.href = '<?php echo url("login/toLoginPhone"); ?>';
            } else {
                if (json.errordesc) {
                    alert("修改失败," + WST.getErrorMsg(json.errordesc));
                } else {
                    alert("修改失败");
                }
            }
        });
    }
    
    $(function () {
        $('input[name="phone_code"]').on("input valuechange", checkLoginBtn);
        $('input[name="password"]').on("input valuechange", checkLoginBtn);
        
        //获取验证码
        $('#get_verification_code').click(WST.throttle(btnVerificationCodeCallBack, 800))
        //登录
        $("#btn-login").click(WST.throttle(btnLoginCallBack, 800));
    });
</script>
<script type="text/javascript">
    $(function () {
        var _hmt = _hmt || [];
        $(function () {
            var hm = document.createElement("script");
            hm.src = "//hm.baidu.com/hm.js?92271316ab45db908e0b6763467fea57";
            var s  = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(hm, s);
        });
    })
</script>
</html>