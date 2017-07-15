<?php
// +----------------------------------------------------------------------
// | SentCMS [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.tensent.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: molong <molong@tensent.cn> <http://www.tensent.cn>
// +----------------------------------------------------------------------

namespace app\user\controller;

use app\common\controller\User;
use think\Cache;

/**
 * 账户充值控制器
 * Class Recharge
 * @package app\index\controller
 */
class Recharge extends User
{
    /**
     * 账户充值列表
     * @return mixed
     */
    public function index()
    {
        \think\Config::load(APP_PATH . "conf/recharge.conf.php");
        $recharge = config('RECHARGE');//可以选择支付的项
        $diamond  = cookie('diamond'); // 魅钻
        
        $this->getPcInfoSimpleSession();
        
        $assign = [
            'diamond'  => $diamond,
            'recharge' => $recharge,
        ];
        $this->assign($assign);
        
        return $this->fetch('recharge/index');
    }

    /**
     * 18岁确认
     */
    public function tip()
    {
        $uid = input('post.uid');
        $isAdult = 1;
        $rd = ['status' => -1, 'errordesc' => ''];
        $m = model('ApiMethod');
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
     * 支付宝支付
     */
    public function aliScanPay()
    {
        $rd           = ['status' => -1, 'content' => ''];
        $channel_code = config('CHANNEL_CODE'); //项目代号
        
        $subject    = input('post.subject', ''); //商品名称
        $product_id = trim(input('post.product_id', '')); //商品id
        $uid        = input('post.uid'); //获取用户id
        $body       = '购买' . $subject; //商品描述
        $payClient  = '3'; //3: PC官网 4:手机官网 5:公众号
        $payType    = '3'; //2微信   3支付宝
        
        $money   = $this->getMoney($product_id);
        $diamond = $this->getMoneyToDiamond($money);
        
        $m           = model('ApiMethod');
        $channel_rid = $m->recharge($uid, $product_id, $payClient, $payType, $money); //下单
        if (!empty($channel_rid['errorcode'])) {
            if ($channel_rid['errorcode'] == 4) {
                $channel_rid['errordesc'] = $channel_rid['desc'];
            }
            return json_encode($channel_rid, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        }
        $data =
            [
                'subject'      => $subject,
                'total_amount' => $money,
                'channel_code' => $channel_code,
                'body'         => $body,
                'channel_rid'  => $channel_rid,
            ];
        
        //生成签名
        $data['sign'] = $this->buildRequestParams($data);
        //接口请求
        $rs = $m->createDirectPayByUser(http_build_query($data));
        
        if ($rs['status'] == 1) {
            $data = ['code_url' => $rs['data']['qr_code'], 'channel_code' => $channel_code];
            //生成签名
            $signs = $this->buildRequestParams($data);
            $url   = 'channel_code=' . $channel_code . '&code_url=' . $rs['data']['qr_code'] . '&sign=' . $signs;
            $r     = $m->bizpayurlAli($url); // 生成二维码并返回二维码存放地址
            if ($r['status'] == '1') {
                $rd['status']       = 1;
                $rd['out_trade_no'] = $rs['data']['out_trade_no'];//返回流水号
                
                $cache_key = "g:imay:pay:scan:al:" . $rd['out_trade_no'];
                $value     = ['m' => $money, 'pic' => $r['content']];
                Cache::set($cache_key, $value, 1800);
                cookie('diamond', $diamond, 1800);
            }
        }
        exit(json_encode($rd));
    }
    
    /**
     * 微信支付
     * @return mixed
     */
    public function wxScanPay()
    {
        $rd           = ['status' => -1, 'content' => ''];
        $channel_code = config('CHANNEL_CODE'); //项目代号
        
        $subject    = trim(input('post.subject', '')); //商品名称
        $product_id = trim(input('post.product_id', '')); //商品id
        $uid        = input('post.uid'); //获取用户id
        
        $money   = $this->getMoney($product_id);
        $diamond = $this->getMoneyToDiamond($money);
        
        $body      = '购买' . $subject; //商品描述
        $payClient = '3'; //3: PC官网 4:手机官网 5:公众号
        $payType   = '2'; //2微信   3支付宝
        
        $m           = model('ApiMethod');
        $channel_rid = $m->recharge($uid, $product_id, $payClient, $payType, $money); //下单
        if (!empty($channel_rid['errorcode'])) {
            if ($channel_rid['errorcode'] == 4) {
                $channel_rid['errordesc'] = $channel_rid['desc'];
            }
            return json_encode($channel_rid, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        }
        $data =
            [
                'subject'      => $subject,
                'amount'       => $money,
                'channel_code' => $channel_code,
                'body'         => $body,
                'channel_rid'  => $channel_rid,
                'product_id'   => $product_id,
            ];
        //生成签名
        $data['sign'] = $this->buildRequestParams($data);
        //接口请求
        $rs = $m->wxScanOrder(http_build_query($data)); //微信扫码支付
        if ($rs['status'] == 1) {
            $data = ['code_url' => $rs['data']['code_url'], 'channel_code' => $channel_code];
            //生成签名
            $signs = $this->buildRequestParams($data);
            $url   = 'channel_code=' . $channel_code . '&code_url=' . $rs['data']['code_url'] . '&sign=' . $signs;
            $r     = $m->bizpayurl($url); // 生成二维码并返回二维码存放地址
            if ($r['status'] == 1) {
                $rd['status']       = 1;
                $rd['out_trade_no'] = $rs['data']['out_trade_no'];//返回流水号
                
                $cache_key = "g:imay:pay:scan:wx:" . $rd['out_trade_no'];
                $value     = ['m' => $money, 'pic' => $r['content']];
                Cache::set($cache_key, $value, 3600);
                cookie('diamond', $diamond, 3600);
            }
        }
        exit(json_encode($rd));
    }
    
    /**
     * 显示支付扫码页面
     */
    public function pay()
    {
        $type         = input('get.type');
        $out_trade_no = input('get.no');
        
        if ($type == 'weixin') {
            $cache = Cache::get('g:imay:pay:scan:wx:' . $out_trade_no);
        } else {
            $cache = Cache::get('g:imay:pay:scan:al:' . $out_trade_no);
        }
        if ($cache['m'] == '') {
            $this->redirect('user/recharge/index');
        }
        
        $this->getPcInfoSimpleSession();
        
        $assign = [
            'type'         => $type,
            'out_trade_no' => $out_trade_no,
            'img_url'      => urldecode($cache['pic']),
            'money'        => $cache['m'],
        ];
        $this->assign($assign);
        
        return $this->fetch('recharge/pay');
    }
    
    /**
     * 定时检查-扫码支付是否成功
     * @return mixed
     */
    public function notice()
    {
        $channel_code = config('CHANNEL_CODE'); //项目代号
        $out_trade_no = input('post.out_trade_no');
        $type         = input('post.type');
        $m            = model('ApiMethod');
        $data         = ['batch_no' => $out_trade_no, 'channel_code' => $channel_code];
        //生成签名
        $signs = $this->buildRequestParams($data);
        $url   = 'channel_code=' . $channel_code . '&batch_no=' . $out_trade_no . '&sign=' . $signs;
        $rd    = $m->notice($url);
        //支付成功 清除缓存
        if ($rd['status'] == '1') {
            if ($type == 'weixin') {
                $key = 'imay:pay:scan:wx:' . $out_trade_no;
            } else {
                $key = 'g:imay:pay:scan:al:' . $out_trade_no;
            }
            Cache::rm($key);
            cookie('diamond', '');
        }
        exit(json_encode($rd));
    }
    
    /**
     * 生成签名
     * @param $para_temp //请求前的参数数组
     * @return //要请求的参数数组
     */
    private function buildRequestParams($para_temp)
    {
        ksort($para_temp);
        
        //获取项目应用支付接口访问秘钥
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
    
    
    private function getMoney($product_id)
    {
        \think\Config::load(APP_PATH . "conf/recharge.conf.php");
        if (((int)$product_id) == 999) {
            $money = trim(input('post.money', 0));
        } else {
            $money = config('RECHARGE')[$product_id - 1]['rmb']; //购买金额
        }
        
        return $money;
    }
    
    private function getMoneyToDiamond($money)
    {
        return $money * 10;
    }
    
    public function test()
    {
        return $this->fetch('recharge/test');
    }
    
    /**
     * @brief  支付成功页面
     * @author wojiaojason@gmail.com
     */
    public function successfulView()
    {
        return $this->fetch('recharge/success');
    }
    
    /**
     * @brief  支付未完成页面
     * @author wojiaojason@gmail.com
     */
    public function unfinishView()
    {
        return $this->fetch('recharge/unfinish');
    }

    /**
     * 七牛图片上传
     */
    public function uploadPic()
    {
        $pic = $this->qiNiuUploadPic();
        $url = '';
        foreach ($pic as $v) {
            $url = $v['url'];
        }
    
        $sfilename = input("sfilename");
        $fname     = input("fname");
        $srcpath   = $url;
        $thumbpath = $url;
    
        echo "<script>parent.getQiNiuUploadFilename('$sfilename','$srcpath','$thumbpath','$fname');</script>";
    }
}
