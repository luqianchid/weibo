<?php
namespace app\admin\controller;

use think\Controller;
use app\admin\model\Admin as Ad;
use think\Session;
use think\Db;

class Admin extends Base
{
    public function index(){
        // 渲染管理员列表界面
        $adminlist = db('admin')->field('admin_id,adminname,add_time')->paginate(3);
        return view('admin/index',[
            'admin'=>$adminlist,
        ]);
    }
    public function editadmin(){
        // 编辑管理员
        $admin_id = input('get.adminid');
        $admin = db('admin')->where('admin_id','=',$admin_id)->select();
        if(request()->isPost()){
            $adminname = input('post.adminname');
            $password = input('post.password');
            $res = db('admin')->where('admin_id','=',$admin_id)->update(['adminname'=>$adminname,'password'=>md5($password)]);
            if(count($res)==1){
                $this->redirect('admin/index');
            }else{
                $this->error('修改失败');
            }
            
        }
        return view('admin/edit',[
            'admin'=>$admin,
        ]);
    }
    public function addadmin(){
        // 添加管理员
        if(request()->isPost()){
            $adminname = input('post.adminname');//获取admin名称
            $password = input('post.password');//密码
            $time = time();
            $res = db('admin')->insert(['adminname'=>$adminname,'password'=>md5($password),'add_time'=>$time]);//加密插入
            if(count($res)==1){
                $this->redirect('admin/index');
            }else{
                $this->error('修改失败');
            }
        }
        return view('admin/add');
    }
    public function deladmin(){
        // 删除管理员
        $adminid = input('get.adminid');
        $res = db('admin')->where('admin_id','=',$adminid)->select();
        if (count($res) == 0){
            $this->error('不存在的管理员');
        }else{
            $res = db('admin')->where('admin_id','=',$adminid)->delete();
            if(count($res)!=0){
                $this->redirect('admin/index');
            }else{
                $this->error('删除失败');
            }
        }
    }
    public function logout(){
        // 退出登陆
        $_SESSION = array();  
        if(isset($_COOKIE[session_name()])){  
            setcookie(session_name(),'',time()-1);
        }        
        session_destroy();
        $this->success('您已退出登陆','Login/index');
    }

}