<?php

/*===============================================================
*   Copyright (C) 2015 All rights reserved.
*
*   file        : CaptureMonster.php
*   author      : jason.zhi
*   date        : 2016/12/12
*   description : 
*   modify      :
*
================================================================*/
namespace app\m\controller;

// class Capturemonster extends \app\common\controller\Base
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
     * @brief  获取授权地址
     * @author wojiaojason@gmail.com
     */
    public function authorizeUrl()
    {
        // header('Access-Control-Allow-Origin:*');
        // header('Access-Control-Allow-Credentials:true');
        $unionid = \think\Session::get("unionid");
        // $unionid      = "oVKnlvzeFNKxhs1pUFkNzPxh-ZdQ";
        $crc32Unionid = crc32($unionid);
        
        // $redirectUrl = \think\Request::instance()->domain() . "/CaptureMonster/index";
        $redirectUrl = "https://m.imay.com/CaptureMonster/index";
        $link        = $this->weObj->getOauthRedirect($redirectUrl, $unionid);
        
        $modelCaptureMonster = model('CaptureMonster');
        $data                = $modelCaptureMonster->info($crc32Unionid, $unionid);
        
        if ($data) {
            $curScore = $data['score'];
            if ($curScore >= 751) {
                $percent     = "100";
                $designation = "后羿";
            } else if ($curScore >= 701) {
                $percent     = "90";
                $designation = "超神射手";
                
            } else if ($curScore >= 601) {
                $percent     = "80";
                $designation = "神射手";
                
            } else if ($curScore >= 401) {
                $percent     = "70";
                $designation = "超级射手";
                
            } else if ($curScore >= 201) {
                $percent     = "60";
                $designation = "黄金射手";
                
            } else if ($curScore >= 100) {
                $percent     = "50";
                $designation = "白银射手";
                
            } else {
                $percent     = "40";
                $designation = "瞎猫射手";
                
            }
            $desc = <<<STR
【{$data['name']}】超过了{$percent}%的人，成就“{$designation}”称号!
STR;
            
            return json([
                'status' => 1,
                'title'  => "碉堡了——360度全景AR直播，逼死处女座的游戏！",
                'desc'   => $desc,
                'link'   => $link,
                'imgUrl' => "{$data['head_img']}",
            ]);
        } else {
            return json([
                'status' => -1,
                'link'   => $link,
            ]);
        }
    }
    
    /**
     * @brief  领取红包
     * @author wojiaojason@gmail.com
     */
    public function getRedPack()
    {
        $timeStamp           = input('timeStamp', 0);
        $modelCaptureMonster = model('CaptureMonster');
        try {
            $starttimeRedPack = strtotime("2016-12-28");
            $endtimeRedPack   = strtotime("2016-12-31");
            if (empty($timeStamp)) {
                $curtime = time();
            } else {
                $curtime = strtotime("2016-12-28");
            }
            if ($curtime >= $endtimeRedPack) {
                throw new \Exception("红包已过期,截止日期为" . date("Y-m-d H:i:s", $endtimeRedPack));
            }
            if ($curtime >= $starttimeRedPack) {
                $ret = $this->weObj->getOauthAccessToken();
                // $ret = [
                //     'openid'  => 'o5h07w374rLUQ97R8bJm5mSdso0o',
                //     'unionid' => 'oVKnlvzeFNKxhs1pUFkNzPxh-ZdQ',
                // ];//todo
                if ($ret) {
                    $unionid      = $ret['unionid'];
                    $crc32Unionid = crc32($unionid);
                    $userInfo     = $modelCaptureMonster->info($crc32Unionid, $unionid);
                    if ($userInfo) {
                        if (!empty($userInfo['get_red_pack'])) {
                            throw new \Exception("领取失败,您已领取过红包");
                        }
                        $openid   = $userInfo['mp_openid'];
                        $arr      = $modelCaptureMonster->getBatch();
                        $targetId = empty($userInfo['id']) ? 0 : $userInfo['id'];
                        
                        if (($ranking = array_search($targetId, array_column($arr, 'id'))) !== FALSE) {
                            $ranking += 1;
                            //进入前200名，领红包啦
                            if ($ranking == 1) {
                                $money = 20000;
                            } else if ($ranking == 2) {
                                $money = 10000;
                            } else if ($ranking == 3) {
                                $money = 5000;
                            } else if ($ranking >= 4 && $ranking <= 10) {
                                $money = 1000;
                            } else if ($ranking >= 11 && $ranking <= 200) {
                                $money = 200;
                            } else {
                                throw new \Exception("领取失败,未能进入前200名！");
                            }
                            $params = [
                                'send_name'    => 'iMay',
                                're_openid'    => $openid,
                                'total_amount' => $money,
                                'total_num'    => '1',
                                'wishing'      => '恭喜你获得红包奖励',
                                'client_ip'    => get_client_ip(),
                                'act_name'     => 'AR全景游戏',
                                'remark'       => '活动红包奖励',
                                'channel_code' => 'zyhb',
                                // 'channel_code' => config('CHANNEL_CODE'),
                                'channel_rid'  => $targetId,
                            ];
                            
                            $modelApiMethod = model('ApiMethod');
                            //生成签名
                            $params['sign'] = $this->buildRequestPara($params);
                            $arr            = $modelApiMethod->redPackSend($params);
                            //
                            if ($arr) {
                                if ($arr['return_code'] === 'SUCCESS' && $arr['result_code'] === 'SUCCESS') {
                                    //领取成功
                                    $modelCaptureMonster->updateRedPack($crc32Unionid, $unionid, $money);
                                    throw new \Exception("领取成功！");
                                } else {
                                    throw new \Exception("领取失败," . $arr['err_code_des']);
                                }
                            } else {
                                //领取失败
                                throw new \Exception("领取失败,服务器超时");
                            }
                        } else {
                            //未进入前200名
                            throw new \Exception("领取失败，未能进入前200名！");
                        }
                    } else {
                        throw new \Exception("领取失败，用户不存在！");
                    }
                    
                } else {
                    throw new \Exception("网络错误，请重新打开页面~");
                }
            } else {
                throw new \Exception("活动还没结束,请于" . date("Y-m-d H:i:s", $starttimeRedPack) . "活动结束后再次点击领取吧！");
            }
        } catch (\Exception $e) {
            $scriptText = $e->getMessage();
        }
        
        $this->assign('scriptText', $scriptText);
        
        return $this->fetch('capturemonster/redpackinfo');
    }
    
    /**
     * @brief 首页
     * @return mixed
    @author wojiaojason@gmail.com
     */
    public function index()
    {
        // return $this->fetch("capturemonster/index");
        
        // $unionid="oVKnlvzeFNKxhs1pUFkNzPxh-ZdQ";//by testm
        $modelCaptureMonster = model('CaptureMonster');
        
        // $unionid = \think\Session::set("unionid", "oVKnlvzeFNKxhs1pUFkNzPxh");//oVKnlvzeFNKxhs1pUFkNzPxh-ZdQ
        // $unionid = \think\Session::delete("unionid");//oVKnlvzeFNKxhs1pUFkNzPxh-ZdQ
        $unionid = \think\Session::get("unionid");//oVKnlvzeFNKxhs1pUFkNzPxh-ZdQ
        // return json(['tmp' => $unionid]);
        
        if (empty($unionid)) {
            try {
                $ret = $this->weObj->getOauthAccessToken();
                if ($ret) {
                    $accessToken  = $ret['access_token'];
                    $openid       = $ret['openid'];
                    $crc32Openid  = crc32($openid);
                    $unionid      = $ret['unionid'];
                    $crc32Unionid = crc32($unionid);
                    
                    $userInfo = $modelCaptureMonster->info($crc32Unionid, $unionid);
                    
                    if (empty($userInfo)) {//用户不存在
                        $userInfo = $this->weObj->getOauthUserinfo($accessToken, $openid);
                        if ($userInfo) {
                            $name = $userInfo['nickname'];
                            // echo addslashes(htmlspecialchars(trim($name)))."<br>";
                            // echo json_encode($name);exit;
                            // echo $openid;exit;
                            $headImg = $userInfo['headimgurl'];
                            $data    = [
                                'unionid'         => $unionid,
                                'crc32_unionid'   => $crc32Unionid,
                                'mp_openid'       => $openid,
                                'crc32_mp_openid' => $crc32Openid,
                                'name'            => preg_replace('/[\xf0-\xf7].{3}/', '', trim($name)),
                                'head_img'        => $headImg,
                                'update_time'     => time(),
                            ];
                            $modelCaptureMonster->insert($data);
                            
                            //set session
                            \think\Session::set('crc32_unionid', $crc32Unionid);
                            \think\Session::set('unionid', $unionid);
                            
                            // return json(['tmp' => $data]);
                            return $this->fetch("capturemonster/index");
                        } else {
                            throw new \Exception("授权失败，请重新打开页面");
                        }
                    } else {//用户已存在
                        //set session
                        \think\Session::set('crc32_unionid', $crc32Unionid);
                        \think\Session::set('unionid', $unionid);
                        
                        // return json(['tmp' => 2]);
                        return $this->fetch("capturemonster/index");
                    }
                    
                } else {
                    throw new \Exception("授权失败，请重新打开页面");
                }
            } catch (\Exception $e) {
                // $this->error($e->getMessage(), NULL, '', 0);
                if (\think\Request::instance()->isAjax()) {
                    return json([
                        'errorcode' => -1,
                        'errormsg'  => $e->getMessage(),
                    ]);
                } else {
                    exception($e->getMessage());
                }
            };
        } else {
            // return json(['tmp' => 3]);
            return $this->fetch("capturemonster/index");
        }
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
    
    /**
     * @brief  上传本次游戏得分，并返回排名
     * @author wojiaojason@gmail.com
     */
    public function score()
    {
        // header('Access-Control-Allow-Origin:*');
        // header('Access-Control-Allow-Credentials:true');
        $score = (int)input('post.score', 0);
        
        $modelCaptureMonster = model('CaptureMonster');
        $unionid             = \think\Session::get("unionid");//oVKnlvzeFNKxhs1pUFkNzPxh-ZdQ
        // $unionid             = "oVKnlvzeFNKxhs1pUFkNzPxh-ZdQ";
        $crc32Unionid = crc32($unionid);
        $ranking      = 9999;
        if ($unionid) {
            $data = $modelCaptureMonster->info($crc32Unionid, $unionid);
            if ($data) {
                $curScore = $data['score'];
                $shareNum = $data['share_num'];
                
                $endtime = strtotime("2016-12-28");
                $curtime = time();
                if ($curScore < $score && $curtime < $endtime) {
                    $curScore = $score;
                    $modelCaptureMonster->updateScore($crc32Unionid, $unionid, $score);
                }
                $ranking = $modelCaptureMonster->getRanking($curScore, $shareNum, $curtime);
            }
        }
        
        return json(['ranking' => $ranking]);
    }
    
    /**
     * @brief  获取前200名玩家的信息
     * @author wojiaojason@gmail.com
     */
    public function rankings()
    {
        // header('Access-Control-Allow-Origin:*');
        // header('Access-Control-Allow-Credentials:true');
        $modelCaptureMonster = model('CaptureMonster');
        $unionid             = \think\Session::get("unionid");
        // $unionid             = "oVKnlvzeFNKxhs1pUFkNzPxh-ZdQ";
        $crc32Unionid = crc32($unionid);
        
        $arr      = $modelCaptureMonster->getBatch();
        $row      = $modelCaptureMonster->info($crc32Unionid, $unionid);
        $targetId = empty($row['id']) ? 0 : $row['id'];
        
        foreach ($arr as $k => &$v) {
            if ($v['id'] == $targetId) {
                $v['isMe'] = TRUE;
            } else {
                $v['isMe'] = FALSE;
            }
            $v['ranking'] = $k + 1;
            unset($v['id']);
        }
        
        return json($arr);
    }
    
    /**
     * @brief  获得坐骑
     * @author wojiaojason@gmail.com
     */
    public function lotteryDraw()
    {
        // header('Access-Control-Allow-Origin:*');
        // header('Access-Control-Allow-Credentials:true');
        $modelLotteryZuoqi = model('LotteryZuoqi');
        $unionid           = \think\Session::get("unionid");
        // $unionid           = "oVKnlvzeFNKxhs1pUFkNzPxh-ZdQ";
        $crc32Unionid = crc32($unionid);
        
        $prize = [
            ['id' => 3007, 'name' => '魔灯号'],
        ];
        $len   = count($prize);
        $index = mt_rand(0, $len - 1);
        
        // $modelLotteryZuoqi->edit([
        //     'unionid'  => $unionid,
        //     'zuoqi_id' => $prize[$index]['id'],
        // ]);
        $modelLotteryZuoqi->execute("REPLACE INTO ime_lottery_zuoqi SET unionid='{$unionid}',zuoqi_id={$prize[$index]['id']}");
        
        return json(['id' => $prize[$index]['id']]);
    }
    
    /**
     * @brief  增加分享次数
     * @author wojiaojason@gmail.com
     */
    public function incrShareNum()
    {
        $modelCaptureMonster = model('CaptureMonster');
        $modelShareRecord    = model('ShareRecord');
        $unionid             = \think\Session::get("unionid");
        $crc32Unionid        = crc32($unionid);
        
        $type = input("post.type");
        $link = input("post.link");
        
        $ret = $modelCaptureMonster->updateShareNum($crc32Unionid, $unionid);
        $modelShareRecord->edit($unionid, $type, $link);
        
        if ($ret) {
            return json(['status' => 1]);
        } else {
            return json(['status' => -1]);
        }
        
    }
    
    public function getBaseAccessToken()
    {
        $arr = $this->weObj->checkAuth();
        var_dump($arr);
    }
    
    public function test()
    {
        // var_dump($_SESSION);
        
        // $openid = "o9wjFw6IS68EJBFT784rkHapfWl0";
        // // return $this->fetch("capturemonster/index");
        // $arr = $this->weObj->getUserInfo($openid);
        // var_dump($arr);
        // $modelCaptureMonster = model('CaptureMonster');
        // $inserid = $modelCaptureMonster->insert([
        //     'name'=> $reposts_msg = preg_replace('/[\xf0-\xf7].{3}/', '', $arr['nickname'])
        // ]);
        // var_dump($inserid);
    }
    
    public function allCount()
    {
        $modelCaptureMonster = model('CaptureMonster');
        $count               = $modelCaptureMonster->count();
        
        return json(['count' => $count]);
    }
    
    public function getRanking()
    {
        $modelCaptureMonster = model('CaptureMonster');
        $unionid             = \think\Session::get("unionid");
        $unionid             = "oVKnlvzeFNKxhs1pUFkNzPxh-ZdQ";
        $crc32Unionid        = crc32($unionid);
        
        $data = $modelCaptureMonster->info($crc32Unionid, $unionid);
        
        $ranking = -1;
        if ($data) {
            $curScore = $data['score'];
            $shareNum = $data['share_num'];
            $curtime  = $data['update_time'];
            
            $ranking = $modelCaptureMonster->getRanking($curScore, $shareNum, $curtime);
        }
        
        return json([
            'ranking' => $ranking,
        ]);
    }
    
    function buildRequestPara($params)
    {
        ksort($params);
        
        $secret_key = "oPJmEKx1E8J3ReSP";
        $buff       = "";
        foreach ($params as $k => $v) {
            if ($v != "" && !is_array($v)) {
                $buff .= $k . "=" . $v . "&";
            }
        }
        $buff = trim($buff, "&");
        $buff .= '&key=' . $secret_key;
        unset($params);
        $sign = md5($buff);
        
        return $sign;
    }
}