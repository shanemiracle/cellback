<?php
/**
 * Created by PhpStorm.
 * User: xiaojie
 * Date: 2016/10/9
 * Time: 下午2:35
 */

namespace app\index\cell;


class Cellfile
{
    public static function upload_file_head($file_size,$md5_id) {

        $Redata = ['cmd_id' =>15, 'cmd_flag' => 0, 'cmd_data' => [
            'file_size'=>intval($file_size),'md5_id'=>$md5_id]];
        return Cellserver::getFileData(json_encode($Redata));
//        if ($ret != null) {
//            $retData = json_decode($ret, true);
//            if ($retData && $retData['retCode'] == 0) {
//                return 0;
//            }
//            else{
//                return $retData['retCode'];
//            }
//
//        } else {
//            return 10000;
//        }
    }

    public static function upload_file_data($index,$block_crc,$block_len,$data_len,$data,$md5_id, $cmdFlag) {

        $Redata = ['cmd_id' =>16, 'cmd_flag' => $cmdFlag, 'cmd_data' => [
            'index'=>intval($index),'block_crc'=>intval($block_crc),'block_len'=>intval($block_len),
            'data_len'=>intval($data_len),'data'=>$data,'md5_id'=>$md5_id]];
        return Cellserver::postFileData(json_encode($Redata),$data);
//        if ($ret != null) {
//            $retData = json_decode($ret, true);
//            if ($retData && $retData['retCode'] == 0) {
//                return 0;
//            }
//            else{
//                return $retData['retCode'];
//            }
//
//        } else {
//            return 10000;
//        }
    }
    public static function upload_file_ok($md5_id) {

        $Redata = ['cmd_id' =>17, 'cmd_flag' => 0, 'cmd_data' => [
            'md5_id'=>$md5_id]];
        return Cellserver::getFileData(json_encode($Redata));
//        if ($ret != null) {
//            $retData = json_decode($ret, true);
//            if ($retData && $retData['retCode'] == 0) {
//                return 0;
//            }
//            else{
//                return $retData['retCode'];
//            }
//
//        } else {
//            return 10000;
//        }
    }

    public static function download_file_head($md5_id) {

        $Redata = ['cmd_id' =>18, 'cmd_flag' => 0, 'cmd_data' => [
            'md5_id'=>$md5_id]];
        return Cellserver::getFileData(json_encode($Redata));
//        if ($ret != null) {
//            $retData = json_decode($ret, true);
//            if ($retData && $retData['retCode'] == 0) {
//                return 0;
//            }
//            else{
//                return $retData['retCode'];
//            }
//
//        } else {
//            return 10000;
//        }
    }

    public static function download_file_data($md5_id,$index,$flag_index1,$flag_index2) {

        $Redata = ['cmd_id' =>19, 'cmd_flag' => 0, 'cmd_data' => [
            'index'=>intval($index),'flag_index1'=>intval($flag_index1),'flag_index2'=>intval($flag_index2),
            'md5_id'=>$md5_id]];
        return Cellserver::getFileData(json_encode($Redata));
//        if ($ret != null) {
//            $retData = json_decode($ret, true);
//            if ($retData && $retData['retCode'] == 0) {
//                return 0;
//            }
//            else{
//                return $retData['retCode'];
//            }
//
//        } else {
//            return 10000;
//        }
    }
}