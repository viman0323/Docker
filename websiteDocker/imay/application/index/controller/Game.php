<?php
// +----------------------------------------------------------------------
// | SentCMS [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.tensent.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: molong <molong@tensent.cn> <http://www.tensent.cn>
// +----------------------------------------------------------------------

namespace app\index\controller;
use app\common\controller\Fornt;

/**
 * 手游教程控制器
 * Class Game
 * @package app\index\controller
 */
class Game extends Fornt
{
    /**
     * 手游助手教程页面
     * @return mixed
     */
    public function index()
    {
        return $this->fetch();
    }

    /**
     * 手游助手下载
     * @return mixed
     */
    public function download()
    {
        return $this->fetch('game/list');
    }

}
