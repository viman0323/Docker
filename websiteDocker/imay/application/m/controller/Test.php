<?php
// +----------------------------------------------------------------------
// | SentCMS [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.tensent.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: molong <molong@tensent.cn> <http://www.tensent.cn>
// +----------------------------------------------------------------------

namespace app\m\controller;

use app\common\controller\Fornt;

/**
 * 手机页面控制器
 * Class Phone
 * @package app\test\controller
 */
class Test extends Fornt
{
    /**
     * 手机邀请页面
     * @return mixed
     */
    public function index()
    {
        $check = false;
        $ip = get_client_ip(0, true);
        if ($ip == '183.63.254.2') {
            $check = true;
        }

        if (IS_POST) {
            $invite_code = model('InviteCode');
            $code = $this->request->post('code');
            $data = $invite_code->checkCode($code);
            if ($data){
                $invite_code->setStatus(1, $data['id']);
                $check = true;
            }
        }
        $param = array(
            'check' => $check
        );
        $this->assign($param);
        return $this->fetch();
    }

    /**
     * 无码邀请测试
     * @return mixed
     */
    public function iv()
    {
        return $this->fetch();
    }

    /**
     * 生成邀请码
     */
    public function createCode()
    {
        /* $code = model('InviteCode');
        $data = [];
        for ($i = 0; $i <= 500; $i++){
            $data['code'] = $this->makeCode();
            $code->add($data);
        } */
    }

    /**
     * 生成唯一邀请码
     *
     * @return string
     */
    private function makeCode()
    {
        $code = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $rand = $code[rand(0,25)]
                . dechex(date('m'))
                . date('d')
                . substr(time(), -5)
                . substr(microtime(), 2, 5)
                . sprintf('%02d', rand(0, 99));
        $rand = strtoupper($rand);

        for(
            $a = md5($rand, true),
            $s = '0123456789ABCDEFGHIJKLMNOPQRSTUV',
            $d = '',
            $f = 0;
            $f < 5;
            $g = ord($a[$f]),
            $d .= $s[($g^ord($a[$f+5])) - $g&0x1F],
            $f++
        );

        return $d;
    }


    public function verification()
    {
        $rd = array('status' => -1);
        $code = input('post.code', '');
        $while_code = [];//array('11111', '22222', '33333', '44444', '55555', '66666', '77777', '88888', '99999');
        if (in_array($code, $while_code)) {
            $rd['status'] = 1;
        }else {
            $m = model('InviteCode');
            $rs = $m->checkCode($code);
            if ($rs == true) {
                $status = 1;
                $data = $m->info($code);
                $m->setStatus($status, $data['id']);
                $rd['status'] = 1;
            }
        }

        return json_encode($rd);
    }

}
