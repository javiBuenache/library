<?php

namespace App\Helpers;
use Firebase\JWT\JWT;

class Token
{
    private $key;
    private $data;
    private $algorithm;
    public function __construct($data = null)
    {
        $this->key = "nfdjoadnfjndjnb";
        $this->algorithm = array('HS256');
        $this->data = $data;
    }
    public function encode()
    {
        return JWT::encode($this->data, $this->key);
    }
    public function decode($token)
    {
        return JWT::decode($token, $this->key, $this->algorithm);
    }
}