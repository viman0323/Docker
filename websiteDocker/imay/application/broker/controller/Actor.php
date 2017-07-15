<?php
/*===============================================================
*   Copyright (C) 2015 All rights reserved.
*
*   file        : .php
*   author      : jason.zhi
*   date        : 2017/03/17
*   description :
*   modify      :
*
================================================================*/
namespace app\broker\controller;

use app\common\controller\User;

class Actor extends User
{
    /**
     * @brief  首页
     * @date   2017/03/17
     * @return mixed
     * @author wojiaojason@gmail.com
     */
    public function index()
    {
        // var_dump($this->login);
        $apiModel = model('ApiMethod');
        //ranktype=>22:收礼物榜,12:送礼榜,32:点赞榜
        $rankList = [
            'income'  => $apiModel->getRankData(['ranktype' => 22]),
            'outcome' => $apiModel->getRankData(['ranktype' => 12]),
            'prise'   => $apiModel->getRankData(['ranktype' => 32]),
        ];
        $this->assign('rankList', $rankList);
        // var_dump($rankList);
        
        return $this->fetch('actor/index');
    }
    
    /**
     * @brief  艺人信息
     * @date   2017/03/17
     * @return mixed
     * @author wojiaojason@gmail.com
     */
    public function info()
    {
        // var_dump($this->login);
        // exit;
        $apiModel = model('ApiMethod');
        $userInfo = $this->getOptUserInfo();
        $rs       = $apiModel->anchorInfor($userInfo['uid']);
        // var_dump($rs);exit;
        $overview = $contributeList = [];
        if (empty($rs['errorcode'])) {
            //今日、本月数据
            $overview = [
                'livetimeday'    => timeTransform($rs['livetimeday']),//本日直播时长
                'livetimemonth'  => timeTransform($rs['livetimemonth']),//本月直播时长
                'incomeday'      => $rs['incomeday'],//本日魅力收入
                'incomemonth'    => $rs['incomemonth'],//本月魅力收入
                'fansincrday'    => $rs['fansincrday'],//本日新增粉丝
                'fansincrmonth'  => $rs['fansincrmonth'],//本月新增粉丝
                'imgfeedcount'   => $rs['imgfeedcount'],//发布图片
                'vediofeedcount' => $rs['vediofeedcount'],//发布视频
            ];
            //贡献榜数据
            $contributeList = [
                'giftrankday'   => $rs['giftrankday'],
                'giftrankweek'  => $rs['giftrankweek'],
                'giftrankmonth' => $rs['giftrankmonth'],
            ];
        }
        
        $this->assign('overview', $overview);
        $this->assign('contributeList', $contributeList);
        
        return $this->fetch('actor/actorInfo');
    }
    
    /**
     * @brief  收入统计
     * @date   2017/03/17
     * @return mixed
     * @author wojiaojason@gmail.com
     */
    public function statIncome()
    {
        $apiModel = model('ApiMethod');
        $userInfo = $this->getOptUserInfo();
        $rs       = $apiModel->statIncome($userInfo['uid']);
        // var_dump($rs);
        
        $this->assign('statData', $rs);
        
        return $this->fetch('actor/statIncome');
    }
    
    /**
     * @brief  粉丝统计
     * @date   2017/03/17
     * @return mixed
     * @author wojiaojason@gmail.com
     */
    public function statFans()
    {
        $apiModel = model('ApiMethod');
        $userInfo = $this->getOptUserInfo();
        $rs       = $apiModel->statFans($userInfo['uid']);
        // var_dump($rs);
        
        $this->assign('statData', $rs);
        
        return $this->fetch('actor/statFans');
    }
    
    /**
     * @brief  动态统计
     * @date   2017/03/17
     * @return mixed
     * @author wojiaojason@gmail.com
     */
    public function statFeed()
    {
        $apiModel = model('ApiMethod');
        $userInfo = $this->getOptUserInfo();
        $rs       = $apiModel->statFeedsns($userInfo['uid']);
        // var_dump($rs);
        
        $this->assign('statData', $rs);
        
        return $this->fetch('actor/statFeed');
    }
    
    /**
     * @brief  直播间统计
     * @date   2017/03/17
     * @return mixed
     * @author wojiaojason@gmail.com
     */
    public function statLive()
    {
        $apiModel = model('ApiMethod');
        $userInfo = $this->getOptUserInfo();
        $rs       = $apiModel->statLive($userInfo['roomId'], $userInfo['uid']);
        // var_dump($rs);
        
        timeTransform($rs['livetimeday']);
        timeTransform($rs['livetimeweek']);
        timeTransform($rs['livetimemonth']);
        
        $this->assign('statData', $rs);
        
        return $this->fetch('actor/statLive');
    }
    
    public function test()
    {
        $apiModel = model('ApiMethod');
        // $rs = $apiModel->getRankData([
        //     'ranktype' => 22,//22 收礼物榜 12 送礼榜 32 点赞榜
        // ]);
        // $rs     = $apiModel->anchorInfor();
        // $rs     = $apiModel->statIncome();
        // $rs     = $apiModel->statFans();
        // $rs     = $apiModel->statFeedsns();
        $rs = $apiModel->statLive("127494");
        // $rs = $apiModel->brokerInfor();
        var_dump($rs);
    }
    
}