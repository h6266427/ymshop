<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/27
 * Time: 16:51
 */
namespace app\index\controller;
use think\Controller;
class Login extends Controller{
    public function index(){
        return $this->fetch('login');
    }
    public function dologin(){
        $data = [
            'username'=>input('username'),
            'password'=>input('password')
        ];
        if(!$data['username']){
            return $this->error('用户名需要填写');
        }
        if(!$data['password']){
            return $this->error('密码不能为空');
        }
        //判断用户名密码是否正确
        $info = db('user')->where(array('username'=>$data['username'],'password'=>$data['password']))->find();
        if(!isset($info)||empty($info)){
            return $this->error('用户名或者密码错误');
        }
        return $this->success('登入成功',url('Index/index'));
    }
}