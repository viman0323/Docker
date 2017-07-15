<?php
// +----------------------------------------------------------------------
// | SentCMS [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.tensent.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: molong <molong@tensent.cn> <http://www.tensent.cn>
// +----------------------------------------------------------------------

namespace app\activity\controller;
use app\common\controller\Fornt;

/**
 * 圣诞&元旦说明控制器
 * Class ActivityDescription
 * @package app\activity\controller
 */
class ActivityDescription extends Fornt
{
    /**
     * 活动页面
     * @return mixed
     */
    public function index()
    {
        return $this->fetch('actdescription/index');
    }

}
