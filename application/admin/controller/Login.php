<?php
/**
 * Created by PhpStorm.
 * User: MyPC
 * Date: 2019/1/1
 * Time: 13:56
 */
namespace app\admin\controller;
use think\Controller;
use app\admin\model\Admin;
class Login extends Controller
{
    public function index()
    {
        //渲染登陆页面
        if (request()->isPost()) {
            // 处理提交数据
            $admin = new Admin();
            $data = input('post.');
            $num = $admin->login($data);           
            if ($num == 3) {
                $this->redirect('Admin/index');
            }else {
                $this->error('用户名或密码错误');
            }
        }
        return view('login/login');
    }
}
