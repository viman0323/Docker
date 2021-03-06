<?php
/*===============================================================
*   Copyright (C) 2015 All rights reserved.
*
*   file        : Wechat.php
*   author      : jason.zhi
*   date        : 2016/12/26
*   description : 微信订阅号接口接入
*   modify      :
*
================================================================*/
namespace app\m\controller;

class Wechatsubscribe extends \think\Controller
{
    private $weObj;
    
    protected function _initialize()
    {
        parent::_initialize(); // TODO: Change the autogenerated stub
        
        vendor("Wechat");
        $this->config = config('WX.MP_SUBSCRIBE');
        
        $this->weObj = new \Wechat([
            'appid'     => $this->config['APPID'],
            'appsecret' => $this->config['AppSecret'],
            'token'     => 'weixin',
        ]);
    }
    
    /**
     * @brief  接口接入
     * @author jason.zhi@lihuobao.cn
     * @date   2016/10/24
     */
    private function switchIn()
    {
        echo $_GET["echostr"];//验证的时候一定要输出这个值，不然是不能验证成功
        exit;
    }
    
    private function route()
    {
        $type = $this->weObj->getRev()->getRevType();
        switch ($type) {
            case \Wechat::MSGTYPE_TEXT:
                $this->weObj->text("xxx")->reply();
                break;
            case \Wechat::MSGTYPE_EVENT:
                break;
            case \Wechat::MSGTYPE_IMAGE:
                break;
            default:
                $this->weObj->text("help info")->reply();
        }
    }
    
    /**
     * @brief  微信服务器回调地址
     * @author jason.zhi@lihuobao.cn
     * @date   2016/10/24
     */
    public function index()
    {
        $this->weObj->valid();
        if (isset($_GET["echostr"])) {
            $this->switchIn();
        } else {
            $this->route();
        }
    }
}