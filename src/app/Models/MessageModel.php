<?php
/**
 * Created by PhpStorm.
 * User: zhangjincheng
 * Date: 16-7-15
 * Time: 下午1:44
 */

namespace app\Models;

use app\Libs\CommonFunction;
use Jormin\IP\IP;

class MessageModel extends BaseModel
{

    public $table = 'xieqiaomin_message';

    /**
     * 搜索
     * @param $query
     * @param $page
     * @param $limit
     * @return mixed
     */
    public function searchMessages($query, $page, $limit){
        $countSql = $this->makeQuerySql($query, true);
        $querySql = $this->makeQuerySql($query, false, $page, $limit);
        $countResult = yield $this->mysql_pool->dbQueryBuilder
            ->coroutineSend(null, $countSql);
        $total = $countResult['result'][0]['total'];
        $queryResult = yield $this->mysql_pool->dbQueryBuilder
            ->coroutineSend(null, $querySql);
        $items = yield $this->combineMessages($queryResult['result']);
        $data = [
            'total' => $total,
            'items' => $items,
            'totalPage' => ceil($total/$limit),
            'currentPage' => $page
        ];
        return $data;
    }

    /**
     * 封装查询sql
     *
     * @param $query
     * @param bool $count
     * @param null $page
     * @param null $limit
     * @param bool $noDeleted
     * @param bool $content
     * @return string
     */
    public function makeQuerySql($query, $count=false, $page=null, $limit=null, $noDeleted=true, $content=false){
        $column = 'm.id as id, m.title as title, su.name as sender, su.gender as gender, ru.name as receiver, a.path as attachment, m.ip, m.ip_address, m.created_at';
        if($content === true){
            $column .= ', m.content';
        }
        if($count === true){
            $column = 'count(*) as total';
        }
        $sql = "
            select {$column}
            from xieqiaomin_message m 
            left join xieqiaomin_message_attachment ma on m.id = ma.message_id 
            left join xieqiaomin_attachment a on a.id = ma.attachment_id 
            left join xieqiaomin_user su on m.user_id = su.id 
            left join xieqiaomin_user ru on m.receiver_id = ru.id 
        ";
        $whereLimit = $orWhereLimit = [];
        $bindParams = [];
        if($noDeleted){
            $whereLimit[] = "m.deleted_at = 0";
        }
        if(isset($query['name'])){
            $orWhereLimit[] = "su.name like ?";
            $bindParams[] = ['value'=>'%'.$query['name'].'%', 'type'=>'string'];
        }
        if(isset($query['gender'])){
            $orWhereLimit[] = "su.gender = ?";
            $bindParams[] = ['value'=>$query['gender'], 'type'=>'integer'];
        }
        if(isset($query['phone'])){
            $orWhereLimit[] = "su.phone = ?";
            $bindParams[] = ['value'=>$query['phone'], 'type'=>'string'];
        }
        if(isset($query['email'])){
            $orWhereLimit[] = "su.email = ?";
            $bindParams[] = ['value'=>$query['email'], 'type'=>'string'];
        }
        if(isset($query['userID'])){
            $orWhereLimit[] = "m.user_id = ?";
            $bindParams[] = ['value'=>$query['userID'], 'type'=>'integer'];
        }
        if(key_exists('receiverID', $query)){
            if(is_null($query['receiverID'])){
                $orWhereLimit[] = "m.receiver_id is null";
            }else{
                $orWhereLimit[] = "m.receiver_id = ?";
                $bindParams[] = ['value'=>$query['receiverID'], 'type'=>'integer'];
            }
        }
        if(isset($query['title'])){
            // 全文索引
//            $orWhereLimit[] = "match(m.title) against(?)";
//            $bindParams[] = ['value'=>$query['title'], 'type'=>'string'];
            // like查询
            $orWhereLimit[] = "m.title like ?";
            $bindParams[] = ['value'=>'%'.$query['title'].'%', 'type'=>'string'];
        }
        if(count($orWhereLimit)){
            $whereLimit[] = implode(' or ', $orWhereLimit);
        }
        if(count($whereLimit)){
            $sql .= 'where '.implode(' and ', $whereLimit);
        }
        $sql .= ' order by m.created_at desc';
        if($page && $limit){
            $sql .= ' limit ? offset ?;';
            $bindParams[] = ['value'=>$limit, 'type'=>'integer'];
            $bindParams[] = ['value'=>$page*$limit, 'type'=>'integer'];
        }
        foreach ($bindParams as $key => $bindParam){
            $this->bindParam($sql, $bindParam['value'], $bindParam['type']);
        }
        $sql .= ';';
        return $sql;
    }

    /**
     * 插入留言信息
     * @param $transactionID
     * @param $userID
     * @param $receiverID
     * @param $title
     * @param $content
     * @return mixed
     */
    public function create($transactionID, $userID, $receiverID, $title, $content)
    {
        $ip = CommonFunction::getClientIP();
        $ipAddress = IP::ip2addr($ip, true);
        $receiverID = !$receiverID ? null : $receiverID;
        $result = yield $this->mysql_pool->dbQueryBuilder->insert($this->table)
            ->set('user_id', $userID)
            ->set('receiver_id', $receiverID)
            ->set('title', $title)
            ->set('content', $content)
            ->set('ip', $ip)
            ->set('ip_address', $ipAddress)
            ->set('created_at', time())
            ->coroutineSend($transactionID);
        return $result;
    }

    /**
     * 获取公共留言
     * @param $page
     * @param $limit
     * @return mixed
     */
    public function getCommonMessages($page, $limit){
        $result = yield $this->searchMessages(['receiverID'=>null], $page, $limit);
        return $result;
    }

    /**
     * 获取指定用户发送的留言
     * @param $userID
     * @param $page
     * @param $limit
     * @return mixed
     */
    public function getSenderMessages($userID, $page, $limit){
        $result = yield $this->searchMessages(['userID'=>$userID], $page, $limit);
        return $result;
    }

    /**
     * 获取指定用户接收的留言
     * @param $receiverID
     * @param $page
     * @param $limit
     * @return mixed
     */
    public function getReceiverMessages($receiverID, $page, $limit){
        $result = yield $this->searchMessages(['receiverID'=>$receiverID], $page, $limit);
        return $result;
    }

    /**
     * 删除留言
     * @param $id
     * @return mixed
     */
    public function deleteMessage($id){
        $result = yield $this->mysql_pool->dbQueryBuilder->update($this->table)
            ->where('id', $id)
            ->set('deleted_at', time())
            ->coroutineSend();
        return $result;
    }

    /**
     * 留言详情
     * @param $id
     * @return mixed
     */
    public function findByID($id){
        $querySql = $this->makeQuerySql(['id'=>$id], false, null, null, true, true);
        $queryResult = yield $this->mysql_pool->dbQueryBuilder
            ->coroutineSend(null, $querySql);
        $item = yield $this->combineMessage($queryResult['result'][0] ?? null);
        return $item;
    }

    /**
     * 组合消息
     * @param $message
     * @return mixed
     */
    public function combineMessage($message){
        if($message['attachment']){
            $message['attachment'] = $this->getParam('qiniu')['domain'].'/'.$message['attachment'];
        }
        $message['created_at'] = CommonFunction::formatTime($message['created_at']);
        $message['gender'] = $message['gender'] == 1 ? '男' : '女';
        return $message;
    }

    /**
     * 组合消息数组
     * @param $messages
     * @return mixed
     */
    public function combineMessages($messages){
        foreach ($messages as $key => $message){
            $messages[$key] = yield $this->combineMessage($message);
        }
        return $messages;
    }
}