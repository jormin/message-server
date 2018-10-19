<?php
/**
 * Created by PhpStorm.
 * User: Jormin
 * Date: 2018/10/12
 * Time: 下午5:50
 */

namespace app\Controllers\Api\Backend;

use app\Services\MessageService;

class MessageController extends TokenController
{

    /**
     * @var MessageService
     */
    protected $messageService;

    protected function initialization($controller_name, $method_name)
    {
        yield parent::initialization($controller_name, $method_name);
        $this->messageService = $this->loader->service('MessageService', $this);
    }

    /**
     * 获取留言列表
     * @return null
     */
    public function actionIndex(){
        if(!$this->beforeAction()){
            return null;
        }
        $params = $this->get();
        $args = ['name', 'gender', 'phone', 'email', 'title'];
        foreach ($args as $key => $arg){
            $value = !empty($params[$arg]) ? $params[$arg] : null;
            if(is_null($value)){
                unset($args[$key]);
            }
        }
        $query = $this->validate('get', $args);
        if($query === false){
            return null;
        }
        $page = $this->get('page') ?? 0;
        $return = yield $this->messageService->searchMessages($query, $page);
        $this->autoReturn($return);
    }

    /**
     * 获取详情
     */
    public function actionDetail(){
        if(!$this->beforeAction()){
            return null;
        }
        $data = $this->validate('get', ['id']);
        if($data === false){
            return null;
        }
        $return = yield $this->messageService->getMessageDetail($data['id']);
        $this->autoReturn($return);
    }

    /**
     * 删除留言
     */
    public function actionDelete(){
        if(!$this->beforeAction()){
            return null;
        }
        $data = $this->validate('get', ['id']);
        if($data === false){
            return null;
        }
        $return = yield $this->messageService->deleteMessage($data['id']);
        $this->autoReturn($return);
    }

    /**
     * 获取留言列表
     * @return null
     */
    public function actionComments(){
        if(!$this->beforeAction()){
            return null;
        }
        $data = $this->validate('get', ['id']);
        if($data === false){
            return null;
        }
        $page = $this->get('page') ?? 0;
        $return = yield $this->messageService->getMessageComments($data['id'], $page);
        $this->autoReturn($return);
    }

    /**
     * 删除留言
     */
    public function actionDeleteComment(){
        if(!$this->beforeAction()){
            return null;
        }
        $data = $this->validate('get', ['id']);
        if($data === false){
            return null;
        }
        $return = yield $this->messageService->deleteMessage($data['id']);
        $this->autoReturn($return);
    }

}