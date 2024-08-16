<?php

namespace App\OAuth;


class Tokenizer
{
     public function getSignature()
     {
        return bin2hex(random_bytes(16));
     }


     public function getCsrf()
     {
        return base64_encode(md5(time()));
     }
}

