<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/21
 * Time: 12:20
 */
namespace app\admin\controller;

use think\Controller;
use app\admin\model\Goods as GoodsModel;

class Goods extends Controller{

    /*获取商品列表
    */
    public function index(){

        $data=GoodsModel::goodsList();
        $this->assign('data',$data);

        //

        return $this->fetch('goods');
    }



    /*
     * 商品上下架
     *
     * */
    public function marketable(){
        $gid=input('id');
        $data=GoodsModel::goodById($gid);
        //判断上下架状态
        if($data['marketable']==0){
            $data['marketable']=1;

            //验证
            $validate=validate('Goods');
            if(!$validate->scene('edit')->check($data)){
                return $this->error($validate->getError());
            }

            //更新数据库
            $res=GoodsModel::updGood($data);
            if ($res!==false){
                return $this->success('上架成功~',url('Goods/index'));
            }else{
                return $this->error('上架失败...');
            }
        }else{
            $data['marketable']=0;

            //验证
            $validate=validate('Goods');
            if(!$validate->scene('edit')->check($data)){
                return $this->error($validate->getError());
            }

            //更新数据库
            $res=GoodsModel::updGood($data);
            if ($res!==false){
                return $this->success('下架成功~',url('Goods/index'));
            }else{
                return $this->error('下架失败...');
            }
        }
    }








}