<?php
/**
 * Created by PhpStorm.
 * User: Jormin
 * Date: 2018/10/16
 * Time: 下午12:59
 */

namespace app\Services;


use app\Traits\ConfigTrait;
use app\Traits\LogTrait;
use app\Traits\SMSTrait;
use app\Traits\TransactionTrait;

class BaseService extends Service
{

    use ConfigTrait;

    use TransactionTrait;

    protected $defaultPageLimit = 15;

}