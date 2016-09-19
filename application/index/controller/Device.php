<?php
/**
 * Created by PhpStorm.
 * User: xiaojie
 * Date: 2016/9/14
 * Time: 下午2:21
 */

namespace app\index\controller;


use app\index\cell\Cellserver;
use app\index\table\tableHospital;
use think\controller\Rest;
use think\Request;
use think\Session;
use think\View;

class Device extends Rest
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

    public function add() {
        $hos_name = Request::instance()->param('hos_name');
        $hos_no =  Request::instance()->param('hos_no');
        return (new View())->fetch('/device/add',['hos_name'=>$hos_name,'hos_no'=>$hos_no]);
    }

    public function edit() {
        $hos_name = Request::instance()->param('hos_name');
        $hos_no =  Request::instance()->param('hos_no');
        $mcode =  Request::instance()->param('mcode');
        $ctime = Request::instance()->param('ctime');
        $etime = Request::instance()->param('etime');

        return (new View())->fetch('/device/edit',['hos_name'=>$hos_name,'hos_no'=>$hos_no,
            'mcode'=>$mcode, 'ctime'=>$ctime, 'etime'=>$etime]);
    }

    public function add_one() {
        $hos_no =  Request::instance()->param('hos_no');
        $mcode = Request::instance()->param('mcode');
        $time = Request::instance()->param('time');

        if( !is_numeric($time) || $time == 0) {
            $time = 1000;
        }

        $end_time = time()+$time*24*60*60;

        $Redata = ['cmd_id' =>5, 'cmd_flag' => 0, 'cmd_data' => ['attest'=>Session::get("attest"),
            'hospital_no'=>intval($hos_no),'machine_code'=>$mcode, 'end_time'=>$end_time]];
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
        $mcode = Request::instance()->param('mcode');
        $time = Request::instance()->param('time');
        $etime = Request::instance()->param('etime');

        if( !is_numeric($time) || $time == 0) {
            $time = 1000;
        }

        $end_time = strtotime($etime)+$time*24*60*60;

        $Redata = ['cmd_id' =>6, 'cmd_flag' => 0, 'cmd_data' => ['attest'=>Session::get("attest"),
            'machine_code'=>$mcode, 'end_time'=>$end_time]];
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
        $mcode = Request::instance()->param('mcode');

        $Redata = ['cmd_id' =>7, 'cmd_flag' => 0, 'cmd_data' => ['attest'=>Session::get("attest"),
            'machine_code'=>$mcode]];
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
        $mcode = Request::instance()->param('mcode');
        $Redata = ['cmd_id' =>13, 'cmd_flag' => 0, 'cmd_data' => ['attest'=>Session::get("attest"),'machine_code'=>$mcode]];
        $ret = Cellserver::postData(json_encode($Redata));
        if ($ret != null) {
            $retData = json_decode($ret, true);
            if ($retData && $retData['retCode'] == 0) {
                print 1;
            }
            else if ($retData && $retData['retCode'] == 0x22) {
                print 0;
            }

        } else {
            print 2;
        }

    }

    public function ajax_list() {
        $hos_no = Request::instance()->param('hos_no');
        $Redata = ['cmd_id' =>8, 'cmd_flag' => 0, 'cmd_data' => ['attest'=>Session::get("attest"),'hospital_no'=>intval($hos_no)]];
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
}