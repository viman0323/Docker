<?php

/*===============================================================
*   Copyright (C) 2015 All rights reserved.
*
*   file        : CaptureMonster.php
*   author      : jason.zhi
*   date        : 2016/12/19
*   description : 
*   modify      :
*
================================================================*/
namespace app\m\model;

use app\common\model\BaseEvent;

class CaptureMonster extends BaseEvent
{
    protected $table = "ime_capture_monster";
    
    /**
     * @brief 获取某个用户的信息
     * @param $crc32Unionid
     * @param $unionid
     * @return array|false|\PDOStatement|string|\think\Model
    @author wojiaojason@gmail.com
     */
    public function info($crc32Unionid, $unionid)
    {
        $ret = $this->where("crc32_unionid={$crc32Unionid} AND unionid='{$unionid}'")->find();
        if ($ret)
            $data = $ret->getData();
        else
            $data = FALSE;
        
        return $data;
    }
    
    /**
     * @brief  更新用户分数
     * @author wojiaojason@gmail.com
     */
    public function updateScore($crc32Unionid, $unionid, $score)
    {
        return $this->where("crc32_unionid={$crc32Unionid} AND unionid='{$unionid}'")->update([
            'score'       => $score,
            'update_time' => time(),
        ]);
    }
    
    /**
     * @brief  更新用户的红包状态
     * @author wojiaojason@gmail.com
     */
    public function updateRedPack($crc32Unionid, $unionid, $money)
    {
        return $this->where("crc32_unionid={$crc32Unionid} AND unionid='{$unionid}'")->update([
            'get_red_pack'       => $money,
        ]);
    }
    /**
     * @brief 获取排名
     * @param $curScore
     * @param $shareNum
     * @return int
    @author wojiaojason@gmail.com
     */
    public function getRanking($curScore, $shareNum, $curtime)
    {
        $ranking = $this->where("score>{$curScore} OR (score={$curScore} AND share_num>{$shareNum}) OR (score={$curScore} AND share_num={$shareNum} AND update_time>{$curtime})")->count();
        
        if (is_int($ranking)) {
            $ranking = (int)$ranking + 1;
        }
        
        return $ranking;
    }
    
    /**
     * @brief 获取一批用户的信息
     * @param int $limit
     * @return mixed
    @author wojiaojason@gmail.com
     */
    public function getBatch($limit = 200)
    {
        $ret  = $this->field('id,name AS username,head_img AS portrait, update_time AS time,score')->limit($limit)->order('score desc,share_num desc,update_time desc')->select();
        $data = [];
        
        if ($ret) {
            foreach ($ret as $v)
                $data[] = $v->getData();
        }
        
        return $data;
    }
    
    /**
     * @brief  更新分享次数
     * @author wojiaojason@gmail.com
     */
    public function updateShareNum($crc32Unionid, $unionid)
    {
        return $this->where("crc32_unionid={$crc32Unionid} AND unionid='{$unionid}'")->setInc('share_num', 1);
    }
}