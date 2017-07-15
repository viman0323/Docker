<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:52:"/home/www/web/imay/application/m/view/edg/index.html";i:1499228975;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>玩咖直播</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta content="telephone=no" name="format-detection">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="msapplication-tap-highlight" content="no">
    <link rel="stylesheet" href="__CSS__/m-edg.css">
</head>
<body>
<img src="__IMG__/edg/bg02.jpg" class="edg-bg">
<div class="edg-bot">
    <img src="__IMG__/edg/bg01.jpg" class="edg-bg01">
    <div class="edg-but">
        <?php if(is_array($result) || $result instanceof \think\Collection): $i = 0; $__LIST__ = $result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;if($vo['status']==1){ ?>
	        <a class="edg-but-a" href="<?php echo $vo['url']; ?>">
	            <img src="__IMG__/edg/Live.png" class="edg-live">
	            <img src="__IMG__/edg/edg-<?php echo $i; ?>.png" class="edg-a-i">
	        </a>
        <?php  }else{  ?>
            <a class="edg-but-a" href="imay://com.imay.live/openwith?type=2&uid=<?php echo $vo['uid']; ?>">
              <img src="__IMG__/edg/edg-<?php echo $i; ?>.png" class="edg-a-i">
            </a>
        <?php  }  endforeach; endif; else: echo "" ;endif; ?>
        
        
        
    </div>
</div>

</body>
</html>