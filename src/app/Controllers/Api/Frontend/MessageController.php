<?php
/**
 * Created by PhpStorm.
 * User: Jormin
 * Date: 2018/10/12
 * Time: 下午5:50
 */

namespace app\Controllers\Api\Frontend;

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
     * 获取公共留言
     * @return null
     */
    public function actionCommonMessages(){
        if(!$this->beforeAction()){
            return null;
        }
        $page = $this->get('page') ?? 0;
        $return = yield $this->messageService->getCommonMessages($page);
        $this->autoReturn($return);
    }

    /**
     * 获取指定用户发送的留言
     * @return null
     */
    public function actionSenderMessages(){
        if(!$this->beforeAction()){
            return null;
        }
        $page = $this->get('page') ?? 0;
        $return = yield $this->messageService->getSenderMessages($this->userID, $page);
        $this->autoReturn($return);
    }

    /**
     * 获取指定用户接收的留言
     * @return null
     */
    public function actionReceiverMessages(){
        if(!$this->beforeAction()){
            return null;
        }
        $page = $this->get('page') ?? 0;
        $return = yield $this->messageService->getReceiverMessages($this->userID, $page);
        $this->autoReturn($return);
    }

    /**
     * 发送留言
     * @return null
     */
    public function actionSend(){
        if(!$this->beforeAction()){
            return null;
        }
        $data = $this->validate('post', ['title', 'content']);
        if($data === false){
            return null;
        }
        $data['receiverID'] = $this->post('receiverID');
        $data['path'] = $this->post('path');
        $return = yield $this->messageService->sendMessage($this->userID, $data['receiverID'], $data['title'], $data['content'], $data['path']);
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
     * 发送评论
     * @return null
     */
    public function actionSendComment(){
        if(!$this->beforeAction()){
            return null;
        }
        $data = $this->validate('post', ['comment', 'id']);
        if($data === false){
            return null;
        }
        $return = yield $this->messageService->sendComment($this->userID, $data['id'], $data['comment']);
        $this->autoReturn($return);
    }

    /**
     * 获取指定留言的评论
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

}