<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:50:"/home/web/imay/application/m/view/index/index.html";i:1498031136;s:64:"/home/web/imay/application/m/view/statistics/baiduStatistcs.html";i:1486463787;}*/ ?>
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
    <script>
        var ThinkPHP = window.Think = {
            "ROOT": "__ROOT__",
            "IMG": "__IMG__"
        };
    </script>
</head>
<body id="m-i-bg">
    <header>
        <div class="i-h-t">
            <div class="i-t-c">
                <div class="i-t-top clearfix aniInTop tab-scroll">
                    <div class="i-top-l">
                        <img src="__IMG__/m-logo.png" class="m-i-logo clearfix">
                    </div>
                    <div class="i-top-m">
                        <img src="__IMG__/m-img01.png" class="m-i-i01">
                        <img src="__IMG__/iMayCode.jpg" class="m-i-i03">
                    </div>
                </div>
                <div class="i-t-bot clearfix tab-scroll aniInbot">
                    <div class="i-t-but">
                        <a class="m-i-a" href='<?php echo url("withdraw/index"); ?>'>
                            <img src="__IMG__/m-img02.png" class="m-i-i02">
                        </a>
                        <a class="m-i-a" href='<?php echo url("recharge/index"); ?>'>
                            <img src="__IMG__/m-img03.png" class="m-i-i02">
                        </a>
                    </div>
                    <div class="i-t-but i-t-but1">
                        <a class="m-i-a m-i-b" href="/download">
                            <img src="__IMG__/m-img05.png" class="m-i-i02">
                        </a>
                    </div>
                    <!--<div class="i-t-but">-->
                        <!--<a class="m-i-a m-i-b" href="/download/indexInvite">-->
                            <!--<img src="__IMG__/m-img06.png" class="m-i-i02">-->
                        <!--</a>-->
                    <!--</div>-->
                </div>
            </div>
        </div>
    </header>
    <article>
        <div class="m-i-mid">
            <img src="__IMG__/m-i-bg.jpg">
        </div>
    </article>
    <footer>
        <div class="m-wx">
            <img src="__IMG__/m-wx.png">
        </div>
        <div class="m-footer">
            <div class="g-txt-f">Copyright © 2015-2016 广州暧魅网络科技有限公司</div>
            <div class="g-txt-f">版权所有 <a href="http://www.miitbeian.gov.cn/">粤ICP备14054705号-1</a> 粤网文[2016]3788-881号</div>
            <div class="g-txt-f">广播电视节目制作经营许可证（粤）字第01949号</div>
            <div class="g-txt-f">意见建议：service@imay.com</div>
            <div class="g-txt-f"><a class="imay-dec" style="width: 212px;" href="http://www.beian.gov.cn/portal/registerSystemInfo?recordcode=44010502000442" target="_blank" ><img src="__PUBLIC__/images/ba.png"><span>粤公网安备 44010502000442号</span></a></div>
            <div class="g-txt-f"><a class="imay-dec" style="clear:both;" href="http://jb.ccm.gov.cn/" target="_blank" >12318 全国文化市场举报网站</a></div>

        </div>
    </footer>
    <!-- 微信提示 -->
    <div class="m-wechat-mes">
        <div class="g-mask" id="iMask"></div>
        <div class="i-m-txt">
            <div class="m-i-w">
                <span>点击这里选择“在浏览器中打开”</span>
                <span>体验更多互动!!!</span>
            </div>
            <div class="m-i-ar">
                <img src="__IMG__/m-img04.png">
            </div>
        </div>
    </div>
    <script type="text/javascript" src="__JS__/jquery.js"></script>
    <script type="text/javascript" src="__PUBLIC__/js/common.js"></script>
    <script type="text/javascript" src="__PUBLIC__/plugins/plugins.js"></script>
    <script type="text/javascript" src="__JS__/m-index.js"></script>
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
</body>
</html>