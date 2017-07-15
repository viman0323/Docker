<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:58:"/home/web/imay/application/broker/view/actor/statLive.html";i:1490690458;s:76:"/home/web/imay/application/broker/view/../../common/view/default/header.html";i:1499155465;s:80:"/home/web/imay/application/broker/view/../../common/view/default/infoBanner.html";i:1490603293;s:75:"/home/web/imay/application/broker/view/../../common/view/default/login.html";i:1492712428;}*/ ?>
<!DOCTYPE html>
<html lang="zh_CN">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>艺人管理</title>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
    <meta name="viewport"
          content="width=device-width,initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no"/>
    <link type="text/css" rel="stylesheet" href="__PC_CSS__/common.css">
    <link type="text/css" rel="stylesheet" href="__PC_CSS__/artist.css">
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
<article>
    <!--展示个人信息的banner-->
    <section>
    <div class="art-nav">
        <div class="art-nav-c">
            <div class="art-nav-l">
                <div class="art-nav-head">
                    <?php if(empty($userInfo['user']['imgHead'])) {  ?>
                    <img src="__PC_IMG__/img01.jpg" class="art-head-i">
                    <?php  } else {  ?>
                    <img src="<?php echo $userInfo['user']['imgHead']; ?>" class="art-head-i">
                    <?php  }  ?>
                </div>
                <div class="art-nav-detail">
                    <div class="art-det-top clearfix ">
                        <div class="det-top-l">
                            <div class="det-l-t">
                                <h5><?php echo (isset($userInfo['user']['nick'] ) && ($userInfo['user']['nick']  !== '')?$userInfo['user']['nick'] :""); ?></h5>
                                <b class="art-level"><?php echo (isset($userInfo['user']['LiveLv'] ) && ($userInfo['user']['LiveLv']  !== '')?$userInfo['user']['LiveLv'] :0); ?></b>
                            </div>
                            <div class="det-l-b">
                                <span>魅号：<b><?php echo (isset($userInfo['user']['roomId'] ) && ($userInfo['user']['roomId']  !== '')?$userInfo['user']['roomId'] :""); ?></b></span>
                                <span>粉丝：<em><?php echo (isset($userInfo['user']['follower'] ) && ($userInfo['user']['follower']  !== '')?$userInfo['user']['follower'] :0); ?></em></span>
                            </div>
                        </div>
                        <div class="det-top-r">
                            <?php if(!empty($login['user']['BrokerStatus']) && $login['user']['BrokerStatus'] == 3) {  ?>
                            <a href="<?php echo url('Broker/Broker/info'); ?>" class="agent-select art-a">经纪人查询</a>
                            <?php  }  ?>
                        </div>
                    </div>
                    <div class="art-det-bot clearfix">
                        <ol class="art-det-ol">
                            <li>
                                <em><?php echo (isset($userInfo['user']['UserLv'] ) && ($userInfo['user']['UserLv']  !== '')?$userInfo['user']['UserLv'] :0); ?></em>
                                <span>用户等级</span>
                            </li>
                            <li>
                                <em><?php echo (isset($userInfo['user']['LiveLv'] ) && ($userInfo['user']['LiveLv']  !== '')?$userInfo['user']['LiveLv'] :0); ?></em>
                                <span>直播等级</span>
                            </li>
                            <li>
                                <em><?php echo (isset($userInfo['user']['meiliGain'] ) && ($userInfo['user']['meiliGain']  !== '')?$userInfo['user']['meiliGain'] :0); ?></em>
                                <span>总魅力收入</span>
                            </li>
                            <!--<li>-->
                                <!--<em><?php echo (isset($userInfo['user']['Medal'] ) && ($userInfo['user']['Medal']  !== '')?$userInfo['user']['Medal'] :0); ?></em>-->
                                <!--<span>获得勋章</span>-->
                            <!--</li>-->
                            <li>
                                <em><?php echo (isset($userInfo['user']['follow'] ) && ($userInfo['user']['follow']  !== '')?$userInfo['user']['follow'] :0); ?></em>
                                <span>关注</span>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="art-nav-r">
                <div class="art-nav-menu">
                    <ul class="art-menu-ul">
                        <li>
                            <a href="<?php echo url('Broker/Actor/index', array('uid'=> $userInfo['user']['uid'])); ?>" class="art-index art-a">
                                <b></b>
                                <span>首页</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo url('Broker/Actor/info', array('uid'=> $userInfo['user']['uid'])); ?>" class="art-artist art-a">
                                <b></b>
                                <span>艺人信息</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo url('Broker/Actor/statIncome', array('uid'=> $userInfo['user']['uid'])); ?>" class="art-income art-a">
                                <b></b>
                                <span>收入统计</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo url('Broker/Actor/statFans', array('uid'=> $userInfo['user']['uid'])); ?>" class="art-fans art-a">
                                <b></b>
                                <span>粉丝统计</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo url('Broker/Actor/statFeed', array('uid'=> $userInfo['user']['uid'])); ?>" class="art-dy art-a">
                                <b></b>
                                <span>动态统计</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo url('Broker/Actor/statLive', array('uid'=> $userInfo['user']['uid'])); ?>" class="art-line art-a">
                                <b></b>
                                <span>直播间统计</span>
                            </a>
                        </li>
                        <script>
                            var curMethod = "<?php echo ACTION_NAME; ?>".toLocaleLowerCase();
                            switch (curMethod) {
                                case 'index':
                                    $(".art-menu-ul").children().removeClass("art-checked").eq(0).addClass("art-checked");
                                    break;
                                case 'info':
                                    $(".art-menu-ul").children().removeClass("art-checked").eq(1).addClass("art-checked");
                                    break;
                                case 'statincome':
                                    $(".art-menu-ul").children().removeClass("art-checked").eq(2).addClass("art-checked");
                                    break;
                                case 'statfans':
                                    $(".art-menu-ul").children().removeClass("art-checked").eq(3).addClass("art-checked");
                                    break;
                                case 'statfeed':
                                    $(".art-menu-ul").children().removeClass("art-checked").eq(4).addClass("art-checked");
                                    break;
                                case 'statlive':
                                    $(".art-menu-ul").children().removeClass("art-checked").eq(5).addClass("art-checked");
                                    break;
                                default:
                                    break;
                            }
                        </script>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
    <section>
        <div class="charm-bar c-t-bar clearfix">
            <ul class="charm-bar-ul">
                <li>
                    <h5 class="charm-bar-tit">今日</h5>
                    <div class="charm-bar-c clearfix">
                        <div class="charm-bar-l">
                            <span class="charm-txt-a">今日直播时长：</span>
                            <span class="charm-txt-b art-red"><b><?php echo (isset($statData['livetimeday']['hour']) && ($statData['livetimeday']['hour'] !== '')?$statData['livetimeday']['hour']:0); ?></b>小时<b><?php echo (isset($statData['livetimeday']['min']) && ($statData['livetimeday']['min'] !== '')?$statData['livetimeday']['min']:0); ?></b>分</span>
                            <div class="charm-line"></div>
                        </div>
                        <div class="charm-bar-l">
                            <span class="charm-txt-a">今日观众人数：</span>
                            <span class="charm-txt-b art-red"><b><?php echo (isset($statData['viewercountday']) && ($statData['viewercountday'] !== '')?$statData['viewercountday']:0); ?></b></span>
                            <div class="charm-line"></div>
                        </div>
                        <div class="charm-bar-l">
                            <span class="charm-txt-a">今日观众最高点：</span>
                            <span class="charm-txt-b art-blue"><b><?php echo (isset($statData['viewerwlmday']) && ($statData['viewerwlmday'] !== '')?$statData['viewerwlmday']:0); ?></b></span>
                        </div>
                    </div>
                    <div class="charm-bar-c clearfix">
                        <div class="charm-bar-l">
                            <span class="charm-txt-a">今日粉丝观看数：</span>
                            <span class="charm-txt-b art-red"><b><?php echo (isset($statData['fansviewerday']) && ($statData['fansviewerday'] !== '')?$statData['fansviewerday']:0); ?></b></span>
                            <div class="charm-line"></div>
                        </div>
                        <div class="charm-bar-l charm-l-w1">
                            <span class="charm-txt-a">今日直播间新增粉丝：</span>
                            <span class="charm-txt-b art-red"><b><?php echo (isset($statData['fansincrday']) && ($statData['fansincrday'] !== '')?$statData['fansincrday']:0); ?></b></span>
                        </div>
                    </div>
                    <div class="charm-bar-c clearfix">
                        <div class="charm-bar-l charm-l-w2">
                            <span class="charm-txt-a">今日直播间礼物收入：</span>
                            <span class="charm-txt-b art-blue"><b><?php echo (isset($statData['livegiftday']) && ($statData['livegiftday'] !== '')?$statData['livegiftday']:0); ?></b></span>
                        </div>
                    </div>
                </li>
                <li>
                    <h5 class="charm-bar-tit">本周</h5>
                    <div class="charm-bar-c clearfix">
                        <div class="charm-bar-l">
                            <span class="charm-txt-a">本周直播时长：</span>
                            <span class="charm-txt-b art-red"><b><?php echo (isset($statData['livetimeweek']['hour']) && ($statData['livetimeweek']['hour'] !== '')?$statData['livetimeweek']['hour']:0); ?></b>小时<b><?php echo (isset($statData['livetimeweek']['min']) && ($statData['livetimeweek']['min'] !== '')?$statData['livetimeweek']['min']:0); ?></b>分</span>
                            <div class="charm-line"></div>
                        </div>
                        <div class="charm-bar-l">
                            <span class="charm-txt-a">本周观众人数：</span>
                            <span class="charm-txt-b art-red"><b><?php echo (isset($statData['viewercountweek']) && ($statData['viewercountweek'] !== '')?$statData['viewercountweek']:0); ?></b></span>
                            <div class="charm-line"></div>
                        </div>
                        <div class="charm-bar-l">
                            <span class="charm-txt-a">本周观众最高点：</span>
                            <span class="charm-txt-b art-blue"><b><?php echo (isset($statData['viewerwlmweek']) && ($statData['viewerwlmweek'] !== '')?$statData['viewerwlmweek']:0); ?></b></span>
                        </div>
                    </div>
                    <div class="charm-bar-c clearfix">
                        <div class="charm-bar-l">
                            <span class="charm-txt-a">本周粉丝观看数：</span>
                            <span class="charm-txt-b art-red"><b><?php echo (isset($statData['fansviewerweek']) && ($statData['fansviewerweek'] !== '')?$statData['fansviewerweek']:0); ?></b></span>
                            <div class="charm-line"></div>
                        </div>
                        <div class="charm-bar-l">
                            <span class="charm-txt-a charm-l-w1">本周直播间新增粉丝：</span>
                            <span class="charm-txt-b art-red"><b><?php echo (isset($statData['fansincrweek']) && ($statData['fansincrweek'] !== '')?$statData['fansincrweek']:0); ?></b></span>
                        </div>
                    </div>
                    <div class="charm-bar-c clearfix">
                        <div class="charm-bar-l charm-l-w2">
                            <span class="charm-txt-a">本周直播间礼物收入：</span>
                            <span class="charm-txt-b art-blue"><b><?php echo (isset($statData['livegiftweek']) && ($statData['livegiftweek'] !== '')?$statData['livegiftweek']:0); ?></b></span>
                        </div>
                    </div>
                </li>
                <li>
                    <h5 class="charm-bar-tit">本月</h5>
                    <div class="charm-bar-c clearfix">
                        <div class="charm-bar-l">
                            <span class="charm-txt-a">本月直播时长：</span>
                            <span class="charm-txt-b art-red"><b><?php echo (isset($statData['livetimemonth']['hour']) && ($statData['livetimemonth']['hour'] !== '')?$statData['livetimemonth']['hour']:0); ?></b>小时<b><?php echo (isset($statData['livetimemonth']['min']) && ($statData['livetimemonth']['min'] !== '')?$statData['livetimemonth']['min']:0); ?></b>分</span>
                            <div class="charm-line"></div>
                        </div>
                        <div class="charm-bar-l">
                            <span class="charm-txt-a">本月观众人数：</span>
                            <span class="charm-txt-b art-red"><b><?php echo (isset($statData['viewercountmonth']) && ($statData['viewercountmonth'] !== '')?$statData['viewercountmonth']:0); ?></b></span>
                            <div class="charm-line"></div>
                        </div>
                        <div class="charm-bar-l">
                            <span class="charm-txt-a">本月观众最高点：</span>
                            <span class="charm-txt-b art-blue"><b><?php echo (isset($statData['viewerwlmmonth']) && ($statData['viewerwlmmonth'] !== '')?$statData['viewerwlmmonth']:0); ?></b></span>
                        </div>
                    </div>
                    <div class="charm-bar-c clearfix">
                        <div class="charm-bar-l">
                            <span class="charm-txt-a">本月粉丝观看数：</span>
                            <span class="charm-txt-b art-red"><b><?php echo (isset($statData['fansviewermonth']) && ($statData['fansviewermonth'] !== '')?$statData['fansviewermonth']:0); ?></b></span>
                            <div class="charm-line"></div>
                        </div>
                        <div class="charm-bar-l">
                            <span class="charm-txt-a charm-l-w1">本月直播间新增粉丝：</span>
                            <span class="charm-txt-b art-red"><b><?php echo (isset($statData['fansincrmonth']) && ($statData['fansincrmonth'] !== '')?$statData['fansincrmonth']:0); ?></b></span>
                        </div>
                    </div>
                    <div class="charm-bar-c clearfix">
                        <div class="charm-bar-l charm-l-w2">
                            <span class="charm-txt-a">本月直播间礼物收入：</span>
                            <span class="charm-txt-b art-blue"><b><?php echo (isset($statData['livegiftmonth']) && ($statData['livegiftmonth'] !== '')?$statData['livegiftmonth']:0); ?></b></span>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </section>
    <section>
        <div class="art-warp art-bot">
            <table class="charm-table">
                <thead>
                    <tr>
                        <th>日期</th>
                        <th>直播时长</th>
                        <th>观众人数</th>
                        <th>观众最高点</th>
                        <th>粉丝观看数</th>
                        <th>直播间新增粉丝</th>
                        <th>直播间收入</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(is_array($statData['last30livestats']) || $statData['last30livestats'] instanceof \think\Collection): $i = 0; $__LIST__ = $statData['last30livestats'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <tr>
                        <td><?php echo date('Y-m-d',strtotime($vo['Date'])); ?></td>
                        <td><?php echo $vo['LiveTime']; ?></td>
                        <td><?php echo $vo['Viewers']; ?></td>
                        <td><?php echo $vo['ViewerWLM']; ?></td>
                        <td><?php echo $vo['FansViewers']; ?></td>
                        <td><?php echo $vo['FansIncr']; ?></td>
                        <td><?php echo $vo['LiveIncome']; ?></td>
                    </tr>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </tbody>
            </table>
        </div>
    </section>
</article>
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
<script type="text/javascript" src="__PC_JS__/g-index.js"></script>
</body>
</html>