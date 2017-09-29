<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/26
 * Time: 11:51
 */
namespace app\index\model;

use think\Model;

class Cart extends Model{

    //用user_id查询购物车数据
    static public function cartById($userId){
        if(empty($userId)){
            return false;
        }
        $data=db('cart')->where('user_id',$userId)->select();

        if(!empty($data)){
            return $data;
        }
        return false;

    }






    static public function checkCartList($userId){
        if(empty($userId)){
            return false;
        }
        //三表联查
        $data=db('cart')
            ->alias('c')
            ->field('c.user_id,c.goods_id,c.goods_num,c.selected,
            g.goods_name,g.keywords,g.sell_price,
            i.image_s_url')
            ->join('goods g','g.goods_id=c.goods_id','left')
            ->join('images i','i.goods_id=c.goods_id','left')
            ->where(['c.user_id'=>$userId,'i.is_face'=>1])
            ->select();
        if(!empty($data)){
            return $data;
        }
        return false;

    }

    //两表联查出商品、图片数据
    static public function cartData($goods_id){
        if(empty($goods_id)){
            return false;
        }
        $cartData=db('goods')
            ->alias('g')
            ->field('g.goods_id,g.goods_name,g.sell_price,i.image_s_url')
            ->join('images i','i.goods_id=g.goods_id','left')
            //->join('cart c','c.goods_id=g.goods_id','left')
            ->where('i.is_face',1)
            ->find($goods_id);
        return $cartData??false;

    }


    //往cart表里插入数据
    static public function insertCart($data){
        if (empty($data)){
            return false;
        }
        $res=db('cart')->insert($data);
        return $res??false;
    }

    //更新数据
    static public function updCart($data){
        if (empty($data)){
            return false;
        }
        $res=db('cart')->update($data);
        return $res??false;
    }




}