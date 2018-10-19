<?php
/**
 * Created by PhpStorm.
 * User: Jormin
 * Date: 2018/10/16
 * Time: 下午1:19
 */

namespace app\Traits;

trait ConfigTrait
{

    /**
     * 读取配置
     * @param null $key
     * @return array|mixed|null
     */
    public function getConfig($key=null){
        $config = get_instance()->config;
        return is_null($key) ? $config->all() : $config->get($key);
    }

    /**
     * 设置配置
     * @param $key
     * @param $value
     */
    public function setConfig($key, $value){
        return get_instance()->config->set($key, $value);
    }

    /**
     * 读取配置
     * @param null $key
     * @return array|mixed|null
     */
    public function getParam($key=null){
        $params = $this->getConfig('params');
        return is_null($key) ? $params : ($params[$key] ?? null);
    }
}