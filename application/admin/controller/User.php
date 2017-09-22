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
        $id = input('id');
        /*if (request()->isPost()){
            //接收参数
            $data = [
                'id'=>$id,
                'name'=>input('name'),
            ];*/
        //查询数据
        $data = UserModel::getUserById($id);
        //分配到模板
        $this->assign('data',$data);
        return $this->fetch();
    }


}