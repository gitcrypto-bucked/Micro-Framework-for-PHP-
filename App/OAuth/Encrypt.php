<?php

namespace App\Oauth;

class Encrypt
{
    public static function encrypt($plaintext_password):string
    {
        $hash = password_hash($plaintext_password,PASSWORD_DEFAULT);
        return $hash;
    }


    public static function verify($plaintext_password, $hash):bool
    {
        return password_verify($plaintext_password, $hash)? true: false;
    }
}

?>