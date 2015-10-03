<?php
namespace util;

class OpenSSLUtil
{

    /**
     * 将PKCS8格式的秘钥转换为PEM格式.
     *
     * @param string $der
     *            pkcs8格式的私钥
     * @param string $beginMarker
     *            开始的包围结构
     * @param string $endMarker
     *            结束的包围结构
     *            
     * @return string pem格式的私钥
     */
    public static function pkcs8ToPEM($der, $beginMarker = '-----BEGIN PRIVATE KEY-----', $endMarker = '-----END PRIVATE KEY-----')
    {
        $pem = $beginMarker . "\n";
        $pem .= chunk_split($der, 64, "\n");
        $pem .= $endMarker . "\n";
        
        return $pem;
    }

    /**
     * 对数据进行RSA签名
     *
     * @param string $data
     *            需要进行签名的数据.
     * @param string $privateKey
     *            签名用户的私钥
     *            
     * @return string
     */
    public static function createRSASign($data, $privateKey)
    {
        $private_key_id = openssl_pkey_get_private($privateKey);
        openssl_sign($data, $signature, $private_key_id, OPENSSL_ALGO_SHA1);
        openssl_free_key($private_key_id);
        
        return base64_encode($signature);
    }

    /**
     * 使用公钥来验证RSA签名合法性
     *
     * @param string $data
     *            需要进行签名的数据.
     * @param string $publicKey
     *            签名用户的公钥
     * @param string $sign
     *            私钥签名
     *            
     * @return bool true/false
     */
    public static function rsaVerify($data, $publicKey, $sign)
    {
        $res = openssl_get_publickey($publicKey);
        $result = (bool) openssl_verify($data, base64_decode($sign), $res);
        openssl_free_key($res);
        
        return $result;
    }
}
