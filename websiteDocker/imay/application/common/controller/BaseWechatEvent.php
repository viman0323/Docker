<?php
// +----------------------------------------------------------------------
// | SentCMS [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.tensent.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: molong <molong@tensent.cn> <http://www.tensent.cn>
// +----------------------------------------------------------------------

namespace app\common\controller;

class BaseWechatEvent extends \think\Controller
{
    
    protected $url;
    protected $request;
    protected $module;
    protected $controller;
    protected $action;
    
    public function _initialize()
    {
        //获取request信息
        $this->requestInfo();
        
        $moduleName    = strtolower(MODULE_NAME);
        $controlerName = strtolower(CONTROLLER_NAME);
        $actionName    = strtolower(ACTION_NAME);
        
        $unionid = \think\Session::get("unionid");
        // echo $unionid;
        $pattern = "/MicroMessenger/i";
        // if (!preg_match($pattern, $_SERVER['HTTP_USER_AGENT'])) {//非微信浏览器
        //     $this->error('请在微信浏览器打开此页面', NULL, '', 3);
        //     exception('请在微信浏览器打开此页面');
        // }
        if (!in_array($actionName, ['index', 'authorizeurl', 'getbaseaccesstoken','allcount', 'getredpack','getranking']) && empty($unionid)) {
            if (\think\Request::instance()->isAjax()) {
                return json([
                    'errorcode' => -1,
                    'errormsg'  => '请退出浏览器并重新打开此页面~(empty unionid)',
                ]);
            } else {
                exception('请退出浏览器并重新打开此页面~(empty unionid)');
            }
        }
    }
    
    public function execute($mc = NULL, $op = '', $ac = NULL)
    {
        $op = $op ? $op : $this->request->module();
        if (\think\Config::get('url_case_insensitive')) {
            $mc = ucfirst(parse_name($mc, 1));
            $op = parse_name($op, 1);
        }
        
        if (!empty($mc) && !empty($op) && !empty($ac)) {
            $ops    = ucwords($op);
            $class  = "\\addons\\{$mc}\\controller\\{$ops}";
            $addons = new $class;
            $addons->$ac();
        } else {
            $this->error('没有指定插件名称，控制器或操作！');
        }
    }
    
    /**
     * 解析数据库语句函数
     * @param string $sql      sql语句   带默认前缀的
     * @param string $tablepre 自己的前缀
     * @return multitype:string 返回最终需要的sql语句
     */
    public function sql_split($sql, $tablepre)
    {
        if ($tablepre != "sent_")
            $sql = str_replace("sent_", $tablepre, $sql);
        $sql = preg_replace("/TYPE=(InnoDB|MyISAM|MEMORY)( DEFAULT CHARSET=[^; ]+)?/", "ENGINE=\\1 DEFAULT CHARSET=utf8", $sql);
        
        if ($r_tablepre != $s_tablepre) {
            $sql          = str_replace($s_tablepre, $r_tablepre, $sql);
            $sql          = str_replace("\r", "\n", $sql);
            $ret          = [];
            $num          = 0;
            $queriesarray = explode(";\n", trim($sql));
            unset($sql);
            foreach ($queriesarray as $query) {
                $ret[$num] = '';
                $queries   = explode("\n", trim($query));
                $queries   = array_filter($queries);
                foreach ($queries as $query) {
                    $str1 = substr($query, 0, 1);
                    if ($str1 != '#' && $str1 != '-')
                        $ret[$num] .= $query;
                }
                $num++;
            }
        }
        
        return $ret;
    }
    
    protected function setSeo($title = '', $keywords = '', $description = '')
    {
        $seo = [
            'title'       => $title,
            'keywords'    => $keywords,
            'description' => $description,
        ];
        //获取还没有经过变量替换的META信息
        $meta = model('SeoRule')->getMetaOfCurrentPage($seo);
        foreach ($seo as $key => $item) {
            if (is_array($item)) {
                $item = implode(',', $item);
            }
            $meta[$key] = str_replace("[" . $key . "]", $item . '|', $meta[$key]);
        }
        
        $data = [
            'title'       => $meta['title'],
            'keywords'    => $meta['keywords'],
            'description' => $meta['description'],
        ];
        $this->assign($data);
    }
    
    
    /**
     * 验证码
     * @param  integer $id 验证码ID
     * @author 郭平平 <molong@tensent.cn>
     */
    public function verify($id = 1)
    {
        $verify = new \org\Verify(['length' => 4]);
        $verify->entry($id);
    }
    
    /**
     * 检测验证码
     * @param  integer $id 验证码ID
     * @return boolean     检测结果
     * @author 麦当苗儿 <zuojiazi@vip.qq.com>
     */
    public function checkVerify($code, $id = 1)
    {
        if ($code) {
            $verify = new \org\Verify();
            $result = $verify->check($code, $id);
            if (!$result) {
                return $this->error("验证码错误！", "");
            }
        } else {
            return $this->error("验证码为空！", "");
        }
    }
    
    //request信息
    protected function requestInfo()
    {
        $this->param = $this->request->param();
        defined('MODULE_NAME') or define('MODULE_NAME', $this->request->module());
        defined('CONTROLLER_NAME') or define('CONTROLLER_NAME', $this->request->controller());
        defined('ACTION_NAME') or define('ACTION_NAME', $this->request->action());
        defined('IS_POST') or define('IS_POST', $this->request->isPost());
        defined('IS_GET') or define('IS_GET', $this->request->isGet());
        $this->url = $this->request->module() . '/' . $this->request->controller() . '/' . $this->request->action();
        $this->assign('request', $this->request);
        $this->assign('param', $this->param);
    }
    
    /**
     * 获取单个参数的数组形式
     */
    protected function getArrayParam($param)
    {
        if (isset($this->param['id'])) {
            return array_unique((array)$this->param[$param]);
        } else {
            return [];
        }
    }
}
