<?php
namespace app\Route;

use app\Lib\CommonFunction;
use Jormin\IP\IP;
use Server\CoreBase\SwooleException;
use Server\Route\IRoute;

/**
 * Created by PhpStorm.
 * User: Jormin
 * Date: 2018/10/12
 * Time: 下午3:12
 */

class ApiRoute implements IRoute
{
    private $client_data;

    public function __construct()
    {
        $this->client_data = new \stdClass();
    }

    function handleClientData($data)
    {
        $this->client_data = $data;
        if (isset($this->client_data->controller_name) && isset($this->client_data->method_name)) {
            return $this->client_data;
        } else {
            throw new SwooleException('route 数据缺少必要字段');
        }
    }

    function handleClientRequest($request)
    {
        $this->client_data->path = $request->server['path_info'];
        $route = explode('/', $request->server['path_info']);
        $count = count($route);
        if ($count == 2) {
            $this->client_data->controller_name = $route[$count - 1] ?? null;
            $this->client_data->method_name = null;
            return;
        }
        $this->client_data->method_name = $route[$count - 1] ?? null;
        unset($route[$count - 1]);
        unset($route[0]);
        $this->client_data->controller_name = implode("\\", array_map(function ($item){
            return ucfirst($item);
        }, $route));
    }

    /**
     * 获取路由控制器名称(脊柱命名法 => 驼峰命名法)
     * @return string
     */
    function getControllerName()
    {
        $arr = explode('-', $this->client_data->controller_name);
        foreach ($arr as $key => $item){
            $arr[$key] = ucfirst($item);
        }
        $this->client_data->controller_name = preg_replace_callback('/([-_]+([a-z]{1}))/i',function($matches){
            return strtoupper($matches[2]);
        },$this->client_data->controller_name);
        return implode('', $arr).'Controller';
    }

    /**
     * 获取方法名称(脊柱命名法 => 驼峰命名法)
     * @return string
     */
    public function getMethodName()
    {
        $arr = explode('-', $this->client_data->method_name);
        foreach ($arr as $key => $item){
            $arr[$key] = ucfirst($item);
        }
        return implode('', $arr);
    }

    public function getPath()
    {
        return $this->client_data->path ?? "";
    }

    public function getParams()
    {
        return $this->client_data->params??null;
    }

    public function errorHandle(\Exception $e, $fd)
    {
        get_instance()->send($fd, "Error:" . $e->getMessage(), true);
        get_instance()->close($fd);
    }

    public function errorHttpHandle(\Exception $e, $request, $response)
    {
        $response->status(500);
        $response->header('Content-type', 'application/json');
        $response->end(json_encode(array(
            'code' => -1,
            'message' => '服务器异常'
        )));
    }


}