<?php
namespace app\index\controller;
use think\Controller;

class Personal extends  Base {
    public function index(){
        $isLogin=$this->isLogin();
        if(!empty($isLogin)){
            $this->assign('user',$isLogin);
        }
        return $this->fetch('personal');
    }
}