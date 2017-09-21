<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/20
 * Time: 15:39
 */
namespace app\admin\controller;
use app\admin\model\Cate as CateModel;
use think\Controller;

class Cate extends Controller{

    /*
     * 显示分类列表
     *
     * */
    public function index(){

        //查询数据库 用model
        $res=CateModel::cateList();

        //分配变量给模板
        $this->assign('data',$res);

        return $this->fetch('cate');
    }


    /*
     * 编辑分类列表
     *
     * */
    public function edit(){
        $id=input('id');

        $data=CateModel::edit($id);
        $this->assign('data',$data);

        return $this->fetch();
        //显示编辑界面
    }



    /*
     * 更新分类
     *
     * */
    public function upd(){
        if(request()->isPost()){
            $id=input('id');
            $data=CateModel::findCate($id);
            $data['cate_name']=input('cate_name');

            //验证
            $validate=validate('Cate');
            if(!$validate->scene('edit')->check($data)){
                return $this->error($validate->getError());
            }

            //更新数据库
            $upd=CateModel::updCate($data);
            if($upd){
                return $this->success('更新成功~',url('Cate/index'));
            }else{
                return $this->error('更新失败...');
            }

        }

    }

    /*
     * 添加顶级分类
     *
     * */

    public function addTopCate(){
        if(request()->isPost()){
            //自建一个数组
            $data=['cate_name'=>input('cate_name'),
                'pid'=>0,
                'level'=>0];

            //验证
            $validate=validate('Cate');
            if(!$validate->scene('add')->check($data)){
                return $this->error($validate->getError());
            }

            //插入数据库并返回id
            $res=CateModel::addChidId($data);

            $data['cate_id']=$res;
            $data['path']=$data['cate_id'];

            //更新数据库
            $upd=CateModel::updCate($data);
            if($upd){
                return $this->success('创建顶级分类成功~',url('Cate/index'));
            }else{
                return $this->error('创建顶级分类失败...');
            }

        }

        return $this->fetch();
    }



    /*
     *
     * 添加分类
     *
     * */


    //ADD添加分类按钮
    public function add(){
        //把所有分类分配给add模板

        //按path排列查询所有分类
        $data=CateModel::allOrderByPath();
        //dump($data);exit;

        //把子分类名称前加符号
        foreach ($data as $k=>$v){
            $data[$k]['cate_name']=str_repeat('&nbsp;&nbsp;',$data[$k]['level']).'>>'.$data[$k]['cate_name'];
        }

        //点击提交按钮的处理方法
        if(request()->isPost()) {
            $pid = input('parentid');

            //如果是选择顶级分类，即value=0，则创建一个顶级分类
            if ($pid == 0) {
                $this->addTopCate();
            } else {
                //否则则创建子分类
                $this->addChildCate();
            }

        }


        $this->assign('data',$data);


        return $this->fetch();
    }

    //列表点击添加子分类
    public function addChildCate(){

        if(request()->isPost()){
            $pid=input('parentid');
            //创建一个数组
            $data=['cate_name'=>input('cate_name')];

            //验证
            $validate=validate('Cate');
            if(!$validate->scene('add')->check($data)){
                return $this->error($validate->getError());
            }

            //查看其父类数据；
            $parent=CateModel::findCate($pid);
            $data['level']=$parent['level']+1;
            $data['pid']=$parent['cate_id'];

            //将数据添加进数据库并返回该数据id；
            $childId=CateModel::addChidId($data);

            //添加数组字段
            $data['cate_id']=$childId;
            $data['path']=$parent['path'].",".$childId;
            //更新数据
            $upd=CateModel::updCate($data);
            if($upd){
                return $this->success('添加子分类成功！',url('Cate/index'));
            }else{
                return $this->error('添加子分类失败...');
            }
        }else{
            $id=input('id');
            //查询该id的数据
            $thisOne=CateModel::findCate($id);
            //分配给addChildCate模板
            $this->assign('data',$thisOne);
        }

        return $this->fetch();
    }



    /*
     * 删除分类
     * */
    public function del(){
        $id=input('id');

        //查询该条数据
        $qry=CateModel::findCate($id);

        //查询所有pid等于该数据id的数据；
        $data=CateModel::queryAllInPid($qry['cate_id']);

        if($data!==false){
            //如果查到的数据不为空，则不能删除
            return $this->error('无法删除含有子分类的分类！');
        }else{
            //没有子分类，则可以删除该条数据;
            $res=CateModel::doDel($qry);
            if($res){
                return $this->success('删除成功~',url('Cate/index'));
            }else{
                return $this->error('删除失败...');
            }
        }



    }


}