<?php
/**
 * Created by PhpStorm.
 * User: xiaojie
 * Date: 2016/8/19
 * Time: 上午9:56
 */

namespace app\index\controller;



use think\View;

class Hospital
{
    public function index() {
        return (new View())->fetch('hospital/index');
    }
}