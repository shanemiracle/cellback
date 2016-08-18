<?php
namespace app\index\controller;

use think\controller\Rest;
use think\Cookie;
use think\Request;
use think\Response;
use think\Session;
use think\View;

class Index extends Rest
{
    public function index()
    {
        $se = Session::get("name");
        if($se == null) {
            Cookie::set("name",1);
        }
        else {
            print "se ".$se.'</br>';
            Session::set("name",$se+1);
        }

        $user = Request::instance()->param('username');
        $pwd = Request::instance()->param('password');
        print $user;
        print $pwd;
        $data = ['cmd_id'=>1,'cmd_flag'=>1024,'cmd_data'=>['user'=>$user,'pwd'=>$pwd]];
        $array =  $this->postData("http://192.9.60.58:8888/".json_encode($data) ) ;
        if( $array != null ){
            $retData = json_decode($array, true);
            if( $retData && $retData['retCode'] == 0 ) {
                $view = new View();

                return $view->fetch('index');
            }
//            print_r($retData);
            return $this->response($array,'html',200);
        }
        else {
            print 'error';
        }

//        return '<style type="text/css">*{ padding: 0; margin: 0; } .think_default_text{ padding: 4px 48px;} a{color:#2E5CD5;cursor: pointer;text-decoration: none} a:hover{text-decoration:underline; } body{ background: #fff; font-family: "Century Gothic","Microsoft yahei"; color: #333;font-size:18px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.6em; font-size: 42px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p> ThinkPHP V5<br/><span style="font-size:30px">十年磨一剑 - 为API开发设计的高性能框架</span></p><span style="font-size:22px;">[ V5.0 版本由 <a href="http://www.qiniu.com" target="qiniu">七牛云</a> 独家赞助发布 ]</span></div><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_bd568ce7058a1091"></thinkad>';

    }


    function postData($url, $timeout=3) {
        print $url;
        $ch = curl_init();

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
