<?php
/**
 * Created by PhpStorm.
 * User: Jormin
 * Date: 2018/10/17
 * Time: 上午11:32
 */

namespace app\Controllers\Api\Frontend;


use app\Services\UserService;

class UserController extends TokenController
{

    /**
     * @var UserService
     */
    protected $userService;

    protected function initialization($controller_name, $method_name)
    {
        yield parent::initialization($controller_name, $method_name);
        $this->userService = $this->loader->service('UserService', $this);
    }

    /**
     * 搜索用户
     * @return null
     */
    public function actionSearch(){
        if(!$this->beforeAction()){
            return null;
        }
        $data = $this->validate('get', ['keyword']);
        if($data === false){
            return null;
        }
        $return = yield $this->userService->searchUser($this->userID, $data['keyword']);
        $this->autoReturn($return);
    }

}