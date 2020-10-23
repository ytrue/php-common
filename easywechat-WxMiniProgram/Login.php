<?php

namespace app\api\controller\client;

use EasyWeChat\Factory;
use EasyWeChat\Kernel\Exceptions\Exception;

class Login
{

    /**
     * wechat login
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     */
    public function wxlogin()
    {
        $conf = [
			'app_id' => '',
			'secret' => '',
			// 下面为可选项
			// 指定 API 调用返回结果的类型：array(default)/collection/object/raw/自定义类名
			'response_type' => 'array',
			'log' => [
				'level' => 'debug',
				'file' => __DIR__ . '/wechat.log',
			]
		];

        $app = Factory::miniProgram($conf);

        $code = input('code');

        $session = $app->auth->session($code);

        if (isset($session['errcode']))
            $this->error('无效code！', '', 2);

        $encryptedData = input('encryptedData');
        $iv = input('iv');

        try {
            $userInfo = $app->encryptor->decryptData($session['session_key'], $iv, $encryptedData);
            //业务逻辑....
		   
		    return 'ok！'
        } catch (Exception $exception) {
            return '无效数据！'
        }
    }
}