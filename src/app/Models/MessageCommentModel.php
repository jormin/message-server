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

class MessageCommentModel extends BaseModel
{

    public $table = 'xieqiaomin_message_comment';

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
        $items = yield $this->combineComments($queryResult['result']);
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
     * @return string
     */
    public function makeQuerySql($query, $count=false, $page=null, $limit=null, $noDeleted=true){
        $column = 'mc.id as id, mc.comment as comment, u.name as user, u.gender as gender, mc.created_at';
        if($count === true){
            $column = 'count(*) as total';
        }
        $sql = "
            select {$column}
            from xieqiaomin_message_comment mc 
            left join xieqiaomin_message m on mc.message_id = m.id 
            left join xieqiaomin_user u on mc.user_id = u.id 
        ";
        $whereLimit = $orWhereLimit = [];
        $bindParams = [];
        if($noDeleted){
            $whereLimit[] = "mc.deleted_at = 0";
        }
        if(isset($query['name'])){
            $orWhereLimit[] = "u.name like ?";
            $bindParams[] = ['value'=>'%'.$query['name'].'%', 'type'=>'string'];
        }
        if(isset($query['gender'])){
            $orWhereLimit[] = "u.gender = ?";
            $bindParams[] = ['value'=>$query['gender'], 'type'=>'integer'];
        }
        if(isset($query['phone'])){
            $orWhereLimit[] = "u.phone = ?";
            $bindParams[] = ['value'=>$query['phone'], 'type'=>'string'];
        }
        if(isset($query['email'])){
            $orWhereLimit[] = "u.email = ?";
            $bindParams[] = ['value'=>$query['email'], 'type'=>'string'];
        }
        if(isset($query['userID'])){
            $orWhereLimit[] = "m.user_id = ?";
            $bindParams[] = ['value'=>$query['userID'], 'type'=>'integer'];
        }
        if(isset($query['messageID'])){
            $orWhereLimit[] = "mc.message_id = ?";
            $bindParams[] = ['value'=>$query['messageID'], 'type'=>'integer'];
        }
        if(count($orWhereLimit)){
            $whereLimit[] = implode(' or ', $orWhereLimit);
        }
        if(count($whereLimit)){
            $sql .= 'where '.implode(' and ', $whereLimit);
        }
        $sql .= ' order by mc.created_at desc';
        if($page && $limit){
            $sql .= ' limit ? offset ?;';
            $bindParams[] = ['value'=>$limit, 'type'=>'integer'];
            $bindParams[] = ['value'=>$page*$limit, 'type'=>'integer'];
        }
        foreach ($bindParams as $key => $bindParam){
            $this->bindParam($sql, $bindParam['value'], $bindParam['type']);
        }
        $sql .= ';';
        print_r($sql);
        return $sql;
    }

    /**
     * 插入评论信息
     * @param $transactionID
     * @param $userID
     * @param $messageID
     * @param $coment
     * @return mixed
     */
    public function create($transactionID, $userID, $messageID, $coment)
    {
        $ip = CommonFunction::getClientIP();
        $ipAddress = IP::ip2addr($ip, true);
        $result = yield $this->mysql_pool->dbQueryBuilder->insert($this->table)
            ->set('user_id', $userID)
            ->set('message_id', $messageID)
            ->set('comment', $coment)
            ->set('ip', $ip)
            ->set('ip_address', $ipAddress)
            ->set('created_at', time())
            ->coroutineSend($transactionID);
        return $result;
    }

    /**
     * 获取指定留言的评论
     * @param $messageID
     * @param $page
     * @param $limit
     * @return mixed
     */
    public function getMessageComments($messageID, $page, $limit){
        $result = yield $this->searchMessages(['messageID'=>$messageID], $page, $limit);
        return $result;
    }

    /**
     * 删除评论
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
     * 评论详情
     * @param $id
     * @return mixed
     */
    public function findByID($id){
        $querySql = $this->makeQuerySql(['id'=>$id], false, null, null, true);
        $queryResult = yield $this->mysql_pool->dbQueryBuilder
            ->coroutineSend(null, $querySql);
        $item = yield $this->combineComment($queryResult['result'][0] ?? null);
        return $item;
    }

    /**
     * 组合评论
     * @param $comment
     * @return mixed
     */
    public function combineComment($comment){
        $comment['created_at'] = CommonFunction::formatTime($comment['created_at']);
        return $comment;
    }

    /**
     * 组合评论数组
     * @param $comments
     * @return mixed
     */
    public function combineComments($comments){
        foreach ($comments as $key => $comment){
            $comments[$key] = yield $this->combineComment($comment);
        }
        return $comments;
    }
}