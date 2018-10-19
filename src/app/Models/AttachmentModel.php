<?php
/**
 * Created by PhpStorm.
 * User: Jormin
 * Date: 2018/10/16
 * Time: 下午2:29
 */

namespace app\Models;


class AttachmentModel extends BaseModel
{

    public $table = 'xieqiaomin_attachment';

    /**
     * 插入附件信息
     * @param $transactionID
     * @param $userID
     * @param $path
     * @return mixed
     */
    public function create($transactionID, $userID, $path){
        $result = yield $this->mysql_pool->dbQueryBuilder->insert($this->table)
            ->set('user_id', $userID)
            ->set('path', $path)
            ->set('created_at', time())
            ->coroutineSend($transactionID);
        return $result;
    }

}