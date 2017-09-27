<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/27
 * Time: 10:40
 */
namespace app\index\controller;


use think\Controller;

class Check extends Controller{
    public function index(){
        return $this->fetch('check');
    }


}