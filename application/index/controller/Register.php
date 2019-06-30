<?php
/**
 * Created by PhpStorm.
 * User: MyPC
 * Date: 2019/1/1
 * Time: 13:56
 */
namespace app\index\controller;
use think\Controller;
use app\index\model\User;
class Register extends Controller
{
    public function index()    {
        if(request()->isPost()){
            $data=[
                'username' => input("username"),
                'password' => input("password"),
                'email'=> input("email"),
                'phone'=>input("phone"),
                'create_time'=>time(),
            ];
            $user = new User();
            $res =$user->register($data);
            if ($res == 1 ){
                return $this->redirect('/index/Login');
            }else{
                return $this->redirect("/index/Register");
            }
        }
        return $this->fetch('login/Register');
    }
}
