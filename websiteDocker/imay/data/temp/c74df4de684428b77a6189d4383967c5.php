<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:58:"/home/web/imay/application/index/view/about/connectUs.html";i:1495616950;s:75:"/home/web/imay/application/index/view/../../common/view/default/footer.html";i:1489659878;}*/ ?>
<!DOCTYPE html>
<html lang="zh_CN">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo $Page['title']; ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no"/>
    <link rel="stylesheet" href="__PC_CSS__/common.css">
    <link rel="stylesheet" href="__PC_CSS__/default.css">
    <script type="text/javascript" src="__PUBLIC__/js/jquery.js"></script>
</head>
<body>
<header>
    <div id="header">
        <div class="h-con">
            <a class="logo"></a>
            <ul class="h-nav">
                <li>
                    <a href="/">官网</a>
                </li>
                <li>
                    <a href="<?php echo url('user/withdraw/index'); ?>">提现</a>
                </li>
                <li>
                    <a href="<?php echo url('user/recharge/index'); ?>">充值</a>
                </li>
            </ul>
        </div>
    </div>
</header>
<div class="g-wrap">
    <div class="g-con g-link-bg">
        <a class="g-h3-ic"></a>
        <h3 class="g-h3-bg"><b><?php echo $Page['title']; ?></b></h3>
        <div class="link-c">
            <?php echo $Page['content']; ?>
        </div>
    </div>
</div>
<footer>
    <div id="g-footer">
        <div class="g-f-txt">
            <a class="imay-dec" href="<?php echo url('/about/privacyService'); ?>" target="_blank">用户协议</a><span>|</span>
            <!--<a href="<?php echo url('/about/service'); ?>" target="_blank">隐私政策</a><span>|</span>-->
            <!--<a href="<?php echo url('/about/privacy'); ?>" target="_blank">服务条款</a><span>|</span>-->
            <a class="imay-dec" href="<?php echo url('/about/connect'); ?>" target="_blank">联系我们</a></div>
        <div class="g-f-txt">Copyright © 2015-2017 广州暧魅网络科技有限公司  版权所有 <a href="http://www.miitbeian.gov.cn/">粤ICP备14054705号-1</a> 粤网文[2016]3788-881号 广播电视节目制作经营许可证（粤）字第01949号</div>
        <div class="g-f-txt">意见建议：service@imay.com <a class="imay-dec" href="http://www.beian.gov.cn/portal/registerSystemInfo?recordcode=44010502000442" target="_blank"><img src="__PUBLIC__/images/ba.png" style="float: left">粤公网安备 44010502000442号</a> <a class="imay-dec" href="http://jb.ccm.gov.cn/" target="_blank">12318 全国文化市场举报网站</a></div>
    </div>
</footer>
<script type="text/javascript">
    $(function () {
        var _hmt = _hmt || [];
        $(function() {
            var hm = document.createElement("script");
            hm.src = "//hm.baidu.com/hm.js?92271316ab45db908e0b6763467fea57";
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(hm, s);
        });
    })
</script>
<!--/#footer-->
</body>
</html>