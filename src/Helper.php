<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/25
 * Time: 9:41
 * Author: 鲁强
 */
namespace Julong\Pay;
use DOMDocument;

class Helper
{
    static function get_client_ip(){
        $cip = 'unknown';
        if($_SERVER['REMOTE_ADDR']){
            $cip = $_SERVER['REMOTE_ADDR'];
        }
        elseif(getenv('REMOTE_ADDR')){
            $cip = $_SERVER['REMOTE_ADDR'];
        }
        return $cip;
    }
    //将XML转为array
    static public function xmlToArray($xml)
    {
        //将XML转为array
        $array_data = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
        return $array_data;
    }
    static function arrayToXml($arr)
    {
        $xml = "<xml>";
        foreach ($arr as $key=>$val)
        {
            if (is_numeric($val))
            {
                $xml.="<".$key.">".$val."</".$key.">";

            }
            else
                $xml.="<".$key."><![CDATA[".$val."]]></".$key.">";
        }
        $xml.="</xml>";
        return $xml;
    }
/*
    static function arrayToXml($arr,$dom=0,$item=0){
        if (!$dom){
            $dom = new DOMDocument("1.0");
        }
        if(!$item){
            $item = $dom->createElement("xml");
            $dom->appendChild($item);
        }
        foreach ($arr as $key=>$val){
            $itemx = $dom->createElement(is_string($key)?$key:"item");
            $item->appendChild($itemx);
            if (!is_array($val)){
                $text = $dom->createTextNode($val);
                $itemx->appendChild($text);

            }else {
                self::arrayToXml($val,$dom,$itemx);
            }
        }
        return $dom->saveXML();
    }
*/
}
