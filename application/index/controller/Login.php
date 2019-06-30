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
class Login extends Controller
{
    public function index()
    {
        if (request()->isPost()) {
            $User = new User();
            $data = input('post.');
            $num = $User->login($data);
            if ($num == 3) {
                $this->redirect('index/index');
            } else {
                $this->redirect('index/login');
            }

        }
        return $this->fetch('login/Login');
    }
}
