<?php
namespace app\index\table;

use think\Db;

/**
 * Created by PhpStorm.
 * User: xiaojie
 * Date: 2016/8/19
 * Time: 下午3:49
 */
class tableHospital
{
    protected static $tableName = 'hospital';

    public static function add($hos_no,$hos_ver,$zone,$hos_name,$hos_num,$create_time) {
        $data = [
            'hospital_no'=>$hos_no,
            'hospital_ver'=>$hos_ver,
            'zone'=>$zone,
            'hospital_name'=>$hos_name,
            'hospital_number'=>$hos_num,
            'create_time'=>$create_time
        ];
        try{
           $ret =  Db::table(tableHospital::$tableName)->insert($data);
        }
        catch (\PDOException $e) {
            echo 'err';
        }

        return $ret;
    }

    public static function get( $hos_no ) {
        $data = Db::table(tableHospital::$tableName)->where('hospital_no',$hos_no)->find();

        return $data;
    }

    public static function getList($hos_no, $limit) {
        $data = Db::table(tableHospital::$tableName)->where('hospital_no','>', $hos_no)->limit($limit)->select();

        return $data;
    }

    public static function count() {
        $data = Db::table(tableHospital::$tableName)->count();

        return $data;
    }

    public static function search_hos($hos_name) {
        $data = Db::table(tableHospital::$tableName)->where('hospital_name','like', '%'.$hos_name.'%')->select();

        return $data;
    }

}