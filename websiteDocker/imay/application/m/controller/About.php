<?php
// +----------------------------------------------------------------------
// | SentCMS [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.tensent.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: molong <molong@tensent.cn> <http://www.tensent.cn>
// +----------------------------------------------------------------------

namespace app\m\controller;
use app\common\controller\Fornt;

/**
 * 首页控制器
 * Class Index
 * @package app\index\controller
 */
class About extends Fornt
{
    /**
     * 联系我们
     * @return mixed
     */
	public function connect()
    {
        $m = model('Page');
        $title = '联系我们';
        $page = $m->page($title);
        $this->assign('Page', $page);
        return $this->fetch('about/connectUs');
	}

    /**
     * 服务条款
     * @return mixed
     */
	public function privacyPolicy()
	{
        $m = model('Page');
        $title = 'ｉＭａｙ直播服务和隐私条款';
        $page = $m->page($title);
        $this->assign('Page', $page);
        return $this->fetch('about/privacy');
	}

    /**
     * 隐私政策
     * @return mixed
     */
    public function servicePrivacy()
    {
        $m = model('Page');
        $title = 'ｉＭａｙ直播用户隐私政策';
        $page = $m->page($title);
        $this->assign('Page', $page);
        return $this->fetch('about/privacy');
    }

    /**
     * 兑换协议
     * @return mixed
     */
    public function exchange()
    {
        $m = model('Page');
        $title = '用户兑换协议';
        $page = $m->page($title);
        $this->assign('Page', $page);
        return $this->fetch('about/agreement');
    }

    /**
     * 充值协议
     * @return mixed
     */
    public function recharge()
    {
        $m = model('Page');
        $title = '用户充值协议';
        $page = $m->page($title);
        $this->assign('Page', $page);
        return $this->fetch('about/agreement');
    }

    /**
     * 玩咖直播服务隐私协议
     * @return mixed
     */
    public function privacyService()
    {
        $m = model('Page');
        $title = '玩咖直播服务隐私协议';
        $page = $m->page($title);
        $this->assign('Page', $page);
        return $this->fetch('about/privacy');
    }

    /**
     * 第三方经纪服务协议
     * @return mixed
     */
    public function brokerService()
    {
        $m = model('Page');
        $title = '第三方经纪服务协议';
        $page = $m->page($title);
        $this->assign('Page', $page);
        return $this->fetch('about/privacy');
    }

    /**
     * 玩咖绿色文明直播公约
     * @return mixed
     */
    public function greenLive()
    {
        $m = model('Page');
        $title = '玩咖绿色文明直播公约';
        $page = $m->page($title);
        $this->assign('Page', $page);
        return $this->fetch('about/privacy');
    }

}
