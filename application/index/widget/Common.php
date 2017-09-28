<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/19
 * Time: 22:44
 */
namespace app\index\widget;

use app\index\controller\Base;
use think\Controller;

class Common extends Base {
    public function head(){
        $isLogin=$this->isLogin();
        if(!empty($isLogin)){
            //dump($isLogin);exit;
            $this->assign('user',$isLogin);
        }
        return $this->fetch('common/head');
    }
    public function footer(){
        return $this->fetch('common/footer');
    }
}