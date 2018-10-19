<?php
/**
 * Created by PhpStorm.
 * User: Jormin
 * Date: 2018/10/16
 * Time: 下午12:54
 */

namespace app\Jobs;

use app\Factories\JobFactory;
use Server\CoreBase\ChildProxy;
use Server\CoreBase\CoreBase;

class Job extends CoreBase
{
    public function __construct($proxy = ChildProxy::class)
    {
        parent::__construct($proxy);
    }

    /**
     * 当被loader时会调用这个方法进行初始化
     */
    public function initialization(&$context)
    {
        $this->setContext($context);
        if ($this->mysql_pool != null) {
            $this->installMysqlPool($this->mysql_pool);
        }
    }

    /**
     * 销毁回归对象池
     */
    public function destroy()
    {
        parent::destroy();
        JobFactory::getInstance()->revertJob($this);
    }

}