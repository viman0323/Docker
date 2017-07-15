<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:56:"/home/web/imay/application/user/view/withdraw/index.html";i:1499140722;s:74:"/home/web/imay/application/user/view/../../common/view/default/header.html";i:1499155465;s:74:"/home/web/imay/application/user/view/../../common/view/default/footer.html";i:1489659878;s:73:"/home/web/imay/application/user/view/../../common/view/default/login.html";i:1492712428;}*/ ?>
<!DOCTYPE html>
<html lang="zh_CN">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>提现-iMay直播</title>
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
    <style>
        .m-tip {
            width: 278px;
            display: block;
            text-align: left;
            line-height: 15px;
            color: green;
            font-size: 8px;
            font-weight: bold;
        }
    </style>
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
        <a class="g-h3-ic"></a>
        <h3 class="g-h3-bg">兑换收益</h3>
        <!-- 充值登录bar -->
        <div class="g-c-log">
            <div class="g-log-l">
                <div class="g-log-t">
                    <?php if($accessCode == '0'): ?>
                    <img class="g-l-img" src="__PC_IMG__/g-logo.png">
                    <div class="g-i-r">
                        <span class="g-l-m1">您还没有登录</span>
                        <span class="g-l-m2">登录后才能提现  <a href="javascript:;" class="g-m2-login pop-login">登录</a></span>
                    </div>
                    <?php else: ?>
                    <img class="g-l-img" src="<?php echo (isset($login['user']['imgHead']) && ($login['user']['imgHead'] !== '')?$login['user']['imgHead']:'__PC_IMG__/g-logo.png'); ?>">
                    <div class="g-i-r i-r-a" style="display: block">
                        <span class="g-l-m3"><?php echo (isset($login['user']['nick']) && ($login['user']['nick'] !== '')?$login['user']['nick']:''); ?></span>
                        <span class="g-l-m4">魅号：<b><?php echo (isset($login['user']['roomId']) && ($login['user']['roomId'] !== '')?$login['user']['roomId']:0); ?></b></span>
                        <div class="g-l-m6">
	                                <span class="g-m6-a">实名认证：
                                        <?php  if(isset($withdrawInfo['realNameVerify']) && $withdrawInfo['realNameVerify']) {  ?>
                                        <b class="g-m6-settle">已认证</b>
                                        <?php  } else {  ?>
                                        <b class="">未认证</b>
                                        <?php  }  ?>
	                                </span>
                            <span class="g-m6-a">绑定手机：
                                <?php  if(isset($withdrawInfo['bindPhone']) && $withdrawInfo['bindPhone']) {  ?>
                                <b class="g-m6-settle">已绑定</b>
                                <?php  } else {  ?>
                                <b class="">未绑定</b>
                                <?php  }  ?>
                            </span>
                            <span class="g-m6-a"> 结算方式：
                                <?php  if(isset($withdrawInfo['signConfirmStatus']) && $withdrawInfo['signConfirmStatus']) {  ?>
                                <b class="g-m6-settle">已确认</b>
                                <?php  } else {  ?>
                                <b class="">未确认</b>
                                <?php  }  ?>
                            </span>
                            <span class="g-m6-b">提现账号：
                                <?php  if(isset($withdrawInfo['alipayAccount']) && $withdrawInfo['alipayAccount']) {  ?>
                                <b class="g-m6-b1"><?php echo $withdrawInfo['alipayAccount']; ?></b>
                                <?php  } else {  ?>
                                <b class="g-m6-b1" style="color: #eb2525">未有帐号</b>
                                <?php  }  ?>
                             <input name="alipay_account" type="hidden"
                                    value="<?php echo (isset($withdrawInfo['alipayAccount'] ) && ($withdrawInfo['alipayAccount']  !== '')?$withdrawInfo['alipayAccount'] :''); ?>" maxlength="25">
                            </span>
                            <input name="alipay-account" type="hidden"
                                   value="<?php echo (isset($withdrawInfo['alipayAccount']) && ($withdrawInfo['alipayAccount'] !== '')?$withdrawInfo['alipayAccount']:''); ?>" maxlength=11
                                   onkeypress="return WST.isNumberKey(event)">
                            <a class="g-m6-edit" onclick="dialogChangeAccount();">
                                <?php 
                                if( isset($withdrawInfo['alipayAccount']))
                                echo '更改';
                                else
                                echo '设定';
                                 ?>
                            </a>
                        </div>
                        <div class="g-l-m7">
                            请去APP中进行实名认证、绑定手机号以及确认结算方式！
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php if($accessCode != '0'): ?>
            <div class="g-log-r">
                <!--<a href="#" class="imay-rc"></a>-->
                <a href="javascript:void(0)" class="imay-sw-ac pop-login">切换账号</a>
            </div>
            <?php endif; ?>
        </div>
        <!-- 魅力余额 -->
        <div class="g-m-con">
            <div class="g-c1-a">
                <div class="g-m-l">
                    <div class="gl-d1">
                        <span class="g-c1-t1">魅力余额</span>
                        <span class="g-c1-t2"><b class="meile-v"><?php echo (isset($withdrawInfo['meili']) && ($withdrawInfo['meili'] !== '')?$withdrawInfo['meili']:"0"); ?></b></span>
                    </div>
                </div>
                <div class="g-line"></div>
                <div class="g-m-r">
                    <span class="g-c1-t1">可兑换收益</span>
                    <span class="g-c1-t2"><b class="meili-enable"><?php echo (isset($withdrawInfo['meili_money']) && ($withdrawInfo['meili_money'] !== '')?$withdrawInfo['meili_money']:"0"); ?></b>元</span>
                </div>
            </div>
        </div>
        <!-- 输入提现魅力： -->
        <div class="g-t-con">
            <div class="gt-t">
                <label>输入提现魅力：</label>
                <div class="pop-info">
                    <input name="meili" type="text" placeholder="请输入大于300魅力的数量"
                           onkeypress="return WST.isNumberKey(event)" maxlength=15>
                    <!--onkeyup="this.value=this.value.replace(/\D/g,'')"-->
                    <!--onafterpaste="this.value=this.value.replace(/\D/g,'')"-->
                    <?php if($withdrawInfo['hasDouble'] > 0){  ?>
                    <span class="p-l-dobule m-tip">*您有双倍卡，提现比例60%</span>
                    <?php  }  ?>
                    <span class="p-l-error">请输入大于300魅力的数量</span>
                </div>
                <span class="gt-t-t1">到账金额：<b name="s_money">0</b></span>
                <input name="money" type="hidden">
            </div>
            <div class="gt-but">
                <a href="javascript:void(0)" class="imay-pay" onclick="javascript:dialogConfirmAlipay();"
                   style="display: none;">提现</a>
                <a href="javascript:void(0)" class="imay-pay-no">提现</a>
                <div class="draw-agree">
                    <input type="checkbox" class="draw-agree-i" id="userReg" checked>
                    <label for="userReg">我已阅读并同意<a href="<?php echo url('/about/exchange'); ?>" target="_blank">《用户兑换协议》</a></label>
                </div>
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

<div class="g-mask" style="display: none;"></div>
<!-- 输入支付宝账号 -->
<div class="g-pop alipay-pop" style="display:none">
    <div class="pop-close"></div>
    <div class="alipay-p-con">
        <ul class="pop-lg-ul" style="margin-top: 60px;">
            <li>
                <h5 class="ali-p-t1">输入支付宝账号</h5>
            </li>
            <li>
                <div class="pop-info">
                    <input class="alipay-phone" type="text" placeholder="输入手机号"
                           onkeyup="this.value=this.value.replace(/\D/g,'')"
                           onafterpaste="this.value=this.value.replace(/\D/g,'')" maxlength=11>
                    <span class="info-mes">手机号不能为空</span>
                </div>
            </li>
            <li class="info-code" style="display: none;">
                <div class="pop-info">
                    <input class="apipay-code" type="text" placeholder="输入验证码">
                    <span class="info-mes">验证码不能为空</span>
                </div>
                <a class="chang-alip-getCode getCode">获取验证码</a>
                <a class="code_btn_dis" style="display: none">0</a>
            </li>
            
            <li style="display: none;">
                <div class="pop-info">
                    <input type="text" placeholder="输入6-16位密码">
                    <span class="info-mes">密码不能为空</span>
                </div>
            </li>
            <li>
                <a href="javascript:void (0)" class="imay-a0 alipay-ok">确定</a>
                <span class="p-l-error">编辑提现帐号失败！</span>
            </li>
            <li class="iMay-mes">
                注意：请仔细确认支付宝账号(打开支付宝在“我的-个人中心-个人主页”查看）和实名认证的姓名是否一致，否则提现操作都将失败
            </li>
        </ul>
    </div>
</div>
<!-- 提取确认信息 -->
<div class="g-pop alipay-detail-pop" style="display: none;">
    
    <div class="pop-close"></div>
    <div class="alipay-p-con">
        <ul class="pop-ad-ul">
            <li>
                <h5 class="ali-p-t1">确认信息</h5>
            </li>
            <li>
                <span>提现支付宝账户：<b class="ali-b-account">0</b></span>
            </li>
            <li class="info-code">
                <span class="ali-p-t2">提现魅力： <b class="ali-b-meili">0</b></span>
            </li>
            <li>
                <span class="ali-p-t3"> 到账金额：<b class="ali-b-money">0</b></span>
            </li>
            <li>
                <div class="ali-but">
                    <a class="ali-but-a">放弃</a>
                    <a class="ali-but-b">确定</a>
                </div>
                <div class="ali-mes">
                    <span class="info-mes" style="display: none;">提现失败</span>
                </div>
            </li>
        </ul>
    </div>
</div>
<script type="text/javascript" src="__BJS__/bootstrap.min.js"></script>
<script type="text/javascript" src="__PJS__/plugins.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/common.js"></script>
<script type="text/javascript" src="__PUBLIC__/pc/js/g-index.js"></script>

<script>
    var wait                = 60;
    var m_itemDouble        = "<?php echo (isset($withdrawInfo['itemDouble']) && ($withdrawInfo['itemDouble'] !== '')?$withdrawInfo['itemDouble']:0); ?>";
    var isRealNameVerify    = Number("<?php echo (isset($withdrawInfo['realNameVerify'] ) && ($withdrawInfo['realNameVerify']  !== '')?$withdrawInfo['realNameVerify'] :0); ?>");
    var isBindPhone         = Number("<?php echo (isset($withdrawInfo['bindPhone'] ) && ($withdrawInfo['bindPhone']  !== '')?$withdrawInfo['bindPhone'] :0); ?>");
    var isSignConfirmStatus = Number("<?php echo (isset($withdrawInfo['signConfirmStatus'] ) && ($withdrawInfo['signConfirmStatus']  !== '')?$withdrawInfo['signConfirmStatus'] :0); ?>");
    var maxMeili            = Number($('.meile-v').html());
    var isSigned            = Number("<?php echo (isset($withdrawInfo['isSigned'] ) && ($withdrawInfo['isSigned']  !== '')?$withdrawInfo['isSigned'] :0); ?>");


    /*
     * 更改提现帐号
     */
    function dialogChangeAccount() {
        $(".alipay-pop").show();
        $(".g-mask").show();
    }
    
    /*
     * 隐藏【更改提现 帐号】窗口
     */
    function dialogChangeAccountHide() {
        $(".alipay-pop").hide();
        $(".g-mask").hide();
    }
    /*
     * 点击提现的提示框
     */
    function dialogConfirmAlipay() {
        $(".ali-but").siblings('.ali-mes').find('.info-mes').css("display", "none");
        $('.ali-b-account').html($('.g-m6-b1').html()); //显示确认提现账号
        $('.ali-b-meili').html($("input[name='meili']").val()); //显示确认的魅力
        $('.ali-b-money').html($("input[name='money']").val()); //显示确认的到账金额
        $('.alipay-detail-pop').show();
        $(".g-mask").show();
    }
    /**
     * 检查参数
     */
    function checkParams(_this) {
//        alert(_this.toString());return;
        var isAlipayAccount = $("input[name='alipay_account']").val();
        var isMeiliRight;
        var meili           = $("input[name='meili']").val();
        
        $("input[name='meili']").siblings('.p-l-error').css("display", "none");
        if (meili < 300 || meili > maxMeili) {
            isMeiliRight = false;
            if ($(_this).attr("name") == "meili") {
                $("input[name='meili']").siblings('.p-l-error').html('请输入大于300魅力的数量');
                $("input[name='meili']").siblings('.p-l-error').css("display", "block");
            }
        } else {
            isMeiliRight = true;
        }
        if (isAlipayAccount == "" && $(_this).hasClass("alipay-ok")) {
            $("input[name='meili']").siblings('.p-l-error').html('请设定提现帐号！');
            $("input[name='meili']").siblings('.p-l-error').css("display", "block");
        }
        
        if (isRealNameVerify && isBindPhone && isAlipayAccount && isMeiliRight && isSignConfirmStatus) {
            $(".imay-pay").show();
            $(".imay-pay-no").hide();
        } else {
            $(".imay-pay").hide();
            $(".imay-pay-no").show();
        }
    }
    /*
     * 将魅力转换成钱
     */
    function convertMeiliToMoney(meile) {
        var money = 0;
        if (meile) {
            if (m_itemDouble != "0") {
                money = (meile / 100) * 3 * 2;
            } else {
                money = (meile / 100) * 3;
            }
        }
        return money.toFixed(2);
    }
    
    /*
     * 检查输入魅力值
     */
    function calcMoney() {
        var meili = Number($("input[name='meili']").val());
        if (meili > maxMeili) {
            meili = maxMeili;
            $("input[name='meili']").val(meili)
        }
        checkParams(this);
        money = convertMeiliToMoney(meili);
        $("b[name='s_money']").html(money + "元");
        $("input[name='money']").val(money);
    }
    
    //60s倒计时
    function time(btn) {
        if (wait === 0) {
            btn.html("重新发送").show();
            btn.siblings('.code_btn_dis').hide();
            wait = 60;
        } else {
            btn.hide();
            btn.siblings('.code_btn_dis').html(wait + '秒').show();
            wait--;
            setTimeout(function () {
                time(btn);
            }, 1000);
        }
    }
    
    $(function () {
        var alipayAccount = "<?php echo (isset($withdrawInfo['alipayAccount']) && ($withdrawInfo['alipayAccount'] !== '')?$withdrawInfo['alipayAccount']: '13633333'); ?>";
        $("input[name='meili']").on("input valuechange", calcMoney);
        
        /*
         * 获取验证码(更换帐号时)
         */
        $('.chang-alip-getCode').click(function () {
            var obj   = {};
            obj.type  = '3';
            obj.phone = $('.alipay-phone').val();
            if (!obj.phone || obj.phone.substring(0, 2) == '输入') {
                $('.alipay-phone').parent().find(".info-mes").css("display", "block");
                return;
            }
            obj.country = 86;//$('.login-country').find('span b').text();
            wait        = 60;
            time($(this));
            $.post(verificationCode, obj);
        });
        
        /*
         * 确定更换支付宝号
         */
        $('.alipay-ok').click(function () {
            var obj     = {};
            obj.account = $('.alipay-phone').val();
            obj.code    = $('.apipay-code').val();
            if (!obj.account) {
                $('.alipay-phone').parent().find(".info-mes").html("手机号不能为空").css("display", "block");
                f
                return;
            } else if (obj.account.length != 11) {
                $('.alipay-phone').parent().find(".info-mes").html("请输入11位手机号码").css("display", "block");
                return;
            }
            
            $("input[name='alipay-account']").val(obj.account);
            $("input[name='alipay_account']").val(obj.account);
            $('.g-m6-b1').html(obj.account);
            $(".g-m6-b1").html($(".g-m6-b1").html().substring(0, 3) + "****" + $(".g-m6-b1").html().substring(8, 11));
            $('.alipay-phone').val('');
            $('.apipay-code').val('');
            checkParams(this);
            dialogChangeAccountHide();
        });
        
        /*
         * 确认信息--放弃事件
         */
        $('.ali-but-a').click(function () {
            $(".alipay-detail-pop").hide();
            $(".g-mask").hide();
        });
        
        /*
         * 确认信息--确定事件
         */
        $('.ali-but-b').click(function () {
            var params           = {};
            params.alipayAccount = $("input[name='alipay-account']").val();
            params.meili         = Number($("input[name='meili']").val());
            
            var submit_url = "<?php echo url('m/withdraw/aliWithDraw'); ?>";
            if (isSigned) {
                $(".ali-but").siblings('.ali-mes').find('.info-mes').css("display", "block").html("您是按月结算主播，无需进行提现操作");
                return;
            }
            $.post(submit_url, params, function (data, textStatus) {
                var json = WST.toJson(data);
                console.log(json);
                if (json.status == '1') {
                    window.location.href = '<?php echo url("user/withdraw/successfulView"); ?>';
                } else {
                    var msg;
                    if (json.errordesc) {
                        msg = "提现失败," + WST.getErrorMsg(json.errordesc);
                    } else {
                        msg = "提现失败";
                    }
                    $(".ali-but").siblings('.ali-mes').find('.info-mes').css("display", "block").html(msg);
                }
            });
        });
        
    });
</script>
</body>
</html>