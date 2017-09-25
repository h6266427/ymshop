<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/25
 * Time: 10:56
 */
namespace app\index\controller;

use think\Controller;

class Goods extends Controller{
    public function index(){


        return $this->fetch();
    }

}