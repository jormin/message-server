<?php
/**
 * Created by PhpStorm.
 * User: Jormin
 * Date: 2018/10/17
 * Time: 上午1:14
 */

namespace app\Controllers\Api\Frontend;


use app\Services\AuthService;

class AccountController extends TokenController
{

    /**
     * @var AuthService
     */
    protected $authService;

    protected function initialization($controller_name, $method_name)
    {
        yield parent::initialization($controller_name, $method_name);
        $this->authService = $this->loader->service('AuthService', $this);
    }

    /**
     * 获取用户信息
     * @return null
     */
    public function actionInfo(){
        if(!$this->beforeAction()){
            return null;
        }
        $user = $this->user;
        $user['created_at'] = date('Y-m-d H:i:s', $user['created_at']);
        $this->success('获取成功', ['user'=>$user]);
    }

    /**
     * 退出登录
     * @return null
     */
    public function actionLogout(){
        if(!$this->beforeAction()){
            return null;
        }
        $return = yield $this->authService->logout($this->token);
        $this->autoReturn($return);
    }

    /**
     * 邮箱激活
     * @return null
     */
    public function actionSendValidateEmail(){
        if(!$this->beforeAction()){
            return null;
        }
        $return = yield $this->authService->sendRegisterEmail($this->userID, $this->user['email'], null);
        $this->autoReturn($return);
    }
}