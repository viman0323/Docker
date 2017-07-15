<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:58:"/home/www/web/imay/application/m/view/share/superLive.html";i:1499229967;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>超胆玩咖都在这里</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta content="telephone=no" name="format-detection">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="msapplication-tap-highlight" content="no">
    <link rel="stylesheet" href="__CSS__/z-common.css">
    <link rel="stylesheet" href="__CSS__/z-index.css">
</head>
<body>
<!-- 头部 -->
<header>
    <div class="z-header clearfix tab-scroll aniInTop">
        <div class="z-header-l clearfix">
            <img src="__IMG__/superlive/z-i-i01.png" class="z-i-i01">
            <div class="z-her-title">
                <h1>玩咖直播</h1>
                <h3>超胆任务，挑战未知</h3>
            </div>
        </div>
        <a class="z-header-open openIMay">
            <img src="__IMG__/superlive/z-i-i02.png" class="z-i-i02">
        </a>
    </div>
</header>
<article>
    <!-- 播放器 头像 背景封面 -->
    <section>
        <div class="z-mid" id="zVideo">
            <!-- 背景封面 -->
            <div class="z-mid-img">
                <div class="s-v-bg" style="background: url('<?php echo $list['personal']['videoUrl']; ?>?vframe/jpg/offset/0/w/450') no-repeat"></div>
            </div>
            <!-- 播放器 -->
            <div class="z-video z-pos">
                <video class="z-video-v" id="iMayVideo" src="<?php echo $list['personal']['videoUrl']; ?>"  playsinline webkit-playsinline></video>
            </div>
            <!-- 播放器按钮 -->
            <div class="z-play z-pos">
                <a class="z-play-a">
                    <img src="__IMG__/superlive/z-i-i03.png" class="z-play-i">
                </a>
            </div>
            <!-- 头像 分享-->
            <div class="z-mid-bar z-pos">
                <div class="mid-bar-con z-pos">
                    <div class="mid-bar-bg clearfix">
                        <div class="mid-share z-pos">
                            <a class="mid-share-a">
                                <img src="__IMG__/superlive/z-i-i15.png" class="z-i-i15">
                            </a>
                            <a class="mid-comment-a">
                                <img src="__IMG__/superlive/z-i-i16.png" class="z-i-i16">
                            </a>
                        </div>
                        <div class="mid-bar-tit">#<?php echo $list['personal']['challengeTitle']; ?></div>
                        <div class="mid-bar-bot">
                            <div class="mid-bot-l">
                                <?php  if ($list['personal']['imgHead']) {  ?>
                                    <img src="<?php echo $list['personal']['imgHead']; ?>?imageView2/5/w/100/h/100" class="mid-bot-head">
                                <?php  } else {  ?>
                                    <img src="__IMG__/no.png" class="mid-bot-head">
                                <?php  }  ?>
                                <h3 class="mid-bar-nick"><?php echo $list['personal']['nick']; ?></h3>
                            </div>
                            <div class="mid-bot-r">
                                <a class="mid-bot-follow openIMay">
                                    <img src="__IMG__/superlive/z-i-i04.png" class="z-i-i04">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- loading-->
            <div class="z-loading z-pos">
                <img src="__IMG__/superlive/loading.gif" class="z-loading-i">
            </div>
            <!-- 重新播放 -->
            <div class="z-reload-play z-pos">
                <div class="z-reload-mask"></div>
                <div class="reload-play-top z-pos">
                    <a class="reload-play">
                        <img src="__IMG__/superlive/z-i-i07.png" class="z-i-07">
                    </a>
                    <a class="reload-play-challenge openIMay">
                        <img src="__IMG__/superlive/z-i-i08.png" class="z-i-08">
                    </a>
                </div>
                <div class="reload-play-bot z-pos">
                    <img src="__IMG__/superlive/z-i-i09.png" class="z-i-i09">
                </div>
            </div>
        </div>
    </section>
    <!-- 热门推荐 -->
    <section>
        <div class="z-list">
            <img src="__IMG__/superlive/z-i-i11.png" class="z-i-i11"> 
            <ul class="z-list-ul clearfix">
            
                <?php if(is_array($list['hotLive']) || $list['hotLive'] instanceof \think\Collection): $i = 0; $__LIST__ = $list['hotLive'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <li>
                        <a class="z-hot-i" href="/Share/superLive?shortLiveId=<?php echo $vo['shortLiveId']; ?>&scheme=<?php echo $search['scheme']; ?>&host=<?php echo $search['host']; ?>"
                           style="background: url('<?php echo $vo['videoUrl']; ?>?vframe/jpg/offset/0/w/300') no-repeat;">
                            <div class="list-txt z-pos">
                                #<?php echo $vo['challengeTitle']; ?>
                            </div>
                        </a>
                    </li>
                <?php endforeach; endif; else: echo "" ;endif; ?>
               
            </ul>
        </div>
    </section>
    <section>
        <div class="z-wechat-mes">
            <div class="z-mask"></div>
            <img src="__IMG__/superlive/z-i-i10.png" class="z-i-i10">
        </div>
    </section>
</article>
<footer>
    <!-- 底部 -->
    <div class="z-footer clearfix">
        <img src="__IMG__/superlive/z-i-i05.png" class="z-i-i05">
        <div class="z-footer-r">
            <h6>玩咖们都在挑战，有胆你来播！</h6>
            <a class="t-footer-challenge openIMay">
                <img src="__IMG__/superlive/z-i-i06.png" class="z-i-i06">
            </a>
        </div>
    </div>
</footer>

<script type="text/javascript" src="__JS__/jquery.js"></script>
<script type="text/javascript" src="__JS__/jweixin-1.0.0.js"></script>
<script>
    var img = "<?php echo $list['personal']['videoUrl']; ?>" + "?vframe/jpg/offset/0/w/450";

    //「用户昵称」有胆你也是主~看我表演！!
    var nick = "<?php echo $list['personal']['nick']; ?>"+"有胆你也是主~看我表演！";
    var desc = "<?php echo $list['personal']['challengeTitle']; ?>";
    var url = "<?php echo $search['url']; ?>" + "/share/superLive";
    var val = '?shortLiveId='+ "<?php echo $search['shortLiveId']; ?>" + '&scheme=' + '<?php echo $search["scheme"]; ?>' + '&host=' + '<?php echo $search["host"]; ?>';
    var wxURL ='<?php echo url("Capturemonster/getJsapiTicket"); ?>';
    var ifrSrc = '<?php echo $search["scheme"]; ?>' + '://' + '<?php echo $search["host"]; ?>' + '/openwith?type=16&shortLiveId=' + '<?php echo $search["shortLiveId"]; ?>';

    $(function () {
        getWXData(wxURL, nick, desc, url + val, img);
        $(".openIMay").click(function () {
            openApp(ifrSrc);
        });
    });
</script>
<script type="text/javascript" src="__JS__/m-common.js"></script>
<script type="text/javascript" src="__JS__/z-index.js"></script>
</body>
</html>