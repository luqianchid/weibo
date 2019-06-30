<?php
/**
 * Created by PhpStorm.
 * User: MyPC
 * Date: 2019/1/1
 * Time: 13:56
 */
namespace app\index\controller;
use think\Controller;
class Base extends Controller
{
    public function _initialize(){
        // 登陆验证
        if(!session('username')){
            $this->redirect('Login/index');
        }
    }
    
}
