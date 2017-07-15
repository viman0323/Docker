<?php
// +----------------------------------------------------------------------
// | SentCMS [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.tensent.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: molong <molong@tensent.cn> <http://www.tensent.cn>
// +----------------------------------------------------------------------
error_reporting(E_ERROR | E_PARSE );
return array(

	// 扩展配置文件
    	'extra_config_list'      => ['database', 'validate', 'server_api'],	

	// 调试模式
	'app_debug'         => false,

	'charset'           => 'UTF-8',
	'lang_switch_on'    => true, // 开启语言包功能
	'lang_list'         => ['zh-cn'], // 支持的语言列表

	'data_auth_key'     => 'sent',

	'base_url'          => BASE_PATH,
	'url_route_on'      => true,
	'url_common_param'  => false,

	'template'          => array(
		'taglib_build_in' => 'cx,com\Sent',
	),

	// 'dispatch_success_tmpl'  => APP_PATH . 'common/view/default/jump.html',
	// 'dispatch_error_tmpl'    => APP_PATH . 'common/view/default/jump.html',

	'attachment_upload' => array(
		// 允许上传的文件MiMe类型
		'mimes'    => [],
		// 上传的文件大小限制 (0-不做限制)
		'maxSize'  => 0,
		// 允许上传的文件后缀
		'exts'     => [],
		// 子目录创建方式，[0]-函数名，[1]-参数，多个参数使用数组
		'subName'  => ['date', 'Ymd'],
		//保存根路径
		'rootPath' => './uploads/attachment',
		// 保存路径
		'savePath' => '',
		// 上传文件命名规则，[0]-函数名，[1]-参数，多个参数使用数组
		'saveName' => ['uniqid', ''],
		// 文件上传驱动e,
		'driver'   => 'Local',
	),

	'editor_upload'     => array(
		// 允许上传的文件MiMe类型
		'mimes'    => [],
		// 上传的文件大小限制 (0-不做限制)
		'maxSize'  => 0,
		// 允许上传的文件后缀
		'exts'     => [],
		// 子目录创建方式，[0]-函数名，[1]-参数，多个参数使用数组
		'subName'  => ['date', 'Ymd'],
		//保存根路径
		'rootPath' => './uploads/editor',
		// 保存路径
		'savePath' => '',
		// 上传文件命名规则，[0]-函数名，[1]-参数，多个参数使用数组
		'saveName' => ['uniqid', ''],
		// 文件上传驱动e,
		'driver'   => 'Local',
	),

	'picture_upload'    => array(
		// 允许上传的文件MiMe类型
		'mimes'    => [],
		// 上传的文件大小限制 (0-不做限制)
		'maxSize'  => 0,
		// 允许上传的文件后缀
		'exts'     => [],
		// 子目录创建方式，[0]-函数名，[1]-参数，多个参数使用数组
		'subName'  => ['date', 'Ymd'],
		//保存根路径
		'rootPath' => './uploads/picture',
		// 保存路径
		'savePath' => '',
		// 上传文件命名规则，[0]-函数名，[1]-参数，多个参数使用数组
		'saveName' => ['uniqid', ''],
		// 文件上传驱动e,
		'driver'   => 'Local',
	),
	'session'           => array(
		'prefix'     => 'sent',
		'type'       => '',
		'auto_start' => true,
	),

	'log'               => array(
		// 日志记录方式，支持 file sae
		'type' => 'file',
		// 日志保存目录
		'path' => LOG_PATH,
	),
	// 页面Trace信息
	'trace'             => array(
		//支持Html,Console 设为false则不显示
		'type' => 'Html',
	),

	'cache' =>  [
        	// 驱动方式
        	'type'   => 'redis',
        	// 服务器地址
        	'host'   => 'r-bp1c7199721641d4.redis.rds.aliyuncs.com',
		'password' => 'ctlqkk1uQcAFvQMBgSV2',
        	'port'   =>  6379,
		// 缓存前缀
        	'prefix' => '',
    	],

    'CHANNEL_CODE' => 'imayrc',//项目代号
    'SECRET_KEY' => 'MlfDaLgrGzXcQYASdvRc',//访问秘钥
    'IMPAY_URL' => 'http://192.168.0.16/',//'https://pay.imay.com/',//微信二维码生成文件路径 todo 完成后换成正式站的地址
    'APP_KEY' => 'web',//appkey
    'pageSize' => '20',//分页条数

    //服务端api地址 todo 完成后换成正式站的地址
    'SERVER_API_URL' => 'http://gate.imay.com', //'http://120.76.207.238:7999',  //'http://192.168.0.55:7999', //'http://192.168.0.200:7999',

    // 微信公众平台
    'WX' => [
        'OPEN' => [
            'APPID'     => 'wxfc5f7517942e1e46',
            'AppSecret' => '0ed3f7a11f845a1259b5b0b1b90687bc',
        ],
        'MP'   => [
            'APPID'     => 'wxd75b6f2cade96a53',
            'AppSecret' => '20982e1051e8721e5fbcbc88e6a37a7f',
        ],
	'MP_SUBSCRIBE' => [
            'APPID'     => 'wx6bc7d946e6aeaed2',
            'AppSecret' => '153bcf430a47d23f585171de9291be2a',
        ],
    ],

    // 新浪微博
    'WB' => [
        'AppKey'     => '3723869525',
        'APPSecret' => '829e1c16c3623b02bb1b30db99fd2bc9',
    ],

   // 新浪微博WAP
    'WB_WAP' => [
        'AppKey'     => '2410876184',
        'APPSecret' => '2de1461352334d831eb334fe9260dea8',
    ],

    // QQ互联
    'QQ_CONNECT' => [
        'WAP' => [
            'APPID'     => '101370230',
            'AppSecret' => '5be3e4040470fe3e8ded42c6bea3289b',
        ],
        'WEB'   => [
            'APPID'     => '101362918',
            'AppSecret' => '9e0f382e3a4d4d94d91b85d81b83818e',
        ],
    ],

//    'SITE_URL' => 'https://www.imay.com', // 回调地址
	'SITE_URL' => 'https://www.imay.cn', // 回调地址
    'SITE_M_URL' => 'https://m.imay.com', // WAP地址
    'SITE_API_URL' => 'http://api.imay.com', // 站内API

	// 七牛云存储实现文件上传配置
	'UPLOAD_SITEIMG_QINIU' => array(
		'maxSize' => 5 * 1024 * 1024, // 文件大小
		'rootPath' => './',
		'saveName' => array(
			'uniqid',
			''
		),
		'driver' => 'Qiniu',
		'driverConfig' => array(
			'secretKey' => 'WOnpfAa3m1BL6Z-6XoOsnlQ8aJqgUu4lLtw28hW3', // '<这里填七牛SK>',secrectKey
			'accessKey' => 'AYARqpEzEgwHZGV_l733_rxt3PZ1YSZAltW417mm', // <这里填七牛AK>',
			'domain' => 'img.imay.com', // '<空间名称>.qiniudn.com',
			'bucket' => 'imayimg'
		) // '<空间名称>'

	),

	// 活动数据库配置
    'EVENT_DB' =>  [
        // 数据库类型
    	'type'        => 'mysql',
    	// 服务器地址
    	'hostname'    => 'rm-bp1pf2yhpdpf7p9y0.mysql.rds.aliyuncs.com',
    	// 数据库名
    	'database'    => 'im_event',
    	// 数据库用户名
    	'username'    => 'imay_im_event',
    	// 数据库密码
    	'password'    => 'x0vQUt32UzLsv4tP',
    	// 数据库连接端口
    	'hostport'    => '3306',
    	// 数据库编码默认采用utf8
    	'charset'     => 'utf8',
    	// 数据库表前缀
    	'prefix'      => 'ime_',
    ],

);
