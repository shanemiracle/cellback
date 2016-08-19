<?php
/**
 * Created by PhpStorm.
 * User: xiaojie
 * Date: 2016/8/19
 * Time: 上午9:56
 */

namespace app\index\controller;



use app\index\table\tableHospital;
use think\View;

class Hospital
{
    public function index() {
        $data = tableHospital::getList(0,10);
        if( $data != null ) {
            $page = [
                'page_size'=>10,
                'page_data'=>$data
            ];

        }

        $page = [
            'page_num'=>13,
            'page_size'=>10,
            'page_data'=>$data
        ];

        return (new View())->fetch('hospital/index',$page);
    }

    public function add() {
        return (new View())->fetch('hospital/add');
    }
}