<?php
/**
 * Created by PhpStorm.
 * User: Jormin
 * Date: 2018/10/12
 * Time: 下午5:50
 */

namespace app\Controllers\Api\Backend;

use app\Services\EmailService;
use app\Services\UserService;

class UserController extends TokenController
{

    /**
     * @var UserService
     */
    protected $userService;

    /**
     * @var EmailService
     */
    protected $emailService;

    protected function initialization($controller_name, $method_name)
    {
        yield parent::initialization($controller_name, $method_name);
        $this->userService = $this->loader->service('UserService', $this);
        $this->emailService = $this->loader->service('EmailService', $this);
    }

    /**
     * 获取用户列表
     * @return null
     */
    public function actionIndex(){
        if(!$this->beforeAction()){
            return null;
        }
        $params = $this->get();
        $args = ['name', 'gender', 'phone', 'email', 'status'];
        foreach ($args as $key => $arg){
            $value = !empty($params[$arg]) ? $params[$arg] : null;
            if(is_null($value)){
                unset($args[$key]);
            }
        }
        $query = $this->validate('get', $args);
        if($query === false){
            return null;
        }
        $page = $this->get('page') ?? 0;
        $return = yield $this->userService->searchUsers($query, $page);
        $this->autoReturn($return);
    }

    /**
     * 获取详情
     */
    public function actionDetail(){
        if(!$this->beforeAction()){
            return null;
        }
        $data = $this->validate('get', ['id']);
        if($data === false){
            return null;
        }
        $return = yield $this->userService->getUserDetail($data['id']);
        $this->autoReturn($return);
    }

    /**
     * 删除用户
     */
    public function actionDelete(){
        if(!$this->beforeAction()){
            return null;
        }
        $data = $this->validate('get', ['id']);
        if($data === false){
            return null;
        }
        $return = yield $this->userService->deleteUser($data['id']);
        $this->autoReturn($return);
    }

    /**
     * 修改状态
     */
    public function actionChangeStatus(){
        if(!$this->beforeAction()){
            return null;
        }
        $data = $this->validate('get', ['id', 'userStatus']);
        if($data === false){
            return null;
        }
        $return = yield $this->userService->changeStatus($data['id'], $data['userStatus']);
        $this->autoReturn($return);
    }

}