<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/20
 * Time: 9:40
 */
namespace Julong\Pay\WechatPay\Libs;
class WechatSdk
{
    private $api = 'https://api.mch.weixin.qq.com/pay/unifiedorder';
    private $appid = ''; //公众账号ID
    private $mch_id = ''; //商户号
    private $device_info = '';//设备号
    private $nonce_str = '';//随机字符串
    private $sign = '';//签名
    private $sign_type = '';//签名类型
    private $body = '';//商品描述
    private $detail = '';//商品详情
    private $attach = '';//附加数据
    private $out_trade_no = '';//商户订单号
    private $fee_type = '';//标价币种
    private $total_fee = '';//标价金额
    private $spbill_create_ip = '';//终端IP
    private $time_start = '';//交易起始时间
    private $time_expire = '';//交易结束时间
    private $goods_tag = '';//订单优惠标记
    private $notify_url = '';//通知地址
    private $trade_type = '';//交易类型
    private $product_id = '';//商品ID
    private $limit_pay = '';//指定支付方式
    private $openid = '';//用户标识
    private $scene_info = '';//场景信息
    private $redirect_url = '';

    /**
     * @author luqiang<345340585@qq.com>
     * WechatSdk constructor.
     * @param string $appid
     * @param string $mch_id
     * @param string $notify_url
     */
    public function __construct($appid, $mch_id, $notify_url)
    {
        $this->appid = $appid;
        $this->mch_id = $mch_id;
        $this->notify_url = $notify_url;
    }


    /**
     * @author luqiang<345340585@qq.com>
     * @return string
     */
    public function getApi()
    {
        return $this->api;
    }

    /**
     * @author luqiang<345340585@qq.com>
     * @param string $api
     */
    public function setApi($api)
    {
        $this->api = $api;
    }

    /**
     * @author luqiang<345340585@qq.com>
     * @return string
     */
    public function getAppid()
    {
        return $this->appid;
    }

    /**
     * @author luqiang<345340585@qq.com>
     * @param string $appid
     */
    public function setAppid($appid)
    {
        $this->appid = $appid;
    }

    /**
     * @author luqiang<345340585@qq.com>
     * @return string
     */
    public function getMchId()
    {
        return $this->mch_id;
    }

    /**
     * @author luqiang<345340585@qq.com>
     * @param string $mch_id
     */
    public function setMchId($mch_id)
    {
        $this->mch_id = $mch_id;
    }

    /**
     * @author luqiang<345340585@qq.com>
     * @return string
     */
    public function getDeviceInfo()
    {
        return $this->device_info;
    }

    /**
     * @author luqiang<345340585@qq.com>
     * @param string $device_info
     */
    public function setDeviceInfo($device_info)
    {
        $this->device_info = $device_info;
    }

    /**
     * @author luqiang<345340585@qq.com>
     * @return string
     */
    public function getNonceStr()
    {
        return $this->nonce_str;
    }

    /**
     * @author luqiang<345340585@qq.com>
     * @param string $nonce_str
     */
    public function setNonceStr($nonce_str)
    {
        $this->nonce_str = $nonce_str;
    }

    /**
     * @author luqiang<345340585@qq.com>
     * @return string
     */
    public function getSign()
    {
        return $this->sign;
    }

    /**
     * @author luqiang<345340585@qq.com>
     * @param string $sign
     */
    public function setSign($sign)
    {
        $this->sign = $sign;
    }

    /**
     * @author luqiang<345340585@qq.com>
     * @return string
     */
    public function getSignType()
    {
        return $this->sign_type;
    }

    /**
     * @author luqiang<345340585@qq.com>
     * @param string $sign_type
     */
    public function setSignType($sign_type)
    {
        $this->sign_type = $sign_type;
    }

    /**
     * @author luqiang<345340585@qq.com>
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @author luqiang<345340585@qq.com>
     * @param string $body
     */
    public function setBody($body)
    {
        $this->body = $body;
    }

    /**
     * @author luqiang<345340585@qq.com>
     * @return string
     */
    public function getDetail()
    {
        return $this->detail;
    }

    /**
     * @author luqiang<345340585@qq.com>
     * @param string $detail
     */
    public function setDetail($detail)
    {
        $this->detail = $detail;
    }

    /**
     * @author luqiang<345340585@qq.com>
     * @return string
     */
    public function getAttach()
    {
        return $this->attach;
    }

    /**
     * @author luqiang<345340585@qq.com>
     * @param string $attach
     */
    public function setAttach($attach)
    {
        $this->attach = $attach;
    }

    /**
     * @author luqiang<345340585@qq.com>
     * @return string
     */
    public function getOutTradeNo()
    {
        return $this->out_trade_no;
    }

    /**
     * @author luqiang<345340585@qq.com>
     * @param string $out_trade_no
     */
    public function setOutTradeNo($out_trade_no)
    {
        $this->out_trade_no = $out_trade_no;
    }

    /**
     * @author luqiang<345340585@qq.com>
     * @return string
     */
    public function getFeeType()
    {
        return $this->fee_type;
    }

    /**
     * @author luqiang<345340585@qq.com>
     * @param string $fee_type
     */
    public function setFeeType($fee_type)
    {
        $this->fee_type = $fee_type;
    }

    /**
     * @author luqiang<345340585@qq.com>
     * @return string
     */
    public function getTotalFee()
    {
        return $this->total_fee;
    }

    /**
     * @author luqiang<345340585@qq.com>
     * @param string $total_fee
     */
    public function setTotalFee($total_fee)
    {
        $this->total_fee = $total_fee;
    }

    /**
     * @author luqiang<345340585@qq.com>
     * @return string
     */
    public function getSpbillCreateIp()
    {
        return $this->spbill_create_ip;
    }

    /**
     * @author luqiang<345340585@qq.com>
     * @param string $spbill_create_ip
     */
    public function setSpbillCreateIp($spbill_create_ip)
    {
        $this->spbill_create_ip = $spbill_create_ip;
    }

    /**
     * @author luqiang<345340585@qq.com>
     * @return string
     */
    public function getTimeStart()
    {
        return $this->time_start;
    }

    /**
     * @author luqiang<345340585@qq.com>
     * @param string $time_start
     */
    public function setTimeStart($time_start)
    {
        $this->time_start = $time_start;
    }

    /**
     * @author luqiang<345340585@qq.com>
     * @return string
     */
    public function getTimeExpire()
    {
        return $this->time_expire;
    }

    /**
     * @author luqiang<345340585@qq.com>
     * @param string $time_expire
     */
    public function setTimeExpire($time_expire)
    {
        $this->time_expire = $time_expire;
    }

    /**
     * @author luqiang<345340585@qq.com>
     * @return string
     */
    public function getGoodsTag()
    {
        return $this->goods_tag;
    }

    /**
     * @author luqiang<345340585@qq.com>
     * @param string $goods_tag
     */
    public function setGoodsTag($goods_tag)
    {
        $this->goods_tag = $goods_tag;
    }

    /**
     * @author luqiang<345340585@qq.com>
     * @return string
     */
    public function getNotifyUrl()
    {
        return $this->notify_url;
    }

    /**
     * @author luqiang<345340585@qq.com>
     * @param string $notify_url
     */
    public function setNotifyUrl($notify_url)
    {
        $this->notify_url = $notify_url;
    }

    /**
     * @author luqiang<345340585@qq.com>
     * @return string
     */
    public function getTradeType()
    {
        return $this->trade_type;
    }

    /**
     * @author luqiang<345340585@qq.com>
     * @param string $trade_type
     */
    public function setTradeType($trade_type)
    {
        $this->trade_type = $trade_type;
    }

    /**
     * @author luqiang<345340585@qq.com>
     * @return string
     */
    public function getProductId()
    {
        return $this->product_id;
    }

    /**
     * @author luqiang<345340585@qq.com>
     * @param string $product_id
     */
    public function setProductId($product_id)
    {
        $this->product_id = $product_id;
    }

    /**
     * @author luqiang<345340585@qq.com>
     * @return string
     */
    public function getLimitPay()
    {
        return $this->limit_pay;
    }

    /**
     * @author luqiang<345340585@qq.com>
     * @param string $limit_pay
     */
    public function setLimitPay($limit_pay)
    {
        $this->limit_pay = $limit_pay;
    }

    /**
     * @author luqiang<345340585@qq.com>
     * @return string
     */
    public function getOpenid()
    {
        return $this->openid;
    }

    /**
     * @author luqiang<345340585@qq.com>
     * @param string $openid
     */
    public function setOpenid($openid)
    {
        $this->openid = $openid;
    }

    /**
     * @author luqiang<345340585@qq.com>
     * @return string
     */
    public function getSceneInfo()
    {
        return $this->scene_info;
    }

    /**
     * @author luqiang<345340585@qq.com>
     * @param string $scene_info
     */
    public function setSceneInfo($scene_info)
    {
        $this->scene_info = $scene_info;
    }

    /**
     * @author luqiang<345340585@qq.com>
     * @return string
     */
    public function getRedirectUrl()
    {
        return $this->redirect_url;
    }

    /**
     * @author luqiang<345340585@qq.com>
     * @param string $redirect_url
     */
    public function setRedirectUrl($redirect_url)
    {
        $this->redirect_url = $redirect_url;
    }//支付成功跳转


}