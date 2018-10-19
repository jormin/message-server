<?php
/**
 * Created by PhpStorm.
 * User: Jormin
 * Date: 2018/10/16
 * Time: 下午12:54
 */

namespace app\Services;

use Jormin\Qiniu\Qiniu;

class UploadService extends BaseService
{

    /**
     * 获取上传Token
     * @return null
     */
    public function getToken()
    {
        $qiniuConfig = $this->getParam('qiniu');
        $qiniu = new Qiniu($qiniuConfig['accessKey'], $qiniuConfig['secretKey']);
        $response = $qiniu->uploadToken($qiniuConfig['bucket']);
        if($response['error']){
            return null;
        }
        $data = [
            'domain' => $qiniuConfig['domain'],
            'token' => $response['data']
        ];
        return $data;
    }

}