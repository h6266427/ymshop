<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/29
 * Time: 11:40
 */
namespace app\index\controller;


use think\Controller;

class Pay extends Controller{

    public function index(){

        return $this->fetch('pay');
    }

}