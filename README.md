"# pay"  
## install 
    composer require julong/pay  
## use   

    $config = [  
      //应用ID,您的APPID。
      'app_id' => "2018011301825418",  
  
      //商户私钥，您的原始格式RSA私钥  
      'merchant_private_key' => file_get_contents("/data/JULONG/JLSERVER/config/key/app_private_key.pem"),  
  
      //异步通知地址  
      'notify_url' => "http://工程公网访问地址/XXX/notify_url.php",  
  
      //同步跳转  
      'return_url' => "",  
  
      //编码格式  
      'charset' => "UTF-8",  
  
      //签名方式  
      'sign_type'=>"RSA2",  

      //支付宝网关  
      'gatewayUrl' => "https://openapi.alipay.com/gateway.do",   
 
      //支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。  
      'alipay_public_key' => file_get_contents("/data/JULONG/JLSERVER/config/key/zfb_public_key.pem"),  
    ];   
  //setParam($subject="test",$total_amount = "0.01",$body= "购买测试商品0.01元",$timeout_express = "1m")   
  
    $alipay = new pay($config); 
    $content = $alipay->setParam()->toPay();   
    echo $content;   
 
## 同步跳转    
### 用法   
    $alipay = new pay($config);    
    $res = $alipay->returnUrl();   
### 返回   
      return [
          'out_trade_no'=>'',//商户订单号
          'trade_no'=>'',//支付宝交易号
          ];

## 异步验证    
### 用法   
    $alipay = new pay($config);    
    $res = $alipay->checkSyncPay();   
    
### 返回     
     return [  
          'out_trade_no'=>'',//商户订单号  
          'trade_no'=>'',//支付宝交易号  
          'trade_status'=>'',//交易状态  
        ];    
# 微信   
## 用法  
    $payModel = Pay::wechat()
                         ->setParam(
                          100,
                          date('YmdHis')
                         )->toPay();
     echo ($payModel);
    /**
     * function setParam
     * @param string $total_fee 总金额（元）
     * @param string $out_trade_no 订单号
     * @param string $body 标题如 武汉光谷-周黑鸭
     * @param string $redirectUrl 支付完成同步跳转路径
     * @param string $timeout_express 订单过期时间如201802202359
     * @param string $fee_type 默认CNY
     * @param string $attach 附加数据如 武汉光谷分店
     * @param string $trade_type 默认MWEB
     * @param string $detail  订单详情默认空
     * @param string $device_info 设备号默认空
     * @return $this
     */
     