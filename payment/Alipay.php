<?php
use base\AlipayBase;

class Alipay
{

    /**
     * md5签名秘钥
     *
     * @var string
     */
    private $key;

    /**
     *
     * @param string $key            
     */
    public function setKey($key)
    {
        $this->key = $key;
    }

    /**
     * 请求API
     *
     * @return mixed
     */
    public function toWebPayed(AlipayBase $alipayBase)
    {
        $data = $alipayBase->toArray();
        $data['sign'] = $this->createMD5Sign($alipayBase->buildRequest($data));
        $data['sign_type'] = 'MD5';
        
        parse_str($alipayBase->createLinkstring($data), $content);
        $string = '';
        foreach ($data as $k => $v) {
            $string .= (($k != 'seller_email') ? $k.'='.urlencode($v) : $k.'='.$v).'&';
        }
        $string = substr($string, 0, strlen($string) - 1);

        return $alipayBase->getGateway().'?'.$string;
    }

    /**
     * 对数据进行MD5签名
     *
     * @return string
     */
    public function createMd5Sign($str)
    {
        $mysign = md5($str . $this->key);

        return $mysign;
    }
}
