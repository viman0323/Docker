<?php
/*===============================================================
*   Copyright (C) 2015 All rights reserved.
*
*   file        : WithDraw.php
*   author      : jason.zhi
*   date        : 2016/10/27
*   description : 提现功能相关
*   modify      :
*
================================================================*/
namespace app\m\controller;

use app\common\controller\User;

class Login extends User
{
    /**
     * @brief  跳到登录主页
     * @return mixed
     * @author wojiaojason@gmail.com
     */
    public function toLogin()
    {
        //echo  phpinfo();exit;
        $redirect = "https://m.imay.com" . "/login/wapLoginByThirdParty";
        
        //微信登录
        $data['ConnectWX'] = model('Login')->getWxMPLoginUrl($redirect);
        //微博登录
        $data['ConnectXL'] = model('Login')->getXlLoginUrl($redirect);
        //QQ登录
        $data['ConnectQQ'] = model('Login')->getWapQQLoginUrl($redirect, "QQ_WAP_STATE");
        $this->assign('data', $data);

        return $this->fetch('login/toLogin');
    }

    /**
     * @brief  跳到手机登录页面
     * @return mixed
     * @author wojiaojason@gmail.com
     */
    public function toLoginPhone()
    {
        return $this->fetch('login/toLoginPhone');
    }
    
    /**
     * @brief 跳到忘记密码页面
     * @return mixed
       @author wojiaojason@gmail.com
     */
    public function toForgetPassword()
    {
        return $this->fetch('login/toForgetPassword');
    }
}