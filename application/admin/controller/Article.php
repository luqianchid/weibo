<?php
namespace app\admin\controller;

use think\Controller;
use app\admin\model\Article as At;
use think\Session;
use think\Db;

class Article extends Base
{
    public function index(){
        // 渲染文章管理列表
        $artlist = db('article')->order('aid desc')->paginate(5);
        return view('article/article',[
            'artlist'=>$artlist,
        ]);
    }
    public function del(){
        // 删除文章
        $aid = input('aid');
        $at = new At();
        $res = $at->del($aid);
        if ($res == 1){
            $this->redirect('Article/index');
        }else{
            $this->error('删除失败');
        }
    }
}