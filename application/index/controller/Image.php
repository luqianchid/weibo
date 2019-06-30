<?php
namespace app\index\controller;
use app\index\model\User;
use think\Session;
use think\Db;
//创建一个类TestImage，继承基类Controller
class Image extends Base
{

    public function index(){
        //判断是否是post 方法提交的
        if(request()->isPost()){
			$data=input('post.');
			$uid = session('uid');
            //处理图片上传
            //提交时在浏览器存储的临时文件名称
            if($_FILES['image']['tmp_name']){
                $data['image']=$this->upload('uploads','image');
            }            
            $add=db('user')->where('id','=',$uid)->update(['avatar'=>$data['image']]);
            if($add){
                //如果添加成功，提示添加成功。success也可以定义跳转链接，success('添加图片成功！','这里写人跳转的url')
                $this->success('修改头像成功！');
            }else{
                $this->error('添加图片失败！');
            }
            return;
		}
		$uid = session('uid');
        $user = new User();
        $userInfo =$user->MyInfo($uid);
        $recent_post = db('post')
                ->alias('p')
                ->join('user u','p.user_id = u.id','left')
                ->limit('3')->select();
        $user = db('user')->where('id','=',$uid)->select();
        $res = db('user')->where('id','=',$uid)->select();
        return view('index/headimg',[
            'userInfo'=>$userInfo,
            'hot_topic'=>$recent_post,
            'userid'=>$uid,
            'user'=>$user,
            'res'=>$res
        ]); 
        
    }
 
    //上传图片函数
    public function upload($filepath,$postname){
        // 获取表单上传的文件，例如上传了一张图片
        $file = request()->file($postname);
        if($file){
            //转移图片 / 
            $info = $file->move(ROOT_PATH . 'public' . DS . 'static'. DS .$filepath);
            if($info){
                return $info->getSaveName();
            }else{
                // 上传失败获取错误信息
                echo $file->getError();die;
            }
        }
    }    
}
