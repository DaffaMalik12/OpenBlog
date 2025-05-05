<?php

if (!function_exists('urlSafeEncode')) {
    function urlSafeEncode($string)
    {
        return rtrim(strtr(base64_encode($string), '+/', '-_'), '=');
    }
}

if (!function_exists('urlSafeDecode')) {
    function urlSafeDecode($string)
    {
        return base64_decode(strtr($string, '-_', '+/'));
    }
}
