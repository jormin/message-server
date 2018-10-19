<?php
/**
 * Created by PhpStorm.
 * User: Jormin
 * Date: 2018/10/16
 * Time: 下午2:18
 */

namespace app\Services;


use app\Models\AttachmentModel;
use app\Models\MessageAttachmentModel;
use app\Models\MessageCommentModel;
use app\Models\MessageModel;
use app\Models\UserModel;

class MessageService extends BaseService
{

    /**
     * @var UserModel
     */
    private $userModel;

    /**
     * @var AttachmentModel
     */
    private $attachmentModel;

    /**
     * @var MessageModel
     */
    private $messageModel;

    /**
     * @var MessageAttachmentModel
     */
    private $messageAttachmentModel;

    /**
     * @var MessageCommentModel
     */
    private $messageCommentModel;

    public function initialization(&$context)
    {
        parent::initialization($context);
        $this->userModel = $this->loader->model('UserModel', $this);
        $this->attachmentModel = $this->loader->model('AttachmentModel', $this);
        $this->messageModel = $this->loader->model('MessageModel', $this);
        $this->messageAttachmentModel = $this->loader->model('MessageAttachmentModel', $this);
        $this->messageCommentModel = $this->loader->model('MessageCommentModel', $this);
    }

    /**
     * 发送留言
     * @param $userID
     * @param $receiverID
     * @param $title
     * @param $content
     * @param $path
     * @return array|\Generator
     */
    public function sendMessage($userID, $receiverID, $title, $content, $path){
        $return = ['code' => 0, 'message' => '请求超时'];
        if($receiverID){
            $receiver = $this->userModel->findByID(null, $receiverID);
            if(!$receiver){
                $return['message'] = '被留言人不存在';
                return $return;
            }
        }

        // TODO 此处应增加标题和内容敏感字过滤，时间原因暂时忽略

        $transactionID = yield $this->beginTransaction();

        $result = yield $this->messageModel->create($transactionID, $userID, $receiverID, $title, $content);
        if (!$result['insert_id']) {
            yield $this->rollbackTransaction($transactionID);
            $return['message'] = '记录留言失败';
            return $return;
        }
        $messageID = $result['insert_id'];
        if($path){
            $result = yield $this->attachmentModel->create($transactionID, $userID, $path);
            if (!$result['insert_id']) {
                yield $this->rollbackTransaction($transactionID);
                $return['message'] = '记录附件失败';
                return $return;
            }
            $attachmentID = $result['insert_id'];
            $result = yield $this->messageAttachmentModel->create($transactionID, $userID, $messageID, $attachmentID);
            if (!$result['insert_id']) {
                yield $this->rollbackTransaction($transactionID);
                $return['message'] = '记录留言附件失败';
                return $return;
            }
        }
        yield $this->commitTransaction($transactionID);
        $return = ['code' => 1, 'message' => '留言成功'];
        return $return;
    }

    /**
     * 搜索留言
     * @param $query
     * @param $page
     * @return array
     */
    public function searchMessages($query, $page){
        $data = yield $this->messageModel->searchMessages($query, $page, $this->defaultPageLimit);
        $return = ['code' => 1, 'message' => '获取成功', 'data' => $data];
        return $return;
    }

    /**
     * 获取公共留言
     * @param $page
     * @return array
     */
    public function getCommonMessages($page){
        $data = yield $this->messageModel->getCommonMessages($page, $this->defaultPageLimit);
        $return = ['code' => 1, 'message' => '获取成功', 'data' => $data];
        return $return;
    }

    /**
     * 获取指定用户发送的留言
     * @param $userID
     * @param $page
     * @return array
     */
    public function getSenderMessages($userID, $page){
        $data = yield $this->messageModel->getSenderMessages($userID, $page, $this->defaultPageLimit);
        $return = ['code' => 1, 'message' => '获取成功', 'data' => $data];
        return $return;
    }

    /**
     * 获取指定用户接收的留言
     * @param $receiverID
     * @param $page
     * @return array
     */
    public function getReceiverMessages($receiverID, $page){
        $data = yield $this->messageModel->getReceiverMessages($receiverID, $page, $this->defaultPageLimit);
        $return = ['code' => 1, 'message' => '获取成功', 'data' => $data];
        return $return;
    }

    /**
     * 获取消息详情
     * @param $id
     * @return array
     */
    public function getMessageDetail($id){
        $message = yield $this->messageModel->findByID($id);
        $return = ['code' => 1, 'message' => '获取成功', 'data' => ['message'=>$message]];
        return $return;
    }

    /**
     * 删除消息
     * @param $id
     * @return array
     */
    public function deleteMessage($id){
        $return = ['code' => 0, 'message' => '请求超时'];
        $result = yield $this->messageModel->deleteMessage($id);
        if($result['result'] !== true){
            $return['message'] = '删除消息失败';
            return $return;
        }
        $return = ['code' => 1, 'message' => '删除成功'];
        return $return;
    }

    /**
     * 发送评论
     * @param $userID
     * @param $messageID
     * @param $comment
     * @return array|\Generator
     */
    public function sendComment($userID, $messageID, $comment){
        $return = ['code' => 0, 'message' => '请求超时'];
        $message = $this->messageModel->findByID($messageID);
        if(!$message){
            $return['message'] = '留言不存在或已被删除';
            return $return;
        }

        // TODO 此处应增加评论内容敏感字过滤，时间原因暂时忽略

        $result = yield $this->messageCommentModel->create(null, $userID, $messageID, $comment);
        if (!$result['insert_id']) {
            $return['message'] = '记录评论失败';
            return $return;
        }
        $return = ['code' => 1, 'message' => '评论成功'];
        return $return;
    }

    /**
     * 获取指定留言的评论
     * @param $messageID
     * @param $page
     * @return array
     */
    public function getMessageComments($messageID, $page){
        $data = yield $this->messageCommentModel->getMessageComments($messageID, $page, $this->defaultPageLimit);
        $return = ['code' => 1, 'message' => '获取成功', 'data' => $data];
        return $return;
    }

}