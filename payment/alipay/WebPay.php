<?php
namespace alipay;

use base\AlipayBase;

class WebPay extends AlipayBase
{

    /**
     * 合作商户号
     *
     * @var string
     */
    private $partner;

    /**
     * 商户订单号,商户网站订单系统中唯一订单号，必填
     *
     * @var string
     */
    private $out_trade_no;

    /**
     * 卖家支付宝帐户 必填
     *
     * @var string
     */
    private $seller_email;

    /**
     * 使用的支付服务, 即时到账
     *
     * @var string
     */
    private $service = 'create_direct_pay_by_user';

    /**
     * 支付类型,必填，不能修改
     *
     * @var integer
     */
    private $payment_type = '1';

    /**
     * 服务器异步通知页面路径,需http://格式的完整路径，不能加?id=123这类自定义参数
     *
     * @var string
     */
    private $notify_url;

    /**
     * 页面跳转同步通知页面路径,需http://格式的完整路径，不能加?id=123这类自定义参数，不能写成http://localhost/
     *
     * @var string
     */
    private $return_url;

    /**
     * 商品名称 必填
     *
     * @var string
     */
    private $subject;

    /**
     * 付款金额 必填
     *
     * @var string
     */
    private $total_fee;

    /**
     * 商品详情
     *
     * @var string
     */
    private $body;

    /**
     * 商品展示地址
     *
     * @var string
     */
    private $show_url;

    /**
     * 防钓鱼时间戳 (可选)
     *
     * @var integer
     */
    private $anti_phishing_key;

    /**
     * 客户端的IP地址,非局域网的外网IP地址
     *
     * @var string
     */
    private $exter_invoke_ip;

    /**
     *
     * @var string
     */
    private $_input_charset = 'utf-8';

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
     * @return the $key
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     *
     * @param string $partner            
     */
    public function setPartner($partner)
    {
        $this->partner = $partner;
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
     * @return the $seller_email
     */
    public function getSeller_email()
    {
        return $this->seller_email;
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
     * @return the $payment_type
     */
    public function getPayment_type()
    {
        return $this->payment_type;
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
     * @return the $return_url
     */
    public function getReturn_url()
    {
        return $this->return_url;
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
     * @return the $total_fee
     */
    public function getTotal_fee()
    {
        return $this->total_fee;
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
     * @return the $show_url
     */
    public function getShow_url()
    {
        return $this->show_url;
    }

    /**
     *
     * @return the $anti_phishing_key
     */
    public function getAnti_phishing_key()
    {
        return $this->anti_phishing_key;
    }

    /**
     *
     * @return the $exter_invoke_ip
     */
    public function getExter_invoke_ip()
    {
        return $this->exter_invoke_ip;
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
     * @param \alipay\string $out_trade_no            
     */
    public function setOut_trade_no($out_trade_no)
    {
        $this->out_trade_no = $out_trade_no;
    }

    /**
     *
     * @param \alipay\string $seller_email            
     */
    public function setSeller_email($seller_email)
    {
        $this->seller_email = $seller_email;
    }

    /**
     *
     * @param \alipay\string $service            
     */
    public function setService($service)
    {
        $this->service = $service;
    }

    /**
     *
     * @param \alipay\integer $payment_type            
     */
    public function setPayment_type($payment_type)
    {
        $this->payment_type = $payment_type;
    }

    /**
     *
     * @param \alipay\string $notify_url            
     */
    public function setNotify_url($notify_url)
    {
        $this->notify_url = $notify_url;
    }

    /**
     *
     * @param \alipay\string $return_url            
     */
    public function setReturn_url($return_url)
    {
        $this->return_url = $return_url;
    }

    /**
     *
     * @param \alipay\string $subject            
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    /**
     *
     * @param \alipay\string $total_fee            
     */
    public function setTotal_fee($total_fee)
    {
        $this->total_fee = $total_fee;
    }

    /**
     *
     * @param \alipay\string $body            
     */
    public function setBody($body)
    {
        $this->body = $body;
    }

    /**
     *
     * @param \alipay\string $show_url            
     */
    public function setShow_url($show_url)
    {
        $this->show_url = $show_url;
    }

    /**
     *
     * @param \alipay\integer $anti_phishing_key            
     */
    public function setAnti_phishing_key($anti_phishing_key)
    {
        $this->anti_phishing_key = $anti_phishing_key;
    }

    /**
     *
     * @param \alipay\string $exter_invoke_ip            
     */
    public function setExter_invoke_ip($exter_invoke_ip)
    {
        $this->exter_invoke_ip = $exter_invoke_ip;
    }

    /**
     *
     * @param \alipay\string $_input_charset            
     */
    public function setInput_charset($_input_charset)
    {
        $this->_input_charset = $_input_charset;
    }

    /**
     * 返回数组
     *
     * @return array
     */
    public function toArray()
    {
        return get_object_vars($this);
    }
}