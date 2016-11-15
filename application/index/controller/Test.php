<?php
/**
 * Created by PhpStorm.
 * User: xiaojie
 * Date: 2016/8/19
 * Time: 上午9:35
 */

namespace app\index\controller;


use app\index\cell\Cellfile;
use app\index\cell\Cellserver;
use app\index\table\tableBizlog;
use app\index\table\tableHospital;
use think\controller\Rest;
use think\Session;
use think\View;

class Test extends Rest
{
    public function index($cmd,$time,$mcode,$hos_no) {

        $data = ['cmd_id' =>intval($cmd), 'cmd_flag' => 0, 'cmd_data' => ['attest'=>Session::get("attest"),
            'end_time' => intval($time), 'machine_code' => $mcode,'hospital_no'=>intval($hos_no)]];
        $ret = Cellserver::postData(json_encode($data));

        return $this->response($ret,'html',200);
    }

    public function test() {
//        $time = "2035-12-12 23:59:59 999999";
//        $limit = 1000;
//        $data = tableBizlog::getList($time,$limit);
        $data = tableBizlog::hos_list();
        return $this->response($data,'json',200);
    }

    public function up() {
        return '<form action="/file/uploadlogo" enctype="multipart/form-data" method="post"> <input type="file" name="image"/> <br> <input type="submit" value="上传"/> </form> ';
    }

    public function file() {
        return (new View())->fetch('file');
    }

    public function bin() {
        $filename = './logo/f0/a18136d77decf88e5376bd450f3142.jpg';
        $file = fopen($filename,'r');

        $filesize = filesize($filename);
        $filemd5 =  md5_file($filename);


        $ret = Cellfile::upload_file_head($filesize,$filemd5);

        $retD = json_decode($ret,true);

        if( $retD['retCode'] == 0 ) {
            $blockSize = $retD['block_size'];
            $num = intval(($filesize+$blockSize-1)/$blockSize);
            echo '</br>';
            echo $num;
            echo '</br>';

            $datalen = $blockSize;

            for($i = 0; $i < $num; $i++) {
                if( $i + 1 == $num ) {
                    $datalen = $filesize- ($num-1)*$blockSize;
                }

                $blockData = fread($file,$datalen);

                $base64Data = base64_encode($blockData);
                $crc = crc32($base64Data);

                $updataRet= Cellfile::upload_file_data($i,$crc,$blockSize,$datalen,$base64Data,$filemd5,$i+1);
                echo $updataRet;
            }

        }
        else{
            echo $ret;
        }


//        echo $ret;

//        $readData = fread($file,100);
//        echo '</br>';
//        echo base64_encode($readData);

        fclose($file);



    }
}