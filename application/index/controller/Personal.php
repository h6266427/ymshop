<?php
namespace app\index\controller;
use think\Controller;
use app\index\model\Personal as PersonalModel;
class Personal extends  Base {
    public function index(){
        //提取登录信息
        $isLogin=$this->isLogin();
        if(!empty($isLogin)){
            //分配登录用户信息到模板
            $this->assign('user',$isLogin);
            //根据用户id查询该用户的订单
            $orderData=PersonalModel::orderByUserId($isLogin['user_id']);

            $this->assign('order',$orderData);

        }



        return $this->fetch('personal');
    }
}