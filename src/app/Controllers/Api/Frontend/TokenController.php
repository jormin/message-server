<?php
/**
 * Created by PhpStorm.
 * User: Jormin
 * Date: 2018/10/16
 * Time: 上午10:31
 */

namespace app\Controllers\Api\Frontend;


use app\Controllers\Api\BaseController;
use app\Models\UserModel;

class TokenController extends BaseController
{

    /**
     * @var UserModel
     */
    protected $userModel;

    protected $token, $userID, $user;

    protected function initialization($controller_name, $method_name)
    {
        parent::initialization($controller_name, $method_name);
        $this->userModel = $this->loader->model('UserModel', $this);
        $this->token = $this->header('user-token');
        if($this->token){
            $this->user = yield $this->userModel->findByToken($this->token);
            $this->userID = $this->user ? $this->user['id'] : null;
            if($this->userID){
                yield $this->userModel->extendTokenExpiretime(null, $this->token);
            }
        }
    }

    /**
     * 请求前处理
     * @return bool
     */
    public function beforeAction(){
        if(strtoupper($this->http_input->getRequestMethod()) === 'OPTIONS'){
            return true;
        }
        if(is_null($this->token) || is_null($this->user)){
            $this->authFail();
            return false;
        }
        if($this->user['status'] == -1){
            $this->authFail('账号已被管理员禁用，请重新登录');
            return false;
        }
        return true;
    }

}