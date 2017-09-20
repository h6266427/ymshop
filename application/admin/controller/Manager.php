<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/20
 * Time: 15:55
 */
namespace app\admin\controller;

use think\Controller;

class Manager extends Controller{
    public function index(){



        return $this->fetch();
    }




}