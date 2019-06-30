<?php
namespace app\admin\controller;

use think\Controller;
use app\admin\model\Info as I;

// 公告
class Info extends Base{

    public function index(){        
        $infolist =db('info')->paginate(5);
        return view('info/index',[
            'infos'=>$infolist,
        ]);
    }
    public function del(){
        $infoid = input('infoid');
        $I= new I();
        $res = $I->delInfo($infoid);
        if ($res == 1){
            $this->redirect('info/index');
        }else{
            $this->error('删除失败');
        }
    }
    public function add(){       
        if(request()->isPost()){
            $data = input('post.');
            $info = new I();
            $res = $info->addInfo($data);
            if ($res==1){
                $this->redirect('info/index');
            }else{
                $this->error('发布失败');
            }
        }        
        return view('info/add');
    }
    public function edit(){
        $editid = input('infoid');
        $info = new I();
        $editinfo = $info->where('infoid','=',$editid)->select();
        return view('info/edit',[
            'editinfo' => $editinfo,
        ]);        
    }
    public function saveedit(){
        
        if (request()->isPost()){            
            $info = new I();
            $data = input('post.');           
            $infoid = $data['infoid'];
            if ($data['title'] == ''){
                $this->error('标题必须填写');
            }
            if ($data['content']==""){
                $this->error("不能发布空文章！");
            }
            $res = $info->saveInfo($infoid,$data);//保存修改            
            if ($res==1){
                $this->redirect('info/index');
            }else{
                $this->error('发布失败');
            }
        }        
    }
   
}