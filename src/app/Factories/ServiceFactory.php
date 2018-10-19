<?php
/**
 * Created by PhpStorm.
 * User: Jormin
 * Date: 2018/10/16
 * Time: 下午12:56
 */

namespace app\Factories;

use Server\CoreBase\SwooleException;
use app\Services\Service;

class ServiceFactory
{
    /**
     * @var ServiceFactory
     */
    private static $instance;
    private $pool = [];
    private $pool_count = [];

    /**
     * ServiceFactory constructor.
     */
    public function __construct()
    {
        self::$instance = $this;
    }

    /**
     * 获取单例
     * @return ServiceFactory
     */
    public static function getInstance()
    {
        if (self::$instance == null) {
            new ServiceFactory();
        }
        return self::$instance;
    }

    /**
     * 获取一个service
     * @param $old_service
     * @return mixed
     * @throws SwooleException
     */
    public function getService($old_service)
    {
        $service = str_replace('/', '\\', $old_service);
        if (!array_key_exists($old_service, $this->pool)) {
            $this->pool[$old_service] = new \SplStack();;
        }
        if (!$this->pool[$old_service]->isEmpty()) {
            $service_instance = $this->pool[$old_service]->shift();
            $service_instance->reUse();
            return $service_instance;
        }
        if (class_exists($service)) {
            $service_instance = new $service;
            $service_instance->core_name = $old_service;
            $this->addNewCount($old_service);
            return $service_instance;
        }

        $class_name = "app\\Services\\$service";

        if (class_exists($class_name)) {
            $service_instance = new $class_name;
            $service_instance->core_name = $old_service;
            $this->addNewCount($old_service);
        } else {
            throw new SwooleException("class $service is not exist");
        }
        return $service_instance;
    }

    /**
     * 归还一个service
     * @param $service Service
     */
    public function revertService($service)
    {
        if (!$service->is_destroy) {
            $service->destroy();
        }
        $this->pool[$service->core_name]->push($service);
    }

    private function addNewCount($name)
    {
        if (isset($this->pool_count[$name])) {
            $this->pool_count[$name]++;
        } else {
            $this->pool_count[$name] = 1;
        }
    }

    /**
     * 获取状态
     */
    public function getStatus()
    {
        $status = [];
        foreach ($this->pool as $key => $value) {
            $status[$key . '[pool]'] = count($value);
            $status[$key . '[new]'] = $this->pool_count[$key] ?? 0;
        }
        return $status;
    }
}