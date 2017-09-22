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


    //首页处理方法
    static public function goodsList(){
        //三表联查出商品数据、分类名称，管理员名称
        $goodsData=db('goods')
            ->alias('g')
            ->field('g.*,c.cate_id cid,c.cate_name,m.manager_name')
            ->join('cate c','c.cate_id=g.cate_id','left')
            ->join('manager m','g.last_modify_id=m.manager_id','left')
            ->order('g.marketable desc,g.cate_id,g.goods_id')
            ->paginate(8);

        $page=$goodsData->render();

        $data=$goodsData->all();

        $all=[
            'data'=>$data,
            'page'=>$page
        ];
        if(empty($all)){
            return false;
        }
        return $all;
    }


    /*
     * 添加商品
     *
     * */

    //查询所有pid=cate_id的分类数据
    static public function disableCate(){
        $data=db('cate')->order('path')->select();


        //添加disable键判断该分类是否可用

        foreach($data as $k=>$v){
            //$v['cate_id']
            foreach ($data as $kk=>$vv){
                if ($v['cate_id']==$vv['pid']){
                    $data[$k]['disabled'] = 'disabled';
                    break;
                }else{
                    $data[$k]['disabled']='abled';
                }
            }
        }
        return $data;

    }






    /*
     * 公共方法
     *
     * */

    //查询Cate表里所有符合条件的数据
    //传参为条件
    static function allCate($condit){
        if(!$condit){
            $data = db('Cate')->select();
            return $data? $data:false;
        }

        $data = db('Cate')->where($condit)->select();
        return $data? $data:false;
    }

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

    //按path排序查询所有分类
    static public function allCaterByPath(){
        $all=db('Cate')->order('path')->select();
        return $all?$all:false;
    }


}