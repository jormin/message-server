<?php
/**
 * Created by PhpStorm.
 * User: Jormin
 * Date: 2018/10/16
 * Time: 下午1:29
 */

namespace app\Loaders;

use app\Factories\JobFactory;
use app\Factories\ServiceFactory;
use Server\Components\AOP\AOP;
use Server\CoreBase\Child;
use Server\CoreBase\Loader;

class CustomLoader extends Loader
{

    private $_service_factory;
    private $_job_factory;

    public function __construct()
    {
        parent::__construct();
        $this->_service_factory = ServiceFactory::getInstance();
        $this->_job_factory = JobFactory::getInstance();
    }

    /**
     * 加载Service
     * @param $service
     * @param Child $parent
     * @return mixed|null
     */
    public function service($service, Child $parent)
    {

        if (empty($service)) {
            return null;
        }
        $root = $parent;
        while (isset($root)) {
            if ($service == $root->core_name) {
                return AOP::getAOP($root);
            }
            if ($root->hasChild($service)) {
                return $root->getChild($service);
            }
            $root = $root->parent??null;
        }
        $service_instance = $this->_service_factory->getService($service);
        $parent->addChild($service_instance);
        $service_instance->initialization($parent->getContext());
        return AOP::getAOP($service_instance);
    }

    /**
     * 加载Job
     * @param $job
     * @param Child $parent
     * @return mixed|null
     */
    public function job($job, Child $parent)
    {

        if (empty($job)) {
            return null;
        }
        $root = $parent;
        while (isset($root)) {
            if ($job == $root->core_name) {
                return AOP::getAOP($root);
            }
            if ($root->hasChild($job)) {
                return $root->getChild($job);
            }
            $root = $root->parent??null;
        }
        $job_instance = $this->_job_factory->getJob($job);
        $parent->addChild($job_instance);
        $job_instance->initialization($parent->getContext());
        return AOP::getAOP($job_instance);
    }

}