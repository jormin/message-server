<?php
/**
 * Created by PhpStorm.
 * User: Jormin
 * Date: 2018/10/16
 * Time: 下午12:53
 */

namespace app\Controllers\Api\Frontend;


use app\Controllers\Api\BaseController;
use app\Services\UploadService;

class UploadController extends BaseController
{

    /**
     * @var UploadService
     */
    protected $uploadService;

    protected function initialization($controller_name, $method_name)
    {
        parent::initialization($controller_name, $method_name);
        $this->uploadService = $this->loader->service('UploadService', $this);
    }

    /**
     * 获取上传七牛Token
     * @return null
     */
    public function actionToken(){
        $return = $this->uploadService->getToken();
        $this->success('获取成功', $return);
    }

}