<?php
/**
 * Created by PhpStorm.
 * User: xiaojie
 * Date: 2016/9/13
 * Time: 下午2:29
 */
namespace app\index\controller;

use think\View;

class Doctor{
    public function index() {
        return (new View())->fetch('doctor/index');
    }
}
