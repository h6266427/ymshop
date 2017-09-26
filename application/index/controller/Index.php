<?php

namespace app\index\controller;

use app\index\model\Index as IndexModel;
use think\Controller;

class Index extends Controller {
    public function index(){
        $data=IndexModel::goodsList();
        $this->assign('data',$data);
        return $this->fetch('home');

    }

    public function lis(){

        return $this->fetch('list');
    }



}
