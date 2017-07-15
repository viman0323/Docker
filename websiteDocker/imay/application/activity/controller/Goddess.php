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
 * 女神活动控制器
 * Class Goddess
 * @package app\activity\controller
 */
class Goddess extends Fornt
{
    /**
     * 女神活动页面
     * @return mixed
     */
    public function index()
    {
        $uid = input('get.uid', '0'); //获取用户id

        $assign = array(
            'uid' => $uid,
        );
        $this->assign($assign);
        return $this->fetch('goddess/index');
    }

    /**
     * 女神活动页面（没有进入房间按钮）
     * @return mixed
     */
    public function indexList()
    {
        $uid = input('get.uid', '0'); //获取用户id

        $assign = array(
            'uid' => $uid,
        );
        $this->assign($assign);
        return $this->fetch('goddess/list');
    }

    /**
     * ajax 获取女神活动数据
     */
    public function ajaxindex()
    {
        $rd = array('status' =>-1, 'ACampRank'=>'', 'BCampRank'=>'', 'ranksC'=>'');
        $m = model('ApiMethod');
        $uid = input('post.uid', '0'); //获取用户id
//        $uid = 23430; //获取用户id
//
        // 女神活动数据接口地址
        $url  = 'http://dev.gate.imay.com/api/v1/activity-0328/victoryGoddess?uid=' . $uid;

//        $url  = 'http://192.168.0.222:7999/api/v1/activity-0328/victoryGoddess?uid=' . $uid;

        $rs = json_decode($m->curlGetUrl($url), true); //获取女神礼物排行榜数据


        if ($rs['result_code'] == 0) {
            $rd['ranksC'] = [
                'goddessNick' => $rs['goddess_nick'], // 女神昵称
                'goddessImgHead' => str_ireplace('http://img.imay.com', 'https://imgs.imay.com', $rs['goddess_img_head']), // 女神头像
                'guardianNick' => $rs['guardian_nick'], // 守护使者昵称
                'guardianImgHead' => str_ireplace('http://img.imay.com', 'https://imgs.imay.com', $rs['guardian_img_head']), // 守护使者头像
                'myCampNumber' => $rs['my_camp_number'], // 我在阵营收礼数量
                'myCampRank' => $rs['my_camp_rank'], // 我在阵营中的排名
                'ACampSum' => $rs['a_camp_total'], // A阵营收礼总和
                'BCampSum' => $rs['b_camp_total'], // B阵营收礼总和
                'whichCamp' => $rs['which_camp'], // 我所属的阵营
            ];
            if ($rs['a_camp_rank']) {
                foreach ($rs['a_camp_rank'] as $k => $v) {
                    $rs['a_camp_rank'][$k]['url'] = 'iMay://com.imay.live/openwith?type=1&roomId=' . $v['room_id'] . '&url=http://down.imay.com/pi/' . $v['room_id'] . '/playlist.m3u8';
                }
            }
            $rd['ACampRank'] = $rs['a_camp_rank'];
            if ($rs['b_camp_rank']) {
                foreach ($rs['b_camp_rank'] as $k => $v) {
                    $rs['b_camp_rank'][$k]['url'] = 'iMay://com.imay.live/openwith?type=1&roomId=' . $v['room_id'] . '&url=http://down.imay.com/pi/' . $v['room_id'] . '/playlist.m3u8';
                }
            }
            $rd['BCampRank'] = $rs['b_camp_rank'];

            $rd['status'] = 1;
        }


        exit(json_encode($rd));

    }
}
