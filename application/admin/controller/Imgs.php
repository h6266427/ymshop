<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/22
 * Time: 18:18
 */
namespace app\admin\controller;

use think\Controller;
use app\admin\model\Imgs as ImgsModel;
class Imgs extends Controller{

    /*
     * 首页
     * */
    public function index(){
        $id=input('id');

        //images和goods和manager三表联查
        $data=ImgsModel::imagesManGoods($id);

        $this->assign('data',$data);

        return $this->fetch('imgs');
    }


    /*
     * 添加图片
     * */
    public function add(){

        $gid=input('id');
        $this->assign('gid',$gid);

        if (request()->isPost()){
            //处理图片表
            if($_FILES['pic']['tmp_name']!=''){
                $id=input('id');

                //处理图片
                $arr=ImgsModel::upload('pic');

                //判断是否保存图片成功；
                if($arr['status']=='success'){
                    //成功
                    $imgs=[
                        'image_url'=>$arr['url'],
                        'is_face'=>0,
                        'goods_id'=>$id,
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
                    $insert=ImgsModel::insertImgTable($imgs);
                    if($insert){
                        return $this->success('添加图片成功~',url('Goods/index'));
                    }else{
                        return $this->error('添加图片失败...');
                    }
                }else{
                    return $this->error($arr['msg']);
                }
            }


        }


        return $this->fetch();
    }


    /*
     * 设置封面
     *
     * */

    public function setFace(){
        $id=input('id');
        $res=ImgsModel::setFace($id);
        if($res['status']=='changed'){
            return $this->success($res['msg'],url('Imgs/index',['id'=>$res['id']]));
        }else{
            return $this->error($res['msg'],url('Imgs/index',['id'=>$res['id']]));
        }
    }

    /*
     * 删除图片
     *
     * */
    public function del(){
        $iId=input('id');

        $del=ImgsModel::delImg($iId);

        if ($del){
            return $this->success('删除图片成功~',url('Imgs/index',['id'=>$iId]));
        }
        return $this->error('删除图片失败...');

    }

}