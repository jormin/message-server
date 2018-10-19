<?php
/**
 * Created by PhpStorm.
 * User: Jormin
 * Date: 2018/10/15
 * Time: 下午4:53
 */

namespace app\Libs;


class Validator
{

    /**
     * 数据源
     * @var
     */
    private $data;

    /**
     * 验证参数
     * @var
     */
    private $args;

    public function init($data, $args){
        $this->data = $data;
        $this->args = $args;
        return $this;
    }

    /**
     * 验证规则
     *
     * @var array
     */
    public static $rules = [
        'name' => ['rule' => "/^[\x{4e00}-\x{9fa5}_a-zA-Z]{2,10}$/u", 'msg' => '请输入2-10位字母、汉字的姓名！'],
        'password' => ['rule' => "/^\S{6,20}$/", 'msg'=>'请输入一个6-20位的密码'],
        'username' => ['rule' => "/^\S{4,20}$/", 'msg'=>'请输入一个4-20位的账号'],
        'gender' => ['rule' => "/^(1|2)$/", 'msg'=>'请选择正确格式的性别'],
        'phone' => ['rule' => "/^1[3|4|5|6|7|8|9][0-9]\d{8}$/", 'msg' => '请输入正确格式的手机号！'],
        'code' => ['rule' => "/^\d{1,4}|\d{1,6}$/", 'msg' => '请输入正确格式的验证码！'],
        'email' => ['rule' => "/^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*\.[a-zA-Z0-9]{2,6}$/", 'msg' => '请输入正确格式的邮箱！'],
        'token' => ['rule' => "/^\S{32,100}$/", 'msg' => 'Token错误！'],
        'title' => ['rule' => "/^\S{1,80}$/", 'msg' => '标题长度为1-80个字符'],
        'content' => ['rule' => "/^\S{1,500}$/", 'msg' => '留言内容长度为1-500个字符'],
        'keyword' => ['rule' => "/^\S{1,80}$/", 'msg' => '搜索关键字为1-80个字符'],
        'id' => ['rule' => '/^\d*$/', 'msg' => 'ID格式错误'],
        'coment' => ['rule' => "/^\S{1,140}$/", 'msg' => '留言内容长度为1-140个字符'],
        'userStatus' => ['rule' => "/^(1|-1)$/", 'msg'=>'用户状态错误'],
        'emailCode' => ['rule' => "/^\S{1,100}$/", 'msg' => '邮箱验证码错误'],
    ];

    /**
     * 根据字段名称获取验证规则
     *
     * @param $param
     * @return mixed
     */
    public function getRule($param)
    {
        if(key_exists($param, self::$rules)){
            return self::$rules[$param];
        }
        // TODO 额外同义验证，如 mobile、tel 对应验证规则 phone
        return null;
    }

    /**
     * 验证数据
     * @return bool
     */
    public function validate(){
        if (!isset($this->data) || !is_array($this->data)) {
            return '验证参数有误';
        }
        foreach ($this->args as $arg){
            $rule = $this->getRule($arg);
            if(!$rule){
                continue;
            }
            $value = $this->data[$arg] ?? null;
            if (is_null($value) || !preg_match($rule['rule'], $value)) {
                return $rule['msg'];
            }
        }
        return true;
    }

    /**
     * 验证指定参数
     * @param $arg
     * @param $value
     * @return bool
     */
    public function validateArg($arg, $value){
        $rule = $this->getRule($arg);
        if(!$rule || !preg_match($rule['rule'], $value)) {
            return false;
        }
        return true;
    }
}