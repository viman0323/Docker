<?php
// +----------------------------------------------------------------------
// | SentCMS [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.tensent.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: molong <molong@tensent.cn> <http://www.tensent.cn>
// +----------------------------------------------------------------------

namespace app\activity\controller;

/**
 * 徐海乔生日会控制器
 * Class Capturemonster
 * @package app\activity\controller
 */
class Capturemonster extends \app\common\controller\BaseWechatEvent
{

    private $weObj = NULL;
    private $config = NULL;

    public function _initialize()
    {
        parent::_initialize();

        vendor("Wechat");
        $this->config = config('WX.MP');

        $this->weObj = new \Wechat([
            'appid'     => $this->config['APPID'],
            'appsecret' => $this->config['AppSecret'],
        ]);
    }

    /**
     * @brief 获取jsapi_ticket
     * @return \think\response\Json
    @author wojiaojason@gmail.com
     */
    public function getJsapiTicket()
    {
        $url = input('post.url', "");
        try {
            $jsapiTicket = $this->weObj->getJsTicket();
            if ($jsapiTicket && !empty($url)) {
                $signPackage = $this->weObj->getJsSign($url);
                if ($signPackage) {
                    // var_dump($jsapiTicket);
                    // var_dump($signPackage);
                    // exit;
                    // $signPackage['jsapiticket'] = $jsapiTicket;

                    return json($signPackage);
                }
            }
            throw new \Exception("获取Jsapiticket失败!请刷新页面");
        } catch (\Exception $e) {
            return json([
                'errorcode' => $e->getCode(),
                'errormsg'  => $e->getMessage(),
            ]);
        }
    }

}
