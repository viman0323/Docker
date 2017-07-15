<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:60:"/home/www/web/imay/application/index/view/about/privacy.html";i:1495423540;s:79:"/home/www/web/imay/application/index/view/../../common/view/default/footer.html";i:1489659878;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no"/>
	<title><?php echo $Page['title']; ?></title>
	<link rel="stylesheet" href="__PC_CSS__/common.css">
	<link rel="stylesheet" href="__CSS__/agree.css">
    <script type="text/javascript" src="__PUBLIC__/js/jquery.js"></script>
</head>
<body>
<header>
	<div class="iMay-header">
		<div class="header-bar">
			<a href="http://www.imay.cn" class="logo"></a>
		</div>
	</div>
</header>
<article>
	<div class="iMay-con">
		<div class="page-1190 imay_server">
			<h3><?php echo $Page['title']; ?></h3>
			<div class="server_text">
				<?php echo $Page['content']; ?>
			</div>
		</div>
	</div>
</article>
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