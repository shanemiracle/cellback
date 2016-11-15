<?php
/**
 * Created by PhpStorm.
 * User: xiaojie
 * Date: 2016/11/15
 * Time: 下午2:53
 */

namespace app\index\controller;


use app\index\table\tableBizlog;
use think\controller\Rest;
use think\Request;
use think\View;

class Log extends Rest
{
    public function index() {
        $data = tableBizlog::count();
        if( $data == null ) {
            $page = [
                'page_num'=>0,
            ];
        }
        else {
            $page = [
                'page_num'=>$data,
            ];
        }

        return (new View())->fetch('log/index',$page);

    }

    public function ajax_list() {
//        $time = "2035-12-12 23:59:59 999999";
//        $limit = 1000;
//        $data = tableBizlog::getList($time,$limit);
        $logType = Request::instance()->param('logType');

        $data = '';

        if( $logType == 'business' ) {
            $data = tableBizlog::hos_list();
        }

        return $this->response(['data'=>$data],'json',200);
    }
}