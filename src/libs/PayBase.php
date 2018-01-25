<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/25
 * Time: 9:41
 * Author: 鲁强
 */
namespace Julong\Pay;
interface PayBase
{
    function toPay();
    function setParam($subject="test",$total_amount =  "0.01",$body= "购买测试商品0.01元",$timeout_express = "1m");
}