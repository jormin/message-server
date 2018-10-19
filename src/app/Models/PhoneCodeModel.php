<?php
/**
 * Created by PhpStorm.
 * User: Jormin
 * Date: 2018/10/16
 * Time: 上午11:34
 */

namespace app\Models;


use Server\Asyn\Mysql\Miner;

class PhoneCodeModel extends BaseModel
{

    public $table = 'xieqiaomin_phone_code';

    /**
     * 插入验证码
     * @param $transactionID
     * @param $type
     * @param $phone
     * @param $code
     * @return mixed
     */
    public function insertCode($transactionID, $type, $phone, $code){
        $result = yield $this->mysql_pool->dbQueryBuilder->insert($this->table)
            ->set('type', $type)
            ->set('phone', $phone)
            ->set('code', $code)
            ->set('expiretime', time()+60*5)
            ->set('created_at', time())
            ->coroutineSend($transactionID);
        return $result;
    }

    /**
     * 验证验证码
     * @param $type
     * @param $phone
     * @param $code
     * @return bool
     */
    public function validateCode($type, $phone, $code){
        $result = yield $this->mysql_pool->dbQueryBuilder->update($this->table)
            ->where('type', $type)
            ->andWhere('phone', $phone)
            ->andWhere('code', $code)
            ->andWhere('expiretime', time(), Miner::GREATER_THAN)
            ->andWhere('validated_at', 0)
            ->set('validated_at', time())
            ->coroutineSend();
        return $result;
    }
}