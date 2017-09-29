<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/29
 * Time: 10:02
 */
namespace app\index\model;
use think\Model;

class Goods extends Model{

    //根据商品id查出商品信息
    static public function getGoodsMsg($goodsId){
        if (empty($goodsId)){
            return false;
        }
        $data=db('goods')->find($goodsId);
        return $data??false;


    }


}