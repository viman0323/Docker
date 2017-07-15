<?php

return array(

	'view_replace_str'       => array(
		'__ADDONS__' => BASE_PATH . '/addons',
		'__PUBLIC__' => BASE_PATH . '/public',
		'__STATIC__' => BASE_PATH . '/application/index/static',
		'__IMG__'    => BASE_PATH . '/application/index/static/images',
		'__CSS__'    => BASE_PATH . '/application/index/static/css',
		'__JS__'     => BASE_PATH . '/application/index/static/js',
		'__BCSS__'     => BASE_PATH . '/public/bootstrap-3.3.0/css',
		'__BJS__'     => BASE_PATH . '/public/bootstrap-3.3.0/js',
		'__PJS__'     => BASE_PATH . '/public/plugins',
		'__PC_CSS__' => '/public/pc/css',
        	'__PC_JS__'  => '/public/pc/js',
        	'__PC_IMG__' => '/public/pc/images',//index模块的图片 还是用__IMG__的，并没有替换为__PC__IMG__,主要是目前还区分不出来哪些要哪些不要的
	)
);
