<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:53:"/home/web/imay/application/m/view/recharge/large.html";i:1498031136;}*/ ?>
<!DOCTYPE html>
<html lang="zh_CN">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title></title>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
    <meta content="telephone=no" name="format-detection">
    <meta name="viewport" content="width=device-width,initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no"/>
    <link type="text/css" rel="stylesheet" href="__CSS__/m-common.css">
    <link type="text/css" rel="stylesheet" href="__CSS__/m-default.css">
</head>
<body>
<div class="vip">
    <img src="__IMG__/vip01.jpg">
    <a class="vip-a" target="_blank">
        <img src="__IMG__/vip-a.png" class="vip-i">
    </a>
    <img src="__IMG__/vip02.jpg" class="vip02">
</div>
<!-- 微信提示 -->
<div class="m-wechat-mes">
    <div class="g-mask" id="iMask"></div>
    <div class="i-m-txt">
        <div class="m-i-w">
            <span>点击这里选择“在浏览器中打开”</span>
        </div>
        <div class="m-i-ar">
            <img src="__IMG__/m-img04.png">
        </div>
    </div>
</div>
<script type="text/javascript" src="__JS__/jquery.js"></script>
<script type="text/javascript" src="__JS__/m-index.js"></script>
<script type="text/javascript">
    $(function () {
        $(".vip-a").click(function () {
            openAQQ("http://wpa.b.qq.com/cgi/wpa.php?ln=2&uin=800811388")
        });
        $(".m-wechat-mes").click(function () {
            closeMask();
        });
    });
</script>
</body>
</html>