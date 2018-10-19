<?php
/**
 * Created by PhpStorm.
 * User: Jormin
 * Date: 2018/10/16
 * Time: 下午3:14
 */

namespace app\Services;


use Jormin\Aliyun\Sms;

class SMSService extends BaseService
{

    /**
     * 发送短信
     * @param $type
     * @param $phone
     * @param $extData
     * @return array
     */
    public function sendSms($type, $phone, $extData){
        $return = ['code' => 0, 'message' => '请求超时'];
        $smsConfig = $this->getParam('aliyun')['sms'];
        $sms = new Sms($smsConfig['accessKeyID'], $smsConfig['accessKeySecret']);
        $templateCodes = ['registerCode'];
        $response = $sms->sendSms($phone,$smsConfig['signature'], $smsConfig[$templateCodes[$type]], $extData);
        if(!$response['success']){
            $return['message'] = '发送短信失败';
            return $return;
        }
        $return = ['code' => 1, 'message' => '发送短信成功'];
        return $return;
    }

}