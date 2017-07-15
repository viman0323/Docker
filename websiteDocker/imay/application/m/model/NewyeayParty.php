<?php

/*===============================================================
*   Copyright (C) 2015 All rights reserved.
*
*   file        : ShareRecord.php
*   author      : jason.zhi
*   date        : 2016/12/19
*   description : 
*   modify      :
*
================================================================*/
namespace app\m\model;

use app\common\model\BaseEvent;

class NewyeayParty extends BaseEvent
{
    /**
     * 根据名称获取信息
     * @param $name
     * @return array|false|\PDOStatement|string|\think\Model
     */
    public function info($name)
    {
        $rs = $this->where("name='{$name}' ")->find();
//        $rs = $this->where("name='{$name}' ")->find();
        if ($rs) {
            $info = $rs->getData();
        } else {
            $info = [];
        }

        return $info;
    }

    public function edit($id)
    {
        // 开启事务
        $this->startTrans();
        $data['got'] = 1; // 是否已领取
        $rd = $this->where('id="' . $id . '"')->update($data);
        if ($rd !== false) {
            // 提交事务
            $this->commit();
            return true;
        } else {
            // 事务回滚
            $this->rollback();
        }

        return false;
    }

}