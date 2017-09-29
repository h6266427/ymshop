<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/27
 * Time: 16:51
 */
namespace app\index\controller;
use think\Controller;
use app\index\controller\Base;

class Login extends Base {
    public function index(){
        $isLogin=$this->isLogin();
        if(!empty($isLogin)){

            return $this->redirect(url('Personal/index'));
        }

        return $this->fetch('login');
    }


    //执行登录
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
        //验证成功后登录次数加1，且记录登录时间
        $info['login_count']+=1;
        $info['login_time']=time();
        $upd=db('user')->update($info);


        if($upd!=false){
            session('user',$info);
            if(!empty(cookie('next_url'))){
                $nextUrl=cookie('next_url');
                cookie('next_url',null);
                return $this->success('登入成功',$nextUrl);
            }
        }
        return $this->success('登入成功',url('Index/index'));
    }

    /*
     * 退出登录
     *
     * */
    public function quit(){
        session('user',null);
        return $this->success('登出成功！',url('Index/index'));
    }
}