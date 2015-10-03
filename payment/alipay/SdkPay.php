<?php
namespace alipay;

use base\AlipayBase;

class SdkPay extends AlipayBase
{

    /**
     * 合作商户号
     */
    private $partner;

    /**
     * 卖家支付宝账号
     */
    private $seller_id;

    /**
     * 商户订单编号
     */
    private $out_trade_no;

    /**
     * 商品名称
     */
    private $subject;

    /**
     * 商品详情
     */
    private $body;

    /**
     * 总金额,该笔订单的资金总额,单位为RMB-Yuan,取值范围为[0.01，100000000.00]，精确到小数点后两位
     */
    private $total_fee;

    /**
     * 服务器异步通知页面
     */
    private $notify_url;

    /**
     * 接口名称
     */
    private $service = 'mobile.securitypay.pay';

    /**
     * 参数编码字符集
     */
    private $_input_charset = 'UTF-8';

    /**
     * 页面回调地址
     */
    private $return_url = 'http://m.alipay.com';

    /**
     * 支付类型。默认值为：1(商品购买)
     */
    private $payment_type = '1';

    /**
     * 未付款交易的超时时间
     * 设置未付款交易的超时时间，一旦超时,该笔交易就会自动被关闭
     * 取值范围：1m～15d。m-分钟,h-小时，d-天,1c-当天(无论交易何时创建，都在0点关闭)
     * 该参数数值不接受小数点，如1.5h，可转换为90m
     */
    private $it_b_pay = '1d';

    /**
     *
     * @return the $partner
     */
    public function getPartner()
    {
        return $this->partner;
    }

    /**
     *
     * @return the $seller_id
     */
    public function getSeller_id()
    {
        return $this->seller_id;
    }

    /**
     *
     * @return the $out_trade_no
     */
    public function getOut_trade_no()
    {
        return $this->out_trade_no;
    }

    /**
     *
     * @return the $subject
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     *
     * @return the $body
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     *
     * @return the $total_fee
     */
    public function getTotal_fee()
    {
        return $this->total_fee;
    }

    /**
     *
     * @return the $notify_url
     */
    public function getNotify_url()
    {
        return $this->notify_url;
    }

    /**
     *
     * @return the $service
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     *
     * @return the $_input_charset
     */
    public function getInput_charset()
    {
        return $this->_input_charset;
    }

    /**
     *
     * @return the $return_url
     */
    public function getReturn_url()
    {
        return $this->return_url;
    }

    /**
     *
     * @return the $payment_type
     */
    public function getPayment_type()
    {
        return $this->payment_type;
    }

    /**
     *
     * @return the $it_b_pay
     */
    public function getIt_b_pay()
    {
        return $this->it_b_pay;
    }

    /**
     *
     * @param field_type $partner            
     */
    public function setPartner($partner)
    {
        $this->partner = $partner;
    }

    /**
     *
     * @param field_type $seller_id            
     */
    public function setSeller_id($seller_id)
    {
        $this->seller_id = $seller_id;
    }

    /**
     *
     * @param field_type $out_trade_no            
     */
    public function setOut_trade_no($out_trade_no)
    {
        $this->out_trade_no = $out_trade_no;
    }

    /**
     *
     * @param field_type $subject            
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    /**
     *
     * @param field_type $body            
     */
    public function setBody($body)
    {
        $this->body = $body;
    }

    /**
     *
     * @param field_type $total_fee            
     */
    public function setTotal_fee($total_fee)
    {
        $this->total_fee = $total_fee;
    }

    /**
     *
     * @param field_type $notify_url            
     */
    public function setNotify_url($notify_url)
    {
        $this->notify_url = $notify_url;
    }

    /**
     *
     * @param string $service            
     */
    public function setService($service)
    {
        $this->service = $service;
    }

    /**
     *
     * @param string $_input_charset            
     */
    public function setInput_charset($_input_charset)
    {
        $this->_input_charset = $_input_charset;
    }

    /**
     *
     * @param string $return_url            
     */
    public function setReturn_url($return_url)
    {
        $this->return_url = $return_url;
    }

    /**
     *
     * @param string $payment_type            
     */
    public function setPayment_type($payment_type)
    {
        $this->payment_type = $payment_type;
    }

    /**
     *
     * @param string $it_b_pay            
     */
    public function setIt_b_pay($it_b_pay)
    {
        $this->it_b_pay = $it_b_pay;
    }

    public function toArray()
    {
        return get_object_vars($this);
    }
}