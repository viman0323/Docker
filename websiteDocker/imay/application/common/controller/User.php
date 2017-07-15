<?php
// +----------------------------------------------------------------------
// | SentCMS [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.tensent.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: molong <molong@tensent.cn> <http://www.tensent.cn>
// +----------------------------------------------------------------------

namespace app\common\controller;

class User extends Base
{
    //已登录用户的信息
    protected $login = NULL;
    
    public function _initialize()
    {
        parent::_initialize();
        
        $moduleName    = strtolower(MODULE_NAME);
        $controlerName = strtolower(CONTROLLER_NAME);
        
        if ($moduleName == 'index') { //PC官网
            $this->getPCLoginSession();
        } else if (in_array($moduleName, ['user'])) { //user模块
            if (!is_login() && !in_array($controlerName, ['login', 'recharge', 'withdraw'])) {//未登录
                $this->error('请登录后再访问此页面', '/');
            }
            $this->getPCLoginSession();
        } else if ($moduleName == "m") {//手机官网
            if (!is_login() && !in_array($controlerName, ['login', 'recharge'])) {//未登录
                $this->redirect('login/toLogin');
            }
        } else if ($moduleName == "broker") {
            if (!is_login()) {
                $this->error('请登录后再访问此页面', '/');
            }
            $this->getPCLoginSession();
            $this->getOptUserInfo();
        } else {
            exit("访问未定义的模块");
        }
    }
    
    private function getOptUid()
    {
        ($uid = Request()->route("uid")) || ($uid = session('user_auth.uid'));
        return $uid;
    }
    
    /**
     * @brief 获取某个用户的信息（无需用户登录）
     * @date   2017/03/24
     * @author wojiaojason@gmail.com
     */
    protected function getOptUserInfo()
    {
        // $uid = input("get.optuid");
        static $userInfo = [];
        
        if (is_array($userInfo) && empty($userInfo)) {
            $uid = $this->getOptUid();
            if ($uid) {
                $m  = model('ApiMethod');
                $rs = $m->getInfoSimpleByUid($uid);
                // var_dump($rs);exit;
                if (!empty($rs['user'])) {
                    $userInfo = $rs['user'];
                    $this->assign('userInfo', $rs);
            
                    return $userInfo;
                }
            }
            Exception("网络错误，请刷新页面~");
        }
        return $userInfo;
    }
    
    /**
     * @brief  通过魅号获取用户信息
     * @author wojiaojason@gmail.com
     */
    public function getInfoSimpleByRoomId()
    {
        $room_id = input('get.room_id');
        $m       = model('ApiMethod');
        $rs      = $m->getInfoSimpleByRoomId($room_id);
        
        $this->setInfoSimpleSession($rs);
        if (request()->isAjax()) {
            $ret = getRetrunStr($rs);
            exit(json_encode($ret));
        }
    }
    
    protected function getPcInfoSimpleSession()
    {
        $m = model('ApiMethod');
        
        $user_auth         = session('user_auth'); //获取session中的用户信息
        $user_auth_room_id = session('user_auth_room_id'); //获取session中的用户信息

        if (!empty($user_auth_room_id)) {//使用魅号登录
            $userInfo   = $m->getInfoSimpleByUid($user_auth_room_id['uid']);
            $rechargeId = $user_auth_room_id['uid'];
            $rs = $m->getRechargeSumByUid($user_auth_room_id['uid']);
            if ($rs['errorcode'] == 0) {
                $recharge['sumRecharge'] = $rs['SumRecharge'];
                $recharge['isAdult'] = $rs['IsAdult'];
            } else {
                $recharge['sumRecharge'] = 0;
                $recharge['isAdult'] = 0;
            }
        } else if (!empty($user_auth)) {//正常登录
            $userInfo   = $m->profile();
            $rechargeId = $user_auth['uid'];
            $rs = $m->getRechargeSumByUid($user_auth['uid']);
            if ($rs['errorcode'] == 0) {
                $recharge['sumRecharge'] = $rs['SumRecharge'];
                $recharge['isAdult'] = $rs['IsAdult'];
            } else {
                $recharge['sumRecharge'] = 0;
                $recharge['isAdult'] = 0;
            }
        } else { //还没登录
            $userInfo   = [];
            $rechargeId = 0;
            $recharge['sumRecharge'] = 0;
            $recharge['isAdult'] = 0;
        }

        $this->assign([
            'user'        => $userInfo,
            'sum'        => $recharge,
            'recharge_id' => $rechargeId,
            'room_id' => $userInfo ? $userInfo['user']['roomId'] : 0,
        ]);
        
    }
    
    protected function setInfoSimpleSession($rs)
    {
        if (!empty($rs['user'])) {
            $user_auth_room_id = [
                'uid'    => $rs['user']['uid'],
                'roomId' => $rs['user']['roomId'],
            ];
            session('user_auth_room_id', $user_auth_room_id);
            
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    private function getPCLoginSession()
    {
        $m        = model('ApiMethod');
        $redirect = config('SITE_URL'); //回调域名
        
        $data         = model('Login')->getOpenLoginUrl($redirect); //第三方登录链接
        $country_code = model('CountryPhoneCode')->info();//获取手机区号信息
        
        $user_auth   = session('user_auth');
        $this->login = $m->profile(); // 获取已登录用户的信息
        
        if (!empty($user_auth) && !empty($this->login['errorcode'])) {//用户如果在不同浏览器登录时就会发生此情况
            session('user_auth', NULL);
            $this->error('登录超时,请重新登录', '/');
        }
        
        // var_dump($login);
        $this->assign([
            'data'         => $data,
            'country_code' => $country_code,
            'login'        => $this->login,
            'accessCode'   => ($user_auth['accessCode']) ? $user_auth['accessCode'] : 0,
        ]);
        
        if (!empty($this->login['errorcode'])) {
            return FALSE;
        } else {
            return TRUE;
        }
    }
    
    /**
     * @brief 登录设置session值，电话登录、第三方登录都可以在这里设置
     * @param $rs
     * @return array
    @author wojiaojason@gmail.com
     */
    protected function setLoginSession($rs)
    {
        if ($rs && empty($rs['errorcode'])) { // 登陆成功
            $auth = [
                'uid'        => $rs['token']['uid'],
                'accessCode' => $rs['token']['accessCode'],
                'expireAt'   => $rs['token']['expireAt'],
            ];
            session('user_auth', $auth);
            session('user_auth_sign', data_auth_sign($auth));
            
            return TRUE;
        } else {//登录失败
            return FALSE;
        }
    }
    
    /**
     * @brief  手机官网手机号登录
     * @author wojiaojason@gmail.com
     */
    public function wapLoginByPhone()
    {
        // $_POST['phone']    = 13760682938;
        // $_POST['password'] = "jasonwell";
        
        $phone    = input('post.phone', '');
        $country  = input('post.country', '86');
        $password = input('post.password', '');
        
        $m  = model('ApiMethod');
        $rs = $m->login($country, $phone, $password);
        $this->setLoginSession($rs);
        
        $ret = getRetrunStr($rs);
        
        exit(json_encode($ret));
    }
    
    /**
     * @brief  第三方登录(微信、微博、QQ)
     * @author wojiaojason@gmail.com
     */
    public function wapLoginByThirdParty()
    {
        $code  = input('get.code', '0'); // 获取授权后回调返回的code值
        $state = input('get.state');      // 获取授权后回调返回的state
        
        //echo \Think\Request::instance()->url();
        //$redirect = config('SITE_M_URL'); //回调域名
        $m = model('ApiMethod');
        if (!empty($code)) {
            switch ($state) {
                case 'WX_STATE'://微信开放平台登录
                    $access_token = $m->getAccessToken($code, "APP"); //获取access_token
                    $rs           = $m->wxLogin($access_token);
                    break;
                case 'WX_MP_STATE'://微信公众平台登录
                    $access_token = $m->getAccessToken($code, "MP"); //获取access_token
                    $rs           = $m->wxLogin($access_token);
                    break;
                case 'XL_STATE'://微博登录
                    $access_code = $m->getAccessCode($code); //获取access code
                    $rs          = $m->getWBUsers($access_code);//此接口不同
                    var_dump($access_code);
                    var_dump($rs);
                    exit;
                    //$m->getWBTokenInfo($access_code);
                    break;
                case 'QQ_WAP_STATE': //QQ手机登录
                    $access_token = $m->getWapQQAccessToken($code); //获取access token
                    // var_dump($code, $access_token);exit;
                    // echo $access_token['access_token'];
                    $openid = $m->getWapQQOpenId($access_token['access_token']);
                    // var_dump($openid);
                    // exit;
                    $arr = [
                        'accesstoken' => $access_token['access_token'],
                        'openid'      => $openid['openid'],
                        'unionid'     => $openid['unionid'],
                    ];
                    // echo json_encode($arr, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);exit;
                    $rs = $m->qqLogin($arr, "wap");
                    // var_dump($rs);
                    // exit;
                    break;
                default:
                    $rs = [];
                    break;
            }
        }
        //var_dump($rs);exit;
        $setSession = $this->setLoginSession($rs);
        if ($setSession) {
            $this->redirect("withdraw/index");
        } else {
            // $this->redirect("login/toLogin");
            if (!empty($rs['errorcode'])) {
                switch ($rs['errorcode']) {
                    case 105:
                        $msg = "昵称已存在，请尝试使用其他方式登录";
                        break;
                    default:
                        $msg = $rs['errordesc'];
                        break;
                    
                }
                $this->error($msg, "login/toLogin");
            } else {
                $this->error("登录失败", "login/toLogin");
            }
        }
    }
    
    /**
     * 退出登录
     */
    public function signOut()
    {
        session('user_auth', NULL);
        session('user_auth_sign', NULL);
        
        exit(json_encode(['status' => 1]));
    }
    
    /**
     * @brief 发送验证码
     * @return string
    @author wojiaojason@gmail.com
     */
    public function wapVerificationCode()
    {
        $type    = input('post.type', '1');
        $phone   = input('post.phone');
        $country = input('post.country', '86');
        $m       = model('ApiMethod');
        $rs      = $m->verificationCode($phone, $country, $type);
        
        return json_encode($rs);
    }
    
    /**
     * 发送验证码
     */
    public function pcVerificationCode()
    {
        //test
        //$_POST['type'] = 1;
        //$_POST['phone'] = 13760682938;
        //$_POST['country'] = 86;
        \think\Config::load(APP_PATH . "conf/messages.php");
        $rd      = ['status' => -1, 'content' => ''];
        $type    = input('post.type', '1');
        $phone   = input('post.phone');
        $str     = input('post.country', '86'); //获取手机区号
        $country = preg_replace('/\D/s', '', $str); //截取手机区号值
        $message = config('MESSAGES');  //获取错误信息
        $m       = model('ApiMethod');
        $rs      = $m->verificationCode($phone, $country, $type);
        if (empty($rs['errorcode']) == FALSE) {
            $rd['status']  = 2;
            $rd['content'] = $message[$rs['errorcode']];
        } else {
            $rd['status'] = 1;
        }
        
        exit(json_encode($rd));
    }
    
    /**
     * 忘记密码
     * @return mixed
     */
    public function wapForgetPassword()
    {
        $phone    = input('post.phone', '');
        $country  = input('post.country', '86');
        $code     = input('post.phone_code', '');
        $password = input('post.password', '');
        $m        = model('ApiMethod');
        $rs       = $m->changePassword($phone, $country, $code, $password);
        
        $ret = getRetrunStr($rs);
        
        exit(json_encode($ret));
    }
    
    /**
     * 忘记密码
     * @return mixed
     */
    public function pcForgetPassword()
    {
        \think\Config::load(APP_PATH . "conf/messages.php");
        $rd       = ['status' => -1, 'content' => ''];
        $phone    = input('post.phone', '');
        $str      = input('post.country', '86'); //获取手机区号
        $country  = preg_replace('/\D/s', '', $str); //截取手机区号值
        $code     = input('post.phone_code', '');
        $password = input('post.password', '');
        $message  = config('MESSAGES');  //获取错误信息
        $m        = model('ApiMethod');
        $rs       = $m->changePassword($phone, $country, $code, $password);
        
        $setSession = $this->setLoginSession($rs);
        if ($setSession) {
            $rd['status']  = 1;
            $rd['content'] = '登陆成功！';
        } else {
            if (!empty($message[$rs['errorcode']])) {
                $rd['status']  = 2;
                $rd['content'] = $message[$rs['errorcode']];
            }
        }
        
        exit(json_encode($rd));
    }
    
    /**
     * 用户注册
     */
    public function register()
    {
        \think\Config::load(APP_PATH . "conf/messages.php");
        $rd       = ['status' => -1, 'content' => ''];
        $phone    = input('post.phone', ''); // 获取手机号
        $str      = input('post.country', '86'); //获取手机区号
        $country  = preg_replace('/\D/s', '', $str); //截取手机区号值
        $code     = input('post.code', ''); // 获取手机验证码
        $password = input('post.password', ''); // 获取密码
        $nick     = input('post.nick', ''); // 获取昵称
        $headImg  = input('post.img_head', ''); // 获取用户头像
        $message  = config('MESSAGES');  //获取错误信息
        
        if (preg_match("/用户/", $nick) != 0) {
            $rd = ['status' => 2, 'content' => '昵称含有屏蔽词'];
            echo json_encode($rd);
            die;
        };
        $m  = model('ApiMethod');
        $rs = $m->register($phone, $country, $code, $password, $nick, $headImg);
        
        $setSession = $this->setLoginSession($rs);
        if ($setSession) {
            $rd['status']  = 1;
            $rd['content'] = '登陆成功！';
        } else {
            if (!empty($message[$rs['errorcode']])) {
                $rd['status']  = 2;
                $rd['content'] = $message[$rs['errorcode']];
            }
        }
        
        exit(json_encode($rd));
    }
    
    /**
     * 搜索手机区号国家
     */
    public function phoneCode()
    {
        $value = input("post.value", '');
        $info  = model('CountryPhoneCode')->rowInfo($value);
        echo json_encode($info);
        die;
    }
    
    protected function setMenu()
    {
        $menu['基础设置'] = [
            ['title' => '个人资料', 'url' => 'user/profile/index', 'icon' => 'newspaper-o'],
            ['title' => '密码修改', 'url' => 'user/profile/editpw', 'icon' => 'key'],
            ['title' => '更换头像', 'url' => 'user/profile/avatar', 'icon' => 'male'],
        ];
        $menu['订单管理'] = [
            ['title' => '我的订单', 'url' => 'user/order/index', 'icon' => 'shopping-bag'],
        ];
        $contetnmenu  = $this->getContentMenu();
        if (!empty($contetnmenu)) {
            $menu['内容管理'] = $contetnmenu;
        }
        
        foreach ($menu as $group => $item) {
            foreach ($item as $key => $value) {
                if (url($value['url']) == $_SERVER['REQUEST_URI']) {
                    $value['active'] = 'active';
                } else {
                    $value['active'] = '';
                }
                $menu[$group][$key] = $value;
            }
        }
        $this->assign('__MENU__', $menu);
    }
    
    protected function getContentMenu()
    {
        $list = [];
        $map  = [
            'is_user_show' => 1,
            'status'       => ['gt', 0],
            'extend'       => ['gt', 0],
        ];
        $list = db('Model')->where($map)->field("name,id,title,icon,'' as 'style'")->select();
        
        foreach ($list as $key => $value) {
            $value['url']   = "user/content/index?model_id=" . $value['id'];
            $value['title'] = $value['title'] . "管理";
            $value['icon']  = $value['icon'] ? $value['icon'] : 'file';
            $list[$key]     = $value;
        }
        
        return $list;
    }
    
    protected function checkProfile($user)
    {
        $result = TRUE;
        //判断用户资料是否填写完整
        if (!$user['nickname'] || !$user['qq']) {
            $result = FALSE;
        }
        
        return $result;
    }
}
