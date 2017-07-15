<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:52:"/home/web/imay/application/m/view/about/privacy.html";i:1495423540;s:60:"/home/web/imay/application/m/view/public/about-footer-1.html";i:1489141872;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width,initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no"/>
    <title><?php echo $Page['title']; ?></title>
    <link rel="stylesheet" href="__CSS__/common.css">
    <style type="text/css">
        .imay_server {
            width: 80%;
            margin: 0 auto;
        }
        
        .server_text p {
            text-indent: 2em;
            margin: 15px 0;
            font-size: 12px;
        }
        
        .imay_server h3 {
            font-size: 18px;
            font-weight: bold;
            text-align: center;
            padding: 20px 0 0 0;
        }
        
        .server_text p b {
            font-weight: bold;
        }
        
        .g-txt-f {
            margin: 2px 0;
            font-size: 10px;
            color: #a7a7a7;
        }
    </style>
</head>
<body>
<div class="imay">
    <div class="page-1190 imay_server">
        
        <h3><?php echo $Page['title']; ?></h3>
        
        <div class="server_text">
            <br>
            <?php echo $Page['content']; ?>
        
        </div>
        <footer>
    <div id="g-footer">
        <div class="g-f-txt">
            <a href="<?php echo url('/about/serviceprivacy'); ?>">隐私政策</a><span>|</span>
            <a href="<?php echo url('/about/privacypolicy'); ?>">服务条款</a><span>|</span>
            <a href="<?php echo url('/about/connect'); ?>">联系我们</a>
        </div>
        <div class="g-txt-f">Copyright © 2015-2017 广州暧魅网络科技有限公司</div>
        <div class="g-txt-f">版权所有 <a href="http://www.miitbeian.gov.cn/">粤ICP备14054705号-1</a> 粤网文[2016]3788-881号</div>
        <div class="g-txt-f">广播电视节目制作经营许可证（粤）字第01949号</div>
        <div class="g-txt-f">意见建议：service@imay.com</div>
        <div class="g-txt-f"><a  class="imay-dec" style="width: 212px;" href="http://www.beian.gov.cn/portal/registerSystemInfo?recordcode=44010502000442" target="_blank"><img src="__PUBLIC__/images/ba.png"><span>粤公网安备 44010502000442号</span></a></div>
    </div>
</footer>
    </div>
</div>

</body>
</html>