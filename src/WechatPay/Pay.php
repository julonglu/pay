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
use Julong\Pay\Helper;
use Julong\Pay\PayBase;
use Julong\Pay\WechatPay\Libs\WechatOrder;
use Julong\Pay\WechatPay\Libs\WechatSdk;

/**
 * Class Pay
 * @package Julong\Pay\WechatPay
 * @property array config
 * @property WechatSdk wechat_pay
 */
class Pay implements PayBase {
    private $config;
    private $wechat_pay = null;
    function __construct($config)
    {
        $this->wechat_pay = new WechatSdk($config['appid'],$config['mch_id']);
        $this->config = $config;
    }

    /**
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
    function setParam($total_fee='',$out_trade_no='',$body= "武汉光谷-周黑鸭",$redirectUrl='',$timeout_express = '',$fee_type='CNY',$attach='武汉光谷分店',$trade_type='MWEB',$device_info='',$detail=''){
        $nonce_str = substr(md5(rand(10000,99999)),8,16);
        if(empty($timeout_express)) $timeout_express = date('YmdHis',time()+2*3600);
        $this->wechat_pay->setBody($body);
        $this->wechat_pay->setDeviceInfo($device_info);
        $this->wechat_pay->setNonceStr($nonce_str);
        $this->wechat_pay->setDetail($detail);
        $this->wechat_pay->setAttach($attach);
        $this->wechat_pay->setFeeType($fee_type);
        $this->wechat_pay->setTotalFee(intval(floatval($total_fee)*100));
        $this->wechat_pay->setSpbillCreateIp(Helper::get_client_ip());
        $this->wechat_pay->setTimeStart(date('YmdHis'));
        $this->wechat_pay->setTimeExpire($timeout_express);
        $this->wechat_pay->setTradeType($trade_type);
        $this->wechat_pay->setOutTradeNo($out_trade_no);
        $this->wechat_pay->setSign($this->config['key']);
        $this->wechat_pay->setNotifyUrl($this->config['notify_url']);
        $this->wechat_pay->setRedirectUrl($redirectUrl);
        return $this;
    }
    function toPay(){
        $WechatOrder = new WechatOrder($this->wechat_pay);
        return $WechatOrder->PayUrl();
    }
}

