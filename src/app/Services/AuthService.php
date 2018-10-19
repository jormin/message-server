<?php
/**
 * Created by PhpStorm.
 * User: Jormin
 * Date: 2018/10/16
 * Time: 下午1:52
 */

namespace app\Services;


use app\Libs\CommonFunction;
use app\Models\EmailCodeModel;
use app\Models\PhoneCodeModel;
use app\Models\UserLoginLogModel;
use app\Models\UserModel;
use Jormin\IP\IP;

class AuthService extends BaseService
{

    /**
     * @var UserModel
     */
    private $userModel;

    /**
     * @var PhoneCodeModel
     */
    private $phoneCodeModel;

    /**
     * @var EmailCodeModel
     */
    private $emailCodeModel;

    /**
     * @var UserLoginLogModel
     */
    private $userLoginLogModel;

    /**
     * @var SMSService
     */
    private $smsService;

    /**
     * @var EmailService
     */
    private $emailService;

    public function initialization(&$context)
    {
        parent::initialization($context);
        $this->userModel = $this->loader->model('UserModel', $this);
        $this->phoneCodeModel = $this->loader->model('PhoneCodeModel', $this);
        $this->emailCodeModel = $this->loader->model('EmailCodeModel', $this);
        $this->userLoginLogModel = $this->loader->model('UserLoginLogModel', $this);
        $this->smsService = $this->loader->service('SMSService', $this);
        $this->emailService = $this->loader->service('EmailService', $this);
    }


    /**
     * 发送注册验证码
     * @param $phone
     * @return array
     */
    public function sendRegisterCode($phone){
        $return = ['code' => 0, 'message' => '请求超时'];
        $user = yield $this->userModel->findByPhone(null, $phone);
        if ($user) {
            $return['message'] = '手机号已注册';
            return $return;
        }
        $code = CommonFunction::getRandChar(6, false);
        $result = yield $this->phoneCodeModel->insertCode(null, 0, $phone, $code);
        if (!$result['insert_id']) {
            $return['message'] = '发送验证码失败';
            return $return;
        }
        $response = $this->smsService->sendSms(0, $phone, ['code'=>$code]);
        if(!$response['code'] === 0){
            return $response;
        }
        $return = ['code' => 1, 'message' => '发送验证码成功'];
        return $return;
    }

    /**
     * 注册用户
     * @param $name
     * @param $gender
     * @param $phone
     * @param $email
     * @param $password
     * @param $code
     * @return array|\Generator
     */
    public function register($name, $gender, $phone, $email, $password, $code)
    {
        $return = ['code' => 0, 'message' => '请求超时'];
        $user = yield $this->userModel->findByPhone(null, $phone);
        if ($user) {
            $return['message'] = '手机号已注册';
            return $return;
        }
        $user = yield $this->userModel->findByEmail(null, $email);
        if ($user) {
            $return['message'] = '邮箱已注册';
            return $return;
        }
        $result = yield $this->phoneCodeModel->validateCode(0, $phone, $code);
        if($result['result'] !== true){
            $return['message'] = '验证码错误或已失效';
            return $return;
        }
        $transactionID = yield $this->beginTransaction();
        $result = yield $this->userModel->register($transactionID, $name, $gender, $phone, $email, $password);
        if (!$result['insert_id']) {
            yield $this->rollbackTransaction($transactionID);
            $return['message'] = '注册失败';
            return $return;
        }
        $userID = $result['insert_id'];
        $result = yield $this->sendRegisterEmail($userID, $email, $transactionID);
        if ($result['code'] == 0) {
            yield $this->rollbackTransaction($transactionID);
            $return['message'] = '发送激活邮件失败';
            return $return;
        }
        $return = yield $this->autoLogin($userID, $transactionID);
        if($return['code'] == 1){
            $return['message'] = '注册成功';
        }
        return $return;
    }

    /**
     * 自动登录
     * @param $userID
     * @param null $transactionID
     * @return array|\Generator
     */
    public function autoLogin($userID, $transactionID=null){
        $return = ['code'=>0, 'message'=>'请求超时'];
        $user = yield $this->userModel->findByID($transactionID, $userID);
        if(!$user){
            $return['message'] = '用户不存在';
            return $return;
        }
        return yield $this->login($userID, $transactionID);
    }

    /**
     * 账号登录
     * @param null $phone
     * @param null $email
     * @param $password
     * @return array|\Generator
     */
    public function accountlogin($phone=null, $email=null, $password){
        $return = ['code'=>0, 'message'=>'请求超时'];
        if(is_null($phone) && is_null($email)){
            $return['message'] = '手机号和邮箱不能同时为空';
            return $return;
        }
        $user = $phone ? yield $this->userModel->findByPhone(null, $phone) : yield $this->userModel->findByEmail(null, $email);
        if(!$user){
            $return['message'] = '用户不存在';
            return $return;
        }
        if(!CommonFunction::validatePassword($password.$user['salt'], $user['password'])){
            $return['message'] = '密码错误';
            return $return;
        }
        if($user['status'] == -1){
            $return = ['code'=>-2, 'message'=>'账号已被管理员禁用，请重新登录'];
            return $return;
        }
        return yield $this->login($user['id']);
    }

    /**
     * 登录处理
     * @param $userID
     * @param null $transactionID
     * @return array|\Generator
     */
    private function login($userID, $transactionID=null){
        $return = ['code' => 0, 'message' => '请求超时'];
        $transactionID = $transactionID ?? yield $this->beginTransaction();
        $loginTime = time();
        $ip = CommonFunction::getClientIP();
        $ipAddress = IP::ip2addr($ip, true);
        $result = yield $this->userLoginLogModel->create($transactionID, $userID, $loginTime, $ip, $ipAddress);
        if(!$result['insert_id']){
            yield $this->rollbackTransaction($transactionID);
            $return['message'] = '记录登录日志错误';
            return $return;
        }
        $tokenExpireTime = $loginTime+1800;
        $token = CommonFunction::encryptPassword($userID.CommonFunction::getRandChar(10).$loginTime);
        $result = yield $this->userModel->updateToken($transactionID, $userID, $token, $tokenExpireTime);
        if($result['affected_rows'] == 0){
            yield $this->rollbackTransaction($transactionID);
            $return['message'] = '记录登录Token错误';
            return $return;
        }
        yield $this->commitTransaction($transactionID);
        $return = ['code'=>1, 'message'=>'登录成功', 'data'=>['token'=>$token]];
        return $return;
    }

    /**
     * 延长Token有效期
     * @param $token
     * @return array
     */
    public function extendTokenExpiretime($token){
        $return = ['code' => 0, 'message' => '请求超时'];
        $result = yield $this->userModel->extendTokenExpiretime(null, $token);
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
        $user = yield $this->userModel->findByToken($token);
        if(!$user){
            $return['message'] = 'Token错误或已过期';
            return $return;
        }
        $result = yield $this->userModel->logout(null, $token);
        if($result['result'] !== true){
            $return['message'] = '退出登录失败';
            return $return;
        }
        $return = ['code'=>1, 'message'=>'退出登录成功'];
        return $return;
    }

    /**
     * 发送激活邮件
     * @param $userID
     * @param $email
     * @param $transactionID
     * @return array
     */
    public function sendRegisterEmail($userID, $email, $transactionID){
        $return = ['code' => 0, 'message' => '请求超时'];
        $code = md5(CommonFunction::encryptPassword($userID.$email.CommonFunction::getRandChar(35, false).time()));
        $result = yield $this->emailCodeModel->insertCode($transactionID, 0, $email, $code);
        if (!$result['insert_id']) {
            $return['message'] = '发送验证码失败';
            return $return;
        }
        $link = $this->getParam('app')['host'].'/verifyEmail/'.$code;
        $response = $this->emailService->sendEmail(0, $email, ['link'=>$link]);
        if(!$response){
            $return['message'] = '发送验证码失败';
            return $response;
        }
        $return = ['code' => 1, 'message' => '发送验证码成功'];
        return $return;
    }

    /**
     * 激活邮箱
     * @param $code
     * @return array
     */
    public function validateEmail($code){
        $return = ['code' => 0, 'message' => '请求超时'];
        $result = yield $this->emailCodeModel->validateCode(0, $code);
        if($result['affected_rows'] == 0){
            $return['message'] = '验证码错误或已失效';
            return $return;
        }
        $return = ['code' => 1, 'message' => '邮箱验证成功'];
        return $return;
    }
}