<?php
/**
 * Created by PhpStorm.
 * User: xiaojie
 * Date: 2016/9/13
 * Time: 下午2:29
 */
namespace app\index\controller;

use app\index\cell\Cellserver;
use think\Request;
use think\Session;
use think\View;

class Doctor{
    public function index() {
        return (new View())->fetch('doctor/index');
    }
    
    public function add_one() {
        $hos_no =  Request::instance()->param('hos_no');
        $doctor_name = Request::instance()->param('doctor_name');
        $pwd= Request::instance()->param('pwd');

        $Redata = ['cmd_id' =>9, 'cmd_flag' => 0, 'cmd_data' => ['attest'=>Session::get("attest"),
            'hospital_no'=>intval($hos_no),'doctor_name'=>$doctor_name,'pwd'=>$pwd]];
        $ret = Cellserver::postData(json_encode($Redata));
        if ($ret != null) {
            $retData = json_decode($ret, true);
            if ($retData && $retData['retCode'] == 0) {
                print 0;
            }
            else{
                print 'err'.$retData['retCode'];
            }

        } else {
            print 10000;
        }
    }

    public function edit_one() {
        $doctor_no = Request::instance()->param('doctor_no');
        $pwd = Request::instance()->param('pwd');
        $level = Request::instance()->param('level');
        $department = Request::instance()->param('department');
        $logo = Request::instance()->param('logo');
        $sign_pic = Request::instance()->param('sign_pic');
        $mobile_no = Request::instance()->param('mobile_no');
        $doctor_ver = Request::instance()->param('doctor_ver');
        $role = Request::instance()->param('role');

        $Redata = ['cmd_id' =>10, 'cmd_flag' => 0, 'cmd_data' => ['attest'=>Session::get("attest"),
            'doctor_no'=>$doctor_no, 'pwd'=>$pwd, 'level'=>$level, 'department'=>$department, 'logo'=>$logo,
            'sign_pic'=>$sign_pic, 'mobile_no'=>$mobile_no,  'doctor_ver'=>intval($doctor_ver),
            'role'=>intval($role)]];
        $ret = Cellserver::postData(json_encode($Redata));
        if ($ret != null) {
            $retData = json_decode($ret, true);
            if ($retData && $retData['retCode'] == 0) {
                print 0;
            }
            else{
                print 'err'.$retData['retCode'];
            }

        } else {
            print 10000;
        }
    }

    public function del_one() {
        $doctor_no = Request::instance()->param('doctor_no');

        $Redata = ['cmd_id' =>11, 'cmd_flag' => 0, 'cmd_data' => ['attest'=>Session::get("attest"),
            'doctor_no'=>$doctor_no]];
        $ret = Cellserver::postData(json_encode($Redata));
        if ($ret != null) {
            $retData = json_decode($ret, true);
            if ($retData && $retData['retCode'] == 0) {
                print 0;
            }
            else{
                print 'err'.$retData['retCode'];
            }

        } else {
            print 10000;
        }

    }

    public function ajax_exist() {
        $hos_no =  Request::instance()->param('hos_no');

        $Redata = ['cmd_id' =>12, 'cmd_flag' => 0, 'cmd_data' => ['attest'=>Session::get("attest"),'hospital_no'=>intval($hos_no)]];
        $ret = Cellserver::postData(json_encode($Redata));
        if ($ret != null) {
            $retData = json_decode($ret, true);
            if ($retData && $retData['retCode'] == 0) {
                print 1;
            }
            else if ($retData && $retData['retCode'] == 0x8) {
                print 0;
            }

        } else {
            print 2;
        }

    }
}
