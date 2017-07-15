<?php
// +----------------------------------------------------------------------
// | SentCMS [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.tensent.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: molong <molong@tensent.cn> <http://www.tensent.cn>
// +----------------------------------------------------------------------

namespace app\m\controller;
use app\admin\controller\Config;
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
        $url = config('SITE_M_URL');
        \think\Config::load(APP_PATH . "conf/share_video.conf.php");
        $room_id = input('param.room_id');
        $scheme = input('get.scheme', 'com.tinlukchina.pc');
        $host = input('get.host', 'com.imay.live');
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
            $room['room']['urlStr'] = base64_encode($room['room']['url']);
            if ($room['room']['streamVendor'] == 2) {
                $room['room']['url'] = str_replace('.flv', '.m3u8', $room['room']['url']);
            } else {
                $room['room']['url'] = str_replace('.flv', '/playlist.m3u8', $room['room']['url']);
            }
            if (empty($room['room']['imgFace']) == false) {
                $room['room']['picture'] = base64_encode($room['room']['imgFace']);
            } else if (empty($room['room']['info']['imgHead']) == false) {
                $room['room']['picture'] = base64_encode($room['room']['info']['imgHead']);
            } else {
                $room['room']['picture'] = '';
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
        $this->assign('url', $url);
        $this->assign('scheme', $scheme);
        $this->assign('host', $host);
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
        $uid = input('post.uid', '');
        $m = model('ApiMethod');
        $rs = $m->livestatus($uid);
        if (isset($rs['live']) && $rs['live'] == true) {
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

    /**
     * 动态分享
     * @return mixed
     */
    public function feed()
    {
        $feed_id = input('get.FeedId'); // 动态id
//        $feed_id = 17581 ; // 动态id
        $scheme = input('get.scheme', 'com.tinlukchina.pc');
        $host = input('get.host', 'com.imay.live');
        $m = model('ApiMethod');
        $count = 15;
        $list = $m->share($feed_id);
//        var_dump($list);
//exit;
        $page = $m->feedsHot($count);
//        var_dump($page);exit;

        if ($list && $list['resultCode'] == 0) {
            if ($list['feeds']) {
                if (!empty($list['feeds']['0']['videoUrl']) || !empty($list['feeds']['0']['imgUrl'])) {
                    $list['feeds']['0']['show'] = 1;
                } else {
                    $list['feeds']['0']['show'] = -1;
                }
                if (empty($list['feeds']['0']['user']['UserLv'])) {
                    $list['feeds']['0']['user']['UserLv'] = 0;
                }
                if ($list['feeds']['0']['feedType'] == 1) {
                    $list['feeds']['0']['videoUrl'] = '';
                } else {
                    $list['feeds']['0']['imgUrl'] = '';
                }
            }
        } else {
            $list['feeds']['0'] = [
                'show' => -1,
                'feedType' => 0,
                'feedId' => '',
                'imgUrl' => '',
                'videoUrl' => '',
                'user' => ['nick' => '','uid' => ''],
            ];
        }

        $url = config('SITE_M_URL');
        $this->assign('list', $list);
        $this->assign('url', $url);
        $this->assign('scheme', $scheme);
        $this->assign('host', $host);
        $this->assign('page', $page);
        return $this->fetch('share/list');
    }

    /**
     * 话题分享
     * @return mixed
     */
    public function topic()
    {
        $url = config('SITE_M_URL');
        $title = input('get.LabelContent'); 
        $nick = input('get.Nick');
        $scheme = input('get.scheme', 'com.tinlukchina.pc');
        $host = input('get.host', 'com.imay.live');
//        $title = '迪丽热巴';
        $titles = [
            '0' => '，没料你靠边瞄，有料你来飙！',
            '1' => '，我有魅你敢撩吗？',
            '2' => '，看老司机神技',
            '3' => '，玩咖就来撩',
        ];
        $content = $titles[mt_rand(0,3)];
        $list = ['label' => [], 'hotFeeds' => [], 'newsFeeds' =>[]];
        $m = model('ApiMethod');
        $info = $m->relatedFeed(urldecode($title));
        $page = $m->newsFeed($feed_id = 0, $count = 12, urldecode($title));
        if ($info) {
            if ($info['hotfeeds'] != '') {
                foreach ($info['hotfeeds'] as $k => $v) {
                    if ($v['FeedData']['FeedType'] == 1) {
                        $info['hotfeeds'][$k]['FeedData']['VideoUrl'] = '';
                    } else {
                        $info['hotfeeds'][$k]['FeedData']['ImgUrl'] = '';
                    }
                }
            }
            $list['label'] = $info['relatedLabels'];
            $list['hotFeeds'] = $info['hotfeeds'];
        }
        if ($page && $page['resultCode'] == 0) {
            if ($page['feeds']) {
                $page['show'] = 1;
                foreach ($page['feeds'] as $key => $value) {
                    if ($value['feedType'] == 1) {
                        $page['feeds'][$key]['videoUrl'] = '';
                    } else {
                        $page['feeds'][$key]['imgUrl'] = '';
                    }
                    $page['feed_id'] = $value['feedId'];
                }
            } else {
                $page['show'] = -1;
            }
        }

        $assign = [
            'title'     => urldecode($title),
            'titles'    => $title,
            'nick_de'   => urldecode($nick),
            'nick'      => $nick,
            'content'   => $content,
            'page'      => $page,
            'list'      => $list,
            'url'       => $url,
            'scheme'    => $scheme,
            'host'      => $host
        ];
        $this->assign($assign);
        if (!$page['feeds']) {
            return $this->fetch('share/blank');
        } else {
            return $this->fetch('share/topic');
        }
    }

    /**
     * 向上滑时请求动态数据
     */
    public function ajaxindex()
    {
        $rd = ['status' => -1, 'feeds' => ''];
        $feed_id = input('post.feed_id');
        $title = input('post.title');
        $m = model('ApiMethod');
        $page = $m->newsFeed($feed_id, $count = 12, $title);
        if ($page && $page['resultCode'] == 0) {
            if ($page['feeds']) {
                foreach ($page['feeds'] as $key => $value) {
                    if ($value['feedType'] == 1) {
                        $page['feeds'][$key]['videoUrl'] = '';
                    } else {
                        $page['feeds'][$key]['imgUrl'] = '';
                    }
                }
                $rd['status'] = 1;
                $rd['feeds'] = $page['feeds'];
            }
        }
        exit(json_encode($rd));

    }

    /**
     * 超胆播挑战分享
     */
    public function superLive()
    {
        // 获取域名
        $search['url'] = config('SITE_M_URL');
        // 获取参数
        $search['scheme'] = input('get.scheme', 'com.tinlukchina.pc');
        $search['host'] = input('get.host', 'com.imay.live');
        $search['shortLiveId'] = input('get.shortLiveId', '345');
        $list = ['personal' => [], 'hotLive' => []];
        $m = model('ApiMethod');
        $rs = $m->superLive((int)$search['shortLiveId']);

        // 数据处理
        if ($rs && $rs['result'] == 0) {
            // 用户信息
            if ($rs['data']['shortLiveInfo']) {
                $list['personal'] = $rs['data']['shortLiveInfo'];
            } else {
                $list['personal']['videoUrl'] = '';
                $list['personal']['challengeTitle'] = '';
            }
            if ($rs['data']['userInfo']) {
                $list['personal'] = array_merge($list['personal'], $rs['data']['userInfo']);
            } else {
                $list['personal']['nick'] = '';
            }

            // 热门推荐
            if ($rs['data']['suggestShortLives']) {
                $list['hotLive'] = $rs['data']['suggestShortLives'];
            }

//            // 添加测试数据 添加个人超胆挑战视频
            //$list['personal']['videoUrl'] = 'https://imgs.imay.com/video-165568-1493788399-2694.mp4';
//
//            // 添加测试数据 添加热门推荐视频
              // foreach ($list['hotLive'] as $k => $v) {
               // $list['hotLive'][$k]['videoUrl'] = 'https://imgs.imay.com/video-165568-1493788399-2694.mp4';
            //}   
        } else {
            $list['personal']['imgHead'] = '';
            $list['personal']['nick'] = '';
            $list['personal']['videoUrl'] = '';
            $list['personal']['challengeTitle'] = '';
        }
//print_r($list);
        $assign = [
            'list'   => $list,
            'search'   => $search
        ];
        $this->assign($assign);
        return $this->fetch('share/superLive');
    }

    /**
     * 超胆播挑战说明页面
     */
    public function superShow()
    {
        $uid = input('get.uid');//735;//
        $m = model('ApiMethod');
        $rs = $uid ? $m->shortLive((int)$uid) : '';
        $info = $uid ? $m->getInfoSimpleByUid((int)$uid) : '';
        
        $num = 0;
        if($rs){
            $num = (int)$rs['data']['countRemain'];
        }
        $info_user = isset($info['user']) ? $info['user'] :'';
        $nick = '';
        $headpic =''; 
        if($info_user){
            $headpic = $info_user['imgHead'] ? $info_user['imgHead'] : '';
            if($headpic){
                $p_arr =explode('.', $headpic);
                if($p_arr && $p_arr[0] == 'http://img'){
                    $p_arr[0] = $p_arr ? 'https://imgs' : '';
                    $headpic = implode('.', $p_arr);
                }
                
                //print_r($headpic);
            }
            $nick = $info_user['nick'] ? $info_user['nick'] : '';
        }
        $assign = [
            'nick'   => $nick,
            'pic'   => $headpic,
            'num'   => $num
        ];
        $this->assign($assign);
        //print_r($rs);
        return $this->fetch('share/superShow');
    }

}
