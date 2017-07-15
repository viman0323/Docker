<?php
// +----------------------------------------------------------------------
// | SentCMS [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.tensent.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: molong <molong@tensent.cn> <http://www.tensent.cn>
// +----------------------------------------------------------------------

return array(

    'SERVER_API_PORTS' => array( // todo 完成后换成正式站的地址
        //充值页面接口
        'createdirectpay' => 'pay.php/AliPayDirect/createDirectPayByUser',//支付宝即时到账支付
        'precreate' => 'pay.php/AliPayScan/create',//支付宝扫码支付
        'alipaywap' => 'pay.php/AliPayWap/wapCreateDirectPayByUser',//支付宝手机网站支付
        'bizpayurlAli' => 'pay.php/AliPayOpen/bizpayurl',//生成支付宝支付二维码

        'wxscanorder' => 'pay.php/WxPayScan/wxScanOrder',//微信扫码支付
        'bizpayurl' => 'pay.php/WxPayScan/bizpayurl',//生成微信支付二维码
        'wxwaporder' => 'pay.php/WxPayWap/wxWapOrder',//微信公众号支付
        'wxh5order' => 'pay.php/WxPayH5/wxH5Order',//微信H5支付
		'notice' => 'pay.php/WxPayScan/order',//微信、支付宝查询订单信息
        'redPackSend' => 'pay.php/WxPaySendRedPack/send',//发红包
        'ucardpay' => 'pay.php/UCard/pay',//优卡支付
        'ucardpaystatus' => 'pay.php/UCard/search',//优卡支付状态


        'recharge' => '/api/v1/account/recharge',//充值下单
        'profile' => '/api/v1/account/profile',//获取用户信息（登陆后）
        'infosimple' => '/api/v1/account/infoSimple',//魅号登陆（获取用户信息）
        'rechargesum' => '/v1/admin/user/recharge/sum',//根据uid获取充值总数和是否成年人
        'rechargetips' => '/v1/admin/user/recharge/tips',//确认已18岁
        'inforoom' => '/api/v1/room/info',//房间信息

         //提现页面接口
         'withdrawInfo'    => '/api/v1/account/withdrawInfo',//获取提现信息
         'withdraw'        => '/api/v1/account/withdraw',//发起提现请求
         'withdrawRecords' => '/api/v1/account/withdrawRecords',//

        //登录、注册、忘记密码
        'send' => '/api/v1/account/sms/send',//发送验证码
        'login' => '/api/v1/account/login',//手机号登陆
        'register' => '/api/v1/account/create',//注册
        'wblogin' => '/api/v1/account/weibo/login', //微博登录
        'accesscode' => 'https://api.weibo.com/oauth2/access_token',//获取微博access_code
        'wxlogin' => '/api/v1/account/wechat/login', //微博登录
        'accesstoken' => 'https://api.weixin.qq.com/sns/oauth2/access_token',//获取微信access_token
        'qqlogin' => '/api/v1/account/qq/login',  // QQ登录
        'qqtoken' => 'https://graph.qq.com/oauth2.0/token',  // 获取QQ access_token
        'qqopenid' => 'https://graph.qq.com/oauth2.0/me',  // 获取QQ access_token
        'wapqqtoken' => 'https://graph.z.qq.com/moc2/token',  // 获取Wap QQ access_token
        'wapqqopenid' => 'https://graph.z.qq.com/moc2/me',  // 获取Wap QQ access_token
		'userinfo' => 'https://api.weixin.qq.com/sns/userinfo',//获取微信登录用户信息
		'gettokeninfo' => 'https://api.weibo.com/oauth2/get_token_info',
		'usershow' => 'http://api.t.sina.com.cn/users/show.json', //获取用户信息
		'nickcheck' => '/api/v1/account/nick/check', //验证用户昵称是否重复
		'passwordforget' => '/api/v1/account/passwordforget', //忘记密码

		//分享页面接口
        'roominfo' => '/api/v1/room/info',//获取房间信息
        'roomhot' => '/api/v1/room/hot',//人气房间
        'livestatus' => '/v1/admin/user/livestatus',//主播直播是否已结束
        'timeline' => '/api/v1/feeds/timeline',//主播最新动态

		// 活动分享
        'share' => '/api/v1/feeds/info/public', // 热门动态
        'feedshot' => '/api/v1/feeds/hot', // 动态信息

		// 话题分享
        'labelcontent' => '/api/v1/feeds/relatedfeedlabels', // 相关话题、热门动态和最新动态
        'newestlabelfeed' => '/api/v1/feeds/newestlabelfeedsimples', // 上拉加载最新数据

		// 超胆挑战分享
        'shareInfo' => '/v2/shortLive/shareInfo', // 超胆挑战视频数据
        'shortlive' => '/v2/shortLive/myInfo', //超胆挑战次数

        // 活动页面接口
        'firstcharge' => '/api/v1/account/firstRechargeInfo', //获取首冲信息
        'rechargegift' => '/api/v1/account/getFirstRechargeGift', //获取首冲奖励
        'festivalactivity' => '/api/v1/activity-1223', // 获取圣诞活动数据
        'newyearactivity' => '/api/v1/activity-1230/info', // 获取元旦活动数据

        // 经纪人数据查询接口
        'getrankdata' => '/v1/admin/user/getrankdata', // 艺人排行榜
        'anchorinfor' => '/v1/admin/user/anchorinfor', //艺人信息
        'statincome' => '/v1/admin/user/statincome', //收入统计
        'statfans' => '/v1/admin/user/statfans', //粉丝统计
        'statfeedsns' => '/v1/admin/user/statfeedsns', //动态互动统计
        'statlive' => '/v1/admin/user/statlive', //在线直播统计
        'brokerinfor' => '/v1/admin/user/brokerinfor', //经纪人信息
    ),
);