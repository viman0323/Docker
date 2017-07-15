<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:59:"/home/web/imay/application/m/view/capturemonster/index.html";i:1486463787;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="x5-fullscreen" content="true">
    <meta name="full-screen" content="yes">
    <title>碉堡了——360度全景AR直播，逼死处女座的游戏！</title>
    <script src="__JS__/bundle.js"></script>
</head>
<body>
<audio data-res-img="background-music" id="background-music" loop="loop"></audio>
<div class="page page-loading active" data-res-bg="bg">
    <div class="loading-wrapper">
        <div class="loading-container">
            <div class="text-hint">正在很努力地加载中啦，等等人家嘛</div>
            <div class="loading" id="loading-process">0</div>
        </div>
        <div class="go-to-live shining">进入直播间</div>
        <video data-res-img="live" id="video"></video>
    </div>
</div>
<div class="page page-welcome" data-res-bg="bg">
    <img alt="title" class="title" data-res-img="title">
    <img alt="girl" class="girl" data-res-img="girl">
    <img alt="start" id="start-button" data-res-img="button" class="button">
</div>
<div class="page page-introduce" data-res-bg="bg2">
    <div class="intro-box" data-res-bg="introBox">
        <div id="close-button">
            <img alt="close" data-res-img="close">
        </div>
        <span class="button active" id="huodong">
            <img alt="huodong" data-res-img="huodong">
        </span>
        <span class="button" id="paihang">
            <img alt="paihang" data-res-img="paihang">
        </span>
        <span class="button" id="jiangpin">
            <img alt="jiangpin" data-res-img="jiangpin">
        </span>
        <div class="content-container">
            <div class="content content-default">
                <img alt="tree" data-res-img="tree">
            </div>
            <div class="content content-huodong active">
                <div class="how-to-play">
                    <p>1、游戏开始后，以60s内射击水果数量决
                        定分数，火龙
                        果10分，其他为5分。</p>
                    <p>2、分数相同者以朋友圈分享次数越多者排
                        名越靠前。</p>
                    <p>3、活动期间不限挑战次数，以最高记录为
                        最终排名。</p>
                    <p>4、活动期间有机会获得imay限量坐骑。</p>
                    <p style="text-align: center;font-size: 14px;"><b>关闭窗口开始游戏。</b></p>
                </div>
                <div class="fruit">
                    <img alt="fruit" data-res-img="fruit">
                </div>
            </div>
            <div class="content content-paihang">
                <ol class="paihang"></ol>
            </div>
            <div class="content content-jiangpin">
                <div class="how-to-get-gift">
                    <img alt="content" data-res-img="jiangpinContent">
                </div>
                <div class="fruit">
                    <img alt="fruit" data-res-img="fruit">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="page page-game">
    <div id="container"></div>
    <div id="control">
        <div id="second">60</div>
        <div id="score">0</div>
        <div id="gun"></div>
    </div>
</div>
<div class="page page-over-1" data-res-bg="bg3">
    <div class="score-and-number">
        <img alt="score" data-res-img="score-and-number">
        <div class="score">0</div>
        <div class="number">1</div>
    </div>
    <div class="click-to-get">
        “恭喜你，成就<span id="grade">xx</span>射手，看你骨骼精奇，是练武奇才，送你一份惊天大礼物”<br/>
        <div style="display: block;text-align: center;">
            <span
                style="display:inline-block;background: #FFB136;width: 50%;height: 25px;border-radius: 10px">
            点击我领取GO
        </span>
        </div>
    </div>
    <div class="buttons">
        <img class="button try-again-button" alt="try-agian" data-res-img="try-again-button"><br>
        <img class="button paihangbang-button" alt="paihangbang" data-res-img="paihangbang-button"><br>
        <img class="button download-button" alt="download" data-res-img="xiazai-button">
    </div>
</div>
<div class="page page-over-2" data-res-bg="bg4">
    <div class="buttons">
        <img class="button try-again-button" alt="try-agian" data-res-img="try-again-button"><br>
        <img class="button paihangbang-button" alt="paihangbang" data-res-img="paihangbang-button"><br>
        <img class="button download-button" alt="download" data-res-img="shiyong-button">
    </div>
    <div class="modal-box-container">
        <div class="modal-box" data-res-bg="introBox">
            <img alt="modenghao" class="airplane">
            <div class="name">魔灯号</div>
            <img alt="close" data-res-img="close" class="close-button">
        </div>
    </div>
</div>
</body>
<script src="__JS__/jquery.js"></script>
<script src="__JS__/jweixin-1.0.0.js"></script>
<script>
    
    function incrShareNum(type, link) {
        var params  = {};
        params.type = type;
        params.link = link;
        $.ajax({
            type   : 'POST',
            url    : '<?php echo url("Capturemonster/incrShareNum"); ?>',
            data   : params,
            success: function (data, textStatus) {
                console.log(data);
                if (data.errormsg) {
                    alert(data.errormsg);
                }
            }
        });
    }
    
    function setShareUrl(title, desc, link, imgUrl) {
        //获取“分享到朋友圈”按钮点击状态及自定义分享内容接口
        wx.onMenuShareTimeline({
            title  : title,
            link   : link,
            imgUrl : imgUrl,
            trigger: function (res) {
                // 不要尝试在trigger中使用ajax异步请求修改本次分享的内容，因为客户端分享操作是一个同步操作，这时候使用ajax的回包会还没有返回
//                alert('用户点击分享到朋友圈');
            },
            success: function (res) {
//                alert('分享成功');
                incrShareNum(2, link);
            },
            cancel : function (res) {
//                alert('已取消');
            },
            fail   : function (res) {
                alert(JSON.stringify(res));
            }
        });
        //获取“分享给朋友”按钮点击状态及自定义分享内容接口
        wx.onMenuShareAppMessage({
            title  : title, // 分享标题
            desc   : desc, // 分享描述
            link   : link, // 分享链接
            imgUrl : imgUrl, // 分享图标
            type   : 'link', // 分享类型,music、video或link，不填默认为link
            dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
            success: function () {
                // 用户确认分享后执行的回调函数
//                alert("分享成功");
                incrShareNum(1, link);
            },
            cancel : function () {
                // 用户取消分享后执行的回调函数
            }
        });
        //获取“分享到QQ”按钮点击状态及自定义分享内容接口
        wx.onMenuShareQQ({
            title  : title, // 分享标题
            desc   : desc, // 分享描述
            link   : link, // 分享链接
            imgUrl : imgUrl, // 分享图标
            success: function () {
                // 用户确认分享后执行的回调函数
//                alert("分享成功");
                incrShareNum(3, link);
            },
            cancel : function () {
                // 用户取消分享后执行的回调函数
            }
        });
        //获取“分享到腾讯微博”按钮点击状态及自定义分享内容接口
        wx.onMenuShareWeibo({
            title  : title, // 分享标题
            desc   : desc, // 分享描述
            link   : link, // 分享链接
            imgUrl : imgUrl, // 分享图标
            success: function () {
                // 用户确认分享后执行的回调函数
//                alert("分享成功");
                incrShareNum(4, link);
            },
            cancel : function () {
                // 用户取消分享后执行的回调函数
            }
        });
        //获取“分享到QQ空间”按钮点击状态及自定义分享内容接口
        wx.onMenuShareQZone({
            title  : title, // 分享标题
            desc   : desc, // 分享描述
            link   : link, // 分享链接
            imgUrl : imgUrl, // 分享图标
            success: function () {
                // 用户确认分享后执行的回调函数
//                alert("分享成功");
                incrShareNum(5, link);
            },
            cancel : function () {
                // 用户取消分享后执行的回调函数
            }
        });
    }
    
    var jsApiList = [
        'onMenuShareTimeline', //分享到朋友圈
        'onMenuShareAppMessage',//分享到朋友
        'onMenuShareQQ',//分享到QQ
        'onMenuShareQZone',//分享到QQ空间
    ];
    $(function () {
        var params = {};
        params.url = location.href.split('#')[0];
        $.ajax({
            type   : 'POST',
            url    : '<?php echo url("Capturemonster/getJsapiTicket"); ?>',
            data   : params,
            success: function (data, textStatus) {
                if (data.errormsg) {
                    alert(data.errormsg);
                    return;
                }
//                alert(JSON.stringify(data));
//                console.log(data);
                //这里的配置见jsapi_ticket机制
                wx.config({
//                    debug    : true, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
                    appId    : data.appId, // 必填，公众号的唯一标识
                    nonceStr : data.nonceStr, // 必填，生成签名的随机串
                    timestamp: data.timestamp, // 必填，生成签名的时间戳
                    signature: data.signature,// 必填，签名，见附录1
                    jsApiList: jsApiList // 必填，需要使用的JS接口列表
                });
                
            }
        });
        
        wx.ready(function () {
//            alert('ready');
            wx.checkJsApi({
                jsApiList: jsApiList,
                success  : function (res) {
                    console.log(res);
                }
            });
            $.ajax({
                type   : 'POST',
                url    : '<?php echo url("Capturemonster/authorizeUrl"); ?>',
                data   : params,
                success: function (data, textStatus) {
                    console.log(data);
                    if (data.errormsg) {
                        alert(data.errormsg);
                    }
//                    alert(JSON.stringify(data));
                    if (data.status) {
                        var title  = data.title;//分享标题
                        var desc   = data.desc;//分享描述
                        var link   = data.link;//分享链接
                        var imgUrl = data.imgUrl;//头像
                        setShareUrl(title, desc, link, imgUrl);
                    }
                }
            })
            
        });
        wx.error(function (res) {
            // config信息验证失败会执行error函数，如签名过期导致验证失败，具体错误信息可以打开config的debug模式查看，也可以在返回的res参数中查看，对于SPA可以在这里更新签名。
            alert("网络繁忙，请重新打开页面~(jsapi)");
//            alert(JSON.stringify(res));
        });
    });
</script>
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