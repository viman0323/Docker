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
 * Class Games
 * @package app\activity\controller
 */
class Games extends Fornt
{
    /**
     * 手游下载
     * @return mixed
     */
    public function index()
    {
        $uid = input('get.uid');
        $accessToken = input('get.accessToken', '');
        $a = '';
        $assign = [
            'a'           => $a,
            'uid'         => $uid,
            'accessToken' => $accessToken,
        ];
        $this->assign($assign);
        return $this->fetch('games/index');
    }

    /**
     * 获取当前用户实名认证和手机绑定信息
     */
    public function ajaxindex()
    {
        $rd = ['status' => -1, 'content' => ''];
        $uid = input('post.uid');
        $accessToken = input('post.accessToken', '');
        $time = time();
        $data = [$uid,$time,$accessToken];
        $sessionId = substr(sha1(implode($data)), 0, 12);
        // 获取用户信息接口地址
        $url = config('SERVER_API_URL'). '/v2/user/info?appkey=app&targetUid='. $uid .'&uid='. $uid .'&t='. $time .'&signature='. $sessionId;
        // 模拟get请求获取数据
        $user = model('ApiMethod')->curlGetUrl($url);

        // 处理数据
        if (!empty($user['data'])) {
            // 判断该用户是否已经绑定手机并且实名认证
            if ($user['data']['realNameStatus'] == 3 && $user['data']['phone']) {
                $user['data']['show'] = 1; // 已实名认证并绑定手机号
            } else if (!$user['data']['phone']) {
                $user['data']['show'] = 2; // 没有绑定手机号
            } else if ($user['data']['phone'] && $user['data']['realNameStatus'] != 3) {
                $user['data']['show'] = 3; // 没有实名认证
            } else {
                $user['data']['show'] = 2;
            }
            $rd['content'] = $user['data'];
            $rd['status'] = 1;
        }
        exit(json_encode($rd));
    }

}
