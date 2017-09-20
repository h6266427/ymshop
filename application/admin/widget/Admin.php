<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/14
 * Time: 19:52
 */
namespace app\admin\widget;
use think\Controller;

class Admin extends Controller {
    public function head(){
        return $this->fetch("common/head");
    }
    public function sidebar(){
        return $this->fetch("common/sidebar");
    }





}