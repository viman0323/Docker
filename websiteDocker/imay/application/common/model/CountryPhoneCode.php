<?php
// +----------------------------------------------------------------------
// | SentCMS [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.tensent.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: molong <molong@tensent.cn> <http://www.tensent.cn>
// +----------------------------------------------------------------------

namespace app\common\model;
use think\Db;

/**
* 设置模型
*/
class CountryPhoneCode extends Base
{
    /**
     * 获取所有的手机区号信息
     * @return false|\PDOStatement|string|\think\Collection
     */
    public function info()
    {
        $info = Db::table('im_country_phone_code')->select();
        return $info;
    }

    /**
     * 手机区号搜索
     * @param $value
     * @return false|\PDOStatement|string|\think\Collection
     */
    public function rowInfo($value)
    {
        if ($value && !is_numeric(substr($value, -1))) {
            $info = Db::table('im_country_phone_code')->where("country LIKE '{$value}%'")->select();
        } else {
            $info = Db::table('im_country_phone_code')->select();
        }
        return $info;
    }

}