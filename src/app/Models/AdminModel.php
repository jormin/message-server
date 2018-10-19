<?php
/**
 * Created by PhpStorm.
 * User: Jormin
 * Date: 2018/10/15
 * Time: 下午3:32
 */

namespace app\Models;


use app\Libs\CommonFunction;
use Jormin\IP\IP;
use Server\Asyn\Mysql\Miner;

class AdminModel extends BaseModel
{

    public $table = 'xieqiaomin_admin';

    /**
     * 根据手机号查找
     * @param $transactionID
     * @param $username
     * @param string $columns
     * @return null
     */
    public function findByUsername($transactionID, $username, $columns='*'){
        $result = yield $this->mysql_pool->dbQueryBuilder->select($columns)
            ->from($this->table)
            ->where('username', $username)
            ->coroutineSend($transactionID);
        return $result['result'][0] ?? null;
    }

    /**
     * 根据Token查找
     * @param $token
     * @return mixed
     */
    public function findByToken($token){
        $result = yield $this->mysql_pool->dbQueryBuilder->select('*')
            ->from($this->table)
            ->where('token', $token)
            ->andWhere('token_expiretime', time(), Miner::GREATER_THAN)
            ->coroutineSend();
        return $result['result'][0] ?? null;
    }

    /**
     * 更新Token
     * @param $transactionID
     * @param $adminID
     * @param $token
     * @param $tokenExpiretime
     * @return mixed
     */
    public function updateToken($transactionID, $adminID, $token, $tokenExpiretime){
        $result = yield $this->mysql_pool->dbQueryBuilder->update($this->table)
            ->where('id', $adminID)
            ->set('token', $token)
            ->set('token_expiretime', $tokenExpiretime)
            ->coroutineSend($transactionID);
        return $result;
    }

    /**
     * 延长用户Token有效期
     * @param $transactionID
     * @param $token
     * @return mixed
     */
    public function extendTokenExpiretime($transactionID, $token){
        $result = yield $this->mysql_pool->dbQueryBuilder->update($this->table)
            ->where('token', $token)
            ->andWhere('token_expiretime', time(), Miner::GREATER_THAN)
            ->set('token_expiretime', time()+1800)
            ->coroutineSend($transactionID);
        return $result;
    }

    /**
     * 退出登录
     * @param $transactionID
     * @param $token
     * @return mixed
     */
    public function logout($transactionID, $token){
        $result = yield $this->mysql_pool->dbQueryBuilder->update($this->table)
            ->where('token', $token)
            ->set('token', '')
            ->set('token_expiretime', 0)
            ->coroutineSend($transactionID);
        return $result;
    }

}