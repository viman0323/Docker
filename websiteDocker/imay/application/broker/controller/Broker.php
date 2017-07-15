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

class Broker extends User
{
    public function info()
    {
        $apiModel = model('ApiMethod');
        $userInfo = $this->getOptUserInfo();
        $rs = $apiModel->brokerInfor($userInfo['uid']);
        
        // var_dump($rs);
        $this->assign('info', $rs);
        
        return $this->fetch('broker/brokerInfo');
    }
    
}