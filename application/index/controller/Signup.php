<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/24
 * Time: 21:20
 */
namespace app\index\controller;

use think\Controller;

class Signup extends Controller{
    public function index(){


        return $this->fetch('signup');
    }



}