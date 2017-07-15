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

class WithDraw extends User
{

    /**
     * 账户充值列表
     * @return mixed
     */
    public function index()
    {
        //var_dump(session('user_auth'));exit;
        $m = model('ApiMethod');

        $withdrawInfo = $m->withdrawInfo();
        if ($withdrawInfo === FALSE || !empty($withdrawInfo['errorcode'])) {
            $this->error("登录超时", url('login/toLogin'));
        }
        $userInfo = $m->profile();
        
        $userInfo = $userInfo['user'];
        $tmp      = [
            'nick'    => empty($userInfo['nick']) ? "" : $userInfo['nick'],
            'roomId'  => empty($userInfo['roomId']) ? "" : $userInfo['roomId'],
            'phone'   => empty($userInfo['phone']) ? "" : $userInfo['phone'],
            'imgHead' => empty($userInfo['imgHead']) ? "" : $userInfo['imgHead'],
        ];
        // $withdrawInfo['meili'] =50000;
        // $withdrawInfo['bindPhone']=1;
        // $withdrawInfo['realNameVerify']=1;
        // $withdrawInfo['signConfirmStatus']=1;
        // $withdrawInfo['isSigned']=1;
        //var_dump(session('user_auth'));
        // var_dump($withdrawInfo);
        // var_dump(strlen($withdrawInfo['meili']));
        // var_dump($userInfo);
        
        $this->assign("withdrawInfo", $withdrawInfo);
        $this->assign("userInfo", $tmp);

        return $this->fetch('withdraw/index');
    }

    /**
     * @brief  支付宝提现
     * @date   //
     * @author wojiaojason@gmail.com
     */
    public function aliWithDraw()
    {
        $alipayAccount = input('post.alipayAccount', '');
        $meili         = input('post.meili', '');

        $m  = model('ApiMethod');
        $rs = $m->aliWithDraw($alipayAccount, $meili);

        $ret = getRetrunStr($rs);

        return $ret;
    }

    /**
     * @brief  提现记录
     * @author wojiaojason@gmail.com
     */
    public function records()
    {
        $m   = model('ApiMethod');
        $res = $m->withdrawRecords();
        // var_dump($res);
        if ($res && empty($res['errorcode'])) {
            if (empty($res['records'])) {
                return $this->fetch('withdraw/no_records');
            } else {
                $this->assign('records', $res['records']);

                return $this->fetch('withdraw/records');
            }
        } else {

        }

    }

    //端口联调-测试
    public function test()
    {
        //$phone    = "13760682938";
        //$_POST['country']  = "86";
        //$password = "123456";

        //端口联调
        //$m        = model('ApiMethod');
        //$userAuth = session('user_auth'); //获取session中的用户信息
        //var_dump($userAuth);
        //$rs = $m->loginPhone($phone, $password);
        //var_dump($rs);

        //用户信息
        //$rs = $m->profile();
        //var_dump($rs);
        //发起提现
        //$alipayAccount = "13760682938";
        //$meili         = "300";
        //$rs            = $m->withdraw($alipayAccount, $meili);
        //var_dump($rs);

        //获取提现信息
        //$withdrawInfo = $m->withdrawInfo();
        //var_dump($withdrawInfo);

        //提现记录
        //$withdrawInfo = $m->withdrawRecords();
        //var_dump($withdrawInfo);

        //$room_id = "110065";
        //$rs = $m->getInfoSimpleByRoomId($room_id);
        //var_dump($rs);exit;
    }
}