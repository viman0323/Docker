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
 * 情人节活动控制器
 * Class Valentine
 * @package app\activity\controller
 */
class Valentine extends Fornt
{
    /**
     * 情人节活动页面
     * @return mixed
     */
    public function index()
    {
        $uid = input('get.uid', '0'); //获取用户id

        $assign = array(
            'uid' => $uid,
        );
        $this->assign($assign);
        return $this->fetch('valentine/index');
    }

    /**
     * 情人节活动页面（没有进入房间按钮）
     * @return mixed
     */
    public function indexList()
    {
        $uid = input('get.uid', '0'); //获取用户id

        $assign = array(
            'uid' => $uid,
        );
        $this->assign($assign);
        return $this->fetch('valentine/list');
    }

    /**
     * ajax 获取情人节排行榜数据
     */
    public function ajaxindex()
    {
        $rd = array('status' =>-1, 'ranksA'=>'', 'ranksB'=>'', 'ranksC'=>'');
        $m = model('ApiMethod');
        $uid = input('post.uid', '0'); //获取用户id

        // 情人节活动浪漫心数据接口连接
        $url  = config("server_api")['SERVER_API_URL'] . '/api/v1/activity-0214/valentine?Uid=' . $uid;

//        $url  = 'http://192.168.0.222:7999/api/v1/activity-0214/valentine?Uid=' . $uid;

        $rs = json_decode($m->curlGetUrl($url), true); //获取情人节双榜排行榜数据

//        var_dump($rs);

        if ($rs['error_code'] == 0 && !empty($rs['nick'])) {
            $rd['ranksC'] = [
                'nick' => $rs['nick'], // 我的昵称
                'imgHead' => $rs['img_head'], //我的头像
                'myReceiveRomantic' => $rs['my_receive_romantic'], //我收到浪漫心个数
                'myRomanticRank' => $rs['my_romantic_rank'], //我的浪漫心排名
                'myReceiveForever' => $rs['my_receive_forever'], //我收到的永恒心个数
                'myForeverRank' => $rs['my_forever_rank'], //我的永恒心排名
                'mySpendDiamond' => $rs['my_spend_diamond'], //我的送礼消耗魅钻
                'mySpendRank' => $rs['my_spend_rank'], //我的送礼排名
            ];
            if ($rs['romantic_rank']) {
                foreach ($rs['romantic_rank'] as $k => $v) {
                    $rs['romantic_rank'][$k]['url'] = 'iMay://com.imay.live/openwith?type=1&roomId=' . $v['room_id'] . '&url=http://down.imay.com/pi/' . $v['room_id'] . '/playlist.m3u8';
                }
            }
            $rd['ranksA'] = $rs['romantic_rank'];
            if ($rs['forever_rank']) {
                foreach ($rs['forever_rank'] as $k => $v) {
                    $rs['forever_rank'][$k]['url'] = 'iMay://com.imay.live/openwith?type=1&roomId=' . $v['room_id'] . '&url=http://down.imay.com/pi/' . $v['room_id'] . '/playlist.m3u8';
                }
            }
            $rd['ranksB'] = $rs['forever_rank'];
            $rd['status'] = 1;
        }

        exit(json_encode($rd));

    }
}
