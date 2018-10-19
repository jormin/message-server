<?php
/**
 * Created by PhpStorm.
 * User: Jormin
 * Date: 2018/10/16
 * Time: 下午2:40
 */

namespace app\Models;


class MessageAttachmentModel extends BaseModel
{

    public $table = 'xieqiaomin_message_attachment';

    /**
     * 插入留言附件信息
     * @param $transactionID
     * @param $userID
     * @param $messageID
     * @param $attachmentID
     * @return mixed
     */
    public function create($transactionID, $userID, $messageID, $attachmentID){
        $result = yield $this->mysql_pool->dbQueryBuilder->insert($this->table)
            ->set('user_id', $userID)
            ->set('message_id', $messageID)
            ->set('attachment_id', $attachmentID)
            ->set('created_at', time())
            ->coroutineSend($transactionID);
        return $result;
    }

    /**
     * 根据留言ID查找
     * @param $messageID
     * @param string $column
     * @return null
     */
    public function findByMessageID($messageID, $column='*'){
        $result = yield $this->mysql_pool->dbQueryBuilder->select($column)
            ->from($this->table)
            ->where('message_id', $messageID)
            ->coroutineSend();
        return $result['result'][0] ?? null;
    }

}