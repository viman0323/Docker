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
 * Class NewYearActivity
 * @package app\activity\controller
 */
class NewYearActivity extends Fornt
{
    /**
     * 元旦活动页面
     * @return mixed
     */
    public function index()
    {
        $uid = input('get.uid', '0'); //获取用户id
        $accessToken = input('get.accessToken', '');

        $assign = array(
            'uid' => $uid,
            'accessToken' => $accessToken,
        );
        $this->assign($assign);
        return $this->fetch('nyactivity/index');
    }
    
    /**
     * ajax 获取红包数据
     */
    public function ajaxlist()
    {
        $rd = array('status' =>-1, 'content'=>'');
        $uid = input('post.uid', '0'); //获取用户id
        $accessToken = input('post.accessToken', '');

        $m = model('ApiMethod');
        $rs = $m->newYearActivity($uid, $accessToken); //获取元旦活动红包数量

        if ($rs['errorcode'] == 0) {
            $rd['status'] = 1;
            $rd['content'] = $rs['redbagRemain'];
        }

        exit(json_encode($rd));

    }

    /**
     * 春节活动
     * @return mixed
     */
    public function indexList()
    {
        return $this->fetch('nyactivity/list');
    }


    /**
     * 春节活动
     * @return mixed
     */
    public function listIndex()
    {
        return $this->fetch('nyactivity/indexList');
    }

    /**
     * ajax 获取恭喜发财排行榜
     */
    public function ajaxindex()
    {
        $rd = array('status' =>-1, 'ranksA'=>'', 'ranksB'=>'');
        $m = model('ApiMethod');

        // 春节活动恭喜发财数据接口连接
        $url  = config("server_api")['SERVER_API_URL'] . '/api/v1/activity-newyear/gongxifacai';
        // 春节活动发财数据接口连接
        $urls  = config("server_api")['SERVER_API_URL'] . '/api/v1/activity-newyear/facai';
        $rs = $m->curlGetUrl($url); //获取恭喜发财排行榜数据
        $r = $m->curlGetUrl($urls); //获取发财排行榜数据

        if ($rs['errorcode'] == 0) {
            if ($rs['ranks']) {
                foreach ($rs['ranks'] as $k => $v) {
                    $rs['ranks'][$k]['User']['url'] = 'iMay://com.imay.live/openwith?type=1&roomId=' . $v['User']['roomId'] . '&url=http://down.imay.com/pi/' . $v['User']['roomId'] . '/playlist.m3u8';
                }
                $rd['status'] = 1;
            } else {
                $rd['status'] = 2;
            }
            $rd['ranksA'] = $rs['ranks'];
        }

        if ($r['errorcode'] == 0) {
            if ($r['ranks']) {
                $rd['status'] = 1;
            } else {
                $rd['status'] = 2;
            }
            $rd['ranksB'] = $r['ranks'];
        }

        exit(json_encode($rd));

    }
}
