<?php
// +----------------------------------------------------------------------
// | SentCMS [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.tensent.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: molong <molong@tensent.cn> <http://www.tensent.cn>
// +----------------------------------------------------------------------

namespace app\m\controller;
use app\common\controller\Fornt;
use think\Cache;
use think\Session;

session_start();
/**
 * APP活动控制器
 * Class Party
 * @package app\m\controller
 */
class Party extends Fornt
{
    /**
     * 抽奖页面
     */
    public function index()
    {
        $session_id = session_id();
        $cache_key = "g:imay:party:scan:name:{$session_id}";
        $cache = Cache::get($cache_key);
        if (isset($cache['pet'])) {
            $data = $this->show($cache['pet']);
            $this->assign('data', $data);
            return $this->fetch('party/list');
        }else {
            $type = input('post.type', '');
            $name = trim(input('post.name', ''));
            if ($type == 'draw') {
                $rd = ['status' => '-1'];
                $m = model('NewyeayParty');
                $info = $m->info($name);
                if ($info) {
                    $m->edit($info['id']);
                    Cache::set($cache_key, $info, 24*3600);
                    $rd['status'] = '1';
                }
                exit(json_encode($rd));
            } else {
                return $this->fetch('party/index');
            }
        }
    }

    /**
     * 中奖页面
     * @return mixed
     */
    private function show($data)
    {
        $pet = explode('-', $data);

        $arr1 = array(
            '小梦兔'=>'xmt.png','猴吉利'=>'hjl.png','粉雀'=>'fq.png','火狐'=>'hh.png','灵猫'=>'lm.png',
            '萌草兽'=>'mcs.png','草小菇'=>'cxg.png','小火灵'=>'xhl.png','岩龟'=>'yg.png','小羊羔'=>'xyg.png'
        );
        $arr2 = array(
            '小梦兔' => array('幼年期' => 'xmt-ynq.jpg', '少年期' => 'xmt-snq.jpg', '成熟期' => 'xmt-csq.jpg'),
            '猴吉利' => array('幼年期' => 'hjl-ynq.jpg', '少年期' => 'hjl-snq.jpg', '成熟期' => 'hjl-csq.jpg'),
            '粉雀' => array('幼年期' => 'fq-ynq.jpg', '少年期' => 'fq-snq.jpg', '成熟期' => 'fq-csq.jpg'),
            '火狐' => array('幼年期' => 'hh-ynq.jpg', '少年期' => 'hh-snq.jpg', '成熟期' => 'hh-csq.jpg'),
            '灵猫' => array('幼年期' => 'lm-ynq.jpg', '少年期' => 'lm-snq.jpg', '成熟期' => 'lm-csq.jpg'),
            '萌草兽' => array('幼年期' => 'mcs-ynq.jpg', '少年期' => 'mcs-snq.jpg', '成熟期' => 'mcs-csq.jpg'),
            '草小菇' => array('幼年期' => 'cxg-ynq.jpg', '少年期' => 'cxg-snq.jpg', '成熟期' => 'cxg-csq.jpg'),
            '小火灵' => array('幼年期' => 'xhl-ynq.jpg', '少年期' => 'xhl-snq.jpg', '成熟期' => 'xhl-csq.jpg'),
            '岩龟' => array('幼年期' => 'yg-ynq.jpg', '少年期' => 'yg-snq.jpg', '成熟期' => 'yg-csq.jpg'),
            '小羊羔' => array('幼年期' => 'xyg-ynq.jpg', '少年期' => 'xyg-snq.jpg', '成熟期' => 'xyg-csq.jpg'),
        );
        $arr3 = array('红'=>'red.png','橙'=>'orange.png','绿'=>'green.png','蓝'=>'blue.png','紫'=>'purple.png');
        $data = [];
        $data['color'] = $arr3[$pet['2']];
        $data['grow_up'] = $arr2[$pet['0']][$pet['1']];
        $data['name'] = $arr1[$pet['0']];
        return $data;
    }

}
