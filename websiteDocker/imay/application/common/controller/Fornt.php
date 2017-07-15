<?php
// +----------------------------------------------------------------------
// | SentCMS [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.tensent.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: molong <molong@tensent.cn> <http://www.tensent.cn>
// +----------------------------------------------------------------------

namespace app\common\controller;

class Fornt extends Base{

	public function _initialize(){
		parent::_initialize();

		//判读是否为关闭网站
		if (\think\Config::get('web_site_close')) {
			header("Content-type:text/html;charset=utf-8");
			echo $this->fetch('common@default/public/close');exit();
		}

		//设置SEO
		$this->setSeo();

		$this->setHoverNav();
	}

	//当前栏目导航
	protected function setHoverNav(){
		//dump($_SERVER['PHP_SELF']);
	}


	/**
	 * 七牛文件上传
	 */
	public function qiNiuUploadPic()
	{
		// $folder = I("folder");
		$setting = config('UPLOAD_SITEIMG_QINIU');
		$upload = new \org\Upload($setting);
		$info = $upload->upload($_FILES);

		// $Filedata = key($_FILES);
		if (! $info) {
			$upload->getError();
		} else {
			return $info; //返回上传结果
		}
	}

}
