<?php
/**
 * Created by PhpStorm.
 * User: Jormin
 * Date: 2018/10/12
 * Time: 下午5:50
 */

namespace app\Controllers\Api\Backend;

use app\Controllers\Api\BaseController;
use app\Services\AdminAuthService;

class AuthController extends BaseController
{

    /**
     * @var AdminAuthService
     */
    protected $adminAuthService;

    protected function initialization($controller_name, $method_name)
    {
        parent::initialization($controller_name, $method_name);
        $this->adminAuthService = $this->loader->service('AdminAuthService', $this);
    }

    /**
     * 登录
     */
    public function actionLogin(){
        $data = $this->validate('post', ['username', 'password']);
        if($data === false){
            return null;
        }
        $return = yield $this->adminAuthService->accountlogin($data['username'], $data['password']);
        $this->autoReturn($return);
    }

}