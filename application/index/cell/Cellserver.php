<?php
namespace app\index\cell;
/**
 * Created by PhpStorm.
 * User: xiaojie
 * Date: 2016/8/19
 * Time: 上午9:38
 */
class Cellserver
{
    public static function postData($url, $timeout=3) {
//        print $url;
        $ch = curl_init();
        $url = "http://192.9.60.58:8888/".$url;
        print $url;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout*2);

        $handles = curl_exec($ch);
        curl_close($ch);

        return $handles;
    }
}