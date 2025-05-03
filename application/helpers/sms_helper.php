<?php

function get_sms($phone,$sms,$temp_id)
{
    $requestParams = array(
        'user'=>'Wehubfoundation',
        'password'=>'Wehub@0308',
        'mobile'=>$phone,
        'message'=>$sms,
        'sender'=>'TWEHUB',
        'type'=>'3',
        'template_id'=>$temp_id
    );

    $apiUrl = 'https://api.bulksmsgateway.in/sendmessage.php?';
    foreach($requestParams as $key => $val){
        $apiUrl .= $key.'='.urlencode($val).'&';
    }
    $apiUrl = rtrim($apiUrl, "&");
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($ch);
    curl_close($ch);
    //print_r($response);
    return true;
}