<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:60:"/home/web/imay/application/activity/view/activity/index.html";i:1489741542;}*/ ?>
<!DOCTYPE html>
<html lang="zh_CN">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>首充活动-iMay</title>
	<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
	<meta content="telephone=no" name="format-detection">
    <meta http-equiv="cache-control" content="no-cache, must-revalidate">
    <meta name="viewport" content="width=device-width,initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no"/>
    <link rel="stylesheet" type="text/css"  href="__CSS__/h-i01.css" />
</head>
<body id="h1-bg">
<header>
    <img src="__IMG__/h1-img01.png" class="h1-img-i01 tab-scroll aniInTop">
</header>
<article>
    <div class="h1-cn">
        <div class="h1-top aniInLeft tab-scroll">
            <img  class="h1-i09">
        </div>
        <div class="h1-bot aniInRight tab-scroll">
            <img class="h1-i10">
            <div class="g1-get-t">
                <a class="h1-get-i">
                    <?php if($level == '1'): if($getGift == '0'): ?>
                    <img  class="h1-i07">
                    <?php else: ?>
                    <img value="3006" type="1" class="h1-i06 receive twinkling1">
                    <?php endif; else: ?>
                    <img class="h1-i06b">
                    <?php endif; ?>
                </a>
                <a class="h1-get-i">
                    <?php if($level == '2'): if($getGift == '0'): ?>
                    <img src="__IMG__/h1-img07.png">
                    <?php else: ?>
                    <img value="3005" type="3" class="h1-i06 receive twinkling1">
                    <?php endif; else: ?>
                    <img src="__IMG__/h1-img06b.png" class="h1-i06b">
                    <?php endif; ?>
                </a>
                <a class="h1-get-i">
                    <?php if($level == '3'): if($getGift == '0'): ?>
                    <img class="h1-i07">
                    <?php else: ?>
                    <img value="3004" type="7" class="h1-i06 receive twinkling1">
                    <?php endif; else: ?>
                    <img  class="h1-i06b">
                    <?php endif; ?>
                </a>
            </div>
        </div>
        <div class="h1-mid tab-scroll aniInBottom">
            <a class="h1-m2-but" href="iMay://com.imay.live/openwith?type=4">
                <img class="h1-i05">
            </a>
            <img class="h1-i11">
            <img class="h1-i12">
        </div>
    </div>
</article>
<div class="mask"></div>
<!--<div class="g1-pop" style="display: none;">-->
    <!--<img src="__IMG__/h1-img08.png" class="h1-img-i08">-->
    <!--<img src="__IMG__/h1-img03.png" class="h1-img-i03">-->
    <!--<img src="__IMG__/h1-img04.png" class="h1-img-i04">-->
    <!--<a class="h1-i03-a h1-a-close">-->
        <!--<img src="__IMG__/h1-img02.png" class="h1-img-i02">-->
    <!--</a>-->
<!--</div>-->
<script src="__JS__/jquery.js"></script>
<script type="text/javascript">
    window.onload=function () {
        setTimeout("showA()",100);
        setTimeout("showB()",300);
    };
    function showA() {
        $(".h1-i09").attr("src","__IMG__/h1-img09.png");
        $(".h1-i10").attr("src","__IMG__/h1-img10.png");
        $(".h1-i07").attr("src","__IMG__/h1-img07.png");
        $(".h1-i06").attr("src","__IMG__/h1-img06.png");
        $(".h1-i06b").attr("src","__IMG__/h1-img06b.png");
    }
    function showB() {
        $(".h1-i05").attr("src","__IMG__/h1-img05.png");
        $(".h1-i10").attr("src","__IMG__/h1-img10.png");
        $(".h1-i11").attr("src","__IMG__/h1-img11.png");
        $(".h1-i12").attr("src","__IMG__/h1-img12.png");
    }

    var _hmt = _hmt || [];
	$(function () {
        $(".h1-a-close").click(function () {
            $('.g1-pop').hide();
            $('.mask').hide();
        });

		$(".g1-get-t a").click(function () {
            var index = $(this).parent().children().index($(this));
            $(this).find("img").removeClass("twinkling1");
            var img = '__IMG__/h1-img07.png';
            var obj = {};
            obj.date = $(this).find('img').attr('type');
            obj.gift_id = $(this).find('img').attr('value');
            obj.uid = '<?php echo $uid; ?>';
            if ($(this).find('img').hasClass('receive')) {
                $.post("<?php echo url('activity/activity/receive'); ?>", obj, function (data) {
                    $(".g1-get-t a").eq(index).find('img').removeClass('receive');
                    if (data.status == '1') { // 领取成功
                        $(".g1-get-t a").eq(index).find('img').attr('src', img);
                        $('.g1-pop').show();
//                        $('.mask').show();
                        $('.h1-img-i08').show();
                        $('.h1-img-i03').hide();
                        $('.h1-img-i04').show();
                    } else { // 领取失败
                        $('.g1-pop').show();
//                        $('.mask').show();
                        $('.h1-img-i08').show();
                        $('.h1-img-i04').hide();
                        $('.h1-img-i03').show();
                    }
                }, 'json')
            }
		});

        var hm = document.createElement("script");
        hm.src = "//hm.baidu.com/hm.js?92271316ab45db908e0b6763467fea57";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
	})
</script>
</body>
</html>