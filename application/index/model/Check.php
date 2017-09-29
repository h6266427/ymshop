<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/27
 * Time: 15:37
 */
namespace app\index\model;
use think\Model;

class Check extends Model{

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
            ->where(['c.user_id'=>$userId,'i.is_face'=>1,'c.selected'=>1])
            ->select();
        if(!empty($data)){
            return $data;
        }
        return false;

    }



    static public function allSheng(){
        $data = db('area')->where(array('parent_id'=>1))->select();
        return $data;
    }
    static public function sheng(){

    }


    //已登录状态下根据user_id查出该用户的地址信息
    static public function userAddress($userId){
        if (empty($userId)){
            return false;
        }

        $addrData=db('address')->where('user_id',$userId)->select();
        if (!empty($addrData)){
            return $addrData;
        }
        return false;

    }

    //根据addr_id查出该条地址信息
    static public function queryAddr($addrId){
        if (empty($addrId)){
            return false;
        }

        $addrData=db('address')->find($addrId);
        if (!empty($addrData)){
            return $addrData;
        }
        return false;

    }
}