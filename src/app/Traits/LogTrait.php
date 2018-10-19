<?php
/**
 * Created by PhpStorm.
 * User: Jormin
 * Date: 2018/10/18
 * Time: 下午3:37
 */

namespace app\Traits;


trait LogTrait
{
    /**
     * 打印消息日志
     *
     * @param $msg
     */
    function stdout($msg=null){
        $msg = '['.date('Y-m-d H:i:s').']'.$msg.chr(10);;
        fwrite(STDOUT, $msg);
    }
}