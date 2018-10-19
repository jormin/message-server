<?php
/**
 * Created by PhpStorm.
 * User: Jormin
 * Date: 2018/10/16
 * Time: 下午1:55
 */

namespace app\Models;


class UserLoginLogModel extends BaseModel
{

    public $table = 'xieqiaomin_user_login_log';

    /**
     * 添加登录日志
     * @param $transactionID
     * @param $userID
     * @param $loginTime
     * @param $ip
     * @param $ipAddress
     * @return mixed
     */
    public function create($transactionID, $userID, $loginTime, $ip, $ipAddress)
    {
        $result = yield $this->mysql_pool->dbQueryBuilder->insert($this->table)
            ->set('user_id', $userID)
            ->set('login_time', $loginTime)
            ->set('ip', $ip)
            ->set('ip_address', $ipAddress)
            ->coroutineSend($transactionID);
        return $result;
    }

    /**
     * 获取指定用户的登录日志
     * @param $userID
     * @param $page
     * @param $limit
     * @return mixed
     */
    public function getUserLoginLogs($userID, $page, $limit){
        $result = yield $this->mysql_pool->dbQueryBuilder->select('*')
            ->from($this->table)
            ->where('user_id', $userID)
            ->limit($limit, $page*$limit)
            ->andWhere('deleted_at', 0)
            ->coroutineSend();
        return $result;
    }

}