<?php
namespace app\admin\controller;

use think\Controller;
use app\admin\model\Admin;
use think\Session;

class Base extends Controller
{
    public function _initialize(){
        // 初始化 判断登陆
        if(!session('adminname')){
            $this->redirect('Login/index');
        }
    }
}
