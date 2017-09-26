<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/25
 * Time: 10:50
 */
namespace app\index\controller;

use think\Controller;

class Cart extends Controller{
    public function index(){


        return $this->fetch();
    }

    public function addInCookie(){

        //记得判断商品数量在库存减去冻结库存之间；


        //接收从首页商品点击添加数量的js传来的参数，包括goods_id,goods_num；
        $gid=input('gid');
        $data=[$gid=>[
            'goods_id'=>$gid,
            'goods_num'=>input('gnum'),
            'selected'=>1
        ]
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
                'msg'=>'添加成功~']);
        }else{
            //cookie里有商品

            if(array_key_exists($gid,$cart)){
                //如果添加的商品是已添加过的
                $cart[$gid]['goods_num']+=input('gnum');
                $cart=serialize($cart);
                cookie('cart',$cart);
                return json(['status'=>'success',
                    'msg'=>'添加成功~']);
            }else{
                //添加的商品是购物车里没有的商品
                $cart[$gid]=[
                    'goods_id'=>$gid,
                    'goods_num'=>input('gnum'),
                    'selected'=>1
                ];
                $cart=serialize($cart);
                cookie('cart',$cart);
                return json(['status'=>'success',
                    'msg'=>'添加成功~']);
            }
        }


    }


}