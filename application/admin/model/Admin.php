<?php

namespace app\admin\model;
use think\Model;
use think\Db;


class Admin extends Model{
    public function login($data){//登陆验证
        $user=Db::name('admin')->where('adminname','=',$data['adminname'])->find();//查询用户名是否存在
        if($user){
            if($user['password'] == md5($data['password'])){
                session('adminname',$user['adminname']);
                session('adminid',$user['admin_id']);
                return 3; //信息正确
            }else{
                return 2; //密码错误
            }
        }else{
            return 1; //用户不存在
        }
    }
}