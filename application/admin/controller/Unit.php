<?php
namespace app\admin\controller;

use think\Controller;
use app\admin\model\Unit as U;
use think\Session;
use think\Db;

class Unit extends Base
{
    // 栏目
    public function index(){
        $u = new U();
        $unitList = $u->paginate(5);
        return view('unit/index',[
            'unit'=>$unitList
        ]);
    }
    public function del(){
        $cateid = input('get.cateid');
        $u = new U();
        $res = $u->delcate($cateid);
        if ($res == 1){
            $this->redirect('unit/index');
        }else{
            $this->error('删除失败');
        }
    }
    public function unitadd(){
        // 渲染栏目添加
        if(request()->isPost()){
            $unit = new U();
            $data = input('post.');
            if ($data['catename'] == ''){
                $this->error('栏目名称必须填写');
            }    
            $res = $unit->addUnit($data);
            if ($res==1){
                $this->redirect('unit/index');
            }else{
                $this->error('添加失败');
            }
        }      
        return view('unit/add');
    }
    public function unitedit(){
        //渲染栏目编辑页面
        $unitid = input('get.cateid');
        $u = new U();
        $unit = $u->where('cateid','=',$unitid)->select();
        return view('unit/edit',[
            'unit'=>$unit,
        ]);
    }
    public function saveunit(){
        //保存编辑
        if (request()->isPost()){            
            $unit = new U();
            $data = input('post.');           
            $uid = $data['uid'];
            if ($data['catename'] == ''){
                $this->error('栏目名称必须填写');
            }            
            $res = $unit->saveunit($uid,$data);//调用模型的保存修改方法            
            if ($res==1){
                $this->redirect('unit/index');
            }else{
                $this->error('添加失败');
            }
        }       
    }
}