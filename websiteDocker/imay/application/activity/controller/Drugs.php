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
 * 小魅有药活动控制器
 * Class Drugs
 * @package app\activity\controller
 */
class Drugs extends Fornt
{
    /**
     * 小魅有药活动页面
     * @return mixed
     */
    public function index()
    {
        $uid = input('get.uid');
        $accessToken = input('get.accessToken', '');
        $assign = array(
            'uid' => $uid,
            'accessToken' => $accessToken,
        );
        $this->assign($assign);
        return $this->fetch('drugs/index');
    }

    /**
     * 关注功能
     */
    public function follow()
    {
        $search = input('post.');
        $m = model('ApiMethod');
        $rd = ['status' => -1];
        $time = time();
        $data = [$search['uid'],$time,$search['accessToken']];
        $signature = sha1(implode($data));
        $datas = ['followUid' => $search['followId']];
        $url  = config("SERVER_API_URL") . '/v2/user/relation/create?appkey=app&uid='. $search['uid'] .'&t='. $time .'&signature='. substr($signature, 0, 12);
//        $url  = 'http://192.168.30.252:7999/v2/user/relation/create?uid='. $search['uid'] .'&t='. $time .'&signature='. substr($signature, 0, 12);
//        var_dump($url);
        $rs = $m->curlPostUrl($url, $datas);
        if ($rs['result'] == 0 && !empty($rs['data'])) {
            $rd['status'] = 1;
        }
        exit(json_encode($rd));

    }

    /**
     * 小魅有药获取数据
     */
    public function ajaxIndex()
    {
        $uid = input('post.uid');
        $m = model('ApiMethod');
        $rd = ['status' => -1, 'rankA' => '', 'rankB' => '', 'rankC' => ''];
        // 获取小魅有药活动排行榜数据接口地址
        $url  = config("SERVER_API_URL") . '/api/v1/activity-0422/loveAngel?uid=' . $uid;

//        $url  = 'http://192.168.30.252:7999/api/v1/activity-0422/loveAngel?uid=' . $uid;
//        var_dump(json_decode($m->curlGetUrl($url), true));exit;

        $rs = json_decode($m->curlGetUrl($url), true); // 获取小魅有药活动排行榜数据
        if ($rs['result_code'] == 0) {

            // 将数据处理之后赋值并返回
            $rd['rankA'] = [
                'angelNick' => $rs['angel_nick'], // 最美爱心天使昵称
                'angelImg' => $rs['angel_head_img'], // 最美爱心天使头像
                'guardianNick' => $rs['guardian_nick'], // 守护使者昵称
                'guardianImg' => $rs['guardian_head_img'], // 守护使者头像
                'myNick' => $rs['my_nick'], // 我的昵称
                'myImg' => $rs['my_head_img'], // 我的头像
                'myReceiveNumber' => $rs['my_receive_number'], // 我的收礼数量
                'myReceiveRank' => $rs['my_receive_rank'], // 我的收礼的排行名次
                'mySendNumber' => $rs['my_send_number'], // 我的送礼数量
                'mySendRank' => $rs['my_send_rank'], // 我的送礼的排行名次
            ];

            // 处理收礼数据
            if ($rs['receive_rank']) { // 收礼排行榜
                foreach ($rs['receive_rank'] as $k => $v) {
                    // 从页面跳转到app房间链接
                    $rs['receive_rank'][$k]['url'] = 'iMay://com.imay.live/openwith?type=1&roomId=' . $v['room_id'] .
                        '&url=http://down.imay.com/pi/' . $v['room_id'] . '/playlist.m3u8';
                }
                $rd['rankB'] = $rs['receive_rank'];
            }

            // 处理送礼数据
            if ($rs['send_rank']) {
                foreach ($rs['send_rank'] as $k => $v) {
                    // 从页面跳转到app房间链接
                    $rs['send_rank'][$k]['url'] = 'iMay://com.imay.live/openwith?type=1&roomId=' . $v['room_id'] .
                        '&url=http://down.imay.com/pi/' . $v['room_id'] . '/playlist.m3u8';
                }
                $rd['rankC'] = $rs['send_rank'];
            }

            // 接口正常返回数据，将状态改为1
            $rd['status'] = 1;
        }

        exit(json_encode($rd));
    }

}
