<?php
/**
 * Created by PhpStorm.
 * User: Jormin
 * Date: 2018/10/19
 * Time: 上午9:50
 */

namespace app\Services;


class EmailService extends BaseService
{

    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    private $from;

    public static $templates = [
        [
            'title' => '注册邮箱激活',
            'body' => '感谢您注册留言板，请<a href="{$link}">点击链接</a> 激活您的邮箱，或拷贝下方链接粘贴到新的浏览器标签打开<br><br>{$link}'
        ]
    ];

    public function initialization(&$context)
    {
        parent::initialization($context);
        $emailConfig = $this->getParam('email');
        $transport = (new \Swift_SmtpTransport($emailConfig['host'], $emailConfig['port'], 'ssl'))
            ->setUsername($emailConfig['username'])
            ->setPassword($emailConfig['password'])
        ;
        $this->mailer = new \Swift_Mailer($transport);
        $this->from = $emailConfig['from'];
    }


    /**
     * 发送邮件
     * @param $type
     * @param $to
     * @param $extData
     * @return array
     */
    public function sendEmail($type, $to, $extData){
        $return = ['code' => 0, 'message' => '请求超时'];
        $template = self::$templates[$type];
        if(!isset($template)){
            $return['message'] = '模板错误';
            return $return;
        }
        foreach ($extData as $key => $value){
            $key = '{$'.$key.'}';
            $template['title'] = str_replace($key, $value, $template['title']);
            $template['body'] = str_replace($key, $value, $template['body']);
        }
        $message = (new \Swift_Message($template['title']))
            ->setFrom([$this->from])
            ->setTo([$to])
            ->setBody($template['body'], 'text/html')
        ;
        $result = $this->mailer->send($message);
        if(!$result){
            $return['message'] = '发送邮件失败';
            return $return;
        }
        $return = ['code' => 1, 'message' => '发送邮件成功'];
        return $return;
    }

}