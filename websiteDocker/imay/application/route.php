<?php
// +----------------------------------------------------------------------
// | SentCMS [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.tensent.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: molong <molong@tensent.cn> <http://www.tensent.cn>
// +----------------------------------------------------------------------

return array(
	'__pattern__'     => array(
		'name' => '\w+',
	),

	'/'               => 'index/index/index', // 首页访问路由
    'ad'              => 'ad/index/index', // 广告推广页
    'active/index'    => 'activity/activity/index', // 活动页面
    'actDescription'  => 'activity/ActivityDescription/index', // 活动页面
    'festivalActivity'  => 'activity/FestivalActivity/index', // 圣诞元旦活动页面
    'newYear'  		  => 'activity/NewYearActivity/index', // 圣诞元旦活动页面
    'springFestival'  => 'activity/NewYearActivity/indexList', // 春节活动页面
    'festival'  	  => 'activity/NewYearActivity/listIndex', // 春节活动页面(没有进入房间按钮)
    'valentine'  	  => 'activity/Valentine/index', // 情人节活动页面
    'lover'  	      => 'activity/Valentine/indexList', // 情人节活动页面(没有进入房间按钮)
    'game'  		  => 'activity/Game/index', // 游戏页面
    'liarsdice'  	  => 'activity/Game/liarsDice', // 大话骰游戏页面
    'fruit'  	  	  => 'activity/Game/cutFruit', // 切水果游戏页面
    'goddess'  	  	  => 'activity/Goddess/index', // 女神活动
    'goddessList'  	  => 'activity/Goddess/indexList', // 女神活动（没有进入房间按钮）
    'barparty'  	  => 'activity/BarParty/index', // 酒吧线下活动
    'foolday'  	  => 'activity/FoolDay/index', // 愚人节活动
    'levygold'  	  => 'activity/LevyGold/index', // 一周大富婆个人金币管理
    'goldlist'  	  => 'activity/LevyGold/goldList', // 一周大富婆排行榜
    'introduce'  	  => 'activity/LevyGold/introduce', // 一周大富婆排行榜

    'download'        => 'm/download/index', // 下载页面
    'test'            => 'm/test/index', // 测试邀请页
    'ccode'           => 'm/test/createCode', // 生成邀请码
    'share'           => 'm/share/index', // APP直播分享页
    'Share/superLive'       => '/m/share/superLive', // APP动态分享页 
    'Share/superShow'       => '/m/share/superShow', // APP动态分享页 
	//'feed'      => 'share/feed', // APP动态分享页
	//'share/topic'     => 'share/topic', // APP话题拓展

	'about/connect'   => 'index/about/connect',
	'about/privacy'   => 'index/about/privacypolicy',
	'about/service'   => 'index/about/serviceprivacy',
	'about/exchange'   => 'index/about/exchange',
	'about/recharge'   => 'index/about/recharge',
	'about/privacyService'   => 'index/about/privacyService',
	'about/brokerService'   => 'index/about/brokerService',
	'about/greenLive'   => 'index/about/greenLive',

	'login'           => 'user/login/index',
	'recharge/index'  => 'user/recharge/index',
	'logout'          => 'user/login/logout',
	'uc'              => 'user/index/index',
	'withdraw/index'  => 'user/withdraw/index', //官网提现

	'admin/login'     => 'admin/index/login',
	'admin/logout'    => 'admin/index/logout',

	// 变量传入index模块的控制器和操作方法
	'addons/:mc/:ac'  => 'index/addons/execute', // 静态地址和动态地址结合
	'usera/:mc/:ac'   => 'user/addons/execute', // 静态地址和动态地址结合
	'admina/:mc/:ac'  => 'admin/addons/execute', // 静态地址和动态地址结合

);