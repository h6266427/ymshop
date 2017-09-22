<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/22
 * Time: 18:36
 */
namespace app\admin\model;

use think\Model;

class Imgs extends Model{


    //images和goods两表联查一条数据
    static public function imagesManGoods($goodsId){
        if(empty($goodsId)){
            return false;
        }
        $data=db('images')
            ->alias('i')
            ->field('g.goods_id,g.goods_name,g.cate_id,
            g.desc,g.content,g.store,g.sell_price,g.market_price,
            g.marketable,g.create_time,g.last_modify_time,m.manager_name,
            g.keywords,g.is_new,i.image_url,i.image_id,i.image_b_url,
            i.image_m_url,i.image_s_url,i.is_face')
            ->join('goods g','i.goods_id=g.goods_id','left')
            ->where('g.goods_id',$goodsId)
            ->join('manager m','m.manager_id=g.last_modify_id','left')
            ->select();

        return $data??false;

    }


    /*
     * 添加图片
     *
     * */

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
            $info = $file->move(ROOT_PATH . 'public'.DS.'static'.DS.'admin' .DS.'images'. DS . 'uploads');
            if($info){
                // 成功上传后 获取上传信息

                //$info->getSaveName();输出日期/文件名；url为根目录的static下的uploads/文件名；
                $url='/static/admin/images/uploads/'.$info->getSaveName();

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

    //图片数据写入数据库图片表
    static public function insertImgTable($data){
        if(empty($data)){
            return false;
        }

        $res=db('images')->insert($data);
        return $res? $res:false;

    }

    /*
     * 设置封面
     *
     * */
    static function setFace($id){
        if (empty($id)){
            return false;
        }
        //判断点击的这条是不是封面
        $img=db('images')->find($id);
        if($img['is_face']==1){
            return ['status'=>'nochanged',
                'msg'=>'该图片已是封面',
                'id'=>$img['goods_id']];
        }else{
            //把所有goods_id等于该图片goods_id的图片都设为不是封面
            $data=db('images')->where('goods_id',$img['goods_id'])->select();
            foreach ($data as $k=>$v){
                if($v['is_face']!=0){
                    $v['is_face']=0;
                    db('images')->update($v);
                };
            };
            $img['is_face']=1;
            $upd=db('images')->update($img);

            return ['status'=>'changed',
                'msg'=>'更改封面成功',
                'id'=>$img['goods_id']];
        }

    }


    /*
     * 删除图片
     *
     * */
    static function delImg($id){
        if (empty($id)){
            return false;
        }
        $image=db('images')->find($id);

        //删除图片
        $o=unlink('.'.$image['image_url']);
        $b=unlink('.'.$image['image_b_url']);
        $m=unlink('.'.$image['image_m_url']);
        $s=unlink('.'.$image['image_s_url']);

       //删数据库图片行
        $del=db('images')->delete($id);
        return $del;
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

}