<?php

class Pay{
	
	/*
	 *@par
	*/
	public function pay(){
		
		$config = [
			'app_id' => '',
			'mch_id' => '',
			'key' => '',
			// 如需使用敏感接口（如退款、发送红包等）需要配置 API 证书路径(登录商户平台下载 API 证书)
			'cert_path' => '',
			// XXX: 绝对路径！！！！
			'key_path' => '',
			'notify_url' => '回调地址',
		]
		
		$app = Factory::payment($config);
		
		 $order_info = [
                    'body' => '微信小程序支付',
                    'out_trade_no' => '订单号',
                    'openid' => '微信用户的openid',
                    'total_fee' => (int)((金额 + 0.00001) * 100), //一定经过这样的转化，不然支付不成功
                    'trade_type' => 'JSAPI', // 交易类型 JSAPI | NATIVE |APP | WAP*/
                ];
        
		$result = $app->order->unify($order_info);
		
		if ($result['result_code'] == 'FALL') {
			return '提交失败！';
		}

		$data = $app->jssdk->sdkConfig($result['prepay_id']); // 返回数组
		
		return $data;
	} 
	
}