<?php
/*===============================================================
*   Copyright (C) 2015 All rights reserved.
*
*   file        : Download.php
*   author      : jason.zhi
*   date        : 2016/12/19
*   description :
*   modify      :
*
================================================================*/
namespace app\index\controller;

use app\common\controller\User;

class Download extends User
{
    public function indexInvite()
    {
        return $this->fetch('download/indexInvite');
    }
    
}