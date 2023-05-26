<?php

if (!defined('BASEPATH'))
    exit('No se permite el acceso directo al script');

class Codificar {


    function encrip($cadena, $clave) {
        global $core;
        $resultado = "";
        for ($i = 0; $i < strlen($cadena); $i++) {
            $char = substr($cadena, $i, 1);
            $keychar = substr($clave, ($i % strlen($clave)) - 1, 1);
            $char = chr(ord($char) + ord($keychar));
            $resultado.=$char;
        }
        return str_replace(array('+', '/', '='), array('-', '_', ''), base64_encode($resultado));
    }

    function decrip($cadena, $clave) {
        global $core;
        $resultado = '';
        $cadena = base64_decode($cadena);
        $cadena = str_replace(array('-', '_'), array('+', '/'), $cadena);
        for ($i = 0; $i < strlen($cadena); $i++) {
            $char = substr($cadena, $i, 1);
            $keychar = substr($clave, ($i % strlen($clave)) - 1, 1);
            $char = chr(ord($char) - ord($keychar));
            $resultado.=$char;
        }
        return $resultado;
    }
}
    