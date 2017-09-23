<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/21
 * Time: 21:15
 */
namespace app\admin\model;

use think\Model;

class User extends Model{
    /*
     * 查出所有用户
     * */
    static public function allUser(){
        $data = db('user')->order('lock')->paginate(8);
        $page =  $data->render();
        //拿出所有数据，返回二/**/维数组
        $data = $data->all();
        return [
            'data'=>$data,
            'page'=>$page
        ];
    }
    /*
   * 修改冻结状态
   *
   * */
    static public function editUserLock(){

    }
    /*
     *
     * 根据user的id查询一条数据
     * */

    static public function getUserById($user_id){
        if (!$user_id){
            return false;
        }
        //查出数据
        $data = db('user')->find($user_id);
        return $data??false;

    }
    public static function lockUser($data){
        if (empty($data)){
            return false;
        }
        //修改数据
        $res = db('user')->update($data);
        return $res!==false?true:false;
    }
    static public function delUser($data){
        //回应
        $response=[
            //创建一个判断条件
            'status'=>'error',
            'msg'=>''
        ];
        if (!$data['lock']){
            $response['msg']='只有被冻结的用户才能进行永久冻结';
            return $response;
        }else{
            $res = db('user')->update($data);
            $response['status']='success';
            $response['msg']='该用户已永久冻结';
            return $response;
        }
    }

}