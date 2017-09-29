<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/25
 * Time: 10:56
 */
namespace app\index\controller;
use app\index\model\Goods as GoodsModel;
use think\Controller;

class Goods extends Controller{
    public function index(){

        $goodsId=input('goods_id');
        //根据商品id查出商品信息
        $data=GoodsModel::getGoodsMsg($goodsId);
        $this->assign('data',$data);

        return $this->fetch();
    }

}