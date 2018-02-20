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
 * @property array config
 */
class Pay implements PayBase {
    private $config;
    private $payRequestBuilder = null;
    function __construct($config)
    {
        $this->config = $config;
        $this->payRequestBuilder = new AlipayTradeWapPayContentBuilder();
    }

    /**
     * @use 用途 设置支付参数
     * @author 鲁强
     * @param string $subject
     * @param string $total_amount
     * @param string $body
     * @param string $timeout_express
     * @return $this
     */
    function setParam($subject="test",$total_amount =  "0.01",$body= "购买测试商品0.01元",$timeout_express = "1m",$out_trade_no=null){

        //商户订单号，商户网站订单系统中唯一订单号，必填
        if($out_trade_no == null)
        $out_trade_no = date("YmdHis").rand(100,999);

        //订单名称，必填
//        $subject = "test";

        //付款金额，必填
//        $total_amount = "0.01";

        //商品描述，可空
//        $body = "购买测试商品0.01元";

        //超时时间
//        $timeout_express="1m";


        $this->payRequestBuilder->setBody($body);
        $this->payRequestBuilder->setSubject($subject);
        $this->payRequestBuilder->setOutTradeNo($out_trade_no);
        $this->payRequestBuilder->setTotalAmount($total_amount);
        $this->payRequestBuilder->setTimeExpress($timeout_express);
        return $this;
    }

    /**
     * @use 用途 进行支付
     * @author 鲁强
     */
    function toPay(){
        $config = $this->config;
        $this->payResponse = new AlipayTradeService($config);
        return $this->payResponse ->wapPay($this->payRequestBuilder,$config['return_url'],$config['notify_url']);
    }


    /**
     * @use 用途
     * @author 鲁强
     * @return array|bool
     */
    function returnUrl(){
        $arr = $_GET;
        $alipaySevice = new AlipayTradeService($this->config);
        $result = $alipaySevice->check($arr);

        if($result) {//验证成功
            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            //请在这里加上商户的业务逻辑程序代码
            //——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
            //获取支付宝的通知返回参数，可参考技术文档中页面跳转同步通知参数列表
            //商户订单号
            $out_trade_no = htmlspecialchars($_GET['out_trade_no']);
            //支付宝交易号
            $trade_no = htmlspecialchars($_GET['trade_no']);
            return [
                'out_trade_no'=>$out_trade_no,//商户订单号
                'trade_no'=>$trade_no,//支付宝交易号
            ];
        }else{
            return false;
        }
    }

    /**
     * @use 用途 检测是否完成支付 $_POST['trade_status'] == 'TRADE_SUCCESS'
     * @author 鲁强
     * @return array|bool
     */
    function checkSyncPay(){


        $arr = $_POST;
        $alipaySevice = new AlipayTradeService($this->config);
        $alipaySevice->writeLog(var_export($arr,true));
        $result = $alipaySevice->check($arr);

        /* 实际验证过程建议商户添加以下校验。
        1、商户需要验证该通知数据中的out_trade_no是否为商户系统中创建的订单号，
        2、判断total_amount是否确实为该订单的实际金额（即商户订单创建时的金额），
        3、校验通知中的seller_id（或者seller_email) 是否为out_trade_no这笔单据的对应的操作方（有的时候，一个商户可能有多个seller_id/seller_email）
        4、验证app_id是否为该商户本身。
        */
        if($result) {//验证成功
            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            //请在这里加上商户的业务逻辑程序代


            //——请根据您的业务逻辑来编写程序（以下代码仅作参考）——

            //获取支付宝的通知返回参数，可参考技术文档中服务器异步通知参数列表

            //商户订单号

//            $out_trade_no = $_POST['out_trade_no'];

            //支付宝交易号

//            $trade_no = $_POST['trade_no'];

            //交易状态
//            $trade_status = $_POST['trade_status'];



//            if($_POST['trade_status'] == 'TRADE_FINISHED') {

                //判断该笔订单是否在商户网站中已经做过处理
                //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
                //请务必判断请求时的total_amount与通知时获取的total_fee为一致的
                //如果有做过处理，不执行商户的业务程序

                //注意：
                //退款日期超过可退款期限后（如三个月可退款），支付宝系统发送该交易状态通知
//            }
//            else if ($_POST['trade_status'] == 'TRADE_SUCCESS') {
                //判断该笔订单是否在商户网站中已经做过处理
                //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
                //请务必判断请求时的total_amount与通知时获取的total_fee为一致的
                //如果有做过处理，不执行商户的业务程序
                //注意：
                //付款完成后，支付宝系统发送该交易状态通知
//            }
            //——请根据您的业务逻辑来编写程序（以上代码仅作参考）——

            return $arr;		//请不要修改或删除

        }else {
            //验证失败
            return false;	//请不要修改或删除

        }
    }
}

