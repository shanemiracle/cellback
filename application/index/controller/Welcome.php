<?php
/**
 * Created by PhpStorm.
 * User: xiaojie
 * Date: 2016/8/17
 * Time: 下午7:30
 */

namespace app\index\controller;


use think\controller\Rest;
use think\View;

class Welcome extends Rest
{
    public function index() {
        $view = new View();

        return $view->fetch('welcome');
    }
}