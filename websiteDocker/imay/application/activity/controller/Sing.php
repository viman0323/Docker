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
 * 唱歌活动页面控制器
 * Class Sing
 * @package app\activity\controller
 */
class Sing extends Fornt
{
    /**
     * 唱歌活动页面
     * @return mixed
     */
    public function index()
    {
        return $this->fetch('sing/index');
    }

    /**
     * 获取唱歌活动数据并处理
     */
    public function ajaxIndex()
    {
        $m = model('ApiMethod');
    // 好情人找不到好情人是好像是好家伙
        $rd = ['status' => -1, 'rankA' => '', 'rankB' => '', 'rankC' => '', 'rankD' => '', 'rankE' => ''];
        $url = config('SERVER_API_URL'). '/api/v1/activity-0515/singing'; // 正式接口地址
//        $url = 'http://192.168.30.200:7999/api/v1/activity-0515/singing?btest=1&bnew=0'   ; // 测试接口

        $rs = $m->curlGetUrl($url);
//        print_r($rs);exit;

        if ($rs['errorcode'] == 0) {
            $user = [];
            // 将哟用户信息根据用户id重组数组
            if (!empty($rs['UserList'])) {
                foreach ($rs['UserList'] as $v) {
                    $user[$v['Uid']] = $v;
                }
            }
            if (!empty($rs['RankList'])) {
                // 动态排名用户信息处理
                foreach ($rs['RankList'] as $key => $value) {
                    if ($key == 0) {
                        $rs['RankList'][$key]['CountPraise'] = 55;
                        $rs['RankList'][$key]['GiftCountPraise'] = 18426;
                    } else if ($key == 1) {
                        $rs['RankList'][$key]['CountPraise'] = 141;
                        $rs['RankList'][$key]['GiftCountPraise'] = $value['GiftCountPraise'] = 14940;
                        $rs['RankList'][$key]['Msg'] = '@沁小君 长腿叔叔🎩 …想听别的歌哒每晚九点半到十二点直播间等你噢  ';
                        $rs['RankList'][$key]['RankIndex'] = 2;
                        $rs['RankList'][$key]['VideoUrl'] = 'https://imgs.imay.com/video-50452-1494942934-5515.mp4';
                        $rs['RankList'][$key]['Uid'] = 50452;
                        $rs['RankList'][$key]['FeedId'] = 30823;
                        $value['Uid'] = 50452;
                        $value['FeedId'] = 30823;
                    } else if ($key == 2) {
                        $rs['RankList'][$key]['CountPraise'] = 204;
                        $rs['RankList'][$key]['GiftCountPraise'] = $value['GiftCountPraise'] = 13983;
                        $rs['RankList'][$key]['Msg'] = ' 。一首告白气球送给宝宝们，笔芯❤';
                        $rs['RankList'][$key]['RankIndex'] = 3;
                        $rs['RankList'][$key]['VideoUrl'] = 'https://imgs.imay.com/video-28528-1494916546-7120.mp4';
                        $rs['RankList'][$key]['Uid'] = 28528;
                        $rs['RankList'][$key]['FeedId'] = 30743;
                        $value['Uid'] = 28528;
                        $value['FeedId'] = 30743;
                    } else if ($key == 3) {
                        $rs['RankList'][$key]['CountPraise'] = 105;
                        $rs['RankList'][$key]['GiftCountPraise'] = 7513;
                    } else if ($key == 4) {
                        $rs['RankList'][$key]['CountPraise'] = 22;
                        $rs['RankList'][$key]['GiftCountPraise'] = 7353;
                    }
                    $rs['RankList'][$key]['ImgHead'] = $user[$value['Uid']]['ImgHead'];
                    $rs['RankList'][$key]['Nick']    = $user[$value['Uid']]['Nick'];
                    $rs['RankList'][$key]['RoomId']  = $user[$value['Uid']]['RoomId'];
                    $rs['RankList'][$key]['Sex']     = $user[$value['Uid']]['Sex'];
                    $rs['RankList'][$key]['UserLV']  = $user[$value['Uid']]['UserLV'];
                    if (empty($value['GiftCountPraise'])) {
                        $rs['RankList'][$key]['GiftCountPraise'] = (int)0;
                    }
                    $rs['RankList'][$key]['url']      = 'iMay://com.imay.live/openwith?type=3&uid=' . $value['Uid'] .
                        '&FeedId=' . $value['FeedId'];
                }
                $rd['rankA'] = $rs['RankList'];

            }
            if (!empty($rs['HelpRankList'])) {
                // 处理点赞送礼人信息
                foreach ($rs['HelpRankList'] as $k => $v) {
                    // 处理点赞人个人信息
                    foreach ($v['HelpRankList'] as $key => $item) {
                        $v['HelpRankList'][$key]['ImgHead']  = $user[$item['Uid']]['ImgHead'];
                        $v['HelpRankList'][$key]['Nick']     = $user[$item['Uid']]['Nick'];
                        $v['HelpRankList'][$key]['RoomId']   = $user[$item['Uid']]['RoomId'];
                        $v['HelpRankList'][$key]['Sex']      = $user[$item['Uid']]['Sex'];
                        $v['HelpRankList'][$key]['UserLV']   = $user[$item['Uid']]['UserLV'];
                        $v['HelpRankList'][$key]['Summeili'] = $item['Summeili'];
                    }
                    if ($k == 0) {
                        $rd['rankB'] = $v['HelpRankList'];

                    } else if ($k == 1) {
                        $rd['rankD'] = $v['HelpRankList'];

                    } else if ($k == 2) {
                        $rd['rankC'] = $v['HelpRankList'];

                    } else {
                        if (!empty($v['HelpRankList'])) {
                            $rd['rankE'][] = $v['HelpRankList'][0];
                        }
                    }
                }
            }
            // 接口数据返回正常
            $rd['status'] = 1;
        }
//        print_r($rd);exit;
        exit(json_encode($rd));
    }

}
