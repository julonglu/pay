<?php
/* *
 * 功能：支付宝手机网站支付接口(alipay.trade.wap.pay)接口调试入口页面
 * 版本：2.0
 * 修改日期：2016-11-01
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
 请确保项目文件有可写权限，不然打印不了日志。
 */
namespace Julong\Pay\Alipay;
use Julong\Pay\Alipay\Libs\Buildermodel\AlipayTradeWapPayContentBuilder;
use Julong\Pay\Alipay\Libs\Service\AlipayTradeService;
use Julong\Pay\PayBase;

/**
 * @property AlipayTradeWapPayContentBuilder payRequestBuilder
 * @property AlipayTradeService payResponse
 */
class Pay implements PayBase {
    private $config;
    function __construct($config)
    {
        $this->config = $config;
    }

    function setParam($subject="test",$total_amount =  "0.01",$body= "购买测试商品0.01元",$timeout_express = "1m"){

        //商户订单号，商户网站订单系统中唯一订单号，必填
        $out_trade_no = date("YmdHis").rand(100,999);

        //订单名称，必填
//        $subject = "test";

        //付款金额，必填
//        $total_amount = "0.01";

        //商品描述，可空
//        $body = "购买测试商品0.01元";

        //超时时间
//        $timeout_express="1m";

        $this->payRequestBuilder = new AlipayTradeWapPayContentBuilder();
        $this->payRequestBuilder->setBody($body);
        $this->payRequestBuilder->setSubject($subject);
        $this->payRequestBuilder->setOutTradeNo($out_trade_no);
        $this->payRequestBuilder->setTotalAmount($total_amount);
        $this->payRequestBuilder->setTimeExpress($timeout_express);
        return $this;
    }
    function toPay(){
        $config = $this->config;
        $this->payResponse = new AlipayTradeService($config);
        $this->payResponse ->wapPay($this->payRequestBuilder,$config['return_url'],$config['notify_url']);
    }
}

