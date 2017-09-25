<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/20
 * Time: 15:55
 */
namespace app\admin\controller;

use think\Controller;
use think\Db;
use app\admin\model\Manager as ManagerModel;

class Manager extends Controller{
    public function index(){
        //查数据
        $data = ManagerModel::checkList();
        $this->assign('data',$data);

        return $this->fetch('list');
    }
    //添加用户
    public function add(){
        if(request()->isPost()){
            $data=[
                'manager_name'=>input('manager_name'),
                'password'=>input('password'),
                'create_time'=>time(),
            ];
            $data['password'] = md5($data['password']);
            //保存数据
            $validate = validate('Manager');
            if(!$validate->scene('add')->check($data)){
                return $this->error($validate->getError());
            }
            $res = ManagerModel::managerList($data);

           if($res){
                return $this->success('添加成功',url('Manager/index'));
            }else{
                return $this->error('添加失败');
            }


        }
        return $this->fetch();
    }
    //删除用户
    public function del(){
        $manager_id = input('manager_id');
        if($manager_id == 1){
            return $this->error('超级管理员不能被删除');
        }

        $res = ManagerModel::delList($manager_id);


     if($res){
            return $this->success('删除成功',url('Manager/index'));
        }else{
            return $this->error('删除失败');
        }
    }

//修改用户
public function edit(){
        $manager_id = input('manager_id');
        $data= ManagerModel::editList($manager_id);
        $this->assign('data',$data);
        return $this->fetch();
}

//执行修改
public function upd(){

    $data = [
        'manager_id' => input('manager_id'),
        'manager_name' => input('manager_name'),
        ];
    $password = input('password');
    $validate = validate('Manager');
    if(!$validate->scene('edit')->check($data)){
        return $this->error($validate->getError());
    }
    if($password != ''){
        $data['password'] = md5($password);
    }
    $res = ManagerModel::updList($data);
    if($res !== false){
        return $this->success('修改成功',url('index'));
    }else{
        return $this->error('修改失败');
    }

}


}