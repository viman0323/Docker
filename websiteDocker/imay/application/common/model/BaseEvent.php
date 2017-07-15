<?php
/*===============================================================
*   Copyright (C) 2015 All rights reserved.
*
*   file        : BaseEvent.php
*   author      : jason.zhi
*   date        : 2016/12/19
*   description : 
*   modify      :
*
================================================================*/
namespace app\common\model;

class BaseEvent extends \think\Model
{
    
    public function __construct($data=[]) {
        $config           = config('EVENT_DB');
        $this->connection = [
            // 数据库类型
            'type'     => $config['type'],
            // 服务器地址
            'hostname' => $config['hostname'],
            // 端口
            'hostport' => $config['hostport'],
            // 数据库名
            'database' => $config['database'],
            // 数据库用户名
            'username' => $config['username'],
            // 数据库密码
            'password' => $config['password'],
            // 数据库编码默认采用utf8
            'charset'  => $config['charset'],
            // 数据库表前缀
            'prefix'   => $config['prefix'],
        ];
        parent::__construct($data);
    }
}