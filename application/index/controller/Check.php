<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/27
 * Time: 10:40
 */
namespace app\index\controller;

use app\index\model\Check as CheckModel;
use app\index\controller\Base;
class Check extends Base{
    public function index(){

        //分配日期给订单模板
        $time=time();
        $this->assign('time',$time);

        //判断是否登录
        $isLogin=$this->isLogin();
        if(!empty($isLogin)){
            //已登录

            //根据user_id查地址表里的地址
            $addrData=CheckModel::userAddress($isLogin['user_id']);
            //dump($addrData);exit;
            $this->assign('addr',$addrData);

            //分配购物车商品列表
            $cartData = CheckModel::checkCartList($isLogin['user_id']);
            if (empty($cartData)){
                return '<script>alert(\'您还未选择商品！\');location=\'/index/Cart/index\'</script>';
            }
            $this->assign('cart',$cartData);

        }else{
            //未登录
            //在cookie里记录当前url
            cookie('next_url','/index/Check/index');
            //跳转登录页面
            return $this->redirect('Login/index');

        }
        //查出所有数据
        $data = CheckModel::allSheng();
        //把数据分配到模板
        $this->assign('data',$data);
        return $this->fetch('check');
    }

    public function submit(){

        //获取收货地址的addr_id；
        $addr_id=input('addr_id');

        //根据addr_id查出address表里的该条地址信息；
        $addrData=CheckModel::queryAddr($addr_id);

        //获取user_id;
        $userId=session('user')['user_id'];

        $create=CheckModel::createOrder($userId,$addrData);

        return $this->success($create['msg'],url('Pay/index'));



    }





    public function sheng($sheng){

        $city = db('area')->where(array('parent_id'=>$sheng))->select();
        return json(
            $city
        );
    }



    public function shi($shi){

        $xian = db('area')->where(array('parent_id'=>$shi))->select();
        return json(
            $xian
        );

    }


}