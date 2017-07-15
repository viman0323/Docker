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
 * 愚人节轰动控制器
 * Class FoolDay
 * @package app\activity\controller
 */
class FoolDay extends Fornt
{
    /**
     * 愚人节活动页面  
     * @return mixed
     */
    public function index()
    {
        // 娱乐人气王
        $room_id = ['0' => '136947', '1' => '187454', '2' => '140620'];
        $video = [
            '0' => [
                'num' => 1,
                'video' => 'https://imgs.imay.com/video-25135-1491243751-8930.mp4',
                'content' => '巧克力派变粑粑整蛊闺蜜，再也无法直视巧克力了....',],
            '1' => [
                'num' => 2,
                'video' => 'https://imgs.imay.com/video-72927-1490965504-7567.mp4',
                'content' => '2017最垮潮流指标妆容，你值得拥有'],
            '2' => [
                'num' => 3,
                'video' => 'https://imgs.imay.com/video-28661-1491039586-4081.mp4',
                'content' => '为了女神，睡什么睡起来搬砖！']
        ];
        // 最佳作品
        $room_ids = ['0' => '162141', '1' => '136947', '2' => '115755'];
        $videos = [
            '0' => [
                'num' => 4,
                'video' => 'https://imgs.imay.com/video-48926-1491043406-9754.mp4',
                'content' => '妹子这么拼，五官还好吗？',],
            '1' => [
                'num' => 5,
                'video' => 'https://imgs.imay.com/video-25135-1491243751-8930.mp4',
                'content' => '实力整蛊，实至名归'],
            '2' => [
                'num' => 6,
                'video' => 'https://imgs.imay.com/video-5182-1491141556-9110.mp4',
                'content' => '你和猪有没有区别，这问题太考验智商了']
        ];

        $data = $list = [];
        $m = model('ApiMethod');
        //娱乐人气王
        foreach ($room_id as $k => $v) {
            $i = 0;
            while ($i < 3) {
                $info = $m->getInfoSimpleByRoomId($v);
                if (!empty($info['user'])) {
                    $info['user']['video'] = $video[$k]['video'];
                    $info['user']['content'] = $video[$k]['content'];
                    $info['user']['num'] = $video[$k]['num'];
                    $info['user']['url'] = 'iMay://com.imay.live/openwith?type=2&uid=' . $info['user']['uid'];
                    $data[$k] = $info['user'];
                    break;
                }
                $i++;
            }
        }
        // 最佳作品
        foreach ($room_ids as $k => $v) {
            $i = 0;
            while ($i < 3) {
                $info = $m->getInfoSimpleByRoomId($v);
                if (!empty($info['user'])) {
                    $info['user']['video'] = $videos[$k]['video'];
                    $info['user']['content'] = $videos[$k]['content'];
                    $info['user']['num'] = $videos[$k]['num'];
                    $info['user']['url'] = 'iMay://com.imay.live/openwith?type=2&uid=' . $info['user']['uid'];
                    $list[$k] = $info['user'];
                    break;
                }
                $i++;
            }
        }

//        var_dump($data);
//        exit;
//        var_dump($list);
//        exit;

        $assign = array(
            'list' => $list,
            'page' => $data,
        );
        $this->assign($assign);
        return $this->fetch('foolday/index');
    }

}
