<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/26
 * Time: 19:08
 */
namespace app\index\model;

use think\Model;

class Index extends Model{

    static public function goodsList(){
        //两表联查出商品/图片数据
        $goodsData=db('goods')
            ->alias('g')
            ->field('g.goods_id,g.goods_name,g.sell_price,g.store,g.keywords,g.desc,g.marketable,g.status,g.is_hot,g.is_new,
            i.image_id,i.image_url,i.image_m_url,i.is_face')
            ->join('images i','i.goods_id=g.goods_id','left')
            ->where('i.is_face',1)
            ->order('g.is_hot desc,g.is_new desc,g.cate_id,g.goods_id')
            ->limit(8)
            ->select();

        if(empty($goodsData)){
            return false;
        }
        return $goodsData;



    }


}