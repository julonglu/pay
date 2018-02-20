<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/20
 * Time: 9:40
 */
namespace Julong\Pay\WechatPay\Libs;
use Julong\Pay\Helper;

class WechatOrder
{
    const API_URL_PREFIX= 'https://api.mch.weixin.qq.com';
    //统一下单
    const UNIFIEDORDER_URL = '/pay/unifiedorder';
    //查询订单URL
    const ORDERQUERY_URL = "/pay/orderquery";
    //关闭订单URL
    const CLOSEORDER_URL = "/pay/closeorder";
    private $param = null;
    public function __construct (WechatSdk $wechatSdk)
    {
        $this->param = $wechatSdk->__sys_param;

    }
    public function checkPay() {
        $xml = Helper::arrayToXml($this->param);
        $response = $this->postXmlCurl($xml,self::API_URL_PREFIX.self::ORDERQUERY_URL);
        if( !$response ){
            return false;
        }
        $result = Helper::xmlToArray( $response );
        if( !empty($result['result_code']) && !empty($result['err_code']) ){
            $result['err_msg'] = $this->error_code( $result['err_code'] );
        }
        if(!empty($result['total_fee']))$result['total_fee'] = $result['total_fee']/100;
        return $result;
    }
    public function PayUrl() {
        $xml = Helper::arrayToXml($this->param);
        $response = $this->postXmlCurl($xml,self::API_URL_PREFIX.self::UNIFIEDORDER_URL);
        if( !$response ){
            return false;
        }
        $result = Helper::xmlToArray( $response );
        if( !empty($result['result_code']) && !empty($result['err_code']) ){
            $result['err_msg'] = $this->error_code( $result['err_code'] );
        }
        if(!empty($result['err_msg']))
            $result = "<script>alert({$result['err_msg']});window.history.back(-1);</script>";
        elseif(!empty($result['mweb_url']))
            $result = "<script>window.location.href='{$result['mweb_url']}'</script>";
        elseif(!empty($result['return_msg']))
	    $result = "<script>alert('{$result['return_msg']}');window.history.back(-1);</script>";
	else
            $result = "<script>alert('暂时无法支付，请联系商家处理');window.history.back(-1);</script>";
        return $result;
    }

    /**
     * @param $xml
     * @param $url
     * @param bool $useCert
     * @param int $second
     * @return bool|mixed
     */
    private function postXmlCurl($xml, $url, $useCert = false, $second = 30){
        $ch = curl_init();
        //设置超时
        curl_setopt($ch, CURLOPT_TIMEOUT, $second);
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,FALSE);
        curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,2);
        //设置header
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        //要求结果为字符串且输出到屏幕上
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        if($useCert == true){
        //设置证书
        //使用证书：cert 与 key 分别属于两个.pem文件
            curl_setopt($ch,CURLOPT_SSLCERTTYPE,'PEM');
        //curl_setopt($ch,CURLOPT_SSLCERT, WxPayConfig::SSLCERT_PATH);
            curl_setopt($ch,CURLOPT_SSLKEYTYPE,'PEM');
        //curl_setopt($ch,CURLOPT_SSLKEY, WxPayConfig::SSLKEY_PATH);
        }
        //post提交方式
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
        //运行curl
        $data = curl_exec($ch);
        //返回结果
        if($data){
            curl_close($ch);
            return $data;
        } else {
            $error = curl_errno($ch);
            curl_close($ch);
            return false;
        }
    }

    /**
     * 错误代码
     * @param $code 服务器输出的错误代码
     * @return mixed
     */
    public function error_code( $code ){
        $errList = array(
            'NOAUTH' => '商户未开通此接口权限',
            'NOTENOUGH' => '用户帐号余额不足',
            'ORDERNOTEXIST' => '订单号不存在',
            'ORDERPAID' => '商户订单已支付，无需重复操作',
            'ORDERCLOSED' => '当前订单已关闭，无法支付',
            'SYSTEMERROR' => '系统错误!系统超时',
            'APPID_NOT_EXIST' => '参数中缺少APPID',
            'MCHID_NOT_EXIST' => '参数中缺少MCHID',
            'APPID_MCHID_NOT_MATCH' => 'appid和mch_id不匹配',
            'LACK_PARAMS' => '缺少必要的请求参数',
            'OUT_TRADE_NO_USED' => '同一笔交易不能多次提交',
            'SIGNERROR' => '参数签名结果不正确',
            'XML_FORMAT_ERROR' => 'XML格式错误',
            'REQUIRE_POST_METHOD' => '未使用post传递参数 ',
            'POST_DATA_EMPTY' => 'post数据不能为空',
            'NOT_UTF8' => '未使用指定编码格式',
        );
        if( array_key_exists( $code , $errList ) ){
            return $errList[$code];
        }
    }


}
