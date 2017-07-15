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

class ShareRecord extends BaseEvent
{
    protected $table = "ime_share_record";
    
    public function edit($unionid, $type, $link)
    {
        $data = [
            'event'         => 2,
            'channel'       => $type,
            'share_unionid' => $unionid,
            'share_url'     => $link,
            'ctime'         => time(),
        ];
        
        return $this->insert($data);
    }
}