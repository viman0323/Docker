<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace app\common\model;

/**
 * 邀请码模型
 */
class InviteCode extends Base
{

    /**
     * 添加数据
     * @param array $data
     */
    public function add($data)
    {
        if ($data) {
			return $this->create($data);
		}else{
			return false;
		}
    }

    /**
     * 修改状态
     * @param int $status
     * @param int $id
     * @return number|\think\false|boolean
     */
    public function setStatus($status, $id)
    {
        $data = [];
        if ($id) {
            $data['status'] = $status;
			return $this->save($data, array('id'=>$id));
		}else{
			return false;
		}
    }

    /**
     * 检查邀请码是否已使用
     * @param string $code
     * @return boolean
     */
    public function checkCode($code)
    {
        if (!$code) {
            $this->error = '邀请码不能为空';
            return false;
        }

        $data = $this->where(array('code'=>strtoupper($code), 'status'=>'0'))->find();
        if ($data) {
            return true;
        }else{
            $this->error = '邀请码已使用！';
            return false;
        }
    }

    /**
     * 根据code获取对应信息
     * @param $code
     * @return array|false|\PDOStatement|string|\think\Model
     */
    public function info($code)
    {
        $data = $this->where("code='". strtoupper($code)."'")->find();
        return $data;
    }
}
