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
    static $ch = 0;
    public static function postData($url, $timeout=3) {
//        print $url;
        if( Cellserver::$ch == 0 ) {
            Cellserver::$ch = curl_init();
        }

        $url = "http://115.236.177.85:8888/".$url;
//        print $url;
        curl_setopt(Cellserver::$ch, CURLOPT_URL, $url);
        curl_setopt(Cellserver::$ch, CURLOPT_HEADER, 0);
        curl_setopt(Cellserver::$ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt(Cellserver::$ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt(Cellserver::$ch, CURLOPT_TIMEOUT, $timeout*2);

        $handles = curl_exec(Cellserver::$ch);
//        curl_close($ch);

        return $handles;
    }

    static $ch2 = 0;
    public static function postFileData($url, $data, $timeout=3) {
//        print $url;
        if(Cellserver::$ch2==0){
            Cellserver::$ch2 = curl_init();
        }
        $url = "http://115.236.177.85:8889/".$url;
//        print $url;
        curl_setopt(Cellserver::$ch2, CURLOPT_URL, $url);
        curl_setopt(Cellserver::$ch2, CURLOPT_POST, 1);
        curl_setopt(Cellserver::$ch2, CURLOPT_HEADER, 0);
        curl_setopt(Cellserver::$ch2, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt(Cellserver::$ch2, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt(Cellserver::$ch2, CURLOPT_POSTFIELDS, $data);
        curl_setopt(Cellserver::$ch2, CURLOPT_TIMEOUT, $timeout*2);

        $handles = curl_exec(Cellserver::$ch2);
//        curl_close($ch);

        return $handles;
    }

    static $ch3 = 0;
    public static function getFileData($url, $timeout=3) {
//        print $url;
        if(Cellserver::$ch3==0){
            Cellserver::$ch3 = curl_init();
        }
        $url = "http://115.236.177.85:8889/".$url;
//        print $url;
        curl_setopt(Cellserver::$ch3, CURLOPT_URL, $url);
        curl_setopt(Cellserver::$ch3, CURLOPT_HEADER, 0);
        curl_setopt(Cellserver::$ch3, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt(Cellserver::$ch3, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt(Cellserver::$ch3, CURLOPT_TIMEOUT, $timeout*2);

        $handles = curl_exec(Cellserver::$ch3);
//        curl_close($ch);

        return $handles;
    }
}