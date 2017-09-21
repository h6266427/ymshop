<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/21
 * Time: 12:23
 */
namespace app\admin\model;

use think\Model;

class Goods extends Model{


    //获取商品列表
    static public function goodsList(){
        $data=db('goods')->order('marketable desc,cate_id,goods_id')->paginate();
        return $data?$data:false;

    }

    /*
     * 公共方法
     *
     * */

    //输入id查找该条商品数据
    static public function goodById($id){
        if (empty($id)){
            return false;
        }
        $data=db('goods')->find($id);
        return $data?$data:false;
    }

    //输入id更新该条商品数据
    static public function updGood($data){
        if (empty($data)){
            return false;
        }
        $res=db('goods')->update($data);
        return $res;

    }




}