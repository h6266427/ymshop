<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/25
 * Time: 10:50
 */
namespace app\index\controller;

use app\index\model\Cart as CartModel;
class Cart extends Base {
    public function index(){

        //cookie('cart',null);

        //判断是否登陆
        $isLogin=$this->isLogin();
        $cartData=[];
        if ($isLogin!=false) {
            //已登陆

            //判断该用户的购物车是否有商品
            //查询登录的用户的购物车数据
            $cartData = CartModel::cartById($isLogin['user_id']);
            //$this->assign('cart',$cartData);

        }else{
            //未登录
            //反字符串化cookie;
            $cart=unserialize(cookie('cart'));
            if(!empty($cart)){
                //cookie里有商品


                //两表联查出商品、图片数据
                foreach ($cart as $k=>$v){
                    $res=CartModel::cartData($v['goods_id']);

                    //往数量信息里添加cookie里的数量信息
                    $res['goods_num']=$v['goods_num'];
                    if($res){
                        $cartData[$v['goods_id']]=$res;
                        //dump($cartData);exit;
                    }
                }

                //$this->assign('cart',$cartData);

            }else{
                //购物车里没有商品


            }
        }

        $this->assign('cart',$cartData);
        return $this->fetch('cart');
    }




    public function addInCookie(){
        //获取传入的goods_id, goods_num
        $goods_id=input('goods_id');
        $goods_num=input('goods_num');

        //记得判断商品数量在库存减去冻结库存之间；


        //判断是否登陆
        $isLogin=$this->isLogin();
        if ($isLogin!=false){
            //已登陆

            //判断该用户的购物车是否有商品
            //查询登录的用户的购物车数据
            $cartData=CartModel::cartById($isLogin['user_id']);
            if(empty($cartData)){
                //购物车里没有商品
                $arr=[
                    'goods_id'=>$goods_id,
                    'goods_num'=>$goods_num,
                    'selected'=>1,
                    'user_id'=>$isLogin['user_id']
                ];
                //将商品写入购物车表
                $res=CartModel::insertCart($arr);
                if($res){
                    return json(['status'=>'success',
                        'msg'=>'已登录购物车没有商品添加成功~']);
                }else{
                    return false;
                }
            }else{
                //购物车里有商品
                //判断商品是否已存在
                foreach ($cartData as $k=>$v){
                    $cartData[$v['goods_id']]=$v;
                }
                if(array_key_exists($goods_id,$cartData)){
                    //存在
                    $cartData[$goods_id]['goods_num']+=$goods_num;
                    $res=CartModel::updCart($cartData[$goods_id]);
                    if($res){
                        return json(['status'=>'success',
                            'msg'=>'已登录购物车有商品且该商品已存在添加成功~']);
                    }else{
                        return false;
                    }
                }else{
                    //不存在
                    $arr=[
                        'goods_id'=>$goods_id,
                        'goods_num'=>$goods_num,
                        'selected'=>1,
                        'user_id'=>$isLogin['user_id']
                    ];
                    //将商品写入购物车表
                    $res=CartModel::insertCart($arr);
                    if($res){
                        return json(['status'=>'success',
                            'msg'=>'已登录且购物车没有该商品添加成功~']);
                    }else{
                        return false;
                    }
                }
            }
        }else{
            //未登陆

            //接收从首页商品点击添加数量的js传来的参数，包括goods_id,goods_num；
            $data[$goods_id]=[
                'goods_id'=>$goods_id,
                'goods_num'=>$goods_num,
                'selected'=>1
            ];

            //判断cookie里是否有商品
            //反字符串化cookie
            $cookie=cookie('cart');
            $cart=unserialize($cookie);

            if(empty($cart)){
                //没有商品
                //将添加的商品信息加入cookie
                $data=serialize($data);
                cookie('cart',$data);
                return json(['status'=>'success',
                    'msg'=>'未登录且没有商品添加成功~']);
            }else{
                //cookie里有商品

                if(array_key_exists($goods_id,$cart)){
                    //如果添加的商品是已添加过的
                    $cart[$goods_id]['goods_num']+=input('goods_num');
                    $cart=serialize($cart);
                    cookie('cart',$cart);
                    return json(['status'=>'success',
                        'msg'=>'未登录且购物车有该商品添加成功~']);
                }else{
                    //添加的商品是购物车里没有的商品
                    $cart[$goods_id]=[
                        'goods_id'=>$goods_id,
                        'goods_num'=>input('goods_num'),
                        'selected'=>1
                    ];
                    $cart=serialize($cart);
                    cookie('cart',$cart);
                    return json(['status'=>'success',
                        'msg'=>'未登录且购物车没有该商品添加成功~']);
                }
            }

        }




    }


}