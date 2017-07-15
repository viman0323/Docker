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

/**
 * APP活动控制器
 * Class Activity
 * @package app\activity\controller
 */
class BarParty extends Fornt
{
    /**
     * 酒吧线下活动下载页
     * @return mixed
     */
    public function index()
    {
        $userAgent = $_SERVER['HTTP_USER_AGENT'];
        $domain    = \think\Request::instance()->domain();

        // 记录用户手机下载次数：苹果和安卓
        $this->addActivityClick();

        $pattern = "/MicroMessenger/i";
        //微信客户端
        if (preg_match($pattern, $userAgent)) {
            // return $this->fetch("download/index");
            $this->redirect('http://a.app.qq.com/o/simple.jsp?pkgname=com.imay.live');
        } else {//其他客户端
            if (strpos($userAgent, "iPhone") || strpos($userAgent, "iPad") || strpos($userAgent, "iPod")) {//ios
                //header('Location: https://itunes.apple.com/cn/app/imay-zhi-bo/id1144832626?mt=8');
                header('Location: https://at.umeng.com/DKHjae');
            } else if (strpos($userAgent, "Android")) {//android
                $file_path = 'http://static.imay.com/download/imay_live_bar_01.apk?t=' . time();
                header("Location: {$file_path}");
            } else {//手机
                header("Location: {$domain}");
            }
        }
    }
    private function addActivityClick(){
        $data = array(
            'ctime' => time(),
            'ip'    => $this->getClientIP(),
            'os'    => $this->getOS()
        );
        $model = model('ApiMethod');
        $res = $model->table('im_activity_click')->insert($data);
        return $res;
    }
    /**
     * TODO 获取浏览器系统
     * @return string $os 返回系统标识：0未知  1苹果   2安卓   3windows
     */
    private function getOS(){
        $user_agent = strtoupper($_SERVER['HTTP_USER_AGENT']);
        if (stripos($user_agent, "IPHONE")!==false) {
            $os = '1';
        }elseif (stripos($user_agent, "ANDROID")!==false){
            $os = '2';
        }elseif (stripos($user_agent, "WINDOWS")!==false){
            $os = '3';
        }else {
            $os = '0';
        }
        return $os;
    }
    /**
     * TODO 获取客户端IP
     * @return string 返回IP字符串
     */
    private function getClientIP()
    {
        $ip = "";

        if (getenv("HTTP_CLIENT_IP"))
            $ip = getenv("HTTP_CLIENT_IP");
        else if(getenv("HTTP_X_FORWARDED_FOR"))
            $ip = getenv("HTTP_X_FORWARDED_FOR");
        else if(getenv("REMOTE_ADDR"))
            $ip = getenv("REMOTE_ADDR");
        else $ip = "Unknown";

        return $ip;
    }
}
