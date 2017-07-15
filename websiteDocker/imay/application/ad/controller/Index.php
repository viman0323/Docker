<?php
// +----------------------------------------------------------------------
// | SentCMS [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.tensent.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: molong <molong@tensent.cn> <http://www.tensent.cn>
// +----------------------------------------------------------------------

namespace app\ad\controller;
use app\common\controller\Fornt;

/**
 * 广告首页控制器
 * Class Index
 * @package app\index\controller
 */
class Index extends Fornt
{
    /**
     * 首页
     * @return mixed
     */
	public function index()
    {
		return $this->fetch();
	}
}
