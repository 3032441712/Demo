<?php

use alipay\WebPay;


function __autoload($class)
{
    static $classLib = [];
    $path = dirname(__FILE__) . DIRECTORY_SEPARATOR;
    $file = $path.str_replace('\\', '/', $class).'.php';
    $md5file = md5($file);
    if (in_array($md5file, $classLib)) {
        return true;
    }

    $classLib[] = $md5file;
    include $file;
}

$alipay = new Alipay();
$alipay->setKey('');  // 填写
$webPay = new WebPay();
$webPay->setPartner('');  // 填写
$webPay->setSeller_email('');  // 填写
$webPay->setGateway('https://mapi.alipay.com/gateway.do');
$webPay->setOut_trade_no(2015092900010001);
$webPay->setSubject('支付测试商品,不声成实际购买订单');
$webPay->setBody('支付测试商品,不声成实际购买订单');
$webPay->setTotal_fee(30.55);
$webPay->setNotify_url("http://www.nogi.com/notify.php");
$webPay->setReturn_url("http://www.nogi.com/notify.php");
$url = $alipay->toWebPayed($webPay);

echo $url;
