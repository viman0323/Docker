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
use DateTime;

/**
 * 盖楼金币控制器
 * Class LevyGold
 * @package app\activity\controller
 */
class LevyGold extends Fornt
{
    /**
     * 个人金币管理页面
     * @return mixed
     */
    public function index()
    {
        $uid = input('get.uid', '0'); //获取用户id
        $rd = array('status' => -1, 'content' => '', 'user' => '', 'type' => 0);
        $m = model('ApiMethod');
        // 获取个人金币情况
        $url  = config("SERVER_API_URL") . '/api/v1/room/house/info?uid=' . $uid;
//        $url  = 'http://192.168.30.200:7999/api/v1/room/house/info?uid=' . $uid;
//        var_dump($m->curlGetUrl($url));
//        exit;

        $rs = $m->curlGetUrl($url);
        if ($rs['errorcode'] == 0) {
            $rd['status'] = 1;
            $rd['content'] = [
                'MyCard1' => $rs['MyCard1'],
                'MyCard2' => $rs['MyCard2'],
                'MyCard3' => $rs['MyCard3'],
                'UserGoldMoney' => $rs['UserGoldMoney'],
            ];
            if ($rs['MyCard1'] == 0 && $rs['MyCard2'] == 0 && $rs['MyCard3'] == 0) {
                $rd['content']['show'] = 0;
            } else {
                $rd['content']['show'] = 1;
            }

            $arr = [];
            if ($rs['UserList']) {
                foreach ($rs['UserList'] as $k => $v) {
                    $arr[$v['RoomId']] = $v;
                }
            }
            $total = 0;
            if ($rs['FloorList']) {
                foreach ($rs['FloorList'] as $key => $value) {
                    $total += $value['SumDevote'];
                    $rs['FloorList'][$key]['nick'] = $arr[$value['RoomId']]['Nick'];
                    $rs['FloorList'][$key]['imgHead'] = $arr[$value['RoomId']]['ImgHead'];
                    $rs['FloorList'][$key]['liveStatus'] = $arr[$value['RoomId']]['LiveStatus'];
                    if ($value['HouseType'] == 1) {
                        $date = self::dateTime($value['CreateTime']);
                        $rs['FloorList'][$key]['content'] = $date . '送出小平房卡';
                    } else if ($value['HouseType'] == 2) {
                        $date = self::dateTime($value['CreateTime']);
                        $rs['FloorList'][$key]['content'] = $date . '送出洋房卡';
                    } else if ($value['HouseType'] == 3) {
                        $date = self::dateTime($value['CreateTime']);
                        $rs['FloorList'][$key]['content'] = $date . '送出别墅卡';
                    } else {
                        $rs['FloorList'][$key]['content'] = '';
                    }
                    $rs['FloorList'][$key]['url'] = 'iMay://com.imay.live/openwith?type=1&roomId=' . $value['RoomId'] .
                        '&url=http://down.imay.com/pi/' . $value['RoomId'] . '/playlist.m3u8';
                }
                $rd['user'] = $rs['FloorList'];
                $rd['type'] = 1;
            }
            $rd['content']['total'] = $total; // 本周获得金币
        }
//        var_dump($rd);
//exit;
        $date = new DateTime();
        $date->modify('this week + 7 days');
        $end_week = $date->format('Y,m,d');
        $end = explode(',', $end_week);

        $assign = array(
            'page' => $rd['content'],
            'list' => $rd['user'],
            'type' => $rd['type'],
            'year' => $end['0'],
            'month' => $end['1']-1,
            'day' => $end['2']
        );
        $this->assign($assign);
        return $this->fetch('levygold/index');
    }

    /**
     * 大富婆活动介绍
     * @return mixed
     */
    public function introduce()
    {
        $uid = input('get.uid', '0'); //获取用户id

        $assign = array(
            'uid' => $uid,
        );
        $this->assign($assign);
        return $this->fetch('levygold/list');
    }

    /**
     * 大富婆排行榜页面
     */
    public function goldList()
    {
        $uid = input('get.uid', 0); // 获取用户id
//        $uid = 5143;
        $this->assign('uid', $uid);
        return $this->fetch('levygold/goldlist');
    }

    /**
     * 获取各个金币和楼榜排行榜数据
     */
    public function ajaxIndex()
    {
        $uid = input('post.uid', '0'); //获取用户id
        $rd = array('status' => -1, 'rankA'=>'', 'rankB'=>'', 'rankC'=>'', 'rankD'=>'', 'rankE'=>'', 'rankF'=>'');
        $m = model('ApiMethod');
        // 获取个人金币情况
        $url  = config("SERVER_API_URL") . '/api/v1/room/house/rank?uid=' . $uid;

//        $url  = 'http://192.168.30.200:7999/api/v1/room/house/rank?uid=' . $uid;
//        var_dump($m->curlGetUrl($url));
//        exit;

        // 获取接口数据并处理
        $rs = $m->curlGetUrl($url);
        if ($rs['errorcode'] == 0) { // 接口成功返回时处理数据
            if ($rs['MyRankList']) { // 个人排行信息
                $rd['rankA'] = $rs['MyRankList'];
            }
            $arr = [];
            if ($rs['UserList']) { // 根据用户id重组数组
                foreach ($rs['UserList'] as $k => $v) {
                    $arr[$v['Uid']] = $v;
                }
            }
            if ($rs['HostessEarnRankList']) { // 金币榜
                foreach ($rs['HostessEarnRankList'] as $k => $v) {
                    $rs['HostessEarnRankList'][$k]['roomId'] = $arr[$v['Uid']]['RoomId'];
                    $rs['HostessEarnRankList'][$k]['nick'] = $arr[$v['Uid']]['Nick'];
                    $rs['HostessEarnRankList'][$k]['imgHead'] = $arr[$v['Uid']]['ImgHead'];
                    $rs['HostessEarnRankList'][$k]['liveStatus'] = $arr[$v['Uid']]['LiveStatus'];
                    $rs['HostessEarnRankList'][$k]['url'] = 'iMay://com.imay.live/openwith?type=1&roomId=' .
                        $arr[$v['Uid']]['RoomId'] . '&url=http://down.imay.com/pi/' . $arr[$v['Uid']]['RoomId'] . '/playlist.m3u8';
                }
                $rd['rankB'] = $rs['HostessEarnRankList'];
            }
            if ($rs['HostessFloorRankList']) { // 楼榜
                foreach ($rs['HostessFloorRankList'] as $k => $v) {
                    $rs['HostessFloorRankList'][$k]['roomId'] = $arr[$v['Uid']]['RoomId'];
                    $rs['HostessFloorRankList'][$k]['nick'] = $arr[$v['Uid']]['Nick'];
                    $rs['HostessFloorRankList'][$k]['imgHead'] = $arr[$v['Uid']]['ImgHead'];
                    $rs['HostessFloorRankList'][$k]['liveStatus'] = $arr[$v['Uid']]['LiveStatus'];
                    $rs['HostessFloorRankList'][$k]['url'] = 'iMay://com.imay.live/openwith?type=1&roomId=' .
                        $arr[$v['Uid']]['RoomId'] . '&url=http://down.imay.com/pi/' . $arr[$v['Uid']]['RoomId'] . '/playlist.m3u8';
                }

                $rd['rankC'] = $rs['HostessFloorRankList'];
            }
            if ($rs['NewHostessEarnRankList']) { // 新人金币榜
                foreach ($rs['NewHostessEarnRankList'] as $k => $v) {
                    $rs['NewHostessEarnRankList'][$k]['roomId'] = $arr[$v['Uid']]['RoomId'];
                    $rs['NewHostessEarnRankList'][$k]['nick'] = $arr[$v['Uid']]['Nick'];
                    $rs['NewHostessEarnRankList'][$k]['imgHead'] = $arr[$v['Uid']]['ImgHead'];
                    $rs['NewHostessEarnRankList'][$k]['liveStatus'] = $arr[$v['Uid']]['LiveStatus'];
                    $rs['NewHostessEarnRankList'][$k]['url'] = 'iMay://com.imay.live/openwith?type=1&roomId=' .
                        $arr[$v['Uid']]['RoomId'] . '&url=http://down.imay.com/pi/' . $arr[$v['Uid']]['RoomId'] . '/playlist.m3u8';
                }
                $rd['rankD'] = $rs['NewHostessEarnRankList'];
            }
            if ($rs['NewHostessFloorRankList']) { // 新人楼榜
                foreach ($rs['NewHostessFloorRankList'] as $k => $v) {
                    $rs['NewHostessFloorRankList'][$k]['roomId'] = $arr[$v['Uid']]['RoomId'];
                    $rs['NewHostessFloorRankList'][$k]['nick'] = $arr[$v['Uid']]['Nick'];
                    $rs['NewHostessFloorRankList'][$k]['imgHead'] = $arr[$v['Uid']]['ImgHead'];
                    $rs['NewHostessFloorRankList'][$k]['liveStatus'] = $arr[$v['Uid']]['LiveStatus'];
                    $rs['NewHostessFloorRankList'][$k]['url'] = 'iMay://com.imay.live/openwith?type=1&roomId=' .
                        $arr[$v['Uid']]['RoomId'] . '&url=http://down.imay.com/pi/' . $arr[$v['Uid']]['RoomId'] . '/playlist.m3u8';
                }
                $rd['rankE'] = $rs['NewHostessFloorRankList'];
            }
            if ($rs['UserSendRankList']) { // 贡献榜
                foreach ($rs['UserSendRankList'] as $k => $v) {
                    $rs['UserSendRankList'][$k]['roomId'] = $arr[$v['Uid']]['RoomId'];
                    $rs['UserSendRankList'][$k]['nick'] = $arr[$v['Uid']]['Nick'];
                    $rs['UserSendRankList'][$k]['imgHead'] = $arr[$v['Uid']]['ImgHead'];
                    $rs['UserSendRankList'][$k]['liveStatus'] = $arr[$v['Uid']]['LiveStatus'];
                    $rs['UserSendRankList'][$k]['url'] = 'iMay://com.imay.live/openwith?type=1&roomId=' .
                        $arr[$v['Uid']]['RoomId'] . '&url=http://down.imay.com/pi/' . $arr[$v['Uid']]['RoomId'] . '/playlist.m3u8';
                }
                $rd['rankF'] = $rs['UserSendRankList'];
            }
            $rd['status'] = 1;
        }

        exit(json_encode($rd));
    }

    /**
     * 将时间段转成时分秒显示
     * @param $time
     * @return string
     */
    public function dateTime($time)
    {
        $date = time();
        if ($date - $time < 3600) {
            $dates = '刚刚';
        } else if ($date - $time < 86400) {
            $hour = floor(($date - $time) / 3600);
            $time = ($date - $time) % 3600;
            $min = floor($time / 60);
            $dates = $hour . '小时' . $min . '分钟前';
        } else {
            $day = floor(($date - $time) / 86400);
            $dates = $day . '天前';
        }
        return $dates;
    }
}
