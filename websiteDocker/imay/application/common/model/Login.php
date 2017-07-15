<?php
namespace app\common\model;

/**
 * api服务端接口
 *
 */
class Login extends Base
{
    protected $autoCheckFields =false;  //设置为虚拟模型，不存在实际表

    /**
     * 获取微信开放平台授权登录
     * @param $redirectUrl,redirect_url需要预先设置
     * @return string
     */
    public function getWxLoginUrl($redirectUrl) {
        $app = config('WX.OPEN');
        $app_id = $app['APPID'];
        return "https://open.weixin.qq.com/connect/qrconnect?appid={$app_id}&redirect_uri=" . urlencode($redirectUrl). "&response_type=code&scope=snsapi_login&state=WX_STATE#wechat_redirect";
    }
    
    /**
     * @brief 微信公众平台授权登录
     * @param $redirectUrl redirect_url需要预先设置
     * @return string
       @author wojiaojason@gmail.com
     */
    public function getWxMPLoginUrl($redirectUrl) {
        $config    = config("WX.MP");
        $appid     = $config["APPID"];
        
        return "https://open.weixin.qq.com/connect/oauth2/authorize?appid={$appid}&redirect_uri={$redirectUrl}&response_type=code&scope=snsapi_userinfo&state=WX_MP_STATE#wechat_redirect";
    }
    
    /**
     * 获取新浪登录授权链接
     * @param $redirectUrl redirect_url不需要预先设置
     * @return string
     */
    public function getXlLoginUrl($redirectUrl) {
        $port = config('WB');
        $client_id = $port['AppKey'];
        return "https://api.weibo.com/oauth2/authorize?client_id={$client_id}&redirect_uri=" . urlencode($redirectUrl). "&response_type=code&display=default&state=XL_STATE&forcelogin=true";
    }

    /**
     * 获取QQ登录授权链接,目前PC和手机公用一个连接
     * @param $redirectUrl redirect_url需要预先设置
     * @return string
     */
    public function getQQLoginUrl($redirectUrl, $state="QQ_STATE") {
        $client = config('QQ_CONNECT.WEB');
        $client_id = $client['APPID'];
        
        return "https://graph.qq.com/oauth2.0/authorize?response_type=code&client_id={$client_id}&redirect_uri=" . urlencode($redirectUrl). "&state={$state}";
    }
    
    /**
     * 获取QQ登录授权链接,目前PC和手机公用一个连接
     * @param $redirectUrl redirect_url需要预先设置
     * @return string
     */
    public function getWapQQLoginUrl($redirectUrl, $state)
    {
        $client    = config('QQ_CONNECT.WAP');
        $client_id = $client['APPID'];
        
        return "https://graph.qq.com/oauth2.0/authorize?response_type=code&client_id={$client_id}&redirect_uri=" . urlencode($redirectUrl) . "&state={$state}";
    }
    
    /**
     * 第三方登录 方法(微信开放平台,微信公众平台, QQ登录,新浪登录)
     * @param $$redirect redirect_url需要预先设置
     * @return array
     */
    public function getOpenLoginUrl($redirect)
    {
        $data = array();
        $redirectUrl = urldecode($redirect);
        // 微信登录
        $data['ConnectWX'] = $this->getWxLoginUrl($redirectUrl); //微信登录链接
        // 新浪微博登录
        $data['ConnectXL'] = $this->getXlLoginUrl($redirectUrl);
        //qq登录
        $data['ConnectQQ'] = $this->getQQLoginUrl($redirectUrl);
        return $data;
    }
    
}