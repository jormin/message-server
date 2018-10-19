<?php
/**
 * Created by PhpStorm.
 * User: Jormin
 * Date: 2018/10/17
 * Time: 上午1:14
 */

namespace app\Controllers\Api\Backend;


class AccountController extends TokenController
{

    /**
     * 获取管理员信息
     * @return null
     */
    public function actionInfo(){
        if(!$this->beforeAction()){
            return null;
        }
        $data = array(
            'roles' => ['admin'],
            'token' => $this->token,
            'introduction' => '超级管理员',
            'avatar' => 'http://img5.imgtn.bdimg.com/it/u=504109330,973544959&fm=26&gp=0.jpg',
            'name' => $this->admin['username']
        );
        $this->success('获取成功', $data);
    }
}