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

        return $data;
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

    static public function getUserById($id){
        if (!$id){
            return false;
        }
        //查出数据
        $data = db('cate')->find($id);
        return $data??false;

    }

}