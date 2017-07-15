<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:49:"/home/web/imay/application/m/view/test/index.html";i:1486463787;s:64:"/home/web/imay/application/m/view/statistics/baiduStatistcs.html";i:1486463787;}*/ ?>
<!DOCTYPE html>
<html lang="zh_CN">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>iMay直播 — 邀请测试</title>
	<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
	<meta name="viewport" content="width=device-width,initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no"/>
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<meta name="referrer" content="always">
	<link type="text/css" rel="stylesheet" href="__CSS__/i-m-index.css">
    <link rel="stylesheet" href="__BCSS__/bootstrap.min.css">
    <script type="text/javascript" src="__JS__/jquery.js"></script>
    <script type="text/javascript" src="__BJS__/bootstrap.min.js"></script>
    <script type="text/javascript" src="__PJS__/plugins.js"></script>
    <style type="text/css">
        a:link,a:visited,a:active{color: #fff;text-decoration: none; outline:none;}
        a:hover{text-decoration: none;color: #fff}
        .y-d-t a{text-decoration: none;color: #fff}
    </style>
</head>
<body>
<article>
	<!-- <section>
		<div class="i-y-d">
			<h5>输入邀请码下载</h5>
			<div class="y-d-t">
				<input type="text" class="y-d-i" value="">
				<a class="i-d-sure">确定</a>
			</div>
		</div>
	</section> -->
	<section>
		<div class="i-d-con">
			<!-- ios -->
			<div class="i-d-n" style="disply:block;">
				<a class="i-ios-d" href="itms-services:///?action=download-manifest&url=https://apple.imay.com/imay_live.plist"></a>
				<a class="i-and-d" href="itms-services:///?action=download-manifest&url=https://iosapp.imay.cn/imay_live.plist"></a>
			</div>
			<!-- 安卓 -->
			<!-- <div class="i-d-n i-d-n1">
				http://static.imay.com/download/imay_live.apk
				https://iosapp.imay.cn/imay_live.apk
				<a class="i-ios-d"></a>
				<a class="i-and-d"></a>
			</div> -->
		</div>
		<div class="i-mes" style="text-align: left; padding-bottom: 10px;">IOS版本下载前，请先将手机上的“iMay直播”删除后再下载安装</div>
		<div class="i-mes" style="text-align: left; padding-bottom: 10px;">注：安装完毕，请打开【设置】->【通用】->【设备管理】，点击设备【Tinluk Information Technology Co.,Ltd】，再点击【信任“Tinluk ...”】选项，最后点【信任】按钮即可正常使用。</div>
	</section>
</article>
<script type="text/javascript">
	$(function(){
		 <?php if($check): ?>$(".i-y-d").hide();$(".i-d-n").show();<?php endif; ?>
		$(".i-d-sure").click(function(){
            var code = $('.y-d-i').val();
            if (!code) {
                var result = '请输入邀请码！';
                $('.tip_content').show();
                $('.tip_content').html("<font color=red style='font-size:28px;'>" + result + "</font>");
                return;
            }
            $.post("/test/verification", {'code': code}, function (data, textStatus) {
                var json = WST.toJson(data);
                if (json.status == '1') {
                    $(".i-y-d").hide();
                    $('.tip_content').hide();
                    $(".i-d-n").show();
                } else {
                    var result = '邀请码已使用！';
                    $('.tip_content').show();
                    $('.tip_content').html("<font color=red style='font-size:28px;'>" + result + "</font>");
                    $('.y-d-i').val("");
                }
            });
		});
	});
</script>

</body>
<script type="text/javascript" src="__PUBLIC__/js/common.js"></script>
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

