<?php
namespace app\index\controller;
use think\Controller;
class Personal extends Controller{
    public function index(){
        return $this->fetch('personal');
    }
}