<?php
/**
 * Created by PhpStorm.
 * Admin: Jormin
 * Date: 2018/10/16
 * Time: 上午10:31
 */

namespace app\Controllers\Api\Backend;


use app\Controllers\Api\BaseController;
use app\Models\AdminModel;

class TokenController extends BaseController
{

    /**
     * @var AdminModel
     */
    protected $adminModel;

    protected $token, $adminID, $admin;

    protected function initialization($controller_name, $method_name)
    {
        parent::initialization($controller_name, $method_name);
        $this->adminModel = $this->loader->model('AdminModel', $this);
        $this->token = $this->header('admin-token');
        if($this->token){
            $this->admin = yield $this->adminModel->findByToken($this->token);
            $this->adminID = $this->admin ? $this->admin['id'] : null;
            if($this->adminID){
                yield $this->adminModel->extendTokenExpiretime(null, $this->token);
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
        if(is_null($this->token) || is_null($this->admin)){
            $this->authFail();
            return false;
        }
        return true;
    }

}