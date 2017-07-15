<?php
namespace app\common\model;

use think\Model;

/**
 * api服务端接口
 *
 */
class ApiMethod extends Base
{
    protected $autoCheckFields = FALSE;  //设置为虚拟模型，不存在实际表

    protected $serverApiPorts = null; //服务端接口列表

    protected $serverApiUrl = null; //服务端接口URL

    public function __construct()
    {
        $server_api_conf = config("server_api");
        $this->serverApiPorts = $server_api_conf['SERVER_API_PORTS'];
        $this->serverApiUrl = config('SERVER_API_URL');
    }

    /**
     * 手机号码登陆
     * @param $country
     * @param $phone
     * @param $password
     * @return mixed
     */
    public function login($country, $phone, $password)
    {
        $url  = $this->serverApiUrl . $this->serverApiPorts['login'];

        $appkey                = config('APP_KEY');
        $data                  = [];
        $data['phone_country'] = $country;
        $data['phone']         = $phone;
        $data['secret']        = md5($phone.$password);
        $data['appkey']        = $appkey;

        $rs = self::curlPostUrl($url, $data);

        return $rs;
    }

    /**
     * 发送验证码
     * @param $phone
     * @param $country
     * @param $type
     * @return bool
     */
    public function verificationCode($phone, $country, $type)
    {
        $port = $this->serverApiPorts;
        $url  = $this->serverApiUrl . $port['send'];

        $data                  = [];
        $data['phone']         = $phone;
        $data['phone_country'] = $country;
        if ($type == '1') {
            $data['send_type'] = 1;
        } elseif ($type == '2') {
            $data['send_type'] = 2;
        }
        $rs = self::curlPostUrl($url, $data);

        return $rs;
    }

    /**
     * 魅号登录（获取用户信息）
     * @param $uid
     * @return bool
     */
    public function getInfoSimpleByUid($uid)
    {
        $url  = $this->serverApiUrl . $this->serverApiPorts['infosimple'];

        $url .= '?uid=' . $uid;
        $rs = self::curlGetUrl($url);

        return $rs;
    }

    /**
     * 根据uid获取充值总数和是否成年人
     * @param $uid
     * @return bool
     */
    public function getRechargeSumByUid($uid)
    {
        $url  = $this->serverApiUrl . $this->serverApiPorts['rechargesum'];
        $data = ['uid' => $uid];
        $rs = self::curlPostUrl($url, $data);

        return $rs;
    }

    /**
     * 根据uid确认已18岁
     * @param $uid
     * @param $isAdult
     * @return bool
     */
    public function getRechargeTipsByUid($uid, $isAdult)
    {
        $url  = $this->serverApiUrl . $this->serverApiPorts['rechargetips'];
        $data = ['uid' => $uid, 'isAdult' => $isAdult];
        $rs = self::curlPostUrl($url, $data);

        return $rs;
    }

    /**
     * 魅号登录（获取用户信息）
     * @param $room_id
     * @return bool
     */
    public function getInfoSimpleByRoomId($room_id)
    {
        $url  = $this->serverApiUrl . $this->serverApiPorts['infosimple'];

        $url .= '?roomId=' . $room_id;
        $rs = self::curlGetUrl($url);

        return $rs;
    }
    
    /**
     * 魅号登录（获取用户信息）
     * @param $room_id
     * @return bool
     */
    public function infoRoom($room_id)
    {
        $url  = $this->serverApiUrl . $this->serverApiPorts['inforoom'];
    
        $url .= '?roomId=' . $room_id;
        $rs = self::curlGetUrl($url);
    
        return $rs;
    }

    /**
     * 微博登录
     * @param $access_code
     * @return bool
     */
    public function wbLogin($access_code)
    {
        $port   = $this->serverApiPorts;
        $url    = $this->serverApiUrl . $port['wblogin'];
        $appkey = config('APP_KEY');
        $data   = [
            'weibouid'    => $access_code['uid'],
            'accesstoken' => $access_code['access_token'],
            'appkey'      => $appkey,
        ];
        $rs     = self::curlPostUrl($url, $data);

        return $rs;
    }

    /**
     * 微信登录
     * @param $access_token
     * @return bool
     */
    public function wxLogin($access_token)
    {
        $url    = $this->serverApiUrl . $this->serverApiPorts['wxlogin'];
        $appkey = config('APP_KEY');
        $data   = [
            'openid'      => $access_token['openid'],
            'unionid'     => $access_token['unionid'],
            'accesstoken' => $access_token['access_token'],
            'appkey'      => $appkey,
        ];
        $rs     = self::curlPostUrl($url, $data);

        return $rs;
    }

    /**
     * QQ登录
     * @param $arr
     * @return bool
     */
    public function qqLogin($arr, $type)
    {
        $url    = $this->serverApiUrl . $this->serverApiPorts['qqlogin'];
        $appkey = config('APP_KEY');
        if ($type == 'web') {
            $app = config('QQ_CONNECT.WEB');
        } else {
            $app = config('QQ_CONNECT.WAP');
        }
        $data = [
            'openid'           => $arr['openid'],
            'unionId'          => $arr['unionid'],
            'accesstoken'      => $arr['accesstoken'],
            'oauthconsumerkey' => $app['APPID'],
            'appkey'           => $appkey,
        ];
        $rs   = self::curlPostUrl($url, $data);

        return $rs;
    }

    /**
     * 忘记密码
     * @param $phone
     * @param $country
     * @param $code
     * @param $password
     * @return array
     */
    public function changePassword($phone, $country, $code, $password)
    {
        $port = $this->serverApiPorts;
        $url  = $this->serverApiUrl . $port['passwordforget'];

        $appkey                = config('APP_KEY');
        $data                  = [];
        $data['phone_country'] = $country;
        $data['phone']         = $phone;
        $data['secret']        = md5($phone.$password);
        $data['verify_code']   = $code;
        $data['appkey']        = $appkey;

        $rs = self::curlPostUrl($url, $data);

        return $rs;
    }

    /**
     * 用户注册
     * @param $phone
     * @param $country
     * @param $code
     * @param $password
     * @param $nick
     * @param $headImg
     * @return bool
     */
    public function register($phone, $country, $code, $password, $nick, $headImg)
    {
        $port = $this->serverApiPorts;
        $url  = $this->serverApiUrl . $port['register'];

        $appkey                = config('APP_KEY');
        $data                  = [];
        $data['phone_country'] = $country;
        $data['phone']         = $phone;
        $data['secret']        = md5($phone.$password);
        $data['verify_code']   = $code;
        $data['img_head']      = $headImg;
        $data['nick']          = $nick;
        $data['appkey']        = $appkey;

        $rs = self::curlPostUrl($url, $data);

        return $rs;
    }

    /**
     * 验证昵称是否重复
     * @param $nick
     * @return bool
     */
    public function nickCheck($nick)
    {
        $port = $this->serverApiPorts;
        $url  = $this->serverApiUrl . $port['nickcheck'];

        $data         = [];
        $data['nick'] = $nick;

        $rs = self::curlPostUrl($url, $data);
        if (!empty($rs['errorcode'])) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /**
     * 获取用户信息
     * @return bool
     */
    // public function userInfo()
    // {
    //     $user_auth = session('user_auth'); //获取登陆用户部分信息
    //     $sessionId = self::sessionId();
    //     $timestamp = time();
    //     $appkey    = config('APP_KEY');
    //     $port      = $this->serverApiPorts;
    //     $url       = $this->serverApiUrl . $port['profile'];
    //
    //     $url .= '?timestamp=' . $timestamp . '&uid=' . $user_auth['uid'] . '&sessionId=' . $sessionId . '&appkey=' . $appkey;
    //     $rs = self::curlGetUrl($url);
    //
    //     return $rs;
    // }

    /**
     * 支付宝扫码支付
     * @param $params
     * @return bool
     */
    public function createDirectPayByUser($params)
    {
        $port = $this->serverApiPorts;
        $url  = config('IMPAY_URL') . $port['precreate'];

        $url .= '?' . $params;
        $rs = self::curlGetUrl($url);

        return $rs;
    }

    /**
     * 支付宝手机网站支付
     * @param $params
     * @return bool
     */
    public function aliPayWap($params)
    {
        $port = $this->serverApiPorts;
        $url  = config('IMPAY_URL') . $port['alipaywap'];

        $url .= '?' . $params;
        $rs = self::curlGetUrl($url);

        return $rs;
    }

    /**
     * 优卡支付
     * @param $params
     * @return bool
     */
    public function uCardPay($params)
    {
        $port = $this->serverApiPorts;
        $url  = config('IMPAY_URL') . $port['ucardpay'];

        $url .= '?' . $params;
        $rs = self::curlGetUrl($url);

        return $rs;
    }

    public function uCardPayStatus($params)
    {
        $port = $this->serverApiPorts;
        $url  = config('IMPAY_URL') . $port['ucardpaystatus'];

        $url .= '?' . $params;
        $rs = self::curlGetUrl($url);

        return $rs;
    }


    /**
     * 定制的下单系统接口
     * @param $uid
     * @param $product_id
     * @param $payClient
     * @param $payType
     * @param $money
     * @return bool
     */
    public function recharge($uid, $product_id, $payClient, $payType, $money)
    {
        // $money = "20.1";
        if (!($money == (int)$money)) {
            return [
                'errorcode' => '-1',
                'errordesc' => "充值金额必须是整数",
            ];
        }

        $port = $this->serverApiPorts;
        $url  = $this->serverApiUrl . $port['recharge'];

        $data        = [];
        $data['uid'] = $uid;
        if (((int)$product_id) === 999) {
            $data['money'] = $money;
        } else {
            $data['id'] = $product_id;
        }
        $data['payClient'] = $payClient;
        $data['payType'] = $payType;
        $rs                = self::curlPostUrl($url, $data);
        if (!empty($rs['errorcode'])) {
            return $rs;
        } else {
            return $rs['channel_rid'];
        }
    }

    /**
     * 微信扫码支付
     * @param $params
     * @return bool
     */
    public function wxScanOrder($params)
    {
        $port = $this->serverApiPorts;
        $url  = config('IMPAY_URL') . $port['wxscanorder'];
        $url .= '?' . $params;
        $rs = self::curlGetUrl($url);

        return $rs;
    }

    /**
     * 微信公众号支付
     * @param $params
     * @return bool
     */
    public function wxWapOrder($params)
    {
        $port = $this->serverApiPorts;
        $url  = config('IMPAY_URL') . $port['wxwaporder'];
        $url .= '?' . $params;
        $rs = self::curlGetUrl($url);

        return $rs;
    }

    /**
     * 微信HT支付
     * @param $params
     * @return bool
     */
    public function wxH5Order($params)
    {
        $port = $this->serverApiPorts;
        $url  = config('IMPAY_URL') . $port['wxh5order'];
        $url .= '?' . $params;
        $rs = self::curlGetUrl($url);

        return $rs;
    }

    /**
     * 生成微信支付二维码
     * @param $params
     * @return bool
     */
    public function bizpayurl($params)
    {
        $rd   = ['status' => -1, 'content' => ''];
        $port = $this->serverApiPorts;
        $url  = config('IMPAY_URL') . $port['bizpayurl'];
        $url .= '?' . $params;
        $rs = self::curlGetUrl($url);
        if ($rs['status'] == 1) {
            $rd['status']  = 1;
            $rd['content'] = $rs['data'];
        }

        return $rd;
    }

    /**
     * 生成支付宝支付二维码
     * @param $params
     * @return bool
     */
    public function bizpayurlAli($params)
    {
        $rd   = ['status' => -1, 'content' => ''];
        $port = $this->serverApiPorts;
        $url  = config('IMPAY_URL') . $port['bizpayurlAli'];
        $url .= '?' . $params;
        $rs = self::curlGetUrl($url);
        if ($rs['status'] == 1) {
            $rd['status']  = 1;
            $rd['content'] = $rs['data'];
        }

        return $rd;
    }

    /**
     * 查询订单信息
     * @param $params
     * @return bool
     */
    public function notice($params)
    {
        $rd   = ['status' => -1];
        $port = $this->serverApiPorts;
        $url  = config('IMPAY_URL') . $port['notice'];
        $url .= '?' . $params;
        $rs = self::curlGetUrl($url);
        if ($rs['status'] == 1 && $rs['data']['status'] == 2) {
            $rd['status']         = 1;
            $rd['payment_status'] = '支付成功';
        }

        return $rd;
    }

    /**
     * 获取房间信息
     * @param $room_id
     * @return bool
     */
    public function roomInfo($room_id)
    {
        $rd   = ['status' => -1];
        $auth = self::apiAuth();
        $port = $this->serverApiPorts;
        $url  = $this->serverApiUrl . $port['roominfo'];
        $url .= '?auth_admin=' . $auth . '&roomId=' . $room_id;
        $rs = self::curlGetUrl($url);
        if (empty($rs['errorcode']) == FALSE) {
            $rd['status'] = 0;
        } elseif (empty($rs['errorcode']) == TRUE) {
            $rd['status'] = 1;
            $rd['room']   = $rs['room'];
        }

        return $rd;
    }

    /**
     * Top人气房间
     * @param $page
     * @param $count
     * @return bool
     */
    public function roomHot($page, $count)
    {
        $auth = self::apiAuth();
        $port = $this->serverApiPorts;
        $url  = $this->serverApiUrl . $port['roomhot'];
        $url .= '?auth_admin=' . $auth . '&page=' . $page . '&count=' . $count;
        $rs = self::curlGetUrl($url);

        return $rs;
    }

    /**
     * 查询主播直播是否已结束
     * @param $uid
     * @return bool
     */
    public function livestatus($uid)
    {
        $auth = self::apiAuth();
        $port = $this->serverApiPorts;
        $url  = $this->serverApiUrl . $port['livestatus'];

        $url .= '?auth_admin=' . $auth . '&uid=' . $uid;
        $rs = self::curlGetUrl($url);

        return $rs;
    }

    /**
     * 查询主播最新动态
     * @param $uid
     * @return bool
     */
    public function timeline($uid)
    {
        $port = $this->serverApiPorts;
        $url  = $this->serverApiUrl . $port['timeline'];

        $url .= '?uid=' . $uid . '&count=1';
        $rs = self::curlGetUrl($url);

        return $rs;
    }

    /**
     * 获取accessToken
     * @param $code
     * @return bool
     */
    public function getAccessToken($code, $platform = "APP")
    {
        if ($platform == "APP") {
            $config = config('WX.OPEN');
        } else {
            $config = config('WX.MP');
        }
        $params = [
            'appid'      => $config['APPID'],
            'secret'     => $config['AppSecret'],
            'code'       => $code,
            'grant_type' => "authorization_code",

        ];
        $url    = $this->serverApiPorts['accesstoken'];
        $url .= "?" . http_build_query($params);

        $rs = self::curlGetUrl($url);

        return $rs;
    }

    /**
     * 获取微信登录用户信息
     * @param $access_token
     * @param $openid
     * @return bool
     */
    public function wxUserInfo($access_token, $openid)
    {
        $port = $this->serverApiPorts;
        $url  = $port['userinfo'];

        $url .= '?access_token=' . $access_token . '&openid=' . $openid;
        $rs = self::curlGetUrl($url);

        return $rs;
    }

    /**
     * 获取accessCode
     * @param $code
     * @return bool
     */
    public function getAccessCode($code, $redirect_uri = NULL)
    {
        $client_id     = config('WB')['AppKey'];
        $client_secret = config('WB')['APPSecret'];

        if ($redirect_uri === NULL)
            $redirect_uri = config('SITE_URL');

        $url  = $this->serverApiPorts['accesscode'];
        $data = [
            'client_id'     => $client_id,
            'client_secret' => $client_secret,
            'grant_type'    => 'authorization_code',
            'redirect_uri'  => $redirect_uri,
            'code'          => $code,
        ];
        $url .= "?" . http_build_query($data);
        //$rs            = self::curlGetUrl($url);
        //用post方式请求，但参数拼接到url中，这么奇葩？见：http://www.cnblogs.com/kvspas/archive/2011/12/30/sina-oauth-21323.html
        $rs = self::curlPostUrl($url, []);

        return $rs;
    }

    /**
     * @brief 获取微博
     * @date  //
     * @param $access_token
     * @return bool|mixed
    @author wojiaojason@gmail.com
     */
    public function getWBTokenInfo($access_token)
    {
        $url  = "https://api.weibo.com/oauth2/get_token_info";
        $data = [
            'access_token' => $access_token['access_token'],
        ];
        $url .= "?" . http_build_query($data);
        //$rs            = self::curlGetUrl($url);
        //用post方式请求，但参数拼接到url中，这么奇葩？见：http://www.cnblogs.com/kvspas/archive/2011/12/30/sina-oauth-21323.html
        $rs = self::curlPostUrl($url, []);

        return $rs;
    }

    public function getWBUsers($accesscode)
    {
        $url  = "https://api.weibo.com/2/users/show.json";
        $data = [
            'access_token' => $accesscode['access_token'],
            'uid'          => $accesscode['uid'],
        ];
        $url .= "?" . http_build_query($data);
        $rs = self::curlGetUrl($url);

        return $rs;
    }


    /**
     * 获取QQ access_token
     * @param $code
     * @return bool
     */
    public function getQQAccessToken($code)
    {
        $url          = $this->serverApiPorts['qqtoken'];
        $app          = config('QQ_CONNECT.WEB');
        $redirect_uri = config('SITE_URL');

        $data = [
            'grant_type'    => 'authorization_code',
            'client_id'     => $app['APPID'],
            'client_secret' => $app['AppSecret'],
            'code'          => $code,
            'redirect_uri'  => $redirect_uri,
        ];
        $url .= "?" . http_build_query($data);

        $rs = self::curlRawGetUrl($url);
        if ($rs) {
            parse_str($rs, $ret);
        } else {
            $ret = $rs;
        }

        return $ret;

    }

    /**
     * 获取QQ openid
     * @param $access_token
     * @return bool
     */
    public function getOpenId($access_token)
    {
        $url = $this->serverApiPorts['qqopenid'];

        $url .= '?access_token=' . $access_token . "&unionid=1";;

        $rs = self::curlRawGetUrl($url);
        if ($rs) {
            $rs  = preg_replace("#^callback\((.*)\).*$#", "$1", $rs);
            $ret = json_decode($rs, TRUE);
        } else {
            $ret = $rs;
        }

        return $ret;

    }

    /**
     * 获取手机QQ access_token
     * @param $code
     * @return bool
     */
    public function getWapQQAccessToken($code)
    {
        $url          = $this->serverApiPorts['qqtoken'];
        $app          = config('QQ_CONNECT.WAP');
        $redirect_uri = config('SITE_M_URL');

        $data = [
            'grant_type'    => 'authorization_code',
            'client_id'     => $app['APPID'],
            'client_secret' => $app['AppSecret'],
            'code'          => $code,
            'redirect_uri'  => $redirect_uri,
        ];
        $url .= "?" . http_build_query($data);

        $rs = self::curlRawGetUrl($url);
        if ($rs) {
            parse_str($rs, $ret);
        } else {
            $ret = $rs;
        }

        return $ret;
    }

    /**
     * 获取QQ openid
     * @param $access_token
     * @return bool
     */
    public function getWapQQOpenId($access_token)
    {
        $url = $this->serverApiPorts['qqopenid'];

        $url .= '?access_token=' . $access_token . "&unionid=1";

        $rs = self::curlRawGetUrl($url);
        if ($rs) {
            $rs  = preg_replace("#^callback\((.*)\).*$#", "$1", $rs);
            $ret = json_decode($rs, TRUE);
        } else
            $ret = $rs;

        return $ret;
    }

    /**
     * 获取tokenInfo
     * @param $access_code
     * @return bool
     */
    public function getTokenInfo($access_code)
    {
        $port = $this->serverApiPorts;
        $url  = $port['gettokeninfo'];

        $url .= '?access_token=' . $access_code;
        $rs = self::curlGetUrl($url);

        return $rs;
    }

    /**
     * 获取授权用户信息
     * @param $token_info
     * @return bool
     */
    public function xlUserInfo($token_info)
    {
        $port = $this->serverApiPorts;
        $url  = $port['usershow'];

        $url .= '?source=' . $token_info['appkey'] . '&user_id=' . $token_info['uid'];
        $rs = self::curlGetUrl($url);

        return $rs;
    }

    /**
     * 判断用户是否满足首充条件
     * @param $uid
     * @return bool
     */
    public function firstCharge($uid)
    {
        $port = $this->serverApiPorts;
        $url  = $this->serverApiUrl . $port['firstcharge'];
        $url  = $url . '?uid=' . $uid;
        $rs   = self::curlGetUrl($url);

        return $rs;
    }

    /**
     * 用户礼物领取的接口
     * @param $data
     * @return bool
     */
    public function receive($data)
    {
        $port = $this->serverApiPorts;
        $url  = $this->serverApiUrl . $port['rechargegift'];
        $rs   = self::curlPostUrl($url, $data);
        if ($rs['errorcode'] == '0') {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * 圣诞活动数据获取接口
     * @param     $uid 用户id
     * @param     $accessToken
     * @param int $day 天数
     * @return bool|mixed
     */
    public function activity($uid, $accessToken)
    {
        $port = $this->serverApiPorts;
        $url  = 'http://gate.imay.com/api/v1/activity-1223';
//        $url  = $this->serverApiUrl . $port['festivalactivity'];
//        var_dump($url);exit;
        $url .= '?uid=' . $uid . '&accessToken=' . $accessToken . '&day=1';
        $rs = self::curlGetUrl($url);

        return $rs;
    }

    /**
     * 元旦活动数据获取接口
     * @param $uid
     * @param $accessToken
     * @return bool|mixed
     */
    public function newYearActivity($uid, $accessToken)
    {
        $port = $this->serverApiPorts;
        $url  = $this->serverApiUrl . $port['newyearactivity'];

        $url .= '?uid='. $uid .'&accessToken=' . $accessToken;
        $rs = self::curlGetUrl($url);

        return $rs;
    }

    /**
     * 动态信息
     * @param $feed_id
     * @return bool|mixed
     */
    public function share($feed_id)
    {
        $url  = $this->serverApiUrl . $this->serverApiPorts['share'];

        $url .= '?ids='. $feed_id;
        $rs = self::curlGetUrl($url);
        return $rs;
    }

    /**
     * 动态信息
     * @param $count
     * @return bool|mixed
     */
    public function feedsHot($count)
    {
        $url  = $this->serverApiUrl . $this->serverApiPorts['feedshot'];

        $url .= '?count='. $count;
        $rs = self::curlGetUrl($url);
        return $rs;
    }

    /**
     * 相关话题、热门动态和最新动态数据
     * @param $content
     * @return bool|mixed
     */
    public function relatedFeed($content)
    {
        $port = $this->serverApiPorts;
        $url  = $this->serverApiUrl . $port['labelcontent'];

        $url .= '?labelcontent='. $content;
        $rs = self::curlGetUrl($url);
        return $rs;
    }

    /**
     * 分页请求最新动态数据
     * @param $feed_id
     * @param $count
     * @param $content
     * @return bool|mixed
     */
    public function newsFeed($feed_id, $count, $content)
    {
        $port = $this->serverApiPorts;
        $url  = $this->serverApiUrl . $port['newestlabelfeed'];

        $url .= '?sinceid='. $feed_id . '&count=' . $count . '&labelcontent=' . $content;
        $rs = self::curlGetUrl($url);
        return $rs;
    }

    /**
     * 超胆挑战接口
     * @param $id
     * @return bool|mixed
     */
    public function superLive($id)
    {
        $port = $this->serverApiPorts;
        $url  = $this->serverApiUrl . $port['shareInfo'];

        $url .= '?shortLiveId='. $id;
        $rs = self::curlGetUrl($url);
        return $rs;
    }

    /**
     * 超胆挑战次数查询接口
     * @param $uid
     * @return bool|mixed
     */
    public function shortLive($uid)
    {
        $port = $this->serverApiPorts;
        $url  = $this->serverApiUrl . $port['shortlive'];
    
        $url .= '?uid='. $uid;
        $rs = self::curlGetUrl($url);
        return $rs;
    }

    /*
     * curl post到服务端
     * @param $url 接口地址
     * @param $data 参数数组
     */
    public function curlPostUrl($url, $data)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_TIMEOUT, 6);
        $rs   = curl_exec($ch);
        $flag = curl_getinfo($ch, CURLINFO_HTTP_CODE); //我知道HTTPSTAT码哦～
        /*  if($flag == 404){
			echo "找不到页面";
        } */
        curl_close($ch);
        if ($rs) {
            return json_decode($rs, TRUE);
        } else {
            return FALSE;
        }
    }


    /*
     * curl get到服务端
     * @param $url 接口地址
     * @param $data 参数数组
     */
    public function curlGetUrl($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 25);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $rs   = curl_exec($ch);
        $flag = curl_getinfo($ch, CURLINFO_HTTP_CODE); //我知道HTTPSTAT码哦～
        /* if($flag == 404){
       echo "找不到页面";
       } */
        curl_close($ch);
        if ($rs) {
            return json_decode($rs, TRUE);
        } else {
            return FALSE;
        }
    }

    /*
     * curl get到服务端
     * @param $url 接口地址
     * @param $data 参数数组
     */
    private function curlRawGetUrl($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 25);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 6);
        $rs   = curl_exec($ch);
        $flag = curl_getinfo($ch, CURLINFO_HTTP_CODE); //我知道HTTPSTAT码哦～
        /* if($flag == 404){
       echo "找不到页面";
       } */
        //print_r($rs);
        curl_close($ch);

        return $rs ? $rs : FALSE;
    }


    /**
     * 接口权限检查参数
     *
     */
    private function apiAuth()
    {
        $token     = "imay_admin";     //保密配置
        $timestamp = time();
        $appid     = '10001';
        $tmpArr    = [$token, $timestamp, $appid];
        $tmpStr    = implode($tmpArr);
        $signature = sha1($tmpStr);

        return $signature;
    }

    /**
     * 生成sessionId
     */
    private function sessionId()
    {
        $user_auth  = session('user_auth'); //获取登陆用户部分信息
        $uid        = $user_auth['uid'];
        $accessCode = $user_auth['accessCode'];     //登陆时获得的token.accessCode
        $timestamp  = time();
        $tmpArr     = [$uid, $timestamp, $accessCode];
        $tmpStr     = implode($tmpArr);
        $sessionId  = sha1($tmpStr);

        return $sessionId;
    }

    private function getAuth()
    {
        $user_auth  = session('user_auth'); //获取登陆用户部分信息
        $uid        = $user_auth['uid'];
        $timestamp  = time();
        $accessCode = $user_auth['accessCode'];

        $tmpArr    = [$uid, $timestamp, $accessCode];
        $tmpStr    = implode($tmpArr);
        $signature = sha1($tmpStr);

        return [
            'uid'       => $uid,
            'timestamp' => $timestamp,
            'sessionId' => $signature,
            'appkey'    => config('APP_KEY'),
        ];
    }

    /**
     * 魅号登录（获取用户信息）
     * @param $uid
     * @return bool
     */
    public function withdrawInfo()
    {
        $params = $this->getAuth();
        $params = http_build_query($params);

        $url = $this->serverApiUrl . $this->serverApiPorts['withdrawInfo'] . "?{$params}";
        $rs  = self::curlGetUrl($url);

        return $rs;
    }

    /**
     * 发起支付宝提现
     * @param $uid
     * @return bool
     */
    public function aliWithDraw($alipayAccount, $meili)
    {
        $params = [
            'alipayAccount' => $alipayAccount,
            'meili'         => $meili,
        ];
        $params = array_merge($params, $this->getAuth());
        $params = http_build_query($params);
        $url    = $this->serverApiUrl . $this->serverApiPorts['withdraw'] . "?{$params}";

        $rs = self::curlPostUrl($url, $params);

        return $rs;
    }

    /**
     * 获取提现记录
     * @param $uid
     * @return bool
     */
    public function withdrawRecords()
    {
        $params = [
            'page'  => 0,
            'count' => 10,
        ];
        $params = array_merge($params, $this->getAuth());
        $params = http_build_query($params);
        $url    = $this->serverApiUrl . $this->serverApiPorts['withdrawRecords'] . "?{$params}";

        $rs = self::curlGetUrl($url);

        return $rs;
    }

    public function profile()
    {
        $params = $this->getAuth();
        $params = http_build_query($params);

        $url = $this->serverApiUrl . $this->serverApiPorts['profile'] . "?{$params}";
        $rs  = self::curlGetUrl($url);

        return $rs;
    }

    public function redPackSend($params)
    {
        //组建url
        $url = config('IMPAY_URL') . $this->serverApiPorts['redPackSend'] . '?' . http_build_query($params);
        //请求
        // var_dump($url);exit;
        $rs  = self::curlGetUrl($url);

        return $rs;
    }

    public function getRankData($params)
    {
        //组建url
        $url = $this->serverApiUrl . $this->serverApiPorts['getrankdata'] . '?' . http_build_query($params);
        //请求
        // var_dump($url);exit;
        $rs = self::curlGetUrl($url);

        return $rs;
    }

    public function anchorInfor($uid)
    {
        $auth = $this->getAuth();
        $params = [
            'uid'       => $uid,
            'optuid'    => $auth['uid'],
            'timestamp' => $auth['timestamp'],
            'sessionId' => $auth['sessionId'],
            'appkey'    => $auth['appkey'],
        ];
        $params = http_build_query($params);

        $url = $this->serverApiUrl . $this->serverApiPorts['anchorinfor'] . "?{$params}";
        $rs  = self::curlGetUrl($url);

        return $rs;
    }

    public function statIncome($uid)
    {
        $auth = $this->getAuth();
        $params = [
            'uid'       => $uid,
            'optuid'    => $auth['uid'],
            'timestamp' => $auth['timestamp'],
            'sessionId' => $auth['sessionId'],
            'appkey'    => $auth['appkey'],
        ];
        $params = http_build_query($params);

        $url = $this->serverApiUrl . $this->serverApiPorts['statincome'] . "?{$params}";
        $rs  = self::curlGetUrl($url);

        return $rs;
    }

    public function statFans($uid)
    {
        $auth = $this->getAuth();
        $params = [
            'uid'       => $uid,
            'optuid'    => $auth['uid'],
            'timestamp' => $auth['timestamp'],
            'sessionId' => $auth['sessionId'],
            'appkey'    => $auth['appkey'],
        ];
        $params = http_build_query($params);

        $url = $this->serverApiUrl . $this->serverApiPorts['statfans'] . "?{$params}";
        $rs  = self::curlGetUrl($url);

        return $rs;
    }

    public function statFeedsns($uid)
    {
        $auth = $this->getAuth();
        $params = [
            'uid'       => $uid,
            'optuid'    => $auth['uid'],
            'timestamp' => $auth['timestamp'],
            'sessionId' => $auth['sessionId'],
            'appkey'    => $auth['appkey'],
        ];
        $params = http_build_query($params);

        $url = $this->serverApiUrl . $this->serverApiPorts['statfeedsns'] . "?{$params}";
        $rs  = self::curlGetUrl($url);

        return $rs;
    }

    public function statLive($roomId, $uid)
    {
        $auth   = $this->getAuth();
        $params = [
            'uid'       => $uid,
            'roomid'    => $roomId,
            'optuid'    => $auth['uid'],
            'timestamp' => $auth['timestamp'],
            'sessionId' => $auth['sessionId'],
            'appkey'    => $auth['appkey'],
        ];
        $params = http_build_query($params);

        $url = $this->serverApiUrl . $this->serverApiPorts['statlive'] . "?{$params}";
        $rs  = self::curlGetUrl($url);

        return $rs;
    }

    public function brokerInfor($uid)
    {
        $auth = $this->getAuth();
        $params = [
            'uid'       => $uid,
            'optuid'    => $auth['uid'],
            'timestamp' => $auth['timestamp'],
            'sessionId' => $auth['sessionId'],
            'appkey'    => $auth['appkey'],
        ];
        $params = http_build_query($params);

        $url = $this->serverApiUrl . $this->serverApiPorts['brokerinfor'] . "?{$params}";
        $rs  = self::curlGetUrl($url);

        return $rs;
    }

}
