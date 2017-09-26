<?php

namespace app\index\controller;


use think\Controller;

class Index extends Controller {
    public function index(){

        return $this->fetch('home');

    }

    public function lis(){

        return $this->fetch('list');
    }



}
