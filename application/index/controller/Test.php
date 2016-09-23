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
use think\View;

class Test extends Rest
{
    public function index($cmd,$time,$mcode,$hos_no) {

        $data = ['cmd_id' =>intval($cmd), 'cmd_flag' => 0, 'cmd_data' => ['attest'=>Session::get("attest"),
            'end_time' => intval($time), 'machine_code' => $mcode,'hospital_no'=>intval($hos_no)]];
        $ret = Cellserver::postData(json_encode($data));

        return $this->response($ret,'html',200);
    }

    public function test() {
        $data = tableHospital::hos_list();
        return $this->response($data,'json',200);
    }

    public function up() {
        return '<form action="/file/upload" enctype="multipart/form-data" method="post"> <input type="file" name="image"/> <br> <input type="submit" value="上传"/> </form> ';
    }

    public function file() {
        return (new View())->fetch('file');
    }
}