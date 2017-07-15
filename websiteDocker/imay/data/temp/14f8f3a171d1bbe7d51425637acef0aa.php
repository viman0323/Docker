<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:57:"/home/web/imay/application/m/view/login/toLoginPhone.html";i:1489659878;s:64:"/home/web/imay/application/m/view/statistics/baiduStatistcs.html";i:1486463787;}*/ ?>
<!DOCTYPE html>
<html lang="zh_CN">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>iMay直播，可以玩的直播！</title>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
    <meta content="telephone=no" name="format-detection">
    <meta name="viewport"
          content="width=device-width,initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no"/>
    <link type="text/css" rel="stylesheet" href="__CSS__/m-common.css">
    <link type="text/css" rel="stylesheet" href="__CSS__/m-default.css">
</head>
<body id="m-login">
<header>
    <h2 class="m-way-h2">手机密码登录</h2>
</header>
<article>
    <section>
        <div class="m-c-way">
            <ul>
                <li>
                    <input name="phone" type="tel" class="m-w-i" placeholder="输入手机号" maxlength="11"
                           onkeypress="return WST.isNumberKey(event)">
                </li>
                <li>
                    <input name="password" type="password" class="m-w-i" placeholder="输入登录密码" maxlength="20">
                </li>
                <li>
                    <a class="m-w-f" href="<?php echo url('login/toForgetPassword'); ?>">忘记密码？</a>
                </li>
                <div class="tx-but">
                    <a class="tx-but-a" id="btn-login">登录</a>
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
    function checkLoginBtn() {
        if ($('input[name="phone"]').val().length === 11 && $('input[name="password"]').val() != "") {
            $("#btn-login").addClass("tx-but-y");
        } else {
            $("#btn-login").removeClass("tx-but-y");
        }
    }
    function ff() {
        console.log(arguments);
//        alert($(this).html());
    }
    function btnLoginCallBack() {
        if (!$(this).hasClass("tx-but-y")) {
            return;
        }
        var params = {
            phone   : $('input[name="phone"]').val(),
            password: $('input[name="password"]').val(),
        };
        $.ajax({
            type   : 'POST',
            url    : '<?php echo url("login/wapLoginByPhone"); ?>',
            data   : params,
            success: function (data, textStatus) {
//                    console.log(data);
                if (data) {
                    var json = WST.toJson(data);
                    if (json.status == 1) {
                        location.href = "<?php echo url('withdraw/index'); ?>";
                    } else {
                        if (json.errordesc) {
                            alert("登录失败," + WST.getErrorMsg(json.errordesc));
                        } else {
                            alert("登录失败");
                        }
                    }
                }
            },
            error  : function () {
                alert("网络出现问题了~");
            }
        });
    }
    
    $(function () {
        checkLoginBtn();
        $('input[name="phone"]').on("input valuechange", checkLoginBtn);
        $('input[name="password"]').on("input valuechange", checkLoginBtn);
        //点击登录
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