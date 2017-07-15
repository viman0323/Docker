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
 * 游戏控制器
 * Class Game
 * @package app\activity\controller
 */
class Game extends Fornt
{
    /**
     * 游戏页面
     * @return mixed
     */
    public function index()
    {
        return $this->fetch('game/index');
    }

    /**
     * 游戏页面
     * @return mixed
     */
    public function rain()
    {
        return $this->fetch('game/rain');
    }

    /**
     * 大话骰游戏页面
     */
    public function liarsDice()
    {
        return $this->fetch('game/liarsdice');
    }

    /**
     * 切水果游戏页面
     */
    public function cutFruit()
    {
        return $this->fetch('game/fruit');
    }

    /**
     * 游戏说明
     */
    public function introduce()
    {
        return $this->fetch('game/list');
    }

    /**
     * 手游助手教程页面
     * @return mixed
     */
    public function liveHelper()
    {
        return $this->fetch('livehelper/index');
    }

    /**
     * 手游助手下载
     * @return mixed
     */
    public function download()
    {
        return $this->fetch('livehelper/download');
    }

}
