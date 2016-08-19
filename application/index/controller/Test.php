<?php
/**
 * Created by PhpStorm.
 * User: xiaojie
 * Date: 2016/8/19
 * Time: 上午9:35
 */

namespace app\index\controller;


use app\index\table\tableHospital;
use think\controller\Rest;

class Test extends Rest
{
    public function index() {

        $data = tableHospital::add(13,1,'北京','武警总医院','bj007','2016-8-19 16:30:00');

        return $this->response($data,'json',200);
    }
}