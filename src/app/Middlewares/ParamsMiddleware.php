<?php
/**
 * Created by PhpStorm.
 * User: Jormin
 * Date: 2018/10/16
 * Time: 下午1:12
 */

namespace app\Middlewares;

use app\Traits\ConfigTrait;
use Server\Components\Middleware\Middleware;

class ParamsMiddleware extends Middleware
{

    use ConfigTrait;

    /**
     * 处理前
     */
    public function before_handle()
    {
        $params = require(dirname(__FILE__).'/../../config/params.php');
        $this->setConfig('params', $params);
    }

    /**
     * 处理后
     * @param $path
     */
    public function after_handle($path)
    {
        // TODO: Implement after_handle() method.
    }


}