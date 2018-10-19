<?php
/**
 * Created by PhpStorm.
 * User: Jormin
 * Date: 2018/10/16
 * Time: 下午3:22
 */

namespace app\Services;


use app\Models\UserLoginLogModel;

class UserLoginLogService extends BaseService
{

    /**
     * @var UserLoginLogModel
     */
    private $userLoginLogModel;

    public function initialization(&$context)
    {
        parent::initialization($context);
        $this->userLoginLogModel = $this->loader->model('UserLoginLogModel', $this);
    }

    /**
     * 获取指定用户的登录日志
     * @param $userID
     * @param $page
     * @return array
     */
    public function getUserLoginLogs($userID, $page){
        $result = $this->userLoginLogModel->getUserLoginLogs($userID, $page, $this->defaultPageLimit);
        $return = ['code' => 1, 'message' => '获取成功', ['messages'=>$result['result']]];
        return $return;
    }

}