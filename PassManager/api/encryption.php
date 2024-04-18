<?php
function secured_encrypt($data)
{
    $ssl_key = $_COOKIE['ssl_key'];       
    $method = "aes-256-cbc";    
    $iv_length = openssl_cipher_iv_length($method);
    $iv = openssl_random_pseudo_bytes($iv_length);
            
    $first_encrypted = openssl_encrypt($data,$method,$ssl_key, OPENSSL_RAW_DATA ,$iv);
                
    $output = base64_encode($iv.$first_encrypted);    
    return $output;        
}
function secured_decrypt($input)
{
    $ssl_key = $_COOKIE['ssl_key'];            
    $mix = base64_decode($input);
            
    $method = "aes-256-cbc";    
    $iv_length = openssl_cipher_iv_length($method);
                
    $iv = substr($mix,0,$iv_length);
    $first_encrypted = substr($mix,$iv_length,64);
                
    $data = openssl_decrypt($first_encrypted,$method,$ssl_key,OPENSSL_RAW_DATA,$iv);
    return $data;
}