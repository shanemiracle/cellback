<?php
/**
 * Created by PhpStorm.
 * User: xiaojie
 * Date: 2016/11/28
 * Time: 下午2:35
 */

namespace app\index\table;


use think\Db;

class tablePlacelog
{
    protected static $tableName = 'place_log';


    public static function count() {
        $data = Db::table(tablePlacelog::$tableName)->count();

        return $data;
    }

    public static function getList($time, $limit) {
        $data = Db::table(tablePlacelog::$tableName)->where('index_time','<', $time)->limit($limit)->select();

        return $data;
    }
    public static function hos_list(){
        $data = Db::table(tablePlacelog::$tableName)->select();

        return $data;
    }

}