<?php
// +----------------------------------------------------------------------
// | SentCMS [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.tensent.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: molong <molong@tensent.cn> <http://www.tensent.cn>
// +----------------------------------------------------------------------

namespace app\activity\controller;
use app\common\controller\Fornt;
use DateTime;

/**
 * 徐海乔生日会控制器
 * Class Birthday
 * @package app\activity\controller
 */
class Birthday extends Fornt
{
    /**
     * 徐海乔生日会页面
     * @return mixed
     */
    public function index()
    {
        $url = config('SITE_URL');
        $url_m = config('SITE_M_URL');
        $assign = [
            'url' => 'com.tinlukchina.pc://com.imay.live/openwith?roomId=520417&liveUrl=' .
                base64_encode('http://down.imay.com/pi/520417/playlist.m3u8'),
            'base_url' => $url,
            'base_m' => $url_m
        ];
        $this->assign($assign);
        return $this->fetch('birthday/index');
    }

}
