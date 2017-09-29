<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/27
 * Time: 15:37
 */
namespace app\index\model;
use think\Model;

class Check extends Model{
    static public function allSheng(){
        $data = db('area')->where(array('parent_id'=>1))->select();
        return $data;
    }
    static public function sheng(){

    }
}