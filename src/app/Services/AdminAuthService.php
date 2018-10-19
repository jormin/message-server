<?php
/**
 * Created by PhpStorm.
 * Admin: Jormin
 * Date: 2018/10/16
 * Time: 下午1:52
 */

namespace app\Services;


use app\Libs\CommonFunction;
use app\Models\AdminModel;

class AdminAuthService extends BaseService
{

    /**
     * @var AdminModel
     */
    private $adminModel;

    public function initialization(&$context)
    {
        parent::initialization($context);
        $this->adminModel = $this->loader->model('AdminModel', $this);
    }

    /**
     * 账号登录
     * @param $username
     * @param $password
     * @return array|\Generator
     */
    public function accountlogin($username, $password){
        $return = ['code'=>0, 'message'=>'请求超时'];
        $admin = yield $this->adminModel->findByUsername(null, $username);
        if(!$admin){
            $return['message'] = '管理员不存在';
            return $return;
        }
        if(!CommonFunction::validatePassword($password.$admin['salt'], $admin['password'])){
            $return['message'] = '密码错误';
            return $return;
        }
        $adminID = $admin['id'];
        $loginTime = time();
        $tokenExpireTime = $loginTime+1800;
        $token = CommonFunction::encryptPassword($adminID.CommonFunction::getRandChar(10).$loginTime);
        $result = yield $this->adminModel->updateToken(null, $adminID, $token, $tokenExpireTime);
        if($result['result'] !== true){
            $return['message'] = '记录登录Token错误';
            return $return;
        }
        $data = array(
            'roles' => ['admin'],
            'token' => $token,
            'introduction' => '超级管理员',
            'avatar' => 'http://img5.imgtn.bdimg.com/it/u=504109330,973544959&fm=26&gp=0.jpg',
            'name' => $admin['username']
        );
        $return = ['code'=>1, 'message'=>'登录成功', 'data'=>$data];
        return $return;
    }

    /**
     * 延长Token有效期
     * @param $token
     * @return array
     */
    public function extendTokenExpiretime($token){
        $return = ['code' => 0, 'message' => '请求超时'];
        $result = yield $this->adminModel->extendTokenExpiretime(null, $token);
        if($result !== true){
            $return['message'] = '延长登录Token错误';
            return $return;
        }
        $return = ['code'=>1, 'message'=>'延长登录Token成功'];
        return $return;
    }

    /**
     * 退出登录
     * @param $token
     * @return array
     */
    public function logout($token){
        $return = ['code' => 0, 'message' => '请求超时'];
        $admin = yield $this->adminModel->findByToken($token);
        if(!$admin){
            $return['msg'] = 'Token错误或已过期';
            return $return;
        }
        $result = yield $this->adminModel->logout(null, $token);
        if($result !== true){
            $return['msg'] = '退出登录失败';
            return $return;
        }
        $return = ['code'=>1, 'message'=>'退出登录成功'];
        return $return;
    }
}