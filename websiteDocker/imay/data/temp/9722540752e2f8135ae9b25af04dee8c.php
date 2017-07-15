<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:52:"/home/web/imay/application/m/view/login/toLogin.html";i:1486463787;s:64:"/home/web/imay/application/m/view/statistics/baiduStatistcs.html";i:1486463787;}*/ ?>
<!DOCTYPE html>
<html lang="zh_CN">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>iMay直播，可以玩的直播！</title>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
    <meta content="telephone=no" name="format-detection">
    <meta name="viewport" content="width=device-width,initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no"/>
    <link type="text/css" rel="stylesheet" href="__CSS__/m-common.css">
    <link type="text/css" rel="stylesheet" href="__CSS__/m-default.css">
</head>
<body id="m-login">
    <header>
        <h1 class="m-way-h1">请登录您的iMay账号</h1>
    </header>
    <article>
        <section>
            <h2 class="m-way-h2">请选择登录方式</h2>
        </section>
        <section>
            <div class="m-c-way">
                <ul>
                    <li>
                        <a class="m-way-a" href="<?php echo url('login/toLoginPhone'); ?>">
                            <div class="way-a-a">
                                <div class="way-a-d">
                                    <img src="__IMG__/m-ic04.png" class="way-ip">
                                </div>
                                <span id="phone">手机号</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a class="m-way-a" onclick="checkEnv()">
                           <div class="way-a-a">
                               <div class="way-a-d">
                                   <img src="__IMG__/m-ic01.png">
                               </div>
                               <span id="wechat">微信号</span>
                           </div>
                        </a>
                    </li>
                    <li>
                        <a class="m-way-a" href="<?php echo $data['ConnectQQ']; ?>">
                            <div class="way-a-a">
                                <div class="way-a-d">
                                    <img src="__IMG__/m-ic02.png" class="way-qq">
                                </div>
                                <span>QQ</span>
                            </div>
                        </a>
                    </li>
                    <!--<li>-->
                        <!--<a class="m-way-a" href="<?php echo $data['ConnectXL']; ?>">-->
                            <!--<div class="way-a-a">-->
                                <!--<div class="way-a-d">-->
                                    <!--<img src="__IMG__/m-ic03.png" class="way-weibo">-->
                                <!--</div>-->
                                <!--<span>微博</span>-->
                            <!--</div>-->
                        <!--</a>-->
                    <!--</li>-->
                   
                </ul>
            </div>
        </section>
    </article>
</body>
<script type="text/javascript" src="__JS__/jquery.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/common.js"></script>
<script type="text/javascript" src="__JS__/m-index.js"></script>
<script type="text/javascript" src="__PUBLIC__/plugins/plugins.js"></script>
<script>
    function checkEnv() {
        if (is_weixn()) {
            location.href = "<?php echo $data['ConnectWX']; ?>";
            return;
        } else {
            alert("微信登录请去公众号");
            return;
        }
    }
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