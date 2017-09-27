<?php

namespace app\index\controller;

use app\index\model\Index as IndexModel;
use think\Controller;

class Index extends Controller {
    public function index(){

        $data=IndexModel::goodsList();
        $cart=unserialize(cookie('cart'));
        if(!empty($cart)){
            //如果cookie不为空，则遍历所有商品数据，显示购物车里的商品数量
            foreach ($data as $k=>$v){
                foreach ($cart as $ck=>$cv){
                    if($data[$k]['goods_id']==$ck){
                        //如果cookie里的键（即商品id）与查出的商品id相等，则将cookie里的商品数量分配给该商品的数量字段
                        $data[$k]['goods_num']=$cv['goods_num'];
                        break;
                    }else{
                        //如果购物车里没有相同id的商品，则该商品在购物车的数量为0；
                        $data[$k]['goods_num']=0;
                    }
                }
            }
            //dump($data);exit;
        }else{
            //如果cookie为空，则所有商品在购物车的数量为0；
            foreach ($data as $k=>$v){
                $data[$k]['goods_num']=0;
            }
        }

        $this->assign('data',$data);
        return $this->fetch('home');

    }

    public function lis(){

        return $this->fetch('list');
    }



}
