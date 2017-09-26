<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/26
 * Time: 10:58
 */
namespace app\index\controller;

use think\Controller;

class Base extends Controller{

    public function isLogin(){

        if(!empty(session('user'))){
            return session('user');
        }
        return false;
    }
}