<?php
/*===============================================================
*   Copyright (C) 2015 All rights reserved.
*
*   file        : Index.php
*   author      : jason.zhi
*   date        : 2016/10/27
*   description :
*   modify      :
*
================================================================*/
namespace app\m\controller;

use app\common\controller\Fornt;

class Index extends Fornt
{
    /**
     * @brief  手机官网首页
     * @return mixed
     * @author wojiaojason@gmail.com
     */
    public function index()
    {
        $this->assign("wap_url", \Think\Request::instance()->domain());
        // $this->assign("download_url", $this->getDownloadUrl());
        
        return $this->fetch("index/index");
    }
    
    // private function getDownloadUrl()
    // {
    //     $userAgent = $_SERVER['HTTP_USER_AGENT'];
    //     $domain    = \think\Request::instance()->domain();
    //     if (strpos($userAgent, "iPhone") || strpos($userAgent, "iPad") || strpos($userAgent, "iPod")) {//ios
    //         $url = "https://itunes.apple.com/cn/app/imay-zhi-bo/id1144832626?mt=8";
    //     } else if (strpos($userAgent, "Android")) {//android
    //         $url = "https://iosapp.imay.cn/imay_live.apk";
    //     } else {//手机
    //         $url="{$domain}/download/indexDefault";
    //     }
    //
    //     return $url;
    // }
}