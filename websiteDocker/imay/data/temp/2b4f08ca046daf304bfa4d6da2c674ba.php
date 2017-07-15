<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:50:"/home/web/imay/application/m/view/share/index.html";i:1499158445;}*/ ?>
<!DOCTYPE html>
<html lang="zh_CN">
<head>
    <meta charset="utf-8">
    <title>
        <?php if($room['room']['title'] != '0'): ?>
            <?php echo $room['room']['title']; else: ?>
            <?php echo $room['room']['info']['nick']; ?>的直播间
        <?php endif; ?>
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta content="telephone=no" name="format-detection">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="msapplication-tap-highlight" content="no">
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
    <section>
        <div class="s-mid">
            <div class="s-mid-c">
                <!-- video播放器 -->
                <div class="s-mid-video" id="top">
                    <?php if($room['room']['imgFace'] != '0'): ?>
                        <div class="s-v-bg"  style='background: url("<?php echo $room['room']['imgFace']; ?>") no-repeat'></div>
                        <img src="<?php echo $room['room']['imgFace']; ?>" class="s-i-d">
                    <?php elseif($room['room']['info']['imgHead']): ?>
                        <div class="s-v-bg"  style='background: url("<?php echo $room['room']['info']['imgHead']; ?>") no-repeat'></div>
                        <img src="<?php echo $room['room']['info']['imgHead']; ?>" class="s-i-d">
                    <?php else: ?>
                        <div class="s-v-bg"  style='background: url(/application/index/static/images/no.jpg) no-repeat'></div>
                        <img src="__IMG__/no.jpg" class="s-i-d">
                    <?php endif; ?>
                    <video class="s-video-a share-video s-pos" id="iMayVideo" src="<?php echo $room['room']['url']; ?>" preload="auto" playsinline webkit-playsinline></video>
                </div>
                <!-- video播放器按钮 -->
                <div class="s-play s-pos s-share-p">
                    <a class="s-play-a" id="iMayPlay"><img src="__IMG__/share/s-play.png" class="s-play-i"></a>
                </div>
                <div class="s-v-over">
                    <span>直播已结束</span>
                </div>
                <div class="s-loading" >
                    <img src="__IMG__/share/loading.gif">
                </div>
                <!-- 头像bar -->
                <?php if($room['status'] != 0): ?>
                <div class="s-d-bar clearfix">
                    <div class="s-bar-top">
                        <a class="s-bar-a s-pos">
                            <?php if($room['room']['info']['imgHead']): ?>
                            <img src="<?php echo $room['room']['info']['imgHead']; ?>" class="s-bar-i">
                            <?php else: ?>
                            <img src="__IMG__/no.jpg" class="s-bar-i">
                            <?php endif; ?>
                        </a>
                        <div class="s-bar-tit s-pos">
                            <div class="s-tit-t1 clearfix">
                                <h5><?php echo $room['room']['info']['nick']; ?></h5>
                                <?php if($room['room']['info']['sex'] == '1'): ?>
                                <em class="s-sex s-sex-m"></em>
                                <?php elseif($room['room']['info']['sex'] == '2'): ?>
                                <em class="s-sex s-sex-g"></em>
                                <?php endif;  if ($room['room']['info']['LiveLv'] > 39) {  ?>
                                <b class="z-level z-level-e"><?php echo $room['room']['info']['LiveLv']; ?></b>
                                <?php  } else if ($room['room']['info']['LiveLv'] > 29) {  ?>
                                <b class="z-level z-level-d"><?php echo $room['room']['info']['LiveLv']; ?></b>
                                <?php  } else if ($room['room']['info']['LiveLv'] > 19) {  ?>
                                <b class="z-level z-level-c"><?php echo $room['room']['info']['LiveLv']; ?></b>
                                <?php  } else if ($room['room']['info']['LiveLv'] > 9) {  ?>
                                <b class="z-level z-level-b"><?php echo $room['room']['info']['LiveLv']; ?></b>
                                <?php  } else {  ?>
                                <b class="z-level z-level-a"><?php echo $room['room']['info']['LiveLv']; ?></b>
                                <?php  }  ?>
                            </div>
                            <div class="s-tit-t2">
                                魅号：<?php echo $room['room']['roomId']; ?>
                            </div>
                        </div>
                        <a class="s-inter s-pos openIMay">
                            <img src="__IMG__/share/s-inter.png" class="s-inter-a">
                        </a>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <section>
        <div class="s-list">
            <div class="s-list-tit">
                <h2>热门直播</h2>
            </div>
            <div class="s-list-c">
                <ul class="s-list-ul clearfix s-share-ul">
                    <?php if(is_array($room_hot['rooms']) || $room_hot['rooms'] instanceof \think\Collection): $i = 0; $__LIST__ = $room_hot['rooms'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <li>
                        <div class="li-d-top">
                            <?php if($vo['imgFace'] != '0'): ?>
                                <a href="/share.html?uid=<?php echo $vo['info']['uid']; ?>&room_id=<?php echo $vo['roomId']; ?>&scheme=<?php echo $scheme; ?>&host=<?php echo $host; ?>" class="s-list-b" style="background-image: url('<?php echo $vo['imgFace']; ?>')"></a>
                            <?php elseif($vo['info']['imgHead'] != '0'): ?>
                                <a href="/share.html?uid=<?php echo $vo['info']['uid']; ?>&room_id=<?php echo $vo['roomId']; ?>&scheme=<?php echo $scheme; ?>&host=<?php echo $host; ?>" class="s-list-b" style="background-image: url('<?php echo $vo['info']['imgHead']; ?>')"></a>
                            <?php else: ?>
                                <a href="/share.html?uid=<?php echo $vo['info']['uid']; ?>&room_id=<?php echo $vo['roomId']; ?>&scheme=<?php echo $scheme; ?>&host=<?php echo $host; ?>" class="s-list-b" style="background-image: url(/application/index/static/images/no.jpg)"></a>
                            <?php endif; ?>
                            <div class="s-list-bg s-pos">
                                <span class="s-list-t1">
                                    <?php if($vo['title'] != '0'): ?>
                                        <?php echo $vo['title']; else: ?>
                                        <?php echo $vo['info']['nick']; endif; ?>
                                </span>
                                <span class="s-list-t2">
                                    <img src="__IMG__/share/s-f02.png" class="s-f02">
                                    <?php if($vo['current'] != '0'): ?>
                                        <?php echo $vo['current']; else: ?>
                                        0
                                    <?php endif; ?>
                                </span>
                            </div>
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
<script type="text/javascript" src="__JS__/jweixin-1.0.0.js"></script>
<script type="text/javascript" src="__JS__/share.js"></script>
<script type="text/javascript">
    var imgURL = '__IMG__/no.jpg';
    var roomId = '<?php echo $room['room']['roomId']; ?>';
    var uid = '<?php echo $room['room']['info']['uid']; ?>';
    var imgFace = '<?php echo $room['room']['imgFace']; ?>';
    var imgHead = '<?php echo $room['room']['info']['imgHead']; ?>';
    var nick = '<?php echo $room['room']['info']['nick']; ?>' + '的玩咖直播';
    var desc = '这里是' + '<?php echo $room['room']['info']['nick']; ?>' + '的直播间，去拿个炸鸡啤酒慢慢看~';
    var url = "<?php echo $url; ?>" + "/share";
    var val = '?room_id=' + roomId + '&uid=' + uid + '&scheme=' + '<?php echo $scheme; ?>' + '&host=' + '<?php echo $host; ?>';
    var wxURL ='<?php echo url("Capturemonster/getJsapiTicket"); ?>';
    var liveUrl= '<?php echo $room['room']['urlStr']; ?>';
    var picture = '<?php echo $room['room']['picture']; ?>';
    var ifrSrc = '<?php echo $scheme; ?>' + '://' + '<?php echo $host; ?>' + '/openwith?type=1&liveType='+'<?php echo $room['room']['OpenLiveType']; ?>'+'&roomId='+roomId+'&liveUrl='+liveUrl+'&uid='+uid+'&picture='+picture;
    var parameter = '&roomId=' + roomId + '&type=1&liveType='+'<?php echo $room['room']['OpenLiveType']; ?>' +'&liveUrl=' + liveUrl + '&scheme=' + '<?php echo $scheme; ?>' + '&host=' + '<?php echo $host; ?>'+'&uid='+uid+'&picture='+picture;
    if (imgFace != 0) {
        imgURL = imgFace;
    } else if (imgHead != 0) {
        imgURL = imgHead;
    }

    var jsApiList = [
        'onMenuShareTimeline', //分享到朋友圈
        'onMenuShareAppMessage',//分享到朋友
        'onMenuShareQQ',//分享到QQ
        'onMenuShareQZone'//分享到QQ空间
    ];



    $(function () {
        setImg();
        setIMayHeight();
        getWXData(wxURL, nick, desc, url + val, imgURL);
        loadPlay();
        $(".openIMay").click(function () {
            openApp(ifrSrc);
        });
    });
    setTimeout(getLive(), 1000);
    //查询主播直播是否已结束
    function getLive() {
        if (uid != '0') {
            $.post("<?php echo url('m/share/live'); ?>", {'uid': uid}, function (data) { //查询是否直播结束
                if (data.status == '1') { // 直播未结束就继续请求
                    setTimeout("getLive();", 10000);
                } else if (data.status == '2') { // 如果结束，则将提示浮在上面并将获取到的动态放到固定位置
                    $(".s-loading").hide();
                    $("#iMayPlay").hide();
                    $('.s-v-over').show(); // 显示直播已结束
                    if (data.type == '1') {
                        var src = "background: url('" + data.content + "') no-repeat";
                        $('.s-mid-video').find('div').attr('style', src); //显示最新动态图片
                    } else if (data.type == '2') {
                        var vedioUrl = "background: url('" + data.content + "?vframe/jpg/offset/0/w/450') no-repeat";
                        $('.s-mid-video').find('div').attr('style', vedioUrl); //显示最新动态图片
                    }
                } else { // 没有动态显示封面图或者头像图
                    $(".s-loading").hide();
                    $("#iMayPlay").hide();
                    $('.s-v-over').show(); // 显示直播已结束
                    if (imgFace != '0') {
                        $('.s-mid-video').find('img').attr('src', imgFace); //显示直播封面图
                    } else if (imgHead != '0') {
                        $('.s-mid-video').find('img').attr('src', imgHead); // 显示头像图
                    }
                }
            }, 'json');
        }
    }
</script>

<script type="text/javascript">
    var _hmt = _hmt || [];
    $(function () {

        var hm = document.createElement("script");
        hm.src = "//hm.baidu.com/hm.js?92271316ab45db908e0b6763467fea57";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
    })

</script>
</body>
</html>