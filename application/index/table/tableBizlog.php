<?php
/**
 * Created by PhpStorm.
 * User: xiaojie
 * Date: 2016/11/14
 * Time: 上午10:12
 */

namespace app\index\table;


use think\Db;

class tableBizlog
{
    protected static $tableName = 'business_log';


    public static function count() {
        $data = Db::table(tableBizlog::$tableName)->count();

        return $data;
    }

    public static function getList($time, $limit) {
        $data = Db::table(tableBizlog::$tableName)->where('index_time','<', $time)->limit($limit)->select();

        return $data;
    }
    public static function hos_list(){
        $data = Db::table(tableBizlog::$tableName)->select();

        return $data;
    }

}