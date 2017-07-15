<?php
// +----------------------------------------------------------------------
// | SentCMS [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.tensent.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: molong <molong@tensent.cn> <http://www.tensent.cn>
// +----------------------------------------------------------------------

namespace app\index\controller;

use app\common\controller\User;

/**
 * 首页控制器
 * Class Index
 * @package app\index\controller
 */
class Index extends User
{
    /**
     * 官网首页
     * @return mixed
     */
    public function index()
    {
        \think\Config::load(APP_PATH . "conf/messages.php");
        $code    = input('get.code', '0'); // 获取授权后返回的code值
        $state   = input('get.state'); // 获取授权后返回的state
        $status  = substr($_SERVER['REQUEST_URI'], 7); // 跳转类型
        $m       = model('ApiMethod');
        $message = config('MESSAGES');  //获取错误信息
        $type    = 'web';
        //登录后操作
        if (!empty($code)) {
            switch ($state) {
                case 'WX_STATE'://微信开放平台登录
                    $access_token = $m->getAccessToken($code); //获取access_token
                    $rs           = $m->wxLogin($access_token);
                    break;
                case 'XL_STATE': //微博登录
                    $access_code = $m->getAccessCode($code); //获取access code
                    $rs          = $m->wbLogin($access_code);
                    break;
                case 'QQ_STATE': //QQ登录
                    $access_token = $m->getQQAccessToken($code); //获取access token
                    $openid       = $m->getOpenId($access_token['access_token']);
                    $arr          = [
                        'accesstoken' => $access_token['access_token'],
                        'openid'      => $openid['openid'],
                        'unionid'     => $openid['unionid'],
                    ];
                    $rs           = $m->qqLogin($arr, $type);
                    break;
                default:
                    $rs = [];
                    break;
            }
            $setSession = $this->setLoginSession($rs);
            if ($setSession) {
                $this->redirect('index/index/index'); // 重定向首页
            } else {
                $this->error($message[$rs['errorcode']], url('/', '?type=register', $suffix = TRUE, $domain = TRUE)); // 重定向首页并提示
            }
        }
        
        $assign = [
            'type' => $status,
        ];
        
        $this->assign($assign);
        
        return $this->fetch('index/index');
    }
}
