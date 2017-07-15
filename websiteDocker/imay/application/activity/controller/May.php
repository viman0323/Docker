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
 * 五一活动页面控制器
 * Class May
 * @package app\activity\controller
 */
class May extends Fornt
{
    /**
     * 五一活动排行榜页面
     * @return mixed
     */
    public function index()
    {
        $uid = input('get.uid');
        $assign = array(
            'uid' => $uid,
        );
        $this->assign($assign);
        return $this->fetch('may/index');
    }

    /**
     * 获取五一数据并处理
     */
    public function ajaxIndex()
    {
        $uid = input('post.uid');
        $m = model('ApiMethod');
        $rd = ['status' => -1, 'rankA' => '', 'rankB' => '', 'rankC' => '', 'rankD' => '', 'time' => ''];
        $url = config('SERVER_API_URL'). '/api/v1/activity-0501/laborDay?uid=' . $uid;
        $rs = json_decode($m->curlGetUrl($url), true);

        if ($rs['result_code'] == 0) {
            // 处理个人信息数据
            $rd['rankA'] = [
                'myANumber' => $rs['my_A_number'], // 我收到A礼物的数量
                'myARank' => $rs['my_A_rank'], // 我收到A礼物的排名
                'myBNumber' => $rs['my_B_number'], // 我收到B礼物的数量
                'myBRank' => $rs['my_B_rank'], // 我收到B礼物的排名
                'myCNumber' => $rs['my_C_number'], // 我收到C礼物的数量
                'myCRank' => $rs['my_C_rank'], // 我收到C礼物的排名
                'myDressUpNumber' => $rs['my_dress_up_number'], // 我的装扮数量
                'myDressUpRank' => $rs['my_dress_up_rank'], // 我的装扮排名
                'totalNumber' => $rs['total_number'], // 奖池值
            ];
            // 判断是否显示个人信息 0不显示  1显示
            if ($rs['my_A_number'] == 0 && $rs['my_B_number'] == 0 && $rs['my_C_number'] == 0 && $rs['my_dress_up_number'] == 0) {
                $rd['rankA']['show'] = 0;
            } else {
                $rd['rankA']['show'] = 1;
            }

            // 5.1号数据处理
            if ($rs['A_top10']) {
                foreach ($rs['A_top10'] as $k => $v) {
                    // 从页面跳转到APP直播间地址
                    $rs['A_top10'][$k]['url'] = 'iMay://com.imay.live/openwith?type=1&roomId=' . $v['room_id'] .
                        '&url=http://down.imay.com/pi/' . $v['room_id'] . '/playlist.m3u8';
                }
                $rd['rankB'] = $rs['A_top10'];
            }

            // 5.2号数据处理
            if ($rs['B_top10']) {
                foreach ($rs['B_top10'] as $k => $v) {
                    // 从页面跳转到APP直播间地址
                    $rs['B_top10'][$k]['url'] = 'iMay://com.imay.live/openwith?type=1&roomId=' . $v['room_id'] .
                        '&url=http://down.imay.com/pi/' . $v['room_id'] . '/playlist.m3u8';
                }
                $rd['rankC'] = $rs['B_top10'];
            }

            // 5.3装扮排行榜数据处理
            if ($rs['dress_up_top10']) {
                foreach ($rs['dress_up_top10'] as $k => $v) {
                    // 从页面跳转到APP直播间地址
                    $rs['dress_up_top10'][$k]['url'] = 'iMay://com.imay.live/openwith?type=1&roomId=' . $v['room_id'] .
                        '&url=http://down.imay.com/pi/' . $v['room_id'] . '/playlist.m3u8';
                }
                $rd['rankD'] = $rs['dress_up_top10'];
            }

            $rd['time'] = $rs['time_stamp']; // 活动当天的时间

            // 接口数据返回正常
            $rd['status'] = 1;
        }
        exit(json_encode($rd));
    }

}
