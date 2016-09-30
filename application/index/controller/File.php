<?php
/**
 * Created by PhpStorm.
 * User: xiaojie
 * Date: 2016/9/22
 * Time: 下午2:28
 */

namespace app\index\controller;


use app\index\cell\Cellserver;
use think\Request;
use think\Session;

class File extends \think\Controller
{
    public function uploadlogo(){
        $hos_name = Request::instance()->param('hos_name');
        $doc_name = Request::instance()->param('doc_name');
        $doc_no = Request::instance()->param('doc_no');
        $doc_ver = Request::instance()->param('doc_ver');
        $pwd = Request::instance()->param('pwd');
        $level = Request::instance()->param('level');
        $depart = Request::instance()->param('depart');
        $mobile = Request::instance()->param('mobile');
//        $role = Request::instance()->param('role');
        $role = 1;


        $ip = 'http://localhost:8888';
        $file = Request::instance()->file('image');
        if( $file) {
            $info = $file->rule('md5')->move(ROOT_PATH.'public'.DS.'logo');
            if($info){
                $filename = $info->getFilename();
                $fatherPath = $info->getPathInfo()->getBasename();

                $logoname = $ip.'/logo/'.$fatherPath.'/'.$filename;
                $sign_pic='';
            }
            else{
                $logoname='';
                $sign_pic='';
            }
        }
        else{
            $logoname='';
            $sign_pic='';
        }

        $data = ['hos_name'=>$hos_name,'doc_name'=>$doc_name,'doc_no'=>$doc_no,
            'doc_ver'=>$doc_ver,'pwd'=>$pwd,'level'=>$level,'depart'=>$depart,'mobile'=>$mobile,
            'logo'=>$logoname,'sign_pic'=>$sign_pic];

        return view('/doctor/edit',$data);
//        return $this->response($data,'json',200);

    }

    public function uploadsign(){
        $ip = 'http://localhost:8888';
        $file = Request::instance()->file('image');
        if( $file) {
            $info = $file->rule('md5')->move(ROOT_PATH.'public'.DS.'logo');
            if($info){
                $filename = $info->getFilename();
                $fatherPath = $info->getPathInfo()->getBasename();

                $logoname = $ip.'/logo/'.$fatherPath.'/'.$filename;

                $data = ['retCode'=>0,'logo'=>$logoname];
            }
            else{
                $data = ['retCode'=>10000];
            }
        }
        else{
            $data = ['retCode'=>10000];
        }

        return $this->response($data,'json',200);

    }

    public function upload_file_head() {
        $file_size =  Request::instance()->param('file_size');
        $md5_id = Request::instance()->param('md5_id');

        $Redata = ['cmd_id' =>15, 'cmd_flag' => 0, 'cmd_data' => ['attest'=>Session::get("attest"),
            'file_size'=>intval($file_size),'md5_id'=>$md5_id]];
        $ret = Cellserver::postData(json_encode($Redata));
        if ($ret != null) {
            $retData = json_decode($ret, true);
            if ($retData && $retData['retCode'] == 0) {
                print 0;
            }
            else{
                print 'err+'.$retData['retCode'];
            }

        } else {
            print 10000;
        }
    }

    public function upload_file_data() {
        $index =  Request::instance()->param('index');
        $block_crc =  Request::instance()->param('block_crc');
        $block_len =  Request::instance()->param('block_len');
        $data_len =  Request::instance()->param('data_len');
        $data = Request::instance()->param('data');
        $md5_id = Request::instance()->param('md5_id');

        $Redata = ['cmd_id' =>16, 'cmd_flag' => 0, 'cmd_data' => ['attest'=>Session::get("attest"),
            'index'=>intval($index),'block_crc'=>intval($block_crc),'block_len'=>intval($block_len),
            'data_len'=>intval($data_len),'data'=>data,'md5_id'=>$md5_id]];
        $ret = Cellserver::postData(json_encode($Redata));
        if ($ret != null) {
            $retData = json_decode($ret, true);
            if ($retData && $retData['retCode'] == 0) {
                print 0;
            }
            else{
                print 'err+'.$retData['retCode'];
            }

        } else {
            print 10000;
        }
    }
    public function upload_file_ok() {
        $md5_id = Request::instance()->param('md5_id');

        $Redata = ['cmd_id' =>17, 'cmd_flag' => 0, 'cmd_data' => ['attest'=>Session::get("attest"),
           'md5_id'=>$md5_id]];
        $ret = Cellserver::postData(json_encode($Redata));
        if ($ret != null) {
            $retData = json_decode($ret, true);
            if ($retData && $retData['retCode'] == 0) {
                print 0;
            }
            else{
                print 'err+'.$retData['retCode'];
            }

        } else {
            print 10000;
        }
    }

    public function download_file_head() {
        $md5_id = Request::instance()->param('md5_id');

        $Redata = ['cmd_id' =>18, 'cmd_flag' => 0, 'cmd_data' => ['attest'=>Session::get("attest"),
            'md5_id'=>$md5_id]];
        $ret = Cellserver::postData(json_encode($Redata));
        if ($ret != null) {
            $retData = json_decode($ret, true);
            if ($retData && $retData['retCode'] == 0) {
                print 0;
            }
            else{
                print 'err+'.$retData['retCode'];
            }

        } else {
            print 10000;
        }
    }

    public function download_file_data() {
        $md5_id = Request::instance()->param('md5_id');
        $index =  Request::instance()->param('index');
        $flag_index1 =  Request::instance()->param('flag_index1');
        $flag_index2 =  Request::instance()->param('flag_index2');

        $Redata = ['cmd_id' =>18, 'cmd_flag' => 0, 'cmd_data' => ['attest'=>Session::get("attest"),
            'index'=>intval($index),'flag_index1'=>intval($flag_index1),'flag_index2'=>intval($flag_index2), 'md5_id'=>$md5_id]];
        $ret = Cellserver::postData(json_encode($Redata));
        if ($ret != null) {
            $retData = json_decode($ret, true);
            if ($retData && $retData['retCode'] == 0) {
                print 0;
            }
            else{
                print 'err+'.$retData['retCode'];
            }

        } else {
            print 10000;
        }
    }
}