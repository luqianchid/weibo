<?php
/**
 * Created by PhpStorm.
 * User: MyPC
 * Date: 2019/1/9
 * Time: 16:55
 */
namespace app\index\controller;

use \app\index\model\Editor as E;
use think\Session;
use think\Db;
use app\index\controller\Image as I;

class Editor extends Base
{
    public function index(){
        // 渲染富文本页面
        $article = new E();
        $uid = session('uid');
        $art_list = $article->publish($uid);        
        return view('editor/Editor',[
            'artlist'=>$art_list
        ]);
    }
    public function SaveArt(){
        // 保存文章
        if(request()->isPost()){
            $data = input('post.');
            $uname =session('username');
            $uid = session('uid');
            if ($data['title'] == ''){
                $this->error('标题必须填写');
            }
            if ($data['editor']=="<p><br></p>"){
                $this->error("不能发布空文章！");
            }
            $img = new I();
            if($_FILES['cover']['tmp_name']){
                $data['cover'] = $img->upload('upcover','cover');
            }           
       
            $art =[
                'user_id'=>$uid,
                'username'=>$uname,
                'cover'=>$data['cover'],
                'title'=>$data['title'],
                'intro'=>$data['intro'],
                'create_time'=>time(),//创建时间
                'content'=>$data['editor'],
                'type'=>$data['subtype'],               
            ];
            $flag= db('article')->insert($art);
            if ($flag == 1){
                $this->redirect('Editor/index');
            }else{
                $this->error('添加文章失败！请联系管理员','Editor/index',-1,3);
            }
        }
        return 0;
    }
    public function DelArt(){
        // 删除文章
        if (request()->isGet()){
            $artid = input('artid');
            $flag = db('article')->where('aid','=',$artid)->delete();
            if ($flag ==1){
                $this->redirect('Editor/index');
            }else{
                $this->redirect("Editor/index",'',500);
            }
        }
    }
    public function EditArt(){   
        // 编辑文章     
        $artid = input('artid');
        $artlist = new E();
        $uid = session('uid');
        $art_list = $artlist->publish($uid);
        $article = db('article')->where('aid','=',$artid)->select();           
        return view('editor/ArtEdit',[
            'artlist'=>$art_list,
            'article'=>$article
        ]);
    }
    public function saveEdit(){
        // 保存编辑
        if (request()->isPost()){
            $data = input('post.');
            if ($data['title'] == ''){
                $this->error('标题必须填写');
            }
            if ($data['editor']=="<p><br></p>"){
                $this->error("不能发布空文章！");
            }
            $img = new I();
            if($_FILES['cover']['tmp_name']){
                $data['cover'] = $img->upload('upcover','cover');
            }
            
            $artid = $data['id'];
            $art =[
                'title'=>$data['title'],
                'intro'=>$data['intro'],
                'create_time'=>time(),//创建时间
                'content'=>$data['editor'],
                'type'=>$data['subtype'],
                'cover'=>$data['cover']
            ];
            $flag = db('article')->where('aid','=',$artid)->update($art);
            if ($flag != 0){
                $this->redirect('Editor/index');
            }else{
                $this->error('更新失败','Editor/index');
            }
        }
    }

}
