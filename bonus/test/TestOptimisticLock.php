<?php
function curl_post($url, array $post = NULL, array $options = array())
{
    $defaults = array(
        CURLOPT_POST => 1,
        CURLOPT_HEADER => 0,
        CURLOPT_URL => $url,
        CURLOPT_FRESH_CONNECT => 1,
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_FORBID_REUSE => 1,
        CURLOPT_TIMEOUT => 4,
        CURLOPT_POSTFIELDS => http_build_query($post)
    );

    $ch = curl_init();
    curl_setopt_array($ch, ($options + $defaults));
    if( ! $result = curl_exec($ch))
    {
        trigger_error(curl_error($ch));
    }
    curl_close($ch);
    return $result;
}

function multiPostData($url, array $post = NULL) {
    // 创建一对cURL资源
    $ch1 = curl_init();
    $ch2 = curl_init();
    
    // 设置URL和相应的选项
    curl_setopt($ch1, CURLOPT_URL, $url);
    curl_setopt($ch1, CURLOPT_HEADER, 0);
    curl_setopt($ch1, CURLOPT_FRESH_CONNECT, 1);
    curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch1, CURLOPT_FORBID_REUSE, 1);
    curl_setopt($ch1, CURLOPT_TIMEOUT, 4);
    curl_setopt($ch1, CURLOPT_POSTFIELDS, http_build_query($post));
    
    curl_setopt($ch2, CURLOPT_URL, $url);
    curl_setopt($ch2, CURLOPT_HEADER, 0);
    curl_setopt($ch2, CURLOPT_FRESH_CONNECT, 1);
    curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch2, CURLOPT_FORBID_REUSE, 1);
    curl_setopt($ch2, CURLOPT_TIMEOUT, 4);
    curl_setopt($ch2, CURLOPT_POSTFIELDS, http_build_query($post));
    
    // 创建批处理cURL句柄
    $mh = curl_multi_init();
    
    // 增加2个句柄
    curl_multi_add_handle($mh,$ch1);
    curl_multi_add_handle($mh,$ch2);
    
    $running=null;
    // 执行批处理句柄
    do {
        curl_multi_exec($mh,$running);
    } while($running > 0);
    
    echo curl_multi_getcontent($ch1);
    echo curl_multi_getcontent($ch2);
    // 关闭全部句柄
    curl_multi_remove_handle($mh, $ch1);
    curl_multi_remove_handle($mh, $ch2);
    curl_multi_close($mh);
}

$link = 'http://127.0.0.1/www/demo/OptimisticLock/index.php';
// $response = curl_post($link,['uid' => '1', 'bonus_id' => '1']);
// echo $response;
multiPostData($link, ['uid' => '1', 'bonus_id' => '1']);