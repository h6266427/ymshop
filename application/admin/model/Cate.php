<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/20
 * Time: 15:39
 */
namespace app\admin\model;

use think\Model;

class Cate extends Model{

    static public function cateList(){

        $data=db('cate')->order('path')->paginate(8);
        $page=$data->render();
        $data=$data->all();

        //dump($data);exit;
        foreach ($data as $k=>$v){
           $data[$k]['cate_name']=str_repeat('--',$v['level']).$v['cate_name'];
        }

        $res=[
            'data'=>$data,
            'page'=>$page
        ];

        return $res;
    }


    /*
     * 编辑分类
     * */
    static public function edit($id){
        if(empty($id)){
            return false;
        }

        //查询点击的该条数据
        $data=db('cate')->find($id);
        if($data){
            return $data;
        }else{
            return false;
        }

    }




    /*
     * 添加子分类
     *
     * */
    //插入一条数据并返回数据id
    static public function addChidId($data){
        if(empty($data)){
            return false;
        }
        //在数据库中创建一条数据并返回该数据id
        $res=db('cate')->insertGetId($data);
        if($res){
            return $res;
        }else{
            return false;
        }
    }

    /*
     * 更新数据
     * */
    static public function updCate($data){
        if(!$data){
            return false;
        }
        $res=db('cate')->update($data);
        return $res;

    }

    //通过id查看该条数据
    static function findCate($id){
        if(empty($id)){
            return false;
        }
        $data=db('cate')->find($id);
        if($data){
            return $data;
        }else{
            return false;
        }
    }


    /*
     * 删除分类
     *
     * */

    //查询所有符合pid的数据;
    static function queryAllInPid($id){
        if(empty($id)){
            return false;
        }
        $data=db('Cate')->where('pid',$id)->select();
        if($data){
            return $data;
        }else{
            return false;
        }
    }

    //从数据库中删除该条数据
    static function doDel($data){
        if(empty($data)){
            return false;
        }
        //删除此条数据
        $del=db('Cate')->delete($data);
        return $del;

    }


    //查询Cate表里所有符合条件的数据
    //传参为条件
    static function allCate($condit){
        $data=db('Cate')->where($condit)->select();
        if ($data){
            return $data;
        }else{
            return false;
        }
    }

}