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

/**
 * 账户提现控制器
 * Class Recharge
 * @package app\index\controller
 */
class WithDraw extends User
{
    public function index()
    {
        \think\Config::load(APP_PATH . "conf/recharge.conf.php");
        
        $m            = model('ApiMethod');
        $withdrawInfo = $m->withdrawInfo();
        
        // $withdrawInfo = ["accountLocked" => FALSE, "alipayAccount" => "13760682938", "bindPhone" => TRUE, "itemDouble" => 0, "liveOnlineTime" => 3373, "meili" => 7437568, "realName" => "植逊杰", "realNameVerify" => true, "result" => 0,"signConfirmStatus"=>1,"isSigned"=>0];
        if ($withdrawInfo) {
            $withdrawInfo['hasDouble'] = 0;//自定义字段，是否有双倍卡:0无，1有
            if (isset($withdrawInfo['meili'])) {
                $itemDouble = 1;
                //"itemDouble": int,    双倍卡过期时间 =0为无双倍卡
                $new_time = time();
                if ($withdrawInfo['itemDouble'] > 0 && $withdrawInfo['itemDouble'] > $new_time) {
                    $itemDouble = 2;
                    $withdrawInfo['hasDouble'] = 1;
                }
                $withdrawInfo['meili_money'] = ($withdrawInfo['meili'] / 100.0) * 3 * $itemDouble;
            }

            $this->assign("withdrawInfo", $withdrawInfo);
        }
        
        // var_dump($user_info);
        // var_dump($withdrawInfo);
        
        return $this->fetch('withdraw/index');
    }

    /**
     * 显示提现成功页面
     */
    public function successfulView()
    {
        return $this->fetch('withdraw/success');
    }
}
