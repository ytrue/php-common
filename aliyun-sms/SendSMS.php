<?php

class SendSMS
{
    /**
     * 发送短信
     *
     * @param $mobile
     * @param $tt
     *
     * @return bool|\stdClass
     */
    public static function sendSMS($mobile, $tt)
    {

        $params = [];

        $conf = \config('aliyunsms');

        // fixme 必填: 请参阅 https://ak-console.aliyun.com/ 取得您的AK信息
        $accessKeyId = $conf['accessKeyId'];
        $accessKeySecret = $conf['accessKeySecret'];
        // fixme 必填: 短信接收号码
        $params["PhoneNumbers"] = $mobile;

        $params["SignName"] = $conf['SignName'];
        // fixme 必填: 短信模板Code，应严格按"模板CODE"填写, 请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/template
        $params["TemplateCode"] = $conf['TemplateCode'];

        // fixme 可选: 设置模板参数, 假如模板中存在变量需要替换则为必填项
        $params['TemplateParam'] = [

            "code" => $tt,

        ];

        // fixme 可选: 设置发送短信流水号
        $params['OutId'] = "12345";

        // fixme 可选: 上行短信扩展码, 扩展码字段控制在7位或以下，无特殊需求用户请忽略此字段
        $params['SmsUpExtendCode'] = "1234567";

        // *** 需用户填写部分结束, 以下代码若无必要无需更改 ***
        if (!empty($params["TemplateParam"])
            && is_array(
                $params["TemplateParam"]
            )
        ) {
            $params["TemplateParam"] = json_encode(
                $params["TemplateParam"],
                JSON_UNESCAPED_UNICODE
            );
        }

        // 初始化SignatureHelper实例用于设置参数，签名以及发送请求
        $helper = new SignatureHelper();

        // 此处可能会抛出异常，注意catch
        $content = $helper->request(
            $accessKeyId,
            $accessKeySecret,
            "dysmsapi.aliyuncs.com",
            array_merge(
                $params,
                [
                    "RegionId" => "cn-hangzhou",
                    "Action" => "SendSms",
                    "Version" => "2017-05-25",
                ]
            )
        );

        return $content;
    }
}