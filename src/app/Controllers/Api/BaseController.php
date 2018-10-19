<?php
/**
 * Created by PhpStorm.
 * User: Jormin
 * Date: 2018/10/12
 * Time: 下午4:40
 */

namespace app\Controllers\Api;


use app\Libs\Validator;
use app\Models\UserModel;
use Server\CoreBase\Controller;
use Server\Memory\Pool;

class BaseController extends Controller
{

    /**
     * Json响应
     * @param $code
     * @param $message
     * @param array|null $data
     */
    public function json($code, $message, array $data=null){
        $this->http_output->setHeader('Content-type', 'application/json');
        $responseData = array(
            'code' => $code,
            'message' => $message
        );
        if($data){
            $responseData = array_merge($responseData, $data);
        }
        $this->http_output->end(json_encode($responseData));
    }

    /**
     * 操作成功
     * @param string $message
     * @param array|null $data
     */
    public function success(string $message='操作成功', array $data=null){
        $this->json(1, $message, $data);
    }

    /**
     * 操作失败
     * @param string $message
     */
    public function fail(string $message='操作失败'){
        $this->json(0, $message);
    }

    /**
     * 自动响应
     * @param $return
     */
    public function autoReturn($return){
        $return['code'] == 1 ? $this->success($return['message'], $return['data'] ?? null) : $this->fail($return['message']);
    }

    /**
     * 操作异常
     * @param string $message
     */
    public function error(string $message='操作异常'){
        $this->json(-1, $message);
    }

    /**
     * 操作异常
     * @param string $message
     */
    public function authFail(string $message='Token错误或已过期，请重新登录'){
        $this->json(-2, $message);
    }

    public function defaultMethod()
    {
        $this->error('404');
    }

    /**
     * 允许跨域
     */
    public function cors(){
        $this->http_output->setHeader('Access-Control-Allow-Origin', '*');
        $this->http_output->setHeader('Access-Control-Allow-Headers', 'Admin-Token, User-Token, Token, Origin, X-Requested-With, Content-Type, Accept');
        $this->http_output->setHeader('ccess-Control-Allow-Methods', 'GET, POST, OPTIONS');
        $responseData = array(
            'code' => 1,
            'message' => 'ok'
        );
        $this->http_output->end(json_encode($responseData));
    }

    /**
     * 获取GET参数
     * @param null $param
     * @return array
     */
    public function get($param=null){
        $params = $this->http_input->getAllGet();
        return $param ? ($params[$param] ?? null) : $params;
    }

    /**
     * 获取POST参数
     * @param null $param
     * @return array|string
     */
    public function post($param=null){
        $params = $this->http_input->getAllPost();
        return $param ? ($params[$param] ?? null) : $params;
    }

    /**
     * 获取HEADER参数
     * @param null $key
     * @return array|null
     */
    public function header($key=null){
        $headers = $this->http_input->getAllHeader();
        return is_null($key) ? $headers : ($headers[$key] ?? null) ;
    }

    /**
     * 参数校验
     * @param $method
     * @param $args
     * @return array|bool
     */
    public function validate($method, $args){
        switch (strtoupper($method)){
            case 'POST':
                $params = $this->post();
                break;
            case 'HEADER':
                $params = $this->header();
                break;
            case 'GET':
            default:
                $params = $this->get();
        }
        $data = [];
        foreach ($args as $arg){
            $data[$arg] = $params[$arg];
        }
        $validator = Pool::getInstance()->get(Validator::class)->init($data, $args);
        $result = $validator->validate();
        Pool::getInstance()->push($validator);
        if($result !== true){
            $this->fail($result);
            return false;
        };
        return $data;
    }

    /**
     * 验证指定参数
     * @param $arg
     * @param $value
     * @return mixed
     */
    public function validateArg($arg, $value){
        $validator = Pool::getInstance()->get(Validator::class)->init([], []);
        $result = $validator->validateArg($arg, $value);
        Pool::getInstance()->push($validator);
        return $result;
    }

}