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
 * 活动说明控制器
 * Class Instruction
 * @package app\activity\controller
 */
class Instruction extends Fornt
{
    /**
     * 小魅有药活动说明页
     * @return mixed
     */
    public function index()
    {
        return $this->fetch('instruction/list');
    }

}
