<?php
/*===============================================================
*   Copyright (C) 2015 All rights reserved.
*
*   file        : Download.php
*   author      : jason.zhi
*   date        : 2016/12/19
*   description :
*   modify      :
*
================================================================*/
namespace app\m\controller;

use app\common\controller\Fornt;

class Download extends Fornt
{
    /**
     * @brief  下载跳转页
     * @author wojiaojason@gmail.com
     */
    public function index()
    {
        $userAgent = $_SERVER['HTTP_USER_AGENT'];
        $domain    = \think\Request::instance()->domain();

        $pattern = "/MicroMessenger/i";
        //微信客户端
        if (preg_match($pattern, $userAgent)) {
            return $this->fetch("download/index");
            // $this->redirect('http://a.app.qq.com/o/simple.jsp?pkgname=com.imay.live');
        } else {//其他客户端
            if (strpos($userAgent, "iPhone") || strpos($userAgent, "iPad") || strpos($userAgent, "iPod")) {//ios
                header('Location: https://itunes.apple.com/cn/app/imay-zhi-bo/id1144832626?mt=8');
//                header('Location: https://itunes.apple.com/cn/app/imay-zhi-bo/id1198166301?mt=8');
//                header('Location: https://itunes.apple.com/cn/app/%E7%8E%A9%E5%92%96%E7%9B%B4%E6%92%AD/id1144832626?mt=8');
            } else if (strpos($userAgent, "Android")) {//android
//                $file_path = 'https://iosapp.imay.cn/Vanka.apk?t=' . time();
                $file_path = 'https://iosapp.imay.cn/Vanka.apk';
                header("Location: {$file_path}");
            } else {//手机
                header("Location: {$domain}");
            }
        }
    }

    /**
     * @brief  市场推广下载跳转页
     * @author wojiaojason@gmail.com
     */
    public function market()
    {
        $userAgent = $_SERVER['HTTP_USER_AGENT'];
        $domain    = \think\Request::instance()->domain();

        $pattern = "/MicroMessenger/i";
        //微信客户端
        if (preg_match($pattern, $userAgent)) {
            return $this->fetch("download/index");
            //$this->redirect('http://a.app.qq.com/o/simple.jsp?pkgname=com.imay.live');
        } else {//其他客户端
            if (strpos($userAgent, "iPhone") || strpos($userAgent, "iPad") || strpos($userAgent, "iPod")) {//ios
                header('Location: https://itunes.apple.com/cn/app/imay-zhi-bo/id1144832626?mt=8');
//                header('Location: https://itunes.apple.com/cn/app/imay-zhi-bo/id1198166301?mt=8');
//                header('Location: https://itunes.apple.com/cn/app/%E7%8E%A9%E5%92%96%E7%9B%B4%E6%92%AD/id1144832626?mt=8');
            } else if (strpos($userAgent, "Android")) {//android
                $file_path = 'https://iosapp.imay.cn/imay_live_fm.apk?t=' . time();
                header("Location: {$file_path}");
            } else {//手机
                header("Location: {$domain}");
            }
        }
    }

    /**
     * @brief  下载的默认页
     * @return mixed
     * @author wojiaojason@gmail.com
     */
    public function indexDefault()
    {
        return $this->fetch("download/indexDefault");
    }

    /**
     * @brief 输入邀请码页
     * @return mixed
    @author wojiaojason@gmail.com
     */
    public function indexInvite()
    {
        if (cookie('invitecode')) {
            $this->assign('setcookie', 1);
        } else {
            $this->assign('setcookie', 0);
        }

        return $this->fetch('download/indexInvite');

    }

    /**
     * 生成邀请码
     */
    public function createCode()
    {
        $code = model('InviteCode');
        $data = [];
        for ($i = 0; $i < 10; $i++) {
            $data['code'] = $this->makeCode();
            $code->add($data);
            var_dump($data);
        }
    }

    /**
     * 生成唯一邀请码
     *
     * @return string
     */
    private function makeCode()
    {
        $code = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $rand = $code[rand(0, 25)]
            . dechex(date('m'))
            . date('d')
            . substr(time(), -5)
            . substr(microtime(), 2, 5)
            . sprintf('%02d', rand(0, 99));
        $rand = strtoupper($rand);

        for (
            $a = md5($rand, TRUE),
            $s = '0123456789ABCDEFGHIJKLMNOPQRSTUV',
            $d = '',
            $f = 0;
            $f < 5;
            $g = ord($a[$f]),
            $d .= $s[($g ^ ord($a[$f + 5])) - $g & 0x1F],
            $f++
        ) ;

        return $d;
    }


    public function verification()
    {
        $code       = input('post.code', '');

        $while_code = [];
        $status = -1;

        if (in_array($code, $while_code)) {
            $status = 1;
        } else {
            $m        = model('InviteCode');
            $codeInfo = $m->info($code);
            if ($codeInfo) {
                if ($codeInfo['status'] == 0) {//邀请码可用
                    $m->setStatus(1, $codeInfo['id']);
                    cookie('invitecode', 1);
                    $status = 1;
                } else {//邀请码已使用
                    $status = 2;
                }
            } else {//邀请码不存在
                $status = -1;
            }
        }

        return json([
            'status' => $status,
        ]);
    }
}