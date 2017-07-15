<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:56:"/home/web/imay/application/user/view/recharge/index.html";i:1493117300;s:74:"/home/web/imay/application/user/view/../../common/view/default/header.html";i:1499155465;s:74:"/home/web/imay/application/user/view/../../common/view/default/footer.html";i:1489659878;s:73:"/home/web/imay/application/user/view/../../common/view/default/login.html";i:1492712428;}*/ ?>
<!DOCTYPE html>
<html lang="zh_CN">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>充值-iMay直播</title>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
    <meta name="viewport"
          content="width=device-width,initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no"/>
    <meta itemprop="name" content="iMay直播">
    <meta name="keywords" content="交友，直播，游戏，年轻，才艺，文艺，校花，电影，90后，00后，大学生，音乐，自由职业，网红，宅男，女神，潮流，时尚，男神，夜店，唱K，秀场，土豪，富二代"/>
    <meta name="description" itemprop="description"
          content="首款可以玩的时尚手机直播APP，极简的产品设计，集离线动态图文、视频等为一体的全新社交点赞模式。意外的邂逅，点亮陌生而并不陌生的社交关系网"/>
    <meta name="application-name" content="iMay直播"/>
    <meta name="msapplication-tooltip" content="iMay直播"/>
    <link type="text/css" rel="stylesheet" href="__PC_CSS__/common.css">
    <link type="text/css" rel="stylesheet" href="__PC_CSS__/default.css">
    <script type="text/javascript" src="__PUBLIC__/js/jquery.js"></script>
</head>
<body>
<!--头部信息-->
<header>
    <div id="header">
        <div class="h-con">
            <a href="/" class="logo"></a>
            <ul class="h-nav">
                <li>
                    <a href="/">官网</a>
                </li>
                <li>
                    <a href="<?php echo url('user/withdraw/index'); ?>">提现</a>
                </li>
                <li>
                    <a href="<?php echo url('user/recharge/index'); ?>">充值</a>
                </li>
                <li>
                    <a href="<?php echo url('index/game/index'); ?>" target="_blank">直播助手</a>
                </li>
                <script>
                    var curController = "<?php echo CONTROLLER_NAME; ?>".toLocaleLowerCase();
                    switch (curController) {
                        case 'recharge':
                            $(".h-nav").children().removeClass("nav-checked").eq(2).addClass("nav-checked")
                            break;
                        case 'withdraw':
                            $(".h-nav").children().removeClass("nav-checked").eq(1).addClass("nav-checked")
                            break;
                        default:
                            break;
                    }
                </script>
                <li>
                    <div class="h-l-r">
                        <?php if (empty($login['user'])) {  ?>
                        <div class="h-l-r">
                            <a class="h-log pop-login" href="javascript:;">登录</a>
                            <span>|</span>
                            <a class="pop-reg-a pop-login" href="javascript:;">注册</a>
                        </div>
                        <?php  } else {  ?>
                        <div class="g-r-i">
                            <img class="h-l-img" src="<?php echo (isset($login['user']['imgHead']) && ($login['user']['imgHead'] !== '')?$login['user']['imgHead']:'__IMG__/g-logo.png'); ?>">
                            <span class="g-l-m5"><?php echo (isset($login['user']['nick']) && ($login['user']['nick'] !== '')?$login['user']['nick']:''); ?></span>
                        </div>
                        <?php  }  ?>
                        <!-- 退出 -->
                        <?php if (empty($login['user'])) {   } else {  ?>
                        <div class="i-exit">
                            <a class="i-exit-a">退出</a>
                        </div>
                        <?php  }  ?>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</header>
<div class="g-wrap">
    <div class="g-con">
        <h3 class="g-h3-bg">魅钻充值</h3>
        <!-- 充值登录bar -->
        <div class="g-c-log">
            <div class="g-log-l">
                <div class="g-log-t">
                    <?php  if (empty($user)) {  ?>
                    <img class="g-l-img" src="__PC_IMG__/g-logo.png">
                    <div class="g-i-r">
                        <span class="g-l-m1">您还没有登录</span>
                        <span class="g-l-m2">登录后即可充值  <a href="javascript:;" class="g-m2-login pop-login">登录</a></span>
                    </div>
                    <?php  } else {   if (!empty($user['user']['imgHead'])) {  ?>
                    <img class="g-l-img" src="<?php echo $user['user']['imgHead']; ?>">
                    <?php  } else {  ?>
                    <img class="g-l-img" src="__PC_IMG__/g-logo.png">
                    <?php  }  ?>
                    <div class="g-i-r">
                        <span class="g-l-m3"><?php echo $user['user']['nick']; ?></span>
                        <span class="g-l-m4">魅号：<b><?php echo $user['user']['roomId']; ?></b></span>
                    </div>
                    <?php  }  ?>
                </div>
            </div>
            <div class="g-log-r">
                <?php  if (empty($user)) {  ?>
                <a href="javascript:;" class="imay-rc">魅号充值</a>
                <?php  } else {  ?>
                <a href="javascript:;" class="imay-sw-ac">切换账号</a>
                <?php  }  ?>

            </div>
        </div>
        <!-- 充值选择金额bar -->
        <div class="">
            <div class="g-c-tit">选择充值金额</div>
            <div class="g-c-log">
                <div class="g-log">
                    <ul class="g-rc-ul">
                        <?php if(is_array($recharge) || $recharge instanceof \think\Collection): $i = 0; $__LIST__ = $recharge;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <li class="rc-bg" value="<?php echo $i; ?>">
                            <?php if($recharge_id != 0): if(isset($user['user']['DiamondRecharge']) && $user['user']['DiamondRecharge']
                            == 0): ?>
                            <div class="rc-bg-s">
                                <a class="rc-s-a"></a>
                                <span class="re-s-txt">送<em><?php echo $vo['first_charge']; ?></em>钻</span>
                            </div>
                            <?php endif; endif; ?>
                            <span class="tc-m2">￥<b><?php echo $vo['rmb']; ?></b></span>
                            <span class="tc-m1"><b><?php echo $vo['diamond']; ?></b>钻</span>
                        </li>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </div>
                <!-- 大额支付 -->
                <div class="g-b-pay">
                    <input type="hidden" class="product_id" value="999">
                    <div class="rc-bg">
                        <span class="tip-message">自定义充值金额</span>
                        <span class="tc-m2"></span>
                        <span class="tc-m1"></span>
                    </div>
                    <div class="g-pay-i">
                        <input type="text" placeholder="请输入所需充值的金额" name="money" class="g-pay-d" maxlength="6"
                               onkeyup="if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,'')}else{this.value=this.value.replace(/\D/g,'')}"
                               onafterpaste="if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,'0')}else{this.value=this.value.replace(/\D/g,'')}"
                        >
                        <span>* 充值金额最低1元，最高可充值20万。首充可获10%魅钻返还。</span>
                    </div>
                </div>
                <div class="g-pay-qq">
                    <a href="http://wpa.b.qq.com/cgi/wpa.php?ln=2&uin=800811388" class="g-qq-a" target="_blank">
                        <img src="__PC_IMG__/pay02.jpg">
                    </a>
                </div>
            </div>
        </div>
        <!-- 充值支付方式 -->
        <div class="g-pay">
            <div class="g-pay-b">支付金额：<b>6</b>元</div>
            <div class="mei" style="display: none;">980</div>
            <div class="g-pay-t">
                <h6 class="g-pay-tit">支付平台：</h6>
                <div class="g-pay-set">
                    <div class="pay-t-c alipay" data-val="1">
                        <a class="g-alipay"></a>
                        <div class="pay-ckecked"></div>
                    </div>
                    <div class="pay-t-c wechat" data-val="2">
                        <a class="g-wechat"></a>
                        <div class="pay-ckecked"></div>
                    </div>
                </div>
            </div>
            <!-- 网银支付 -->
            <div class="g-pay-t">
                <h6 class="g-pay-tit">网上银行：</h6>
                <div class="g-pay-set">
                    <ul class="g-bank-ul">
                        <li data-val="3">
                            <div class="g-bank"></div>
                            <div class="g-bank-check"></div>
                        </li>
                        <li data-val="4">
                            <div class="g-bank"></div>
                            <div class="g-bank-check"></div>
                        </li>
                        <li data-val="5">
                            <div class="g-bank"></div>
                            <div class="g-bank-check"></div>
                        </li>
                        <li data-val="6">
                            <div class="g-bank"></div>
                            <div class="g-bank-check"></div>
                        </li>
                        <li data-val="7">
                            <div class="g-bank"></div>
                            <div class="g-bank-check"></div>
                        </li>
                        <li data-val="8">
                            <div class="g-bank"></div>
                            <div class="g-bank-check"></div>
                        </li>
                        <li data-val="9">
                            <div class="g-bank"></div>
                            <div class="g-bank-check"></div>
                        </li>
                        <li data-val="10">
                            <div class="g-bank"></div>
                            <div class="g-bank-check"></div>
                        </li>
                    </ul>
                    <div class="g-bank-mes">* 单笔最高50,000元，具体受限于银行卡网上支付限额</div>
                </div>
            </div>
            <div class="g-log-r">
                <?php if($recharge_id == 0): ?>
                <a id="imay-recharge-pay" style="cursor: pointer;" class="imay-pay-no">确认支付</a>
                <?php else: ?>
                <a id="imay-recharge-pay" style="cursor: pointer;" class="imay-pay">确认支付</a>
                <?php endif; ?>
                <div class="draw-agree draw-agree-a">
                    <input type="checkbox" name="userReg" class="draw-agree-i" id="userReg" checked>
                    <label for="userReg">我已阅读并同意<a href="<?php echo url('/about/recharge'); ?>"
                                                   target="_blank">《用户充值协议》</a></label>
                </div>
            </div>
        </div>
    
    </div>
    <div class="g-mask"></div>
    <!-- 限额3000 -->
    <div class="g-pop g-pop-a">
        <div class="pop-close"></div>
        <div class="pop-a-con">
            <span class="pop-a-txt">微信支付目前不支持单笔超过￥3000的充值业务</span>
            <div class="pop-a-but">
                <a class="pop-a-a" onclick="largeBtnClick()">调整金额</a><!--  pop-a-c1 -->
                <a class="pop-a-b pop-a-c2" onclick="aliPayBtnClick()">使用其它方式支付</a>
            </div>
        </div>
    </div>
    <!-- 支付订单确认 -->
    <div class="g-pop g-pop-a">
        <div class="pop-close" onclick="closeDialog_2()"></div>
        <div class="pop-a-con">
            <h5 class="pop-l-tit">支付订单</h5>
            <div class="pop-g-l">
                <div class="pop-l-info">
                    <label>充值：</label>
                    <span>7000魅钻</span>
                </div>
                <div class="pop-l-info">
                    <label>支付：</label>
                    <span class="pop-money">7200元</span>
                </div>
            </div>
            <div class="pop-l-mes">请在新打开的支付页面完成支付</div>
            <div class="pop-a-but">
                <a class="pop-a-a" onclick="uCardPayStatus(currentOrderid);
">支付完成</a><!--  pop-a-c1 -->
                <a class="pop-a-b pop-a-c2" href="<?php echo url('/about/connect'); ?>">遇到问题？</a>
            </div>
        </div>
    </div>
    <!--iMay充值-->
    <div id="g-pop" class="g-rc-pop">
        <div class="pop-close"></div>
        <div class="pop-con">
            <div class="g-rec-i">
                <h5>iMay号充值</h5>
                <ul class="pop-lg-ul">
                    <li>
                        <div class="pop-info">
                            <input class="imay-i0 imay-number" type="text" placeholder="输入暧魅号">
                            <span class="info-mes">魅号不能为空</span>
                        </div>
                    </li>
                </ul>
                <a href="javascript:;" class="imay-a0 imay-recharge">充值</a>
                <span class="p-l-error">魅号不存在或者魅号错误！</span>
            </div>
        </div>
    </div>

    <!-- 18岁提醒 -->
    <div class="g-pop g-pop-a recharge-tip" style="display: none;">
        <div class="pop-a-con">
            <span class="pop-a-txt txt-t1">您已成为我们的贵宾用户，为保证您的消费安全，请确认您已满18周岁。若您不满18周岁，
                请您告知监护人向本直播平台追认与同意后，再进行充值；若您存在不实确认行为，
                由此造成的一切法律后果与财产损失均由您与您的监护人自行承担。</span>
            <div class="pop-a-but">
                <a class="pop-a-a recharge-checked" style="cursor: pointer;" id="<?php echo $recharge_id; ?>">我已满18岁</a><!--  pop-a-c1 -->
                <a class="pop-a-b pop-a-c2"  style="cursor: pointer;" onclick="closeTip()">取消</a>
            </div>
        </div>
    </div>
</div>
<!--底部信息-->
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
<!--登录、注册、忘记密码-->

<!--登录、注册-->
<div class="g-pop g-login-pop">
    <div class="pop-close"></div>
    <div class="pop-con">
        <div class="pop-l-l">
            <a class="pop-reg-t pop-pouple pop-login">登录</a>
            <a class="pop-reg-a pop-login">注册</a>
        </div>
        <div class="pop-l-r">
            <!-- 登录 -->
            <div class="pop-tab-c">
                <ul class="pop-lg-ul">
                    <li style="display: none;">
                        <div class="pop-info">
                            <div class="pop-s-val login-country">
                                <input class="sc-val login-sc" value="中国86" placeholder="中国86">
                            </div>
                            <div class="pop-sel" id="secHide">
                                <ul class="pop-sec-ul">
                                    <?php if(is_array($country_code) || $country_code instanceof \think\Collection): $i = 0; $__LIST__ = $country_code;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                        <li value="<?php echo $vo['phone_code']; ?>"><?php echo $vo['country']; ?></li>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="pop-info">
                            <input class="login-phone phone" type="text" placeholder="输入手机号" maxlength="11">
                            <span class="info-mes">请输入正确的手机号码</span>
                        </div>
                    </li>
                    <li>
                        <div class="pop-info">
                            <input class="login-password password" type="password" placeholder="输入6-16位密码" maxlength="16">
                            <span class="info-mes">请输入正确的密码</span>
                        </div>
                    </li>
                    <li>
                        <a href="javascript:void (0)" class="imay-a0 imay-login">登录</a>
                        <span class="p-l-error">手机号或密码不正确！</span>
                    </li>
                    <li>
                        <a class="p-f-pass">忘记密码？</a>
                    </li>
                    <li>
                        <div class="pop-line">
                            <h5>社交账号快速登录</h5>
                            <div class="pop-line-c">
                                <a class="pop-wechat" style="display: none;" href="<?php echo $data['ConnectWX']; ?>"></a>
                                <a class="pop-qq" href="<?php echo $data['ConnectQQ']; ?>"></a>
                                <a class="pop-weibo" href="<?php echo $data['ConnectXL']; ?>"></a>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="draw-agree draw-agree-b">
                            <input type="checkbox" name="loginReg" class="draw-agree-i" id="userReg" checked>
                            <label for="userReg">我已阅读并同意<a href="<?php echo url('/about/privacyService'); ?>" target="_blank">《用户服务及隐私协议》</a></label>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="pop-tab-c">
                <ul class="pop-lg-ul">
                    <li style="display: none;">
                        <div class="pop-info">
                            <div class="pop-s-val secHide register-country">
                                <input class="sc-val register-sc" value="中国86" placeholder="中国86">
                            </div>
                            <div class="pop-sel" id="secHide">
                                <ul class="pop-sec-ul">
                                    <?php if(is_array($country_code) || $country_code instanceof \think\Collection): $i = 0; $__LIST__ = $country_code;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                        <li value="<?php echo $vo['phone_code']; ?>"><?php echo $vo['country']; ?></li>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="pop-info">
                            <input class="register-phone phone" type="text" placeholder="输入手机号" maxlength="11">
                            <span class="info-mes">请输入正确的手机号码</span>
                            <b style="display: none;" class="register-message">0</b>
                        </div>
                    </li>
                    <li class="info-code">
                        <div class="pop-info">
                            <input class="register-code public-code" type="text" placeholder="输入验证码">
                            <span class="info-mes">验证码不能为空</span>
                        </div>
                        <a class="getCode">获取验证码</a>
                        <a class="code_btn_dis"></a>
                    </li>
                    <li>
                        <div class="pop-info">
                            <input class="register-password password" type="password" placeholder="输入6-16位密码" maxlength="16">
                            <span class="info-mes">请输入正确的密码</span>
                        </div>
                    </li>
                    <li>
                        <a href="javascript:void(0)" class="imay-a0 iamy-register">确定</a>
                    </li>
                </ul>
            </div>
            <!-- 注册 -->
        </div>
    </div>
</div>

<!--忘记密码-->
<div class="g-pop g-forgot-password">
    <div class="pop-close"></div>
    <div class="pop-con">
        <div class="pop-l-l">
            <a class="pop-for-t pop-pouple pop-login">登录</a>
            <a class="pop-for-a pop-login">注册</a>
        </div>
        <div class="pop-l-r">
            <div class="pop-tab-f forget-tab">
                <ul class="pop-lg-ul">
                    <li style="display: none;">
                        <div class="pop-info">
                            <div class="pop-s-val forgot-country">
                                <input class="sc-val forget-sc" value="中国86" placeholder="中国86">
                            </div>
                            <div class="pop-sel" id="secHide">
                                <ul class="pop-sec-ul">
                                    <?php if(is_array($country_code) || $country_code instanceof \think\Collection): $i = 0; $__LIST__ = $country_code;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                        <li value="<?php echo $vo['phone_code']; ?>"><?php echo $vo['country']; ?></li>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="pop-info">
                            <input class="forgot-phone phone"  type="text" placeholder="输入手机号" maxlength="11">
                            <span class="info-mes">请输入正确的手机号码</span>
                            <b style="display: none;" class="forgot-message">0</b>
                        </div>
                    </li>
                    <li class="info-code">
                        <div class="pop-info">
                            <input class="forgot-code public-code" type="text" placeholder="输入验证码">
                            <span class="info-mes">验证码不能为空</span>
                        </div>
                        <a class="getCodes">获取验证码</a>
                        <a class="codes_btn_dis"></a>
                    </li>
                    <li>
                        <div class="pop-info">
                            <input class="forgot-password password" type="password" placeholder="输入6-16位密码" maxlength="16">
                            <span class="info-mes">请输入正确的密码</span>
                        </div>
                    </li>
                    <li>
                        <a href="javascript:void(0)" class="imay-a0 forget-password">确定</a>
                        <span class="p-l-error">手机号或密码不正确</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!--上传头像-->
<div class="g-pop g-upload-pop">
    <div class="pop-close"></div>
    <div class="pop-con">
        <div class="g-rec-i g-up-i">
            <div class="pop-u-t">
                <!-- 上传按钮 -->

                <iframe name="upload" style="display:none"></iframe>
                <form  id="uploadform_Filedata" autocomplete="off"  enctype="multipart/form-data" method="POST" target="upload" action="<?php echo url('user/recharge/uploadPic'); ?>">
                    <div class="pop-upload">
                        <div class="div1">
                            <input type="file" class="inputstyle" id="Filedata" name="Filedata" onchange="updfile('Filedata');"/>
                            <span class="info-mes">请上传头像！</span>
                        </div>
                        <div style="clear:both;"></div>
                        <input type="hidden" name="dir" value="ads">
                        <input type="hidden" name="width" value="1024">
                        <input type="hidden" name="folder" value="Filedata">
                        <input type="hidden" name="sfilename" value="Filedata">
                        <input type="hidden" name="fname" value="adFile">
                        <input type="hidden" id="s_Filedata" name="s_Filedata" value="">

                    </div>
                    <a class="pop-up-a"></a>
                    <div id="preview_Filedata" class="pop-up-img">
                        <img id='preview' src="">
                    </div>
                </form>
                <!---->
                <!-- 上传后头像 -->


            </div>
            <input class="country-register" type="hidden" >
            <input class="phone-register" type="hidden" >
            <input class="code-register" type="hidden" >
            <input class="password-register" type="hidden" >
            <div class="pop-info">
                <input class="imay-i0 nick" type="text" placeholder="请输入昵称">
                <span class="info-mes">请输入正确的昵称</span>
            </div>
            <a href="javascript:void (0)" class="imay-a0 submit-register" style="margin-top: 80px;">完成</a>
            <span class="p-l-error">注册失败！</span>
        </div>
    </div>
</div>
<script>
    var jumpPage         = "<?php echo url('/'.CONTROLLER_NAME.'/index'); ?>"; // 登录、注册完成重load的地址
    var upLoadPic        = "<?php echo url('user/recharge/qiNiuUploadPic'); ?>";
    var login            = "<?php echo url('user/login/login'); ?>"; // 登录地址
    var forgetPassword   = "<?php echo url('user/login/pcForgetPassword'); ?>"; // 忘记密码地址
    var register         = "<?php echo url('user/login/register'); ?>"; // 注册地址
    var verificationCode = "<?php echo url('user/login/pcVerificationCode'); ?>"; // 获取验证码地址
    var signOut          = "<?php echo url('user/login/signOut'); ?>"; // 退出登录地址
    var phoneCode        = "<?php echo url('user/login/phoneCode'); ?>"; // 手机区号搜索
    
    //有注册的地方就需要上传，需要上传就需要声明以下两个变量
    var ThinkPHP = window.Think = {
        "ROOT": "__ROOT__"
    };
    var filetypes = ["gif", "jpg", "png", "jpeg"];
</script>
<script type="text/javascript" src="__PUBLIC__/js/upload.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/login.js"></script>
<script type="text/javascript" src="__BJS__/bootstrap.min.js"></script>
<script type="text/javascript" src="__PJS__/plugins.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/common.js"></script>
<script type="text/javascript" src="__PUBLIC__/pc/js/g-index.js"></script>

<script type="text/javascript">
    //弹框1
    function showDialog_1() {
        $(".g-mask").show();
        var dialog = $(".g-pop-a").eq(0);
        dialog.show();
    }
    //弹框2
    function showDialog_2($diamond, $money) {
        $(".g-mask").show();
        var dialog = $(".g-pop-a").eq(1);
        dialog.find(".pop-l-info:eq(0) span").html($diamond + "魅钻");
        dialog.find(".pop-l-info:eq(1) span").html($money + "元");
        dialog.show();
        
        //修改确认支付按钮样式
        $("#imay-recharge-pay").removeClass("imay-pay").addClass("imay-pay-no").html("下单中");
    }
    
    function closeDialog_1() {
        $(".g-mask").hide();
        $(".g-pop-a").hide();
    }
    
    function closeDialog_2() {
        $(".g-mask").hide();
        $(".g-pop-a").hide();
        clearClock();
        //修改确认支付按钮样式
        $("#imay-recharge-pay").removeClass("imay-pay-no").addClass("imay-pay").html("确认支付");
    }
    
    function setClock(orderid, setClock) {
        currentClockId = setTimeout("uCardPayStatus(" + orderid + "," + setClock + ")", 5000);
    }
    function clearClock() {
        clearTimeout(currentClockId);
    }
    //获取UCard支付状态
    function uCardPayStatus(orderid, setClock) {
        var params = {
            orderid: orderid
        };
        $.ajax({
            type   : 'get',
            url    : '<?php echo url("m/recharge/uCardPayStatus"); ?>',
            data   : params,
            success: function (json) {
                var json = WST.toJson(json);
                console.log(json);
                if (json.status == 1) { //成功支付
                    location.href = "<?php echo url('user/recharge/successfulView'); ?>"
                } else {
                    if (setClock)
                        window.setClock(orderid, setClock);
                    else
                        location.href = "<?php echo url('user/recharge/unfinishView'); ?>";
                }
            }
        });
    }
    
    function checkRules($money, $payType) {
        $money   = getPayMoney();
        $payType = getPayType();
        
        if ($payType == 2 && $money > maxMoneyWxPay) { //微信支付
            showDialog_1();
            return;
        }
    }
    //获取要充值多少钱
    function getPayMoney() {
        return Number($('.g-pay-b').find('b').text());
    }
    //获取支付方式
    function getPayType() {
        return Number($("#linkChecked").data("val"))
    }
    function largeBtnClick() {
        //模拟大额支付按钮点击效果
        $(".g-b-pay .rc-bg").click();
        //修改大额金额
        $('.g-pay-d').val(maxMoneyWxPay).keyup();
        closeDialog_1();
    }
    function aliPayBtnClick() {
        //模拟支付宝支付按钮点击效果
        $(".pay-t-c").click();
        $(".g-alipay").click();
        
        closeDialog_1();
    }
    /**
     * 初始化支付方式
     */
    function initPayType() {
        $('.g-rc-ul li:first-child').addClass("tc-checked");
        $(".g-pay-b b").html($('.g-rc-ul li:first-child').find(".tc-m2 b").text());
        $(".mei").html($('.g-rc-ul li:first-child').find(".tc-m1 b").text());
    }
    
    // 关闭18岁提示
    function closeTip() {
        $('.recharge-tip').hide();
        $(".g-mask").hide();
    }
    
    //点击浏览器上一步/返回按钮时，将大额数据回写在金额魅钻框中
    function large() {
        var name  = $('.g-pay-d');
        var money = name.val();
        if (money) {
            $('.tip-message').hide();
            name.parents().parent('.g-b-pay').find('.tc-m2').html('￥' + money);
            name.parents().parent('.g-b-pay').find('.tc-m1').html(money * 10 + ' 钻');
            $(".g-pay-i").show();
        }
    }
    function newWin(url, id) {
        var a = document.createElement('a');
        a.setAttribute('href', url);
        a.setAttribute('target', '_blank');
        a.setAttribute('id', id);
        // 防止反复添加
        if (!document.getElementById(id)) {
            document.body.appendChild(a);
        }
        a.click();
    }
    var currentOrderid   = -1;
    var currentClockId   = -1;
    var wait          = 60;
    var recharge_id   = "<?php echo $recharge_id; ?>";
    var diamond       = "<?php echo $diamond; ?>";
    var rechargeSum   = "<?php echo $sum['sumRecharge']; ?>";
    var isAdult       = "<?php echo $sum['isAdult']; ?>";
    var maxMoneyWxPay = 3000;
    // 判断是否充值超过10000并且未确认已是成年人
    if (rechargeSum > 100000 && isAdult == 0) {
        $("#imay-recharge-pay").removeClass("imay-pay").addClass("imay-pay-no");
        $('.g-mask').show();
        $('.recharge-tip').show();
    }
    $(function () {
        initPayType();
        //点击确认支付
        $('.imay-pay').click(function () {
            checkRules();
            if ($('#imay-recharge-pay').hasClass('imay-pay-no')) {
                return;
            }
            var money = getPayMoney();
            if (!money) {
                return;
            }
            var obj = {
                diamond  : $('.mei').text(),
                subject  : $('.g-h3-bg').text(),
                uid      : '<?php echo $recharge_id; ?>',
                payClient: 3,
                money    : money
            };
            //获取充值项
            if ($('.g-b-pay .rc-bg').hasClass("tc-checked")) {
                obj.product_id = $('.product_id').val(); //默认product_id
            } else {
                obj.product_id = $('.tc-checked').val();
            }
            //获取支付方式
            var v = getPayType();
            if (v === 1) {
                obj.payment = 'zhifubao';
                $.post("<?php echo url('user/recharge/aliScanPay'); ?>", obj, function (json) {
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
                    if (json.status == '1') { // 支付宝支付
                        var url              = "<?php echo url('user/recharge/pay'); ?>";
                        var params           = "?no=" + json.out_trade_no + "&type=" + obj.payment;
                        window.location.href = url + params;
                    }
                }, "json");
            } else if (v === 2) {
                obj.payment = 'weixin';
                $.post("<?php echo url('user/recharge/wxScanPay'); ?>", obj, function (json) {
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
                    if (json.status == '1') { // 微信支付
                        var url              = "<?php echo url('user/recharge/pay'); ?>";
                        var params           = "?no=" + json.out_trade_no + "&type=" + obj.payment;
                        window.location.href = url + params;
                    }
                }, "json");
            } else {
                switch (v) {
                    case 3:
                        obj.type = 965;//中国建设银行
                        break;
                    case 4:
                        obj.type = 964;//中国农业银行
                        break;
                    case 5:
                        obj.type = 970;//招商银行
                        break;
                    case 6:
                        obj.type = 980;//民生银行
                        break;
                    case 7:
                        obj.type = 967;//中国工商银行
                        break;
                    case 8:
                        obj.type = 963;//中国银行
                        break;
                    case 9:
                        obj.type = 981;//交通银行
                        break;
                    case 10:
                        obj.type = 972;//兴业银行
                        break;
                    default:
                        break;
                }
                if (obj.type) {
                    //先修改按钮状态，防止多次请求
                    showDialog_2(obj.diamond, obj.money);
                    $.ajax({
                        type   : 'post',
                        url    : "<?php echo url('m/recharge/uCardPay'); ?>",
                        data   : obj,
                        success: function (json) {
                            var json = WST.toJson(json);
//                            console.log(json);
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
                                var data       = json.data;
                                currentOrderid = data.orderid;
//                                window.open(data.url);
                                newWin(data.url, "new-win");
                                //检测支付状态
                                uCardPayStatus(currentOrderid, 1);
                            } else {
                                alert("网络繁忙，请重新发起支付~");
                            }
                        }
                    });
                }
            }
            
        });
        
        //输入魅号框-点击充值
        $(".imay-recharge").click(function () {
            var room_id = $(".imay-number").val();
            if (!room_id || room_id.substring(0, 3) == '请输入') {
                $('.imay-number').parent().find(".info-mes").css("display", "block");
                return;
            }
            $.get("<?php echo url('user/login/getInfoSimpleByRoomId'); ?>", {'room_id': room_id}, function (data, textStatus) {
                var json = WST.toJson(data);
                if (json.status == '1') {
                    window.location.href = '<?php echo url("user/recharge/index"); ?>';
                } else {
                    $(".imay-recharge").siblings('.p-l-error').css("display", "block");
                }
            });
        });
        
        //取消协议勾选和重新勾选协议切换
        if (recharge_id != 0) {
            $('#userReg').click(function () {
                if ($('input:checkbox[name="userReg"]:checked').val() == 'on') {
                    $('#imay-recharge-pay').removeClass('imay-pay-no');
                    $('#imay-recharge-pay').addClass('imay-pay');
                } else {
                    $('#imay-recharge-pay').removeClass('imay-pay');
                    $('#imay-recharge-pay').addClass('imay-pay-no');
                }
            })
        }
        
        //勾选切换支付方式
        $('[name="pay"]:checked').trigger("click");

        // 确认已是成年人
        $('.recharge-checked').click(function () {
            var obj = {};
            obj.uid = $(this).attr('id');
            $.post("<?php echo url('user/recharge/tip'); ?>", obj, function (data) {
                var json = WST.toJson(data);
                if (json.errordesc) {
                    alert(WST.getErrorMsg(json.errordesc));
                    return;
                }
                if (json.status == '1') { // 18岁确认
                    $("#imay-recharge-pay").removeClass("imay-pay-no").addClass("imay-pay");
                    $('.g-mask').hide();
                    $('.recharge-tip').hide();
                } else {
                    alert("网络繁忙，请稍后再试~");
                }
            }, "json");
        });
        
        $('.g-pay-d').keyup(checkRules);
//        $('.g-pay-d').change(function(){
//            console.log("change");
//        });
        $(".g-rc-ul li").click(checkRules);
        $(".pay-t-c").click(checkRules)
    });
    large();
</script>
</body>
</html>