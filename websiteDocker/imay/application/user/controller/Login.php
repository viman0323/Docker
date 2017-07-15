<?php
// +----------------------------------------------------------------------
// | SentCMS [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.tensent.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: molong <molong@tensent.cn> <http://www.tensent.cn>
// +----------------------------------------------------------------------

namespace app\user\controller;

use app\common\controller\User;

class Login extends User
{
    
    public function index($username = '', $password = '', $verify = '')
    {
        if (IS_POST) {
            if (!$username || !$password) {
                return $this->error('用户名或者密码不能为空！', '');
            }
            //验证码验证
            $this->checkVerify($verify);
            $user = model('User');
            $uid  = $user->login($username, $password);
            if ($uid > 0) {
                $url = session('http_referer') ? session('http_referer') : url('user/index/index');
                
                return $this->success('登录成功！', $url);
            } else {
                switch ($uid) {
                    case -1:
                        $error = '用户不存在或被禁用！';
                        break; //系统级别禁用
                    case -2:
                        $error = '密码错误！';
                        break;
                    default:
                        $error = '未知错误！';
                        break; // 0-接口参数错误（调试阶段使用）
                }
                
                return $this->error($error, '');
            }
        } else {
            session('http_referer', isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '');
            if (is_login()) {
                return $this->redirect('user/index/index');
            } else {
                return $this->fetch();
            }
        }
    }
    
    /**
     * 手机号登陆
     */
    public function login()
    {
        \think\Config::load(APP_PATH . "conf/messages.php");
        $rd = ['status' => -1, 'content' => ''];
        
        $phone    = input('post.phone', '');
        $str      = input('post.country', '86'); //获取手机区号
        $country  = preg_replace('/\D/s', '', $str); //截取手机区号值
        $password = input('post.password', '');
        $message  = config('MESSAGES');  //获取错误信息
        
        $m  = model('ApiMethod');
        $rs = $m->login($country, $phone, $password);
        
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
     * 验证昵称是否重复
     * @return mixed
     */
    public function nickCheck()
    {
        $rd   = ['status' => -1];
        $nick = input('post.nick', '');
        $m    = model('ApiMethod');
        $rs   = $m->nickCheck($nick);
        if ($rs) {
            $rd['status'] = 1;
        } else {
            $rd['status'] = 0;
        }
        
        return json_encode($rs);
    }
    
    public function forget($email = '', $verify = '')
    {
        if (IS_POST) {
            //验证码验证
            $this->checkVerify($verify);
            if (!$email) {
                return $this->error('邮件必填！', url('index/index/index'));
            }
            $result = FALSE;
            $user   = db('Member')->where(['email' => $email])->find();
            if (!empty($user)) {
                $time  = time();
                $token = authcode($user['uid'] . "\n\r" . $user['email'] . "\n\r" . $time, 'ENCODE');
                config('url_common_param', TRUE);
                $url  = url('user/login/find', ['time' => $time, 'token' => $token], 'html', TRUE);
                $html = \think\Lang::get('find_password', ['url' => $url]);
                
                $result = send_email($user['email'], '找回密码确认邮件', $html);
            }
            if ($result) {
                return $this->success("已发送邮件至您邮箱，请登录您的邮箱！", url('index/index/index'));
            } else {
                return $this->error('发送失败！', '');
            }
        } else {
            return $this->fetch();
        }
    }
    
    public function find()
    {
        //http://127.0.0.2/user/login/find.html?time=1467174578&token=b561PJhVI2OjWUPNLsAMdeW8AKZLw/RcqyXUHBa1mCiX2OUzvq0D69Rt40F/n7zfJKR05d7qA41G6/33NQ
        if (IS_POST) {
            $data = $this->request->post();
            //验证码验证
            $this->checkVerify($data['verify']);
            if ($data['password'] !== $data['repassword']) {
                return $this->error('确认密码和密码不同！', '');
            }
            
            $token_decode = authcode($data['token']);
            list($uid, $email, $time) = explode("\n\r", $token_decode);
            
            $save['salt']     = rand_string(6);
            $save['password'] = md5($data['password'] . $save['salt']);
            $result           = db('Member')->where(['uid' => $uid])->update($save);
            if (FALSE != $result) {
                return $this->success('重置成功！');
            } else {
                return $this->success('重置失败！');
            }
        } else {
            $time  = input('get.time', '', 'trim');
            $token = input('get.token', '', 'trim');
            if (!$time || !$token) {
                return $this->error('参数错误！', '');
            }
            
            $token_decode = authcode($token);
            list($uid, $email, $time) = explode("\n\r", $token_decode);
            
            if ((time() - $time) > 3600 || (time() - $time) < 0) {
                return $this->error('链接已失效！', '');
            }
            if ($time != $time) {
                return $this->error('非法操作！', '');
            }
            
            $data = [
                'token' => $token,
                'email' => $email,
                'uid'   => $uid,
            ];
            $this->assign($data);
            
            return $this->fetch();
        }
    }
}
