<?php
/**
 * Created by PhpStorm.
 * User: xiaojie
 * Date: 2016/9/14
 * Time: 下午2:21
 */

namespace app\index\controller;


use app\index\table\tableHospital;
use think\View;

class Device
{
    public function index(){
        $data = tableHospital::hos_list();

        if( $data ) {
            $count = count($data);
            $ret = ['count'=>$count,'data'=>$data];
        }
        else{
            $ret = ['count'=>0,'data'=>null];
        }

        return (new View())->fetch('/device/index',$ret);
    }
}