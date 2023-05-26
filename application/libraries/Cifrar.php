<?php if ( ! defined('BASEPATH')) exit('No se permite el acceso directo al script');
/**
* Me sirve Para encriptar Y desencriptar Un String
*
* @author jose
*/
class Cifrar {
 
    private static $Key = "dublin";
 
    public static function enc ($input) {
        $output = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5(Cifrar::$Key), $input, MCRYPT_MODE_CBC, md5(md5(Cifrar::$Key))));
        return $output= str_replace(array('/'), array('~'), $output);
    }
 
    public static function dec ($input) {
        $output = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5(Cifrar::$Key), base64_decode(str_replace(array('~'), array('/'), $input)), MCRYPT_MODE_CBC, md5(md5(Cifrar::$Key))), "\0");
        return $output;
    }
 
}
