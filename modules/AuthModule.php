<?php
class AuthModule{
    public static function SessionKey(){
        //Generate MD5 key using microtime and random integer
        return md5(microtime().rand(11111111,999999999));
    }
}
?>