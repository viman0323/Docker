<?php
// +----------------------------------------------------------------------
// | SentCMS [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.tensent.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: molong <molong@tensent.cn> <http://www.tensent.cn>
// +----------------------------------------------------------------------

namespace app\index\controller;
use app\common\controller\Fornt;

/**
 * APP分享控制器
 * Class Share
 * @package app\share\controller
 */
class Share extends Fornt
{
    /**
     * APP分享页面
     * @return mixed
     */
    public function index()
    {
        \think\Config::load(APP_PATH . "conf/share_video.conf.php");
        $room_id = input('param.room_id');
        $page = '1';
        $count = config('pageSize');
        $video = config('SHARE_VIDEO');
        $m = model('ApiMethod');
        $room = $m->roomInfo($room_id);
        $room_hot = $m->roomHot($page, $count);
        if (isset($room['room']) && !empty($room['room'])) {
            if (empty($room['room']['title']) == true) {
                $room['room']['title'] = '0';
            }
            if (empty($room['room']['imgFace']) == true) {
                $room['room']['imgFace'] = '0';
            }
            if (empty($room['room']['info']['uid']) == true) {
                $room['room']['info']['uid'] = '0';
            }
            if (empty($room['room']['info']['nick']) == true) {
                $room['room']['info']['nick'] = '0';
            }
        }
        else {
            $this->error("对不起，该用户或房间不存在！", "/");
        }
        if (isset($room_hot['rooms']) && !empty($room_hot['rooms'])) {
            foreach ($room_hot['rooms'] as $k => $v) {
                if (empty($v['imgFace']) == true) {
                    $room_hot['rooms'][$k]['imgFace'] = '0';
                }
                if (empty($v['current']) == true) {
                    $room_hot['rooms'][$k]['current'] = '0';
                }
                if (empty($v['info']) == true) {
                    $room_hot['rooms'][$k]['info'] = array();
                }
                if (empty($v['title']) == true) {
                    $room_hot['rooms'][$k]['title'] = '0';
                }
                if($v['roomId'] == $room_id) {
                    unset($room_hot['rooms'][$k]);
                }
            }
        }
        $this->assign('room', $room);
        $this->assign('video', $video[mt_rand(0,2)]);
        $this->assign('room_hot', $room_hot);
        return $this->fetch();
    }

    /**
     * 查询主播直播是否已结束
     * @return mixed
     */
    public function live()
    {
        $rd = array('status' => -1);
        $uid = input('param.uid', '');
        $m = model('ApiMethod');
        $rs = $m->livestatus($uid);
        if ($rs['live'] == true) {
            $rd['status'] = 1;
        } elseif ($rs['live'] == false) { // 获取最新动态
            $newslist = $m->timeline($uid);
            if ($newslist['feeds']) {
                if ($newslist['feeds']['0']['FeedType'] == 1) {
                    $rd['status'] = 2;
                    $rd['type'] = 1;
                    $rd['content'] = $newslist['feeds']['0']['ImgUrl'];
                } elseif ($newslist['feeds']['0']['FeedType'] == 2) {
                    $rd['status'] = 2;
                    $rd['type'] = 2;
                    $rd['content'] = $newslist['feeds']['0']['VideoUrl'];
                }
            }
        }
        echo json_encode($rd); die;
    }

}
