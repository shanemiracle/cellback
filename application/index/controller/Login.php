<?php
/**
 * Created by PhpStorm.
 * User: xiaojie
 * Date: 2016/8/17
 * Time: 下午8:03
 */

namespace app\index\controller;


use think\controller\Rest;
use think\Request;
use think\View;

class Login extends Rest
{
    public function index() {

        return (new View())->fetch('login');
    }


}