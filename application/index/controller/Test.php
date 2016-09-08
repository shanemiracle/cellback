<?php
/**
 * Created by PhpStorm.
 * User: xiaojie
 * Date: 2016/8/19
 * Time: 上午9:35
 */

namespace app\index\controller;


use app\index\cell\Cellserver;
use app\index\table\tableHospital;
use think\controller\Rest;
use think\Session;

class Test extends Rest
{
    public function index($zone,$hos_name,$hos_no) {

        $data = ['cmd_id' => 3, 'cmd_flag' => 0, 'cmd_data' => ['attest'=>Session::get("attest"),
            'zone' => $zone, 'hospital_name' => $hos_name,'hospital_no'=>intval($hos_no)]];
        $ret = Cellserver::postData(json_encode($data));

        return $this->response($ret,'html',200);
    }
}