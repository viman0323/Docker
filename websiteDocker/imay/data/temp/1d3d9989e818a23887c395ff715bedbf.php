<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:49:"/home/web/imay/application/m/view/share/list.html";i:1499158445;s:64:"/home/web/imay/application/m/view/statistics/baiduStatistcs.html";i:1486463787;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>玩咖直播动态分享</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta content="telephone=no" name="format-detection">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="msapplication-tap-highlight" content="no">
    <meta content="black" name="apple-mobile-web-app-status-bar-style">
    <meta content="yes" name="apple-touch-fullscreen">
    <link rel="stylesheet" href="__CSS__/share.css">
</head>
<body>
<header>
    <div class="s-header tab-scroll aniInTop">
        <div class="s-header-c clearfix">
            <div class=s-h-l>
                <img src="__IMG__/superlive/z-i-i01.png" class="s-logo-i">
                <div class="s-h-txt">
                    <h1>玩咖直播</h1>
                    <h5>可以玩的直播</h5>
                </div>
            </div>
            <div class=s-h-r>
                <a class="s-o-a openIMay"><img src="__IMG__/superlive/z-i-i02.png" class="s-open"></a>
            </div>
        </div>
    </div>
</header>
<article>
    <?php if($list['feeds']['0']['show'] == 1): ?>
    <section>
        <div class="s-mid">
            <div class="s-mid-c">
                <?php if($list['feeds']['0']['feedType'] == 2): ?>
                    <!-- video播放器 -->
                    <div class="s-mid-video">
                        <img src="<?php echo $list['feeds']['0']['videoUrl']; ?>?vframe/jpg/offset/0/w/450" class="s-video-i">
                        <video class="s-video-a s-pos" id="iMayVideo" playsinline -webkit-playsinline>
                            <source type="video/mp4" src="<?php echo $list['feeds']['0']['videoUrl']; ?>" -webkit-playsinline=true>
                        </video>
                    </div>
                    <!-- video播放器按钮 -->
                    <div class="s-play s-pos">
                        <a class="s-play-a" id="iMayPlay"><img src="__IMG__/share/s-play.png" class="s-play-i"></a>
                    </div>
                <?php else: ?>
                    <div class="s-mid-video">
                        <img src="<?php echo $list['feeds']['0']['imgUrl']; ?>" class="s-video-i">
                    </div>
                <?php endif; ?>
                <div class="s-loading" >
                    <img src="__IMG__/share/loading.gif">
                </div>
                <!-- 头像bar -->
                <div class="s-d-bar clearfix">
                    <?php if($list['feeds']['0']['show'] == 1): ?>
                    <div class="s-bar-top">
                        <a class="s-bar-a s-pos">
                            <?php if($list['feeds']['0']['user']['imgHead']): ?>
                            <img src="<?php echo $list['feeds']['0']['user']['imgHead']; ?>?imageView2/2/w/200" class="s-bar-i">
                            <?php else: ?>
                            <img src="__IMG__/no.jpg" class="s-bar-i">
                            <?php endif; ?>
                        </a>
                        <div class="s-bar-tit s-pos">
                            <div class="s-tit-t1 clearfix">
                                <h5><?php echo $list['feeds']['0']['user']['nick']; ?></h5>

                                <?php  if ($list['feeds']['0']['user']['sex'] == 1) {  ?>
                                <em class="s-sex s-sex-m"></em>
                                <?php  } else {  ?>
                                <em class="s-sex s-sex-g"></em>
                                <?php  }   if ($list['feeds']['0']['user']['UserLv'] > 39) {  ?>
                                <b class="s-level level-e"><?php echo $list['feeds']['0']['user']['UserLv']; ?></b>
                                <?php  } else if ($list['feeds']['0']['user']['UserLv'] > 29) {  ?>
                                <b class="s-level level-d"><?php echo $list['feeds']['0']['user']['UserLv']; ?></b>
                                <?php  } else if ($list['feeds']['0']['user']['UserLv'] > 19) {  ?>
                                <b class="s-level level-c"><?php echo $list['feeds']['0']['user']['UserLv']; ?></b>
                                <?php  } else if ($list['feeds']['0']['user']['UserLv'] > 9) {  ?>
                                <b class="s-level level-b"><?php echo $list['feeds']['0']['user']['UserLv']; ?></b>
                                <?php  } else {  ?>
                                <b class="s-level level-a"><?php echo $list['feeds']['0']['user']['UserLv']; ?></b>
                                <?php  }  ?>

                            </div>
                            <div class="s-tit-t2">
                                魅号：<?php echo $list['feeds']['0']['user']['roomId']; ?>
                            </div>
                        </div>
                        <a class="s-more s-pos openIMay" href="javascript:;">
                            <img src="__IMG__/share/s-more.png" class="s-more-a">
                        </a>
                    </div>
                    <div class="s-bar-bot">
                        <?php if (isset($list['feeds'][0]['msg'])) {  ?>
                        <span><?php echo $list['feeds'][0]['msg']; ?>
                            <a class="s-bot-h">
                                <?php if (isset($list['feeds'][0]['atUsers'])) {  if(is_array($list['feeds'][0]['atUsers']) || $list['feeds'][0]['atUsers'] instanceof \think\Collection): $i = 0; $__LIST__ = $list['feeds'][0]['atUsers'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                        @<?php echo $vo['nick']; endforeach; endif; else: echo "" ;endif;  }  if (isset($list['feeds'][0]['labels'])) {  if(is_array($list['feeds'][0]['labels']) || $list['feeds'][0]['labels'] instanceof \think\Collection): $i = 0; $__LIST__ = $list['feeds'][0]['labels'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                                        #<?php echo $v; endforeach; endif; else: echo "" ;endif;  }  ?>
                            </a>
                        </span>
                        <?php  } else {  ?>
                        <span><a class="s-bot-h">
                            <?php if (isset($list['feeds'][0]['atUsers'])) {  if(is_array($list['feeds'][0]['atUsers']) || $list['feeds'][0]['atUsers'] instanceof \think\Collection): $i = 0; $__LIST__ = $list['feeds'][0]['atUsers'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                    @<?php echo $vo['nick']; endforeach; endif; else: echo "" ;endif;  }  if (isset($list['feeds'][0]['labels'])) {  if(is_array($list['feeds'][0]['labels']) || $list['feeds'][0]['labels'] instanceof \think\Collection): $i = 0; $__LIST__ = $list['feeds'][0]['labels'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                                    #<?php echo $v; endforeach; endif; else: echo "" ;endif;  }  ?>
                        </a></span>
                        <?php  }  ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
    <?php else: ?>
    <section>
        <div class="no-dy">
            <img src="__IMG__/share/no-dy.jpg" class="no-dy-i">
        </div>
    </section>
    <?php endif; ?>
    <section>
        <div class="s-list">
            <div class="s-list-tit">
                <h2>推荐动态</h2>
            </div>
            <div class="s-list-c">
                <ul class="s-list-ul clearfix">
                    <?php if(is_array($page['feeds']) || $page['feeds'] instanceof \think\Collection): $i = 0; $__LIST__ = $page['feeds'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <li>
                            <div class="li-d-top">
                                <?php if($vo['feedType'] == 2): ?>
                                    <a href="/share/feed.html?FeedId=<?php echo $vo['feedId']; ?>&scheme=<?php echo $scheme; ?>&host=<?php echo $host; ?>" class="s-list-a" style="background-image: url('<?php echo $vo['videoUrl']; ?>?vframe/jpg/offset/0/w/450')"></a>
                                    <img src="__IMG__/share/s-play-s.png" class="s-play-s">
                                <?php else: ?>
                                    <a href="/share/feed.html?FeedId=<?php echo $vo['feedId']; ?>&scheme=<?php echo $scheme; ?>&host=<?php echo $host; ?>" class="s-list-a" style="background-image: url('<?php echo $vo['imgUrl']; ?>?imageView2/2/w/200')"></a>
                                <?php endif; ?>
                            </div>
                        </li>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
            </div>
        </div>
    </section>
    <section>
        <div id="imay-mask">
            <div class="iMay-shadow"></div>
            <div class="w-mes">
                <img src="__IMG__/superlive/z-i-i10.png" class="w-mes-img">
            </div>
        </div>
    </section>
</article>
<footer>
    <!-- 底部 -->
    <div class="z-footer clearfix">
        <img src="__IMG__/superlive/z-i-i05.png" class="z-i-i05">
        <div class="z-footer-r">
            <h6>都翻到这了，就下载个玩咖体验一下吧</h6>
            <a class="t-footer-challenge openIMay">
                <img src="__IMG__/share/s-down.png" class="z-i-i06">
            </a>
        </div>
    </div>
</footer>
<script type="text/javascript" src="__JS__/jquery.js"></script>
<script type="text/javascript">
    var type = "<?php echo $list['feeds']['0']['feedType']; ?>";
    //分享自「用户昵称」的动态@i玩咖直播
    var nick = "分享自「"+"<?php echo $list['feeds']['0']['user']['nick']; ?>"+"」的动态@玩咖直播";
    var desc = "一言不合就发动态啦，快来围观~";
    var imgURL = '';
    var url = "<?php echo $url; ?>" + "/share/feed";
    var val = '?FeedId='+ "<?php echo $list['feeds']['0']['feedId']; ?>" + '&scheme=' + '<?php echo $scheme; ?>' + '&host=' + '<?php echo $host; ?>';
    var wxURL ='<?php echo url("Capturemonster/getJsapiTicket"); ?>';
    var ifrSrc = '<?php echo $scheme; ?>' + '://' + '<?php echo $host; ?>' + '/openwith?type=3&uid=' + "<?php echo $list['feeds']['0']['user']['uid']; ?>" + '&FeedId=' + "<?php echo $list['feeds']['0']['feedId']; ?>";
    if (type == '1') {
        imgURL = "<?php echo $list['feeds']['0']['imgUrl']; ?>" + "?imageView2/2/w/200";
    } else if (type == '2') {
        imgURL = "<?php echo $list['feeds']['0']['videoUrl']; ?>" + "?vframe/jpg/offset/0/w/450";
    }
    var parameter = '&type=3&uid=' + "<?php echo $list['feeds']['0']['user']['uid']; ?>" + '&FeedId=' + "<?php echo $list['feeds']['0']['feedId']; ?>" + '&scheme=' + '<?php echo $scheme; ?>' + '&host=' + '<?php echo $host; ?>';

    $(function () {
        getWXData(wxURL, nick, desc, url + val, imgURL);
        $(".openIMay").click(function () {
           openApp(ifrSrc);
        });
    });

</script>
<script type="text/javascript" src="__JS__/jweixin-1.0.0.js"></script>
<script type="text/javascript" src="__JS__/share.js"></script>
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