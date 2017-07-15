<?php

/*===============================================================
*   Copyright (C) 2015 All rights reserved.
*
*   file        : LotteryZuoqi.php
*   author      : jason.zhi
*   date        : 2016/12/19
*   description : 
*   modify      :
*
================================================================*/
namespace app\m\model;

use app\common\model\BaseEvent;

class LotteryZuoqi extends BaseEvent
{
    protected $table = "ime_lottery_zuoqi";
    
    public function edit($data)
    {
        return $this->insert($data);
    }
}