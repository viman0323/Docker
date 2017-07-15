<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:54:"/home/web/imay/application/index/view/index/index.html";i:1499140722;s:75:"/home/web/imay/application/index/view/../../common/view/default/footer.html";i:1489659878;s:74:"/home/web/imay/application/index/view/../../common/view/default/login.html";i:1492712428;}*/ ?>
<!DOCTYPE html>
<html lang="zh_CN">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>iMay直播，可以玩的直播！</title>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no"/>
    <meta itemprop="name" content="iMay直播">
    <meta name="keywords" content="交友，直播，游戏，年轻，才艺，文艺，校花，电影，90后，00后，大学生，音乐，自由职业，网红，宅男，女神，潮流，时尚，男神，夜店，唱K，秀场，土豪，富二代" />
    <meta name="description" itemprop="description" content="首款可以玩的时尚手机直播APP，极简的产品设计，集离线动态图文、视频等为一体的全新社交点赞模式。意外的邂逅，点亮陌生而并不陌生的社交关系网" />
    <meta name="application-name" content="iMay直播" />
    <meta name="msapplication-tooltip" content="iMay直播" />
    <link type="text/css" rel="stylesheet" href="__PC_CSS__/common.css">
    <link type="text/css" rel="stylesheet" href="__CSS__/index.css">
    <script type="text/javascript" src="__PUBLIC__/js/jquery.js"></script>
</head>
<body>
<header>
    <div class="i-header">
        <div class="i-nav">
            <ul class="i-nav-ul">
                <li>
                    <a href="/" class="i-logo"></a>
                </li>
                <li>
                    <a href="<?php echo url('user/withdraw/index'); ?>" class="i-nav-a"><span>提现</span><b></b></a>
                </li>
                <li>
                    <a href="<?php echo url('user/recharge/index'); ?>" class="i-nav-a"><span>充值</span><b></b></a>
                </li>
                <!--<li>-->
                    <!--<a href="<?php echo url('index/game/index'); ?>" class="i-nav-a"><span>直播助手</span><b></b></a>-->
                <!--</li>-->
                <li>
                <?php if(!empty($login['user'])){  ?>
                        <a href="<?php echo url('broker/Actor/index'); ?>" class="i-nav-a" style="width: 100px"><span>我的信息</span><b></b></a>
                <?php  }  ?>
                </li>
            </ul>
            <div class="i-nav-r">
                <div class="h-l-r">
                    <?php if (empty($login['user'])) {  ?>
                        <div class="g-no-i">
                            <a class="h-log pop-login" href="#">登录</a>
                        </div>
                    <?php  } else {  ?>
                        <div class="g-r-i">
                            <img class="h-l-img" src="<?php echo (isset($login['user']['imgHead']) && ($login['user']['imgHead'] !== '')?$login['user']['imgHead']:'__IMG__/g-logo.png'); ?>">
                            <span class="g-l-m5"><?php echo $login['user']['nick']; ?></span>
                        </div>
                        <div class="i-exit">
                            <a class="i-exit-a">退出</a>
                        </div>
                    <?php  }  ?>
                </div>
            </div>
        </div>
        <div class="i-h-con">
            <div class="i-c-l tab-scroll aniInLeft">
                <div class="i-l-ic">
                    <img src="__IMG__/g-ox.png">
                </div>
                <div class="i-l-but">
                    <div class="i-l-l">
                        <a class="i-ios" style="cursor: pointer;" href="https://itunes.apple.com/cn/app/imay-zhi-bo/id1144832626?mt=8">
                        <!-- <a class="i-ios" style="cursor: pointer;" href="https://itunes.apple.com/cn/app/imay-zhi-bo/id1198166301?mt=8"> -->
                            <!--<span class="i-ios-s">敬请期待...</span>-->
                        </a>
                        <a class="i-android" style="cursor: pointer" href="https://iosapp.imay.cn/Vanka.apk">
                            <!--<span class="i-ios-s">敬请期待...</span>-->
                        </a>
                    </div>
                    <div class="i-l-r">
                        <img src="__IMG__/iMayCode.jpg">
                    </div>
                </div>
                <!--<div class="i-cap-d">-->
                    <!--<a class="i-cap" href="<?php echo url('Download/indexInvite'); ?>"></a>-->
                <!--</div>-->
            </div>
            <div class="i-c-r">
                <div class="i-r-img tab-scroll aniInRight">
                    <img src="__IMG__/g-img01.png">
                </div>
            </div>
        </div>
    </div>
</header>
<div class="i-wrap">
    <div class="i-w-p i-w-m">
        <div class="i-t-i01 tab-scroll">
            <img src="__IMG__/i-img01.png">
        </div>
        <div class="i-t-i02 tab-scroll">
            <img src="__IMG__/i-img02.png">
        </div>

    </div>
    <div class="i-w-p i-w-h">
        <div class="i-w-fly tab-scroll1">
            <img src="__IMG__/fly.png">
        </div>
        <div class="i-t-i03">
            <img src="__IMG__/i-img05.png">
        </div>
        <div class="i-t-i04">
            <img src="__IMG__/i-img06.png">
        </div>
    </div>
    <div class="i-w-p i-w-b">
        <div class="i-t-i05">
            <img src="__IMG__/i-img08.png">
        </div>
        <div class="i-t-i06">
            <img src="__IMG__/i-img09.png">
        </div>
        <div class="i-t-i07">
            <img src="__IMG__/i-img12.png">
        </div>
        <div class="i-t-i08">
            <img src="__IMG__/i-img03.png">
        </div>
        <div class="i-t-i09">
            <img src="__IMG__/i-img04.png">
        </div>
        <div class="i-t-i10">
            <img src="__IMG__/i-img10.png">
        </div>
        <div class="i-t-i11">
            <img src="__IMG__/i-img11.png">
        </div>
        <div class="i-t-i12">
            <img src="__IMG__/i-img13.png">
        </div>
    </div>
</div>

<div class="footer-bar">
    <img src="__IMG__/w-imay.png">
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
<div class="g-mask"></div>

<script type="text/javascript" src="__PUBLIC__/js/jquery.js"></script>
<script type="text/javascript" src="__PUBLIC__/pc/js/g-index.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/common.js"></script>
<script type="text/javascript">
    var wait = 60;
    var type = "<?php echo $type; ?>";

    $(function () {
        if (type == 'register') {
            $(".g-login-pop").show();
            $(".g-mask").show();
            $('.pop-l-l a').removeClass("pop-pouple");
            $('.h-l-r a').removeClass("pop-pouple");
            $(".register-sc").val('中国86');
            $(".pop-reg-a").addClass("pop-pouple");
            $('.pop-tab-c:last-child').show();
            $('.pop-tab-c:first-child').hide();
            $(".pop-sec-ul").css('display', 'block');
        }
    })

</script>
</body>
</html>