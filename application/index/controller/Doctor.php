<?php
/**
 * Created by PhpStorm.
 * User: xiaojie
 * Date: 2016/9/13
 * Time: 下午2:29
 */
namespace app\index\controller;

use app\index\cell\Cellserver;
use think\controller\Rest;
use app\index\table\tableHospital;
use think\Request;
use think\Session;
use think\View;

class Doctor extends Rest{

    public $url = 'http://localhost:8888/logo/';
    public function index() {
        $data = tableHospital::hos_list();

        if( $data ) {
            $count = count($data);
            $ret = ['count'=>$count,'data'=>$data];
        }
        else{
            $ret = ['count'=>0,'data'=>null];
        }

        return (new View())->fetch('doctor/index',$ret);
    }

    public function add() {
        $hos_name = Request::instance()->param('hos_name');
        $hos_no =  Request::instance()->param('hos_no');
        return (new View())->fetch('/doctor/add',['hos_name'=>$hos_name,'hos_no'=>$hos_no]);
    }

    public function edit() {
        $hos_name = Request::instance()->param('hos_name');
        $hos_no = Request::instance()->param('hos_no');
        $doc_name =  Request::instance()->param('doc_name');
        $Redata = ['cmd_id' =>14, 'cmd_flag' => 0, 'cmd_data' => ['attest'=>Session::get("attest"),'hospital_no'=>intval($hos_no),'doctor_name'=>$doc_name]];
        $ret = Cellserver::postData(json_encode($Redata));
        if ($ret != null) {
            $retData = json_decode($ret, true);
            if ($retData && $retData['retCode'] == 0) {
                $logo = $retData['logo'];
                if(empty($logo)){
                    $logo = '/static/h-ui/images/ucnter/avatar.png';
                }
                $data=['hos_name'=>$hos_name,'doc_name'=>$retData['doctor_name'],'doc_no'=>$retData['doctor_no'],
                    'pwd'=>$retData['pwd'],'level'=>$retData['level'],'logo'=>$logo,'sign_pic'=>$retData['sign_pic'],'url'=>$this->url,
                    'mobile'=>$retData['mobile_no'],'doc_ver'=>$retData['doctor_ver'],'role1'=>$retData['role']&1,'role2'=>($retData['role']&2)>>1,
                    'role3'=>($retData['role']&4)>>2,'role4'=>($retData['role']&8)>>3,'depart'=>$retData['department']];
                return (new View())->fetch('/doctor/edit',$data);
            }
            else if ($retData && $retData['retCode'] == 0x1B) {
//                print 0;

            }

        } else {
//            print 2;
        }
//        $doc_ver = Request::instance()->param('doc_ver');
        $data=['hos_name'=>$hos_name,'doc_name'=>'','doc_no'=>'',
            'pwd'=>'','level'=>'','logo'=>'','sign_pic'=>'',
            'mobile'=>'','doc_ver'=>'','role'=>'',
            'depart'=>''];
        return (new View())->fetch('/doctor/edit',$data);
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
                print 'err+'.$retData['retCode'];
            }

        } else {
            print 10000;
        }
    }

    public function edit_ajax(){
        $hos_name = Request::instance()->param('hos_name');
        $doc_name = Request::instance()->param('doc_name');
        $doc_no = Request::instance()->param('doc_no');
        $doc_ver = Request::instance()->param('doc_ver');
        $pwd = Request::instance()->param('pwd');
        $level = Request::instance()->param('level');
        $depart = Request::instance()->param('depart');
        $mobile = Request::instance()->param('mobile');
        $logo = Request::instance()->param('logo');
        $sign_pic = Request::instance()->param('sign_pic');
        $logofile = Request::instance()->file('logofile');
        $sign_picfile= Request::instance()->file('sign_picfile');
        $role1 = Request::instance()->param('role1');
        $role2 = Request::instance()->param('role2');
        $role3 = Request::instance()->param('role3');
        $role4 = Request::instance()->param('role4');

        if($role1){
            $role1 = 1;
        }
        else{
            $role1 = 0;
        }

        if($role2){
            $role2 = 2;
        }else{
            $role2 = 0;
        }

        if($role3){
            $role3 = 4;
        }else{
            $role3 = 0;
        }

        if($role4){
            $role4 = 8;
        }else{
            $role4 = 0;
        }

        $role = $role1|$role2|$role3|$role4;

        if( $logofile) {
            $info = $logofile->rule('md5')->move(ROOT_PATH.'public'.DS.'logo');
            if($info){
                $filename = $info->getFilename();
                $fatherPath = $info->getPathInfo()->getBasename();

                $logoname = $fatherPath.'/'.$filename;
            }
            else{
                $logoname=$logo;
            }
        }
        else{
            $logoname=$logo;
        }

        if( $sign_picfile) {
            $info = $sign_picfile->rule('md5')->move(ROOT_PATH.'public'.DS.'logo');
            if($info){
                $filename = $info->getFilename();
                $fatherPath = $info->getPathInfo()->getBasename();

                $signname = $fatherPath.'/'.$filename;
            }
            else{
                $signname=$sign_pic;
            }
        }
        else{
            $signname=$sign_pic;
        }

        $Redata = ['cmd_id' =>10, 'cmd_flag' => 0, 'cmd_data' => ['attest'=>Session::get("attest"),
            'doctor_no'=>$doc_no, 'pwd'=>$pwd, 'level'=>$level, 'department'=>$depart, 'logo'=>$logoname,
            'sign_pic'=>$signname, 'mobile_no'=>$mobile,  'doctor_ver'=>intval($doc_ver),
            'role'=>$role]];
        $ret = Cellserver::postData(json_encode($Redata));
        if ($ret != null) {
            $retData = json_decode($ret, true);
            if ($retData && $retData['retCode'] == 0) {
                $data = ['hos_name'=>$hos_name,'doc_name'=>$doc_name,'doc_no'=>$doc_no,
                    'doc_ver'=>$retData['doctor_ver'],'pwd'=>$pwd,'level'=>$level,'depart'=>$depart,'mobile'=>$mobile,
                    'logo'=>$logoname,'sign_pic'=>$signname,'url'=>$this->url,
                    'role1'=>$role&1,'role2'=>($role&2)>>1,'role3'=>($role&4)>>2,'role4'=>($role&8)>>3];
                return view('/doctor/edit',$data);
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

    public function ajax_list() {
        $hos_no = Request::instance()->param('hos_no');
        $Redata = ['cmd_id' =>12, 'cmd_flag' => 0, 'cmd_data' => ['attest'=>Session::get("attest"),'hospital_no'=>intval($hos_no)]];
        $ret = Cellserver::postData(json_encode($Redata));

        if( $ret ) {

            $getData = json_decode($ret,true);
            if($getData['retCode']==0) {
                $data=['data'=>$getData['data']];
            }
            else{
                $data=['data'=>""];
            }

        }
        else {
            $data=['data'=>""];
        }

        return $this->response($data,'json',200);
    }

    public function ajax_exist() {
        $hos_no = Request::instance()->param('hos_no');
        $doctor_name = Request::instance()->param('doctor_name');
        $Redata = ['cmd_id' =>14, 'cmd_flag' => 0, 'cmd_data' => ['attest'=>Session::get("attest"),'hospital_no'=>intval($hos_no),'doctor_name'=>$doctor_name]];
        $ret = Cellserver::postData(json_encode($Redata));
        if ($ret != null) {
            $retData = json_decode($ret, true);
            if ($retData && $retData['retCode'] == 0) {
                print 1;
            }
            else if ($retData && $retData['retCode'] == 0x1B) {
                print 0;
            }

        } else {
            print 2;
        }

    }
}
