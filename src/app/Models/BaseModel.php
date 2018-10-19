<?php
/**
 * Created by PhpStorm.
 * User: Jormin
 * Date: 2018/10/15
 * Time: 下午2:20
 */

namespace app\Models;


use app\Traits\ConfigTrait;
use Server\CoreBase\Model;

class BaseModel extends Model
{

    use ConfigTrait;

    public $table = '';

    /**
     * 参数绑定
     * @param $sql
     * @param $value
     * @param string $type
     * @return string
     */
    public function bindParam(&$sql, $value, $type='STRING') {
        switch (strtoupper($type)) {
            case 'STRING' :
                $value = addslashes($value);
                $value = "'".$value."'";
                break;
            case 'INTEGER' :
            case 'INT' :
                $value = (int)$value;
        }
        $pos = strpos($sql, '?');
        $sql = substr($sql, 0, $pos) . $value . substr($sql, $pos + 1);
        return $sql;
    }
}