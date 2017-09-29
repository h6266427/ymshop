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

        //dump($data['cateData']);exit;
        //把商品数据返给模板
        $this->assign('data',$data['data']);
        //把商品分页返给数组；
        $this->assign('page',$data['page']);


        return $this->fetch('goods');
    }

    /*
     * 添加商品
     *
     * */
    public function add(){

        //获取分类列表
        $cateData=GoodsModel::disableCate();

        foreach ($cateData as $k=>$v){
            $cateData[$k]['cate_name']=str_repeat('&nbsp;&nbsp;',$cateData[$k]['level']).'>>'.$cateData[$k]['cate_name'];
        }
        $this->assign('cateData',$cateData);

        if (request()->isPost()){
            if (empty($_FILES['pic']['tmp_name'])){
                return $this->error('必须添加一张封面图片！');
            }else{
                $data=[
                    'goods_name'=>input('goods_name'),
                    'cate_id'=>input('cate_id'),
                    'keywords'=>input('keywords'),
                    'desc'=>input('desc'),
                    'content'=>input('content'),
                    'market_price'=>input('market_price'),
                    'sell_price'=>input('sell_price'),
                    'store'=>input('store'),
                    'create_time'=>time()
                ];

                //判断是否上架
                if(input('marketable')=='on'){
                    $data['marketable']=1;
                }else{
                    $data['marketable']=0;
                }

                //判断是否推荐上新
                if (input('is_new')=='on'){
                    $data['is_new']=1;
                }else{
                    $data['is_new']=0;
                }


                //判断是哪个管理员添加的,填写last_modify_id字段
                $data['last_modify_id']=input('manager_id');

                //验证
                $validate=validate('Goods');
                if (!$validate->scene('add')->check($data)){
                    return $this->error($validate->getError());
                }

                //写入数据库商品表
                //获取添加的商品数据的goods_id;
                $res=GoodsModel::addGoodId($data);

                //处理图片表
                if($_FILES['pic']['tmp_name']!=''){

                    //处理图片
                    $arr=GoodsModel::upload('pic');

                    //判断是否保存图片成功；
                    if($arr['status']=='success'){
                        //成功
                        $imgs=[
                            'image_url'=>$arr['url'],
                            'is_face'=>1,
                            'goods_id'=>$res,
                        ];

                        $imgName=basename($imgs['image_url']);
                        $dirName=dirname($imgs['image_url']);

                        //图片缩放
                        $image = \think\Image::open('.'.$imgs['image_url']);

                        // 按照原图的比例生成一个最大为650*650的缩略图并保存为$imgName;
                        //650*650
                        $image->thumb(650, 650)->save('.'.$dirName.'/b_'.$imgName);
                        //250*250
                        $image->thumb(250, 250)->save('.'.$dirName.'/m_'.$imgName);
                        //60*60
                        $image->thumb(60, 60)->save('.'.$dirName.'/s_'.$imgName);

                        //缩放完成编写字段
                        $imgs['image_b_url']=$dirName.'/b_'.$imgName;
                        $imgs['image_m_url']=$dirName.'/m_'.$imgName;
                        $imgs['image_s_url']=$dirName.'/s_'.$imgName;

                        //写入数据库images表;
                        $insert=GoodsModel::insertImgTable($imgs);
                        if($insert){



                            return $this->success('添加商品成功~',url('Goods/index'));
                        }else{
                            return $this->error('添加商品失败...');
                        }

                    }else{
                        return $this->error($arr['msg']);
                    }
                }
            }
        }

        return $this->fetch();
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
            //正在下架中，改为上架
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
            //正在上架，要改成下架

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

    /*
     *
     * 编辑商品
     * */
    public function edit(){

        //获取分类列表
        $cateData=GoodsModel::disableCate();

        foreach ($cateData as $k=>$v){
            $cateData[$k]['cate_name']=str_repeat('&nbsp;&nbsp;',$cateData[$k]['level']).'>>'.$cateData[$k]['cate_name'];
        }
        $this->assign('cateData',$cateData);

        //分配该条商品数据到模板
        $id=input('id');
        $data=GoodsModel::goodById($id);
        $this->assign('data',$data);

        if (request()->isPost()){
            $data=[
                'goods_id'=>input('goods_id'),
                'goods_name'=>input('goods_name'),
                'cate_id'=>input('cate_id'),
                'keywords'=>input('keywords'),
                'desc'=>input('desc'),
                'content'=>input('content'),
                'market_price'=>input('market_price'),
                'sell_price'=>input('sell_price'),
                'store'=>input('store'),
                'last_modify_time'=>time(),
                'last_modify_id'=>input('manager_id')
            ];

            //判断是否上架
            if(input('marketable')=='on'){
                $data['marketable']=1;
            }else{
                $data['marketable']=0;
            }

            //判断是否推荐上新
            if (input('is_new')=='on'){
                $data['is_new']=1;
            }else{
                $data['is_new']=0;
            }

            //判断是否设置热销
            if (input('is_hot')=='on'){
                $data['is_hot']=1;
            }else{
                $data['is_hot']=0;
            }

            //验证
            $validate=validate('Goods');
            if(!$validate->scene('edit')->check($data)){
                return $this->error($validate->getError());
            }

            //更新数据库
            $res=GoodsModel::updGood($data);
            if ($res!==false){
                return $this->success('更新商品成功~',url('Goods/index'));
            }else{
                return $this->error('更新商品失败...');
            }

        }
        return $this->fetch();
    }


    /*
     * 删除商品
     * */

    public function del(){
        $id=input('id');

        $data=GoodsModel::goodById($id);
        if ($data!=false){
            $data['status']=1;
            $upd=GoodsModel::updGood($data);
            if ($upd){
                return $this->success('删除商品成功',url('Goods/index'));
            }else{
                return $this->error('删除商品失败...');
            }
        }
    }

    /*
    * 撤销删除
    * */

    public function cancelDel(){
        $id=input('id');
        $data=GoodsModel::goodById($id);
        if ($data!=false){
            $data['status']=0;
            $upd=GoodsModel::updGood($data);
            if ($upd){
                return $this->success('撤销删除成功',url('Goods/index'));
            }else{
                return $this->error('撤销删除失败...');
            }
        }
    }







}