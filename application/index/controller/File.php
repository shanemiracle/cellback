<?php
/**
 * Created by PhpStorm.
 * User: xiaojie
 * Date: 2016/9/22
 * Time: 下午2:28
 */

namespace app\index\controller;


use think\Request;

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



}