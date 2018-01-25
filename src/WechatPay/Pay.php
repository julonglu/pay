<?php
/* *
 * 功能：支付宝手机网站支付接口(alipay.trade.wap.pay)接口调试入口页面
 * 版本：2.0
 * 修改日期：2016-11-01
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
 请确保项目文件有可写权限，不然打印不了日志。
 */
namespace Julong\Pay\WechatPay;
use Julong\Pay\Alipay\Libs\Buildermodel\AlipayTradeWapPayContentBuilder;
use Julong\Pay\Alipay\Libs\Service\AlipayTradeService;
use Julong\Pay\PayBase;

class Pay implements PayBase {
    private $config;
    function __construct($config)
    {
        $this->config = $config;
    }

    function setParam($subject="test",$total_amount =  "0.01",$body= "购买测试商品0.01元",$timeout_express = "1m"){
        return '暂无信息';
    }
    function toPay(){

    }

}

