<?php
/**
 * Created by PhpStorm.
 * User: Jormin
 * Date: 2018/10/18
 * Time: 下午2:25
 */

namespace app\Jobs;

use app\Services\SMSService;

class SMSJob extends BaseJob
{

    public $args;

    private $type;

    private $phone;

    private $data;

    /**
     * @var SMSService
     */
    private $smsService;

    public function __construct()
    {
        $this->smsService = new SMSService();
        $this->type = $this->args['type'];
        $this->phone = $this->args['phone'];
        $this->data = $this->args['data'];
    }

    /**
     * 预处理
     */
    public function setUp(){
        $this->stdout('短信类型:'.$this->type);
        $this->stdout('手机号:'.$this->phone);
        $this->stdout('数据:'.json_encode($this->data));
    }

    /**
     * 具体任务
     */
    public function perform(){
        $response = $this->smsService->sendSms($this->type, $this->phone, $this->data);
        $this->stdout('发送结果:'.json_encode($response));
    }

    /**
     * 后续处理
     */
    public function tearDown(){
        $this->stdout('任务执行完毕');
        $this->stdout();
    }

}