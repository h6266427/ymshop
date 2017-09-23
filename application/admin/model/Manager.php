<?php
namespace app\admin\model;
use think\Model;
class Manager extends Model{
    static public function managerList($data){
        $res = db('manager')->insert($data);
        return $res;
    }
    static public function checkList(){
        $data = db('manager')->paginate(3);
        return $data;
    }
    static public function delList($manager_id){
        $res = db('manager')->delete($manager_id);
        return $res;
    }
    static public function editList($data){
        $res = db('manager')->find($data);
        return $res;
    }
    static public function updList($data){
        $res = db('manager')->update($data);
        return $res;
    }

}