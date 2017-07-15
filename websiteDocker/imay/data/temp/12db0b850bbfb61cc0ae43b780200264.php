<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:53:"/home/web/imay/application/m/view/recharge/index.html";i:1493117300;s:64:"/home/web/imay/application/m/view/statistics/baiduStatistcs.html";i:1486463787;}*/ ?>
<!DOCTYPE html>
<html lang="zh_CN">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>iMay直播，可以玩的直播！</title>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
    <meta content="telephone=no" name="format-detection">
    <meta name="viewport"
          content="width=device-width,initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no"/>
    <link type="text/css" rel="stylesheet" href="__CSS__/m-common.css">
    <link type="text/css" rel="stylesheet" href="__CSS__/m-default.css">
    <script>
        var ThinkPHP = window.Think = {
            "ROOT": "__ROOT__",
            "IMG" : "__IMG__",
        };
    </script>
</head>
<body>
<header>
    <h1 class="m-pay-h1">充值账户</h1>
    <div class="m-pay-d1">
        <input type="hidden" id="user_id" value="<?php echo $user_id; ?>">
        <input type="hidden" id="open_id" value="<?php echo $open_id; ?>">
        
        <!-- 未登录 隐藏状态-->
        <?php if($user_id == 0): ?>
        <div class="m-pay-no" style="display: block">
            <input class="m-pay-i room_id" type="text" placeholder="输入魅号" maxlength="15">
            <a class="m-pay-a1">确认</a>
        </div>
        <?php else: ?>
        <div class="m-pay-yes">
            <?php if($user['user']['imgHead']): ?>
            <img src=<?php echo $user['user']['imgHead']; ?> class="m-user-img">
            <?php else: ?>
            <img src="__IMG__/img01.jpg" class="m-user-img">
            <?php endif; ?>
            <div class="g-i-r">
                <span class="g-l-m3"><?php echo $user['user']['nick']; ?></span>
                <span class="g-l-m4">魅号：<b><?php echo $user['user']['roomId']; ?></b></span>
            </div>
            <div class="m-l-r">
                <a class="m-tab-user" href="<?php echo url('recharge/switchAccount'); ?>">切换账号</a>
            </div>
        </div>
        <?php endif; ?>
    </div>
</header>
<article>
    <!-- 卡值选择 -->
    <section>
        <div class="m-pay-m">
            <ul class="m-pay-ul1">
                <?php if(is_array($recharge) || $recharge instanceof \think\Collection): $i = 0; $__LIST__ = $recharge;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;if($i == 1): ?>
                <li class="m-li-check" onclick="checkCanPay();">
                    <input type="hidden" class="product_id" value="<?php echo $i; ?>">
                    <input type="hidden" class="money" value="<?php echo $vo['rmb']; ?>">
                    <img src="__IMG__/pay02.png" class="m-li-i2">
                    <div class="m-pay-t1">
                        <div class="tc-m2">￥<b><?php echo $vo['rmb']; ?></b></div>
                        <div class="tc-m1"><b><?php echo $vo['diamond']; ?></b>钻</div>
                    </div>
                    <?php if ($user_id != 0) {  if (isset($user['user']['DiamondRecharge']) && $user['user']['DiamondRecharge'] == 0) {  ?>
                    <div class="m-pay-s">
                        <img src="__IMG__/m-pay-s.png" class="m-pay-i1">
                        <span class="re-s-txt">送<em><?php echo $vo['first_charge']; ?></em>钻</span>
                    </div>
                    <?php } } ?>
                </li>
                <?php else: ?>
                <li onclick="checkCanPay();">
                    <input type="hidden" class="product_id" value="<?php echo $i; ?>">
                    <input type="hidden" class="money" value="<?php echo $vo['rmb']; ?>">
                    <img src="__IMG__/pay01.png" class="m-li-i2">
                    <div class="m-pay-t1">
                        <div class="tc-m2">￥<b><?php echo $vo['rmb']; ?></b></div>
                        <div class="tc-m1"><b><?php echo $vo['diamond']; ?></b>钻</div>
                    </div>
                    <?php if ($user_id != 0) {  if (isset($user['user']['DiamondRecharge']) && $user['user']['DiamondRecharge'] == 0) {  ?>
                    <div class="m-pay-s">
                        <img src="__IMG__/m-pay-s.png" class="m-pay-i1">
                        <span class="re-s-txt">送<em><?php echo $vo['first_charge']; ?></em>钻</span>
                    </div>
                    <?php } } ?>
                </li>
                <?php endif; endforeach; endif; else: echo "" ;endif; ?>
            </ul>
            <!-- 大额支付 -->
            <div class="m-pay-z">
                <input type="hidden" class="product_id" value="999">
                <input type="hidden" class="money">
                
                <img src="__IMG__/pay01.png" class="m-li-i3">
                <div class="m-z-t1 m-z-bg" id="de-default" onclick="checkCanPay();">自定义充值</div>
                <!-- 填写大额后的样式 -->
                <div class="m-z-t1" id="de-user" style="display: none">
                    <div class="m-pay-t1">
                        <div class="tc-m2">￥<b></b></div>
                        <div class="tc-m1"><b></b>钻</div>
                    </div>
                </div>
                <div class="m-z-t2">
                    <input type="input" class="m-t2-i" placeholder="请输入所需充值的金额">
                    <span class="m-t2-t1">* 充值金额最低1元，最高可充值20万。首充可获10%魅钻返还。</span>
                </div>
            </div>
        </div>
    </section>
    <!-- 卡值方式选择 -->
    <section>
        <div class="m-pay-card">
            <!-- 支付宝支付 -->
            <div class="m-card-wechat zhifubao">
                <div class="m-card-l">
                    <img src="__IMG__/alipay01.jpg" class="m-card-img">
                    <div class="m-card-txt">
                        <span class="card-t1">支付宝支付</span>
                        <span class="card-t2">最高200,000元，秒到</span>
                    </div>
                    <div class="m-card-em">
                        <img src="__IMG__/w-icon02.png" class="m-icon01" id="iconCheck">
                    </div>
                </div>
            
            </div>
            <!-- 微信支付 -->
            <div class="m-card-wechat wechat" id="linkChecked">
                <div class="m-card-l">
                    <img src="__IMG__/wechat01.jpg" class="m-card-img">
                    <div class="m-card-txt">
                        <span class="card-t1">微信支付</span>
                        <span class="card-t2">最高3,000元，秒到</span>
                    </div>
                    <div class="m-card-em">
                        <img src="__IMG__/w-icon01.png" class="m-icon01">
                    </div>
                </div>
            
            </div>
        </div>
        <!--<div class="m-card-mes">-->
            <!--该功能即将推出，使用微信支付用户可添加官方公众号（搜索“iMay服务中心”）进行充值。-->
        <!--</div>-->
    </section>
    <!-- 其他购买方式 -->
    <section>
        <div class="g-buy">
            <h5>其他购买方式</h5>
            <div class="g-buy-c">
                <a href='<?php echo url("recharge/guide"); ?>' class="g-buy-go">
                    <img src="__IMG__/iMay.png" class="iMayLogo">
                    <div class="m-card-txt">
                        <span class="card-t1">官网充值</span>
                        <span class="card-t2">需要登录电脑网页操作，支持银联支付，单笔最高5万</span>
                    </div>
                    <img src="__IMG__/w-pre.png" class="w-go-i">
                </a>
            </div>
            <div class="g-buy-c g-link">
                <a href="<?php echo url('recharge/largeVip'); ?>" class="g-buy-go">
                    <img src="__IMG__/vip.png" class="iMayLogo">
                    <div class="m-card-txt">
                        <span class="card-t1">VIP充值</span>
                        <span class="card-t2">VIP通道，官方客服为您服务，单笔充值金额5万以上</span>
                    </div>
                    <img src="__IMG__/w-pre.png" class="w-go-i">
                </a>
            </div>
        </div>
    </section>
    <section>
        <div class="m-pay-but">
            <!-- 不可以支付时a标签样式pay-but-no 删除pay-but-yes-->
            <a id="confirm-pay" href="javascript:void(0)" class="pay-but-a pay-but-no">确认支付</a>
            <div class="tx-p-t1">
                <div class="draw-agree">
                    <input type="checkbox" class="draw-agree-i" id="userReg" checked>
                    <label for="userReg">我已阅读并同意<a href="<?php echo url('about/recharge'); ?>">《用户充值协议》</a></label>
                </div>
            </div>
        </div>
    </section>
    <!-- 遮罩层 -->
    <section>
        <div class="g-mask"></div>
        <img src="__IMG__/loading.gif" class="g-loading">
    </section>
    <!-- 支付成功弹出框 -->
    <section>
        <div id="mPop" class="m-pop">
            <div class="pop-c-d" onclick="location.href='<?php echo url('recharge/index'); ?>'">
                <img src="__IMG__/m-close.png" class="m-pop-close">
            </div>
            <div class="sus-txt-d">
                <img src="__IMG__/pay-s.png" class="m-pop-sus">
                <span class="sus-txt">支付成功！</span>
            </div>
        </div>
    </section>
    <section>
        <div class="iMay-mes-pop">
            <div class="iMay-mes-top">
                <span class="iMay-s2">支付未完成</span>
            </div>
            <div class="iMay-mes-but">
                <span>重试</span>
            </div>
        </div>
    </section>
    <section>
        <div class="mes-pop" id="check-your-account">
            <span>请确认您的充值账号信息是否正确</span>
            <a class="mes-close">确定</a>
        </div>
    </section>
    <section>
        <div class="mes-pop" id="wxPay-exceed">
            <span>微信支付目前暂不支持单笔超过￥3000充值业务</span>
            <div class="mes-but">
                <a class="mes-but-a" onclick="largeBtnClick()">调整金额</a>
                <a class="mes-but-b mes-nut-check" onclick="aliPayBtnClick()">使用支付宝支付</a>
            </div>
        </div>
    </section>
    <section>
        <div class="mes-pop" id="recharge-tips" style="display: none;">
            <span class="m-pop-t1">您已成为我们的贵宾用户，为保证您的消费安全，请确认您已满18周岁。若您不满18周岁，
                请您告知监护人向本直播平台追认与同意后，再进行充值；若您存在不实确认行为，
                由此造成的一切法律后果与财产损失均由您与您的监护人自行承担。</span>
            <div class="mes-but">
                <a class="mes-but-a mes-checked" id="<?php echo $user_id; ?>">我已满18岁</a>
                <a class="mes-but-b mes-nut-check" onclick="closeTips()">取消</a>
            </div>
        </div>
    </section>
</article>
<!-- 微信提示 -->
<div class="m-wechat-mes">
    <div class="g-mask" id="iMask"></div>
    <div class="i-m-txt">
        <div class="m-i-w">
            <span>点击这里选择“在浏览器中打开”</span>
            <!--<span>体验更多互动!!!</span>-->
        </div>
        <div class="m-i-ar">
            <img src="__IMG__/m-img04.png">
        </div>
    </div>
</div>
<script type="text/javascript" src="__JS__/jquery.js"></script>
<script type="text/javascript" src="__JS__/m-index.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/common.js"></script>
<script type="text/javascript" src="__PUBLIC__/plugins/plugins.js"></script>
<script>
    $(document).ajaxStart(function () {
        showFlower();
    }).ajaxComplete(function () {
        closeFlower();
    });
    function closeTips() {
        $('.mes-pop').hide();
        $('.g-mask').hide();
    }
    function showFlower() {
        $(".g-loading").show();
        $(".g-mask").show();
    }
    function closeFlower() {
        $(".g-loading").hide();
        $(".g-mask").hide();
    }
    function showDialog_1() {
        $(".m-wechat-mes").show();
        $(".g-mask").show();
    }
    //支付成功的弹框
    function showDialog_2() {
        $("#mPop").show();
        $(".g-mask").show();
    }
    //微信支付超过3000元
    function showDialog_3() {
        $("#wxPay-exceed").show();
        $(".g-mask").show();
    }
    
    function closeDialog_1() {
        $(".m-wechat-mes").hide();
        $(".g-mask").hide();
    }
    
    function closeDialog_3() {
        $("#wxPay-exceed").hide();
        $(".g-mask").hide();
    }
    //判断是否为微信
    function isWechat() {
        var ua = navigator.userAgent.toLowerCase();
        if (ua.match(/MicroMessenger/i) == "micromessenger") {
            return true;
        } else {
            return false;
        }
    }
    //获取支付类型
    function getPayType() {
        var checkEle = $("#linkChecked");
        if (checkEle.hasClass("zhifubao")) {
            if (isWechat()) { //支付宝支付，微信浏览器
                return 0;
            } else { //支付宝支付,手机浏览器
                return 1;
            }
        } else {
            if (isWechat()) { //微信支付，微信浏览器
                return 2;
            } else { //微信支付，手机浏览器
                return 3;
            }
        }
    }
    //获取支付金额
    function getPayMoney() {
        return Number($(".m-li-check .money").val())
    }
    /**判断浏览器非微信端**/
    function not() {
        if (!isWechat()) {
            closeDialog_1();
            $(".m-card-wechat").attr("id", "");
            $(".m-card-wechat").eq(0).attr("id", "linkChecked");
            $(".m-icon01").each(function () {
                if ($(this).attr("id")) {
                    $(this).attr("id", "");
                    $(this).attr("src", ThinkPHP.IMG + "/w-icon01.png")
                } else {
                    $(this).attr("src", ThinkPHP.IMG + "/w-icon02.png");
                    $(this).attr("id", "iconCheck");
                }
            })
        }
    }
    
    function aliPay(params) {
        $.ajax({
            type   : 'POST',
            url    : '<?php echo url("recharge/aliPay"); ?>',
            data   : params,
            success: function (data, textStataus) {
                var json = WST.toJson(data);
                if (json.errordesc) {
                    if (json.errordesc == 'user exist UserBlacklist') {
                        var room_id = "<?php echo $room_id; ?>";
                        var content = "您所充值的账号（魅号：" + room_id + "）已被冻结，请联系官方客服QQ：800811388";
                        alert(WST.getErrorMsg(content));
                        return;
                    } else {
                        alert(WST.getErrorMsg(json.errordesc));
                        return;
                    }
                }
                if (json.status == 1) {
                    document.write(json.data);
                } else {
                    alert("网络繁忙，请稍后再试~");
                }
            }
        })
    }
    
    function wxPay(params) {
        $.ajax({
            type   : 'post',
            url    : '<?php echo url("recharge/wxJsApiPay"); ?>',
            data   : params,
            success: function (data, textStatus) {
                var json = WST.toJson(data);
//                    alert(JSON.stringify(params));
//                    alert(JSON.stringify(json));
                if (json.errordesc) {
                    if (json.errordesc == 'user exist UserBlacklist') {
                        var room_id = "<?php echo $room_id; ?>";
                        var content = "您所充值的账号（魅号：" + room_id + "）已被冻结，请联系官方客服QQ：800811388";
                        alert(WST.getErrorMsg(content));
                        return;
                    } else {
                        alert(WST.getErrorMsg(json.errordesc));
                        return;
                    }
                }
                if (json.status == 1) {
                    wxJsApiCall(json.data.jsapi_str);
                } else {
                    alert("网络繁忙，请稍后再试~");
                    return;
                }
            }
        });
    }
    
    //调用微信jsAPI 支付
    function wxJsApiCall(params) {
//        alert(JSON.stringify(params));
        params   = JSON.parse(params);
        var data = {
            "appId"    : params.appId,             //公众号名称，由商户传入
            "timeStamp": String(params.timeStamp),     //时间戳，自1970年以来的秒数
            "nonceStr" : params.nonceStr,      //随机串
            "package"  : params.package,
            "signType" : params.signType,      //微信签名方式：
            "paySign"  : params.paySign        //微信签名
        };
        WeixinJSBridge.invoke(
            'getBrandWCPayRequest',
            data,
            function (res) {
                if (res.err_msg == "get_brand_wcpay_request:ok") {
                    showDialog_2();
                } else {
                    $(".g-mask").show();
                    $(".iMay-mes-pop").show();
                }
            }
        );
    }
    
    function uCardPay($params) {
        $params.type        = 1006;
        $params.hrefbackurl = "<?php echo $sync_url; ?>";
        $.ajax({
            type   : 'post',
            url    : "<?php echo url('recharge/uCardPay'); ?>",
            data   : $params,
            success: function (json) {
                var json = WST.toJson(json);
                if (json.errordesc) {
                    if (json.errordesc == 'user exist UserBlacklist') {
                        var room_id = "<?php echo $room_id; ?>";
                        var content = "您所充值的账号（魅号：" + room_id + "）已被冻结，请联系官方客服QQ：800811388";
                        alert(WST.getErrorMsg(content));
                        return;
                    } else {
                        alert(WST.getErrorMsg(json.errordesc));
                        return;
                    }
                }
                if (json.status == 1) {
                    var data      = json.data;
                    location.href = data.url;
                } else {
                    alert("网络繁忙，请稍后再试~");
                }
            }
        });
    }
    
    //点击充值按钮
    function payConfirm() {
        if ($(this).hasClass("pay-but-no")) {
            return;
        }
        var params        = {};
        params.money      = getPayMoney();
        params.subject    = "魅钻充值";
        params.product_id = $(".m-li-check .product_id").val();
        params.uid        = $("#user_id").val();
        params.openid     = $("#open_id").val();
        
        if (isWechat()) {
            params.payClient = 5;
        } else {
            params.payClient = 4;
        }
        
        //充值流程
        $payType = getPayType();
        switch ($payType) {
            case 0:
                showDialog_1();
                break;
            case 1:
                aliPay(params);
                break;
            case 2:
                wxPay(params);
                break;
            case 3:
//                if (checkCanWxPay()) {
//                    uCardPay(params);
//                } else {
                    alert('使用微信支付用户可添加官方公众号(搜索"iMay服务中心")进行充值')
//                }
                break;
            default:
                alert("请选择支付方式!");
        }
    }
    
    /**
     * 是否点亮确认支付按钮
     * */
    function checkCanPay() {
        var isLogin      = Number($("#user_id").val());
        var isRead       = $("#userReg").prop("checked");
        var isMoneyRight = Number($(".m-li-check .money").val());
        
        //判断是否登录状态
        if (isLogin && isRead && isMoneyRight) {
            $("#confirm-pay").removeClass("pay-but-no").addClass("pay-but-yes");
        } else {
            $("#confirm-pay").addClass("pay-but-no").removeClass("pay-but-yes");
        }
    }
    //超过多少钱不能进行微信支付
    function checkRules() {
        $money   = getPayMoney();
        $payType = getPayType();
        
        if (($payType == 2 || $payType == 3) && $money > maxMoneyWxPay) { //微信支付
            showDialog_3();
            return;
        }
    }
    /**
     * 检查输入的金钱是否有问题
     * */
    function checkMoney() {
        var val    = Number($(this).val());
        var MaxVal = 200000;
        var MinVal = 1;
        if (val < MinVal) {
            val = 0;
            $(this).val("");
            
        }
        if (val > MaxVal) {
            val = MaxVal
            $(this).val(val);
        }
        if (val <= 0) {
            $("#de-user").hide();
            $("#de-default").css("display", "block");
        } else {
            $("#de-user").show();
            $("#de-default").css("display", "none");
        }
        
        $("#de-user .tc-m2 b").html(val);
        $("#de-user .tc-m1 b").html(val * 10);
        $(".m-li-check .money").val(val);
        checkRules();
        checkCanPay();
    }
    
    function getInfoSimpleByRoomId(room_id, needAlert) {
        var params    = {
            room_id: room_id
        }
        var urlParams = needAlert ? "?needAlert=1" : "?needAlert=0";
        if (checkCanWxPay()) {
            urlParams += "&wp=1";
        }
        $.ajax({
            type   : 'get',
            url    : "<?php echo url('login/getInfoSimpleByRoomId'); ?>",
            data   : params,
            success: function (data) {
                var json = WST.toJson(data);
                //console.log(json);
                if (json.status == '1') {
                    location.href = "<?php echo url('recharge/index'); ?>" + urlParams;
                } else {
                    if (json.errordesc) {
                        alert("登录失败," + WST.getErrorMsg(json.errordesc));
                    } else {
                        alert("登录失败");
                    }
                }
            }
        });
    }
    
    //自动登录
    function checkAutoSignIn() {
        var curUrl = location.href;
        var reg    = /room\/(\d+)/i;
        if ((ret = curUrl.match(reg)) && ret.length >= 2) {
//            alert(ret[1]);
            getInfoSimpleByRoomId(ret[1], 1);
        }
    }

    //检查是否可以微信支付
    function checkCanWxPay() {
        var curUrl = location.href;
        var reg    = /wp[\/=](\d+)/i;
        if ((ret = curUrl.match(reg)) && ret.length >= 2) {
            if (ret[1] == 1) {
                return true;
            }
        }
        return false;
    }
    
    //是否需要弹框
    function checkNeedAlert() {
        var needAlert = Number('<?php echo $needAlert; ?>');
        switch (needAlert) {
            case 1:
                setTimeout(function () {
                    $(".g-mask").show();
                    $("#check-your-account").show();
                }, 0);
                break;
            case 2:
                showDialog_2();
                break;
        }
    }
    //模拟点击大额充值按钮
    function largeBtnClick() {
        $(".m-pay-z").trigger("touchstart");
        $(".m-t2-i").val(maxMoneyWxPay).trigger("input");
        closeDialog_3()
    }
    //模拟支付宝支付按钮点击效果
    function aliPayBtnClick() {
        $(".m-pay-card .m-card-wechat.zhifubao").trigger("touchstart");
        closeDialog_3()
    }
    /**
     * 手机端限制只能输入数字
     */

    function isNumWap(event) {
        if (/[^\d]/.test(this.value)) {
            this.value = this.value.replace(/[^1-9]/g, '');
        }
    }
    
    var maxMoneyWxPay = 3000;
    var rechargeSum   = "<?php echo $sum['sumRecharge']; ?>";
    var isAdult       = "<?php echo $sum['isAdult']; ?>";
    if (rechargeSum > 100000 && isAdult == 0) {
        setTimeout('sum()', 50);
    }
    // 判断是否充值超过10000并且未确认已是成年人
    function sum() {
        $("#confirm-pay").removeClass("pay-but-yes").addClass("pay-but-no");
        $(".g-mask").show();
        $('#recharge-tips').show();
    }

    $(function () {
        $(".m-pay-card .m-card-wechat.wechat").on("touchstart", checkRules);
        $(".m-pay-ul1 li").on("touchstart",checkRules);
        $("#userReg").click(checkCanPay);
        $(".m-t2-i").on("keyup input valuechange afterpaste",isNumWap)
        $(".m-t2-i").on("input valuechange", checkMoney)
        //确认支付
        $("#confirm-pay").click(WST.throttle(payConfirm, 1000));
        //确认登录
        $(".m-pay-a1").on("click", function () {
            var room_id = $(".m-pay-i").val();
            if (!room_id) {
                alert('请输入魅号!');
                return;
            }
            getInfoSimpleByRoomId(room_id);
        });
        
        not();
        
        $(".iMay-mes-but").click(function () {
            $(this).parent().hide();
            $(".g-mask").hide();
        });
        checkCanPay();
        checkAutoSignIn();

        // 确认已是成年人
        $('.mes-checked').click(function () {
            var params = {
                uid : $(this).attr('id')
            };
            $.ajax({
                type   : 'POST',
                url    : '<?php echo url("recharge/tips"); ?>',
                data   : params,
                success: function (data, textStataus) {
                    var json = WST.toJson(data);
                    if (json.errordesc) {
                        alert(WST.getErrorMsg(json.errordesc));
                        $('#recharge-tips').hide();
                        return;
                    }
                    if (json.status == 1) {
                        $("#confirm-pay").removeClass("pay-but-no").addClass("pay-but-yes");
                        $(".g-mask").hide();
                        $('#recharge-tips').hide();
                    } else {
                        alert("网络繁忙，请稍后再试~");
                    }
                }
            })
        });
    });
    window.addEventListener('load', function () {
        checkNeedAlert();
    })

</script>
</body>
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