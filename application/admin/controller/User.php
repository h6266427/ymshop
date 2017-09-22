<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/21
 * Time: 19:38
 */
namespace app\admin\controller;

use app\admin\model\User as UserModel;
use think\Controller;

class User extends Controller{
    /*
     *
     * 用户列表页面
     * */
    public function index(){
        $data = UserModel::allUser();
        $this->assign('data',$data);

        return $this->fetch('list');
    }
    /*
    * 修改冻结状态页面
    *
    * */
    public function edit(){
        //接受id
        $user_id = input('user_id');
        /*if (request()->isPost()){
            //接收参数
            $data = [
                'user_id'=>$user_id,
                'name'=>input('name'),
            ];*/
        //查询数据
        $data = UserModel::getUserById($user_id);
        //分配到模板
        $this->assign('data',$data);
        return $this->fetch();
    }
    //修改数据
    public function upd(){
        $user_id = input('user_id');
        if (request()->isPost()){
            //接收参数
            $data = [
                'user_id'=>$user_id,
                'lock'=>input('lock')
            ];
            //dump($data);exit;
            //提交到数据库  转到model操作
            $res = UserModel::lockUser($data);
            //返回结果
            if ($res){
                return $this->success('修改成功','User/index');
            }else{
                return $this->error('修改失败');
            }

        }
    }
    /*
     * 永久冻结
     * */
    public function del(){
        $user_id = input('user_id');

        //查询数据
        $data = UserModel::getUserById($user_id);
        //判断是否是冻结状态
       // dump($data['lock']);exit;
        if ($data['lock']==1){
        $data['lock']=2;
        }
       // dump($data['lock']);exit;

        //操作数据库
        $res = UserModel::delUser($data);
        if ($res['status']=='success'){
            return $this->success($res['msg'],'User/index');

        }else{
            return $this->error($res['msg']);
        }

        
    }
/*
 * 新增用户 只能设置新用户的手机号
 * 密码为默认的 123456
 * */
    public function add(){
        if (request()->isPost()){
            //接收参数
            $data = [
                'phone'=>input('phone'),
                'password'=>input('password')
            ];
            $data['username']='新用户：；'.$data['phone'];
            //验证

            $validate=validate('User');
            if (!$validate->check($data)){
                return $this->error($validate->getError());
            }
            $data['password'] = md5($data['password']);
            //保存数据
            $res = db('user')->insert($data);
            //insert() 成功返回条数 通常1  失败返回false
            if($res){
                return $this->success('添加成功',url('User/index'));
            }else{
                return $this->error('添加失败');
            }

        }
        return $this->fetch();

    }

}