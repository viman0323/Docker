<?php
// +----------------------------------------------------------------------
// | SentCMS [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.tensent.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: molong <molong@tensent.cn> <http://www.tensent.cn>
// +----------------------------------------------------------------------

namespace app\ad\controller;
use app\common\controller\Fornt;

/**
 * 广告推广控制器
 * Class Share
 * @package app\ad\controller
 */
class Ad extends Fornt
{
    /**
     * 市场推广广告页面
     * @return mixed
     */
    public function index()
    {

        /* $param = array(
            'check' => $check
        );
        $this->assign($param); */
        return $this->fetch();
    }


}
