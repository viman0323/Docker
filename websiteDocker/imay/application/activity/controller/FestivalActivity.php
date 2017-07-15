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
class FestivalActivity extends Fornt
{
    /**
     * 圣诞元旦活动页面
     * @return mixed
     */
    public function index()
    {
//        $uid = '749';
//        $uid = '23425';
        $uid = input('get.uid', '0'); //获取用户id
        $accessToken = input('get.accessToken', '');
        $m = model('ApiMethod');
        $rs = $m->activity($uid, $accessToken); //获取圣诞活动数据
//        var_dump($rs);exit;

        $activity_data = array();
        if ($rs['errorcode'] == 0) {
            $today = array(
                'nick' => $rs['myUserInfo']['nick'], // 昵称
                'myRank' => $rs['myRank'], // 排名
                'myMeiliGainTotal' => $rs['myMeiliGainTotal'], // 自己活动期间获取的魅力值总数
            );

            if (is_array($rs['totalRank'])) {
                $total = array_slice($rs['totalRank'], 0, 3); //前3名排名
                $total_data = array_slice($rs['totalRank'], 3, 7); //前4-8名排名
            }

            $date = date('Y-m-d', time());
            // 获取第n天活动数据
            if ($date == '2016-12-28') { //第一天
                if ($rs['datas']) {
                    $activity_data = array_slice($rs['datas'], 0, 1);
                }
            } elseif ($date == '2016-12-29') { //第二天
                if ($rs['datas']) {
                    $activity_data = array_slice($rs['datas'], 0, 2);
                }
            }
//            var_dump($activity_data);exit;
        }

        $count = count($activity_data);
        if ($count == 0) { // 赋默认值
            $activity_data = array(
                '0' => array('MySide' => 2, 'MyMeiliGain' => '0', 'SideAInfo' => array('MeiliGain' => 0, 'Rank' => 0), 'SideBInfo' => array('MeiliGain' => 0, 'Rank' => 0)),
                '1' => array('MySide' => 2, 'MyMeiliGain' => '0', 'SideAInfo' => array('MeiliGain' => 0, 'Rank' => 0), 'SideBInfo' => array('MeiliGain' => 0, 'Rank' => 0)),
                '2' => array('MySide' => 2, 'MyMeiliGain' => '0', 'SideAInfo' => array('MeiliGain' => 0, 'Rank' => 0), 'SideBInfo' => array('MeiliGain' => 0, 'Rank' => 0))
            );
            $today = array(
                'nick' => '', // 昵称
                'myRank' => 0, // 排名
                'myMeiliGainTotal' => 0, // 自己活动期间获取的魅力值总数
            );
            $total = array(
                '0' => array('Nick' => '', 'HeadImg' => '', 'MeiliGain' => 0, 'SideBInfo' => array('MeiliGain' => 0, 'Rank' => 0)),
                '1' => array('Nick' => '', 'HeadImg' => '', 'MeiliGain' => 0, 'SideBInfo' => array('MeiliGain' => 0, 'Rank' => 0)),
                '2' => array('Nick' => '', 'HeadImg' => '', 'MeiliGain' => 0, 'SideBInfo' => array('MeiliGain' => 0, 'Rank' => 0))
            );
            $total_data = array();
        }

        $assign = array(
            'today' => $today,
            'uid' => $uid,
            'accessToken' => $accessToken,
            'total' => $total,
            'activityData' => $activity_data,
            'count' => $count,
            'totalData' => $total_data,
            'day' => '20161228',
//            'day' => date('Ymd', time()),
        );
        $this->assign($assign); 
        return $this->fetch('festivalactivity/index');
    }
    
    /**
     * ajax 获取今天数据
     */
    public function ajaxlist()
    {
        $rd = array('status' =>-1, 'data'=>'');
        $uid = input('post.uid', '0'); //获取用户id
        $accessToken = input('post.accessToken', '');
        $day = input("post.day",'');
        $m = model('ApiMethod');
        $rs = $m->activity($uid, $accessToken); //获取圣诞活动数据

        $activity_data = array();
        if ($rs['errorcode'] == 0) {
            
            $today = array(
                'nick' => $rs['myUserInfo']['nick'], // 昵称
                'myRank' => $rs['myRank'], // 排名
                'myMeiliGainTotal' => $rs['myMeiliGainTotal'], // 自己活动期间获取的魅力值总数
            );

            if (is_array($rs['totalRank'])) {
                $total = array_slice($rs['totalRank'], 0, 3); //前3名排名
                $total_data = array_slice($rs['totalRank'], 3, 7); //前4-8名排名
            }
        
            $date = date('Y-m-d', time());
            // 获取第n天活动数据
            if ($date == '2016-12-28') { //第一天
                if (is_array($rs['datas'])) {
                    $activity_data = array_slice($rs['datas'], 0, 1);
                }
            } elseif ($date == '2016-12-29') { //第二天
                if (is_array($rs['datas'])) {
                    $activity_data = array_slice($rs['datas'], 0, 2);
                }
            }

            $count = count($activity_data);
            $arr = [];
            foreach($activity_data as $k=>$v){
                $i = 0;
                if($v['MySide'] == '1'){
                    $i  = 1;
                }else if($v['MySide'] == '2'){
                    $i = 2;
                }
              $arr[$k]['num'] = $i;
              $arr[$k]['MyMeiliGain'] = $v['MyMeiliGain'] ? $v['MyMeiliGain'] : '0';
            }
            if ($count == 0) { // 赋默认值
                $activity_data = array(
                    '0' => array('MySide' => 2, 'MyMeiliGain' => '0', 'SideAInfo' => array('MeiliGain' => 0, 'Rank' => 0), 'SideBInfo' => array('MeiliGain' => 0, 'Rank' => 0)),
                    '1' => array('MySide' => 2, 'MyMeiliGain' => '0', 'SideAInfo' => array('MeiliGain' => 0, 'Rank' => 0), 'SideBInfo' => array('MeiliGain' => 0, 'Rank' => 0)),
                    '2' => array('MySide' => 2, 'MyMeiliGain' => '0', 'SideAInfo' => array('MeiliGain' => 0, 'Rank' => 0), 'SideBInfo' => array('MeiliGain' => 0, 'Rank' => 0))
                );
                $today = array(
                    'nick' => '', // 昵称
                    'myRank' => 0, // 排名
                    'myMeiliGainTotal' => 0, // 自己活动期间获取的魅力值总数
                );
                $total = array(
                    '0' => array('Nick' => '', 'HeadImg' => '', 'MeiliGain' => 0, 'SideBInfo' => array('MeiliGain' => 0, 'Rank' => 0)),
                    '1' => array('Nick' => '', 'HeadImg' => '', 'MeiliGain' => 0, 'SideBInfo' => array('MeiliGain' => 0, 'Rank' => 0)),
                    '2' => array('Nick' => '', 'HeadImg' => '', 'MeiliGain' => 0, 'SideBInfo' => array('MeiliGain' => 0, 'Rank' => 0))
                );
                $total_data = array();
            }

            $rd['status'] = 1;
            $rd['data'] = array(
                'today' => $today,
                'uid' => $uid,
                'accessToken' => $accessToken,
                'total' => $total,
                'SideAInfo_list' => $activity_data['0']['SideAInfo']['Rank'], //红方
                'SideBInfo_list' => $activity_data['0']['SideBInfo']['Rank'], //紫方
                'SideAInfo_MeiliGain' => $activity_data['0']['SideAInfo']['MeiliGain'], //红方
                'SideBInfo_MeiliGain' => $activity_data['0']['SideBInfo']['MeiliGain'], //紫方
                'count' => $count,
                'totalData' => $total_data,
                'day' => '20161228',
                'news' => $arr,
//                'day' => date('Ymd', time()),
            );
            //print_r($arr);
        }
        //print_r($rd);
        exit(json_encode($rd));
        
        
    }

    
}
