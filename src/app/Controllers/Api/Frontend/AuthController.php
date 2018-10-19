<?php
/**
 * Created by PhpStorm.
 * User: Jormin
 * Date: 2018/10/15
 * Time: 下午2:16
 */

namespace app\Controllers\Api\Frontend;


use app\Controllers\Api\BaseController;
use app\Jobs\SMSJob;
use app\Libs\CommonFunction;
use app\Services\AuthService;

class AuthController extends BaseController
{

    /**
     * @var AuthService
     */
    protected $authService;

    protected function initialization($controller_name, $method_name)
    {
        parent::initialization($controller_name, $method_name);
        $this->authService = $this->loader->service('AuthService', $this);
    }

    /**
     * 发送注册验证码
     * @return null
     */
    public function actionRegisterCode(){
        $data = $this->validate('post', ['phone']);
        if($data === false){
            return null;
        }
        $return = yield $this->authService->sendRegisterCode($data['phone']);
        $this->autoReturn($return);
    }

    /**
     * 注册
     */
    public function actionRegister(){
        $data = $this->validate('post', ['name', 'gender', 'phone', 'email', 'password', 'code']);
        if($data === false){
            return null;
        }
        $return = yield $this->authService->register($data['name'], $data['gender'], $data['phone'], $data['email'], $data['password'], $data['code']);
        $this->autoReturn($return);
    }

    /**
     * 账号登录
     * @return null
     */
    public function actionLogin(){
        $data = $this->validate('post', ['password']);
        if($data === false){
            return null;
        }
        $account = $this->post('account');
        if(!isset($account)){
            $this->fail('请输入手机号或者邮箱');
            return;
        }
        $phoneValidate = $this->validateArg('phone', $account);
        $emailValidate = $this->validateArg('email', $account);
        if(!$phoneValidate && !$emailValidate){
            $this->fail('请输入正确格式的手机号或者邮箱');
            return;
        }
        $phone = $phoneValidate ? $account : null;
        $email = $phoneValidate ? $account : null;
        $return = yield $this->authService->accountlogin($phone, $email, $data['password']);
        $this->autoReturn($return);
    }

    /**
     * 邮箱激活
     * @return null
     */
    public function actionValidateEmail(){
        $data = $this->validate('post', ['emailCode']);
        if($data === false){
            return null;
        }
        $return = yield $this->authService->validateEmail($data['emailCode']);
        $this->autoReturn($return);
    }

}