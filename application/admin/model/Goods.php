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
            ->field('g.goods_id,g.goods_name,g.sell_price,g.store,g.keywords,g.desc,g.content,g.create_time,g.last_modify_time,g.marketable,g.status,g.is_hot,g.is_new,c.cate_id cid,c.cate_name,m.manager_name,i.image_id,i.image_url')
            ->join('cate c','c.cate_id=g.cate_id','left')
            ->join('manager m','g.last_modify_id=m.manager_id','left')
            ->join('images i','i.goods_id=g.goods_id','left')
            ->where('i.is_face',1)
            ->order('g.status,g.marketable desc,g.cate_id,g.goods_id')
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
     *
     * 处理图片上传
     */
    static public function upload($fileName){
        // 获取表单上传文件 例如上传了001.jpg
        $file = request()->file($fileName);

        // 移动到框架应用根目录/public/uploads/ 目录下
        if($file){
            //移动到应用框架的根目录的public/uploads/日期/文件夹下；
            $info = $file->move(ROOT_PATH . 'public'.DS.'static'.DS.'admin' .DS.'imgs'. DS . 'uploads');
            if($info){
                // 成功上传后 获取上传信息

                //$info->getSaveName();输出日期/文件名；url为根目录的static下的uploads/文件名；
                $url='/static/admin/imgs/uploads/'.$info->getSaveName();

                //将字符‘\’转化为‘/’；
                $url=str_replace('\\','/',$url);
                //dump($url);exit;
                return ['status'=>'success',
                    'url'=>$url];

            }else{
                // 上传失败获取错误信息
                return ['status'=>'error',
                    'msg'=>$file->getError()];
            }
        }

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

    //插入一条数据并返回数据id
    static public function addGoodId($data)
    {
        if (empty($data)) {
            return false;
        }
        //在数据库中创建一条数据并返回该数据id
        $res = db('goods')->insertGetId($data);
        return $res ? $res : false;
    }

    //图片数据写入数据库图片表
    static public function insertImgTable($data){
        if(empty($data)){
            return false;
        }

        $res=db('images')->insert($data);
        return $res? $res:false;

    }



}