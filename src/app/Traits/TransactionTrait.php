<?php
/**
 * Created by PhpStorm.
 * User: Jormin
 * Date: 2018/10/16
 * Time: 下午1:58
 */

namespace app\Traits;


trait TransactionTrait
{

    /**
     * 开启事务
     * @return \Generator
     */
    public function beginTransaction(){
        return yield get_instance()->mysql_pool->coroutineBegin($this);
    }

    /**
     * 回滚事务
     * @param $transactionID
     * @return \Generator
     */
    public function rollbackTransaction($transactionID){
        yield get_instance()->mysql_pool->coroutineRollback($transactionID);
    }

    /**
     * 提交事务
     * @param $transactionID
     * @return \Generator
     */
    public function commitTransaction($transactionID){
        yield get_instance()->mysql_pool->coroutineCommit($transactionID);
    }

}