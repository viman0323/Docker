<?php

namespace app\m\controller;

use app\common\controller\Fornt;

/**
 * EDG活动控制器
 * Class Share
 * @package app\share\controller
 */

class Activity extends Fornt
{
    public function index()
    {
        $room_arr =array(520666,520777,520888,777777);//array(115208,114684,115209,114686);//
        $m  = model('ApiMethod');
        $result =[];
        $conf ='imay://com.imay.live'; 
       
         foreach($room_arr as $v){
            $rs = $m->infoRoom($v);
            $result[$v]['status'] = isset($rs['room'])?$rs['room']['liveStatus']:'' ;
            
            //var_dump($rd);
            $result[$v]['uid'] = isset($rs['room'])?$rs['room']['uid']:'' ;
            if($result[$v]['status']){
                $result[$v]['url']= isset($rs['room'])?$rs['room']['url']:'' ;
                $imgFace= isset($rs['room'])?$rs['room']['imgFace']:'' ;
                $LiveType= isset($rs['room'])?$rs['room']['OpenLiveType']:'' ;//开播类型
                $url = $conf."/openwith?type=1&liveType=".$LiveType."&roomId=".$v."&liveUrl=".base64_encode($result[$v]['url'])."&uid=".$result[$v]['uid']."&picture=".base64_encode($imgFace);
                $result[$v]['url'] =$url;
            }
            
            //print_r($result);die;
            
        } 
        
        //print_r($result);
        $this->assign('conf', $conf);
        $this->assign('result', $result);
        $this->assign('room_arr', $room_arr);
        return $this->fetch('edg/index');
    }
    
    /**
     * edg报名
     */
    public function join()
    {
        return $this->fetch('edg/join');
    }
    
}