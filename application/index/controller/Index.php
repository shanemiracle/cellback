<?php
namespace app\index\controller;

use app\index\cell\Cellserver;
use think\controller\Rest;
use think\Request;
use think\Session;
use think\View;

class Index extends Rest
{
    public function index()
    {
        $se_user = Session::get("user");
        $se_pwd = Session::get('pwd');

        if ($se_user != null && $se_pwd != null) {
            $user = $se_user;
            $pwd = $se_pwd;
        } else {
            $user = Request::instance()->param('username');
            $pwd = Request::instance()->param('password');
        }

        if ($user == null || $pwd == null) {
            $view = new View();
            return $view->fetch('login/login');
        }

        $data = ['cmd_id' => 1, 'cmd_flag' => 1024, 'cmd_data' => ['user' => $user, 'pwd' => $pwd]];
        $array = Cellserver::postData(json_encode($data));

        if ($array != null) {
            $retData = json_decode($array, true);
            if ($retData && $retData['retCode'] == 0) {
                Session::set('user', $user);
                Session::set('pwd', $pwd);
                Session::set('attest', $retData['attest']);

                $view = new View();

                return $view->fetch('index');
            }else {
                $view = new View();
                return $view->fetch('login/login');
            }

//            return $this->response($array, 'html', 200);

        } else {
            print 'error';
        }

    }
}