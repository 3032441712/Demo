<?php
namespace base;

class AlipayBase
{

    /**
     * 请求的网关地址
     *
     * @return string
     */
    private $gateway;

    /**
     * 获取网关地址
     *
     * @return the $gateway
     */
    public function getGateway()
    {
        return $this->gateway;
    }

    /**
     *
     * @param field_type $gateway            
     */
    public function setGateway($gateway)
    {
        $this->gateway = $gateway;
    }

    /**
     * 构造接口请求数据
     *
     * @return string
     */
    public function buildRequest($data)
    {
        $datafilter = $this->paraFilter($data);
        ksort($datafilter);
        reset($datafilter);
        
        return $this->createLinkstring($datafilter);
    }
    
    //
    public function paraFilter($data)
    {
        $dataFilter = array();
        foreach ($data as $k => $v) {
            if ($k == "sign" || $k == "sign_type" || $v == "") {
                continue;
            } else {
                $dataFilter[$k] = $data[$k];
            }
        }
        
        return $dataFilter;
    }

    /**
     * 构造接口访问参数
     *
     * @return string
     */
    public function createLinkstring($data)
    {
        $arg = "";
        while (list ($key, $val) = each($data)) {
            $arg .= $key . "=" . $val . "&";
        }
        // 去掉最后一个&字符.
        $arg = substr($arg, 0, count($arg) - 2);
        // 如果存在转义字符，那么去掉转义.
        if (get_magic_quotes_gpc()) {
            $arg = stripslashes($arg);
        }
        
        return $arg;
    }
}