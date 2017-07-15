<?php
/*===============================================================
*   Copyright (C) 2015 All rights reserved.
*
*   file        : recharge.php
*   author      : jason.zhi
*   date        : 2016/10/27
*   description :
*   modify      :
*
================================================================*/
namespace app\m\controller;

use app\common\controller\Fornt;

class Recharge extends Fornt
{
    //const APPID = "wxd75b6f2cade96a53";
    //const APPSECRET = "20982e1051e8721e5fbcbc88e6a37a7f";
    
    public function curlGetUrl($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
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
    
    private function curlPostUrl($url, $data)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
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
    
    /**
     * 生成支付宝/微信支付请求 的签名
     * @param $para_temp //请求前的参数数组
     * @return //要请求的参数数组
     */
    function buildRequestParams($para_temp)
    {
        ksort($para_temp);
        
        $secret_key = config('SECRET_KEY');
        $buff       = "";
        foreach ($para_temp as $k => $v) {
            if ($v != "" && !is_array($v)) {
                $buff .= $k . "=" . $v . "&";
            }
        }
        $buff = trim($buff, "&");
        $buff .= '&key=' . $secret_key;
        unset($para_temp);
        $sign = md5($buff);
        
        return $sign;
    }
    
    /**
     * @brief  获取用户的openid
     * @author jason.zhi@lihuobao.cn
     * @date   2016/10/28
     * @refer  from sdk
     */
    public function getOpenid()
    {
        $config    = config("WX.MP");
        $appid     = $config["APPID"];
        $appsecret = $config["AppSecret"];
        
        if (!isset($_GET['code'])) {//获取授权code
            $redirect_url = \Think\Request::instance()->url(TRUE);
            //$redirect_url = "http://vicp.iask.in/wap.php/recharge/index";//回调到本页面 TODO 放到配置项中去
            //redirect_url参数错误：1 试试打开Safari查看具体的回调地址是什么？2 公众号设置的回调地址是否正确？
            $url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid={$appid}&redirect_uri={$redirect_url}&response_type=code&scope=snsapi_base&state=STATE#wechat_redirect";
            Header("Location: $url");
            exit();
        } else {//通过code换取网页授权access_token
            //var_dump($_GET);
            $code = $_GET['code'];
            $url  = "https://api.weixin.qq.com/sns/oauth2/access_token?appid={$appid}&secret={$appsecret}&code={$code}&grant_type=authorization_code";
            $ret  = $this->curlGetUrl($url);
            //var_dump($ret);exit;
            //if (isset($ret['openid']))
            //    $openid = $ret['openid'];
            //else
            //    $openid = "";
            $openid = $ret['openid'];
            
            //echo $openid;exit;
            return $openid;
        }
    }
    
    /**
     * 账户充值列表
     * @return mixed
     */
    public function index()
    {
        // echo \Think\Request::instance()->domain();
        // echo \Think\Request::instance()->url(TRUE);exit;
        // echo \Think\Request::instance()->baseUrl(TRUE);exit;
        // echo url("/user/recharge/index");exit;
        $needAlert = input('get.needAlert', 0);
        $order_id = input('get.orderid', 0);
        if (!empty($order_id)) {//优卡支付成功的同步返回
            $needAlert = 2;
        }
        
        $pattern = "/MicroMessenger/i";
        if (preg_match($pattern, $_SERVER['HTTP_USER_AGENT'])) {//微信浏览器
            $openid = \think\Session::get("openid");
            // $openid = "o5h07w374rLUQ97R8bJm5mSdso0o";
            if (empty($openid)) {
                $openid = $this->getOpenid();
                \think\Session::set("openid", $openid);
                //echo "{$openid},not from session";
                $this->redirect("recharge/index");
            } else {
                //echo "{$openid},from session";
            }
        } else {//普通浏览器
            $openid = "";
            //echo "normal";
        }
        \think\Config::load(APP_PATH . "conf/recharge.conf.php");
        
        $recharge = config('RECHARGE');//可以选择支付的项
        //获取用户信息
        $user_auth_room_id = session('user_auth_room_id'); //获取session中的用户信息

        $user_info = [];
        if (!empty($user_auth_room_id)) {
            $m         = model('ApiMethod');
            $user_info = $m->getInfoSimpleByRoomId($user_auth_room_id['roomId']);
            $rs = $m->getRechargeSumByUid($user_auth_room_id['uid']);
            if ($rs['errorcode'] == 0) {
                $sum['sumRecharge'] = $rs['SumRecharge'];
                $sum['isAdult'] = $rs['IsAdult'];
            } else {
                $sum['sumRecharge'] = 0;
                $sum['isAdult'] = 0;
            }
        } else {
            $sum = [
                'sumRecharge' => 0,
                'isAdult' => 0,
            ];
        }
        // $user_info['user']['DiamondRecharge']=1;
        // var_dump($user_info);

        $assign = [
            'needAlert' => $needAlert,
            'user_id'   => ($user_auth_room_id['uid']) ? $user_auth_room_id['uid'] : 0,
            'open_id'   => !empty($openid) ? $openid : 0,
            'recharge'  => $recharge,
            'user'      => $user_info,
            'sum'       => $sum,
            'room_id'   => $user_info ? $user_info['user']['roomId'] : 0,
            'sync_url'  => \Think\Request::instance()->baseUrl(TRUE), //支付成功的同步地址
        ];
        $this->assign($assign);
        
        return $this->fetch('recharge/index');
    }

    /**
     * 确认成年
     */
    public function tips()
    {
        $uid = input('post.uid');
        $m = model('ApiMethod');
        $isAdult = 1;
        $rd = ['status' => -1, 'errordesc' => ''];
        if (!$uid) {
            $rd['errordesc'] = 'CodeParamError';
            exit(json_encode($rd, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
        }
        $rs = $m->getRechargeTipsByUid($uid, $isAdult);
        if ($rs['errorcode'] == 0) {
            $rd['status'] = 1;
        }
        exit(json_encode($rd, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
    }
    
    /**
     * @brief  切换账号
     * @author jason.zhi@lihuobao.cn
     * @date   2016/10/31
     */
    public function switchAccount()
    {
        \think\Session::delete("user_auth_room_id");
        
        return $this->redirect('recharge/index');
    }
    
    /**
     * 微信支付
     * @return mixed
     */
    public function wxJsApiPay()
    {
        $channel_code = config('CHANNEL_CODE'); //项目代号
        
        $product_id = trim(input('post.product_id', 999)); //商品id
        $subject    = trim(input('post.subject', '')); //商品名称
        $uid        = input('post.uid'); //获取用户id
        $openid     = input('post.openid', '');//用户公众号的openid
        $payClient  = input('post.payClient');
        $payType    = '2'; //2微信 3支付宝 4优卡支付
        
        $money = $this->getMoney($product_id);
        
        $body = "购买" . $this->getMoneyToDiamond($money) . "魅钻"; //商品描述
        
        $m = model('ApiMethod');
        //获取我们自己平台的下单系统的订单ID
        $channel_rid = $m->recharge($uid, $product_id, $payClient, $payType, $money);
        if (!empty($channel_rid['errorcode'])) {
            if ($channel_rid['errorcode'] == 4) {
                $channel_rid['errordesc'] = $channel_rid['desc'];
            }
            return json_encode($channel_rid, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_SLASHES);
        }
        
        $data =
            [
                'subject'      => $subject,
                'amount'       => $money,
                'channel_code' => $channel_code,
                'body'         => $body,
                'channel_rid'  => $channel_rid,
                'product_id'   => $product_id,
                'openid'       => $openid,
            ];
        
        //生成签名
        $data['sign'] = $this->buildRequestParams($data);
        //接口请求
        $rs = $m->wxwaporder(http_build_query($data));
        
        return json_encode($rs, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }
    
    
    /**
     * 微信支付
     * @return mixed
     */
    public function wxH5Pay()
    {
        $channel_code = config('CHANNEL_CODE'); //项目代号
        
        $product_id = trim(input('post.product_id', 999)); //商品id
        $subject    = trim(input('post.subject', '')); //商品名称
        $uid        = input('post.uid'); //获取用户id
        $openid     = input('post.openid', '');//用户公众号的openid
        $payClient  = input('post.payClient');
        $payType    = '2'; //2微信 3支付宝 4优卡支付
        
        $money = $this->getMoney($product_id);
        
        $body = "购买" . $this->getMoneyToDiamond($money) . "魅钻"; //商品描述
        
        $m = model('ApiMethod');
        //获取我们自己平台的下单系统的订单ID
        $channel_rid = $m->recharge($uid, $product_id, $payClient, $payType, $money);
        if (!empty($channel_rid['errorcode'])) {
            if ($channel_rid['errorcode'] == 4) {
                $channel_rid['errordesc'] = $channel_rid['desc'];
            }
            return json_encode($channel_rid, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_SLASHES);
        }
        
        $data =
            [
                'subject'      => $subject,
                'amount'       => $money,
                'channel_code' => $channel_code,
                'body'         => $body,
                'channel_rid'  => $channel_rid,
                'product_id'   => $product_id,
                'openid'       => $openid,
            ];
        
        //生成签名
        $data['sign'] = $this->buildRequestParams($data);
        //接口请求
        $rs = $m->wxH5Order(http_build_query($data));
        
        return json_encode($rs, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }
    
    /**
     * @brief  支付宝支付
     * @author jason.zhi@lihuobao.cn
     * @date   //
     */
    public function aliPay()
    {
        $channel_code = config('CHANNEL_CODE'); //项目代号
        
        $product_id = trim(input('post.product_id', 999)); //商品id
        $subject    = trim(input('post.subject', '')); //商品名称
        $uid        = input('post.uid'); //获取用户id
        $payClient  = input('post.payClient');
        $payType    = '3'; //2微信 3支付宝 4优卡支付
        
        $money = $this->getMoney($product_id);
        
        $body = "购买" . $this->getMoneyToDiamond($money) . "魅钻"; //商品描述
        
        $m = model('ApiMethod');
        //获取我们定制的下单系统的订单ID
        $channel_rid = $m->recharge($uid, $product_id, $payClient, $payType, $money);
        if (!empty($channel_rid['errorcode'])) {
            if ($channel_rid['errorcode'] == 4) {
                $channel_rid['errordesc'] = $channel_rid['desc'];
            }
            return json_encode($channel_rid, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        }
        
        //调用接口的数据
        $data =
            [
                'subject'      => $subject,
                'total_amount' => $money,
                'channel_code' => $channel_code,
                'body'         => $body,
                'channel_rid'  => $channel_rid,
                'product_id'   => $product_id,
            ];
        
        //生成签名
        $data['sign'] = $this->buildRequestParams($data);
        //接口请求
        $rs = $m->aliPayWap(http_build_query($data));
        
        exit(json_encode($rs, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
    }
    
    /**
     * @brief  优卡支付
     * @author jason.zhi@lihuobao.cn
     */
    public function uCardPay()
    {
        $channel_code = config('CHANNEL_CODE'); //项目代号
        
        $product_id = trim(input('post.product_id', 999)); //商品id
        $subject    = trim(input('post.subject', '')); //商品名称
        $uid        = input('post.uid'); //获取用户id
        $payClient  = input('post.payClient');
        $type       = input('post.type');
        $hrefbackurl = input('post.hrefbackurl', '');
        $payType    = '4'; //2微信 3支付宝 4优卡支付
        
        //测试数据
        // $product_id = 999; //商品id
        // $subject    = "魅钻充值"; //商品名称
        // $uid        = 749; //获取用户id
        // $payClient  = 3;
        // $type       = 963;
        // $payType    = '4'; //2微信 3支付宝
        
        $money = $this->getMoney($product_id);
        
        //
        // $money = 0.1;
        
        $body = "购买" . $this->getMoneyToDiamond($money) . "魅钻"; //商品描述
        
        $m = model('ApiMethod');
        //获取我们定制的下单系统的订单ID
        $channel_rid = $m->recharge($uid, $product_id, $payClient, $payType, $money);
        if (empty($channel_rid) || !empty($channel_rid['errorcode'])) {
            if ($channel_rid['errorcode'] == 4) {
                $channel_rid['errordesc'] = $channel_rid['desc'];
            }
            return json_encode($channel_rid, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_SLASHES);
        }
        
        //调用接口的数据
        $data =
            [
                'type'         => $type,//银行卡类型
                'value'        => $money,//金额,单位元（人民币），2位小数，最小支付金额为0.02
                'channel_rid'  => $channel_rid,
                'channel_code' => $channel_code,
                'goodsname'    => $subject,
                'attach'       => $body,
                'hrefbackurl'  => $hrefbackurl,
            ];
        
        //生成签名
        $data['sign'] = $this->buildRequestParams($data);
        //接口请求
        $rs = $m->uCardPay(http_build_query($data));
        
        exit(json_encode($rs, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
    }
    
    /**
     * @brief  获取优卡支付状态
     * @author wojiaojason@gmail.com
     */
    public function uCardPayStatus()
    {
        $channel_code = config('CHANNEL_CODE'); //项目代号
        $orderid      = input('get.orderid');
        $m            = model('ApiMethod');
        
        //test
        // $orderid = "201702240023";
        //
        
        //调用接口的数据
        $data = [
            'payment_no'   => $orderid,
            'channel_code' => $channel_code,
        ];
        //生成签名
        $data['sign'] = $this->buildRequestParams($data);
        //接口请求
        $rs = $m->uCardPayStatus(http_build_query($data));
        if (isset($rs['retcode']) && $rs['retcode'] == 0) {
            $rs = ['status' => 1, 'data' => $rs];
        } else {
            $rs = ['status' => -1, 'data' => $rs];
        }
        exit(json_encode($rs, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
        
    }
    
    private function getMoney($product_id)
    {
        \think\Config::load(APP_PATH . "conf/recharge.conf.php");
        if (((int)$product_id) == 999) {
            $money = trim((input('post.money', 0)));
        } else {
            $money = config('RECHARGE')[$product_id - 1]['rmb']; //购买金额
        }
        
        return $money;
    }
    
    private function getMoneyToDiamond($money)
    {
        return $money * 10;
    }
    
    public function guide()
    {
        return $this->fetch('recharge/guide');
    }

    /**
     * vip充值页面
     */
    public function largeVip()
    {
        return $this->fetch('recharge/large');
    }
}