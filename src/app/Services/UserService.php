<?php
/**
 * Created by PhpStorm.
 * User: Jormin
 * Date: 2018/10/17
 * Time: 上午11:33
 */

namespace app\Services;


use app\Libs\CommonFunction;
use app\Models\UserModel;

class UserService extends BaseService
{

    /**
     * @var UserModel
     */
    private $userModel;

    public function initialization(&$context)
    {
        parent::initialization($context);
        $this->userModel = $this->loader->model('UserModel', $this);
    }

    /**
     * 搜索用户
     * @param $query
     * @param $page
     * @return array
     */
    public function searchUsers($query, $page){
        $data = yield $this->userModel->searchUsers($query, $page, $this->defaultPageLimit);
        $return = ['code' => 1, 'message' => '获取成功', 'data' => $data];
        return $return;
    }

    /**
     * 搜索用户
     * @param $userID
     * @param $keyword
     * @return array
     */
    public function searchUser($userID, $keyword){
        $result = yield $this->userModel->searchUser($userID, $keyword);
        $users = $result['result'];
        foreach ($users as $key => $user){
            $user['phone'] = CommonFunction::formatPhone($user['phone']);
            $user['label'] = $user['name'].'('.$user['phone'].')';
            $users[$key] = $user;
        }
        $return = ['code' => 1, 'message' => '获取成功', 'data' => ['users'=>$users]];
        return $return;
    }

    /**
     * 修改用户状态
     * @param $userID
     * @param $status
     * @return array
     */
    public function changeStatus($userID, $status){
        $result = yield $this->userModel->changeStatus($userID, $status);
        if($result['result'] !== true){
            $return['message'] = '修改用户状态失败';
            return $return;
        }
        $return = ['code' => 1, 'message' => '修改用户状态成功'];
        return $return;
    }

}