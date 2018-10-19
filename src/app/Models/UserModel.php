<?php
/**
 * Created by PhpStor
 * User: Jormin
 * Date: 2018/10/15
 * Time: 下午3:32
 */

namespace app\Models;


use app\Libs\CommonFunction;
use Jormin\IP\IP;
use Server\Asyn\Mysql\Miner;

class UserModel extends BaseModel
{

    public $table = 'xieqiaomin_user';

    /**
     * 注册用户
     * @param $transactionID
     * @param $name
     * @param $gender
     * @param $phone
     * @param $email
     * @param $password
     * @return mixed
     */
    public function register($transactionID, $name, $gender, $phone, $email, $password)
    {
        $salt = CommonFunction::getRandChar(10);
        $password = CommonFunction::encryptPassword($password.$salt);
        $ip = CommonFunction::getClientIP();
        $ipAddress = IP::ip2addr($ip, true);
        $result = yield $this->mysql_pool->dbQueryBuilder->insert($this->table)
            ->set('name', $name)
            ->set('gender', $gender)
            ->set('phone', $phone)
            ->set('email', $email)
            ->set('password', $password)
            ->set('salt', $salt)
            ->set('ip', $ip)
            ->set('ip_address', $ipAddress)
            ->set('token', '')
            ->set('token_expiretime', 0)
            ->set('created_at', time())
            ->coroutineSend($transactionID);
        return $result;
    }

    /**
     * 更新Token
     * @param $transactionID
     * @param $userID
     * @param $token
     * @param $tokenExpiretime
     * @return mixed
     */
    public function updateToken($transactionID, $userID, $token, $tokenExpiretime){
        $result = yield $this->mysql_pool->dbQueryBuilder->update($this->table)
            ->where('id', $userID)
            ->set('token', $token)
            ->set('token_expiretime', $tokenExpiretime)
            ->coroutineSend($transactionID);
        return $result;
    }

    /**
     * 根据手机号查找
     * @param $transactionID
     * @param $phone
     * @param string $columns
     * @return null
     */
    public function findByPhone($transactionID, $phone, $columns='*'){
        $result = yield $this->mysql_pool->dbQueryBuilder->select($columns)
            ->from($this->table)
            ->where('phone', $phone)
            ->coroutineSend($transactionID);
        return $result['result'][0] ?? null;
    }

    /**
     * 根据邮箱查找
     * @param $transactionID
     * @param $email
     * @param string $columns
     * @return null
     */
    public function findByEmail($transactionID, $email, $columns='*'){
        $result = yield $this->mysql_pool->dbQueryBuilder->select($columns)
            ->from($this->table)
            ->where('email', $email)
            ->andWhere('email_verify', 1)
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
     * 根据ID查找
     * @param $transactionID
     * @param $id
     * @return null
     */
    public function findByID($transactionID, $id){
        $result = yield $this->mysql_pool->dbQueryBuilder->select('*')
            ->from($this->table)
            ->where('id', $id)
            ->coroutineSend($transactionID);
        return $result['result'][0] ?? null;
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

    /**
     * 搜索用户
     * @param $userID
     * @param $keyword
     * @return mixed
     */
    public function searchUser($userID, $keyword){
        $result = yield $this->mysql_pool->dbQueryBuilder->select('id, name, phone')
            ->from($this->table)
            ->where('id', $userID, Miner::NOT_EQUALS)
            ->where('name', '%'.$keyword.'%', Miner::LIKE)
            ->coroutineSend();
        return $result;
    }

    /**
     * 搜索
     * @param $query
     * @param $page
     * @param $limit
     * @return mixed
     */
    public function searchUsers($query, $page, $limit){
        $countSql = $this->makeQuerySql($query, true);
        $querySql = $this->makeQuerySql($query, false, $page, $limit);
        $countResult = yield $this->mysql_pool->dbQueryBuilder
            ->coroutineSend(null, $countSql);
        $total = $countResult['result'][0]['total'];
        $queryResult = yield $this->mysql_pool->dbQueryBuilder
            ->coroutineSend(null, $querySql);
        $items = yield $this->combineUsers($queryResult['result']);
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
     * @param bool $content
     * @return string
     */
    public function makeQuerySql($query, $count=false, $page=null, $limit=null, $content=false){
        $column = '*';
        if($count === true){
            $column = 'count(*) as total';
        }
        $sql = "select {$column} from xieqiaomin_user ";
        $whereLimit = $orWhereLimit = [];
        $bindParams = [];
        if(isset($query['name'])){
            $orWhereLimit[] = "name like ?";
            $bindParams[] = ['value'=>'%'.$query['name'].'%', 'type'=>'string'];
        }
        if(isset($query['gender'])){
            $orWhereLimit[] = "gender = ?";
            $bindParams[] = ['value'=>$query['gender'], 'type'=>'integer'];
        }
        if(isset($query['status'])){
            $orWhereLimit[] = "status = ?";
            $bindParams[] = ['value'=>$query['status'], 'type'=>'integer'];
        }
        if(isset($query['phone'])){
            $orWhereLimit[] = "phone = ?";
            $bindParams[] = ['value'=>$query['phone'], 'type'=>'string'];
        }
        if(isset($query['email'])){
            $orWhereLimit[] = "email = ?";
            $bindParams[] = ['value'=>$query['email'], 'type'=>'string'];
        }
        if(key_exists('userID', $query)){
            if(is_null($query['userID'])){
                $orWhereLimit[] = "user_id is null";
            }else{
                $orWhereLimit[] = "user_id = ?";
                $bindParams[] = ['value'=>$query['userID'], 'type'=>'integer'];
            }
        }
        if(count($orWhereLimit)){
            $whereLimit[] = implode(' or ', $orWhereLimit);
        }
        if(count($whereLimit)){
            $sql .= 'where '.implode(' and ', $whereLimit);
        }
        $sql .= ' order by created_at desc';
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
     * 组合用户信息
     * @param $user
     * @return mixed
     */
    public function combineUser($user){
        $user['created_at'] = CommonFunction::formatTime($user['created_at']);
        $user['gender'] = $user['gender'] == 1 ? '男' : '女';
        return $user;
    }

    /**
     * 组合用户信息数组
     * @param $users
     * @return mixed
     */
    public function combineUsers($users){
        foreach ($users as $key => $user){
            $users[$key] = yield $this->combineUser($user);
        }
        return $users;
    }

    /**
     * 修改用户状态
     * @param $id
     * @param $status
     * @return mixed
     */
    public function changeStatus($id, $status){
        $result = yield $this->mysql_pool->dbQueryBuilder->update($this->table)
            ->where('id', $id)
            ->set('status', $status)
            ->coroutineSend();
        return $result;
    }

}