<?php
/**
 * Created by PhpStorm.
 * User: Jormin
 * Date: 2018/10/18
 * Time: 下午2:25
 */

namespace app\Jobs;

use app\Traits\ConfigTrait;
use app\Traits\LogTrait;

class BaseJob
{

    use LogTrait;

    use ConfigTrait;

}