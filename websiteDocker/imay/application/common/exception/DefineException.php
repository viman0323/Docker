<?php

/*===============================================================
*   Copyright (C) 2015 All rights reserved.
*
*   file        : DefineException.php
*   author      : jason.zhi
*   date        : 2016/12/15
*   description : 
*   modify      :
*
================================================================*/
namespace app\common\exception;

use think\exception\Handle;
use think\exception\HttpException;
use think\Request;
use think\Response;
use think\Config;
use \Exception;

class DefineException extends Handle
{
    public function __construct()
    {
        //http://www.kancloud.cn/manual/thinkphp5/163256
        //http://www.kancloud.cn/manual/thinkphp5/118136
        if (isMobile()) {//手机
            config(
                'http_exception_template', [
                    404 => ROOT_PATH . '/public/tpl/404_wap.tpl',
                ]
            );
            config('exception_tmpl', ROOT_PATH . '/public/tpl/error_wap.tpl');
        } else {//官网
            config(
                'http_exception_template', [
                    404 => ROOT_PATH . '/public/tpl/404_pc.tpl',
                ]
            );
            config('exception_tmpl', ROOT_PATH . '/public/tpl/error_pc.tpl');
        }
    }
    
    /**
     * @brief 参考：http://www.kancloud.cn/manual/thinkphp5/126075
     * @param Exception $e
     * @return Response
    @author wojiaojason@gmail.com
     */
    public function render(\Exception $e)
    {
        $domain = \think\Request::instance()->domain();
        //TODO::开发者对异常的操作
        //可以在此交由系统处理
        return parent::render($e);
    }
    
    
}