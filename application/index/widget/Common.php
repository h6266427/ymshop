<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/19
 * Time: 22:44
 */
namespace app\index\widget;

use think\Controller;

class Common extends Controller{
    public function head(){
        return $this->fetch('common/head');
    }
    public function footer(){
        return $this->fetch('common/footer');
    }
}