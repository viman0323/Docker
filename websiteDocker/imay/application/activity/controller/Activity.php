<?php
// +----------------------------------------------------------------------
// | SentCMS [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.tensent.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: molong <molong@tensent.cn> <http://www.tensent.cn>
// +----------------------------------------------------------------------

namespace app\activity\controller;
use app\common\controller\Fornt;

/**
 * APP活动控制器
 * Class Activity
 * @package app\activity\controller
 */
class Activity extends Fornt
{
    /**
     * APP活动页面
     * @return mixed
     */
    public function index()
    {
        $uid = input('get.uid', '0');
        $m = model('ApiMethod');
        $rs = $m->firstCharge($uid); //首充条件是否符合
        $level = $get_gift = '0';
        if ($rs['firstRecharge']) {
            if ($rs['getGift']) {
                $get_gift = '0';
            } else {
                $get_gift = '1';
            }
            if (100 <= $rs['firstMoney'] && $rs['firstMoney'] < 5000) {
                $level = '1';
            } elseif (5000 <= $rs['firstMoney'] && $rs['firstMoney'] < 50000) {
                $level = '2';
            } else {
                $level = '3';
            }
        }
        $assign = array(
            'uid' => $uid,
            'level' => $level,
            'getGift' => $get_gift,
        );
        $this->assign($assign);
        return $this->fetch('activity/index');
    }

    /**
     * 首充活动领取
     */
    public function receive()
    {
        $uid = input('post.uid', '0');
        $accessToken = input('get.accessToken', '');
        $date = input('post.date');
        $gift_id = input('post.gift_id');
        $rd = array('status' => -1);
        $data = array(
            'uid' => $uid,
            'accessToken' => $accessToken,
            'itemId' => $gift_id,
            'duration' => $date,
        );
        $m = model('ApiMethod');
        if ($uid == '0') {
            echo json_encode($rd); die;
        }
        $rs = $m->receive($data);
        if ($rs) {
            $rd['status'] = 1;
        }
        echo json_encode($rd); die;
    }
}
