<?php
namespace app\admin\controller;

use think\Controller;
use app\admin\model\Post as P;
use think\Session;
use think\Db;

// 说说
class Talks extends Base
{
    public function index(){
        // 渲染说说 列表页
        $talk = new P();
        $talkList = $talk->paginate(5);
        return view('talks/index',[
            'talks'=>$talkList
        ]);
    }
    public function del(){
        // 删除说说
        $pid = input('pid');
        $p = new P();
        $res = $p->delpost($pid);
        if ($res == 1){
            $this->redirect('talks/index');
        }else{
            $this->error('删除失败');
        }
    }
}