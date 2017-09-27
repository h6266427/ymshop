<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/26
 * Time: 13:44
 */
namespace app\admin\controller;
use think\Controller;
use app\admin\model\Order as OrderModel;

class Order extends Controller{
    /*
     *
     * 订单列表页面
     * */
    public function index(){
        //查询数据并分配到列表上
        $data = OrderModel::allOrder();
        $this->assign('data',$data);


        return $this->fetch('list');
    }
}