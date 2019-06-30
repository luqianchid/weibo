<?php

namespace app\admin\model;
use think\Model;
use think\Db;
//栏目模型
class Unit extends Model{
    public function delcate($cateid){
        //删除栏目
        $unit = Unit::get($cateid);
        $res = $unit->delete($cateid);
        $flag = count($res);
        if ($flag == 0){
            return 0;//删除失败
        }else{
            return 1;//删除成功
        }
    }
    public function addUnit($data){
        //添加栏目
        $catename = $data['catename'];
        $u = new Unit;
        $u->data([
            'catename'=>$catename,
        ]);
        $res = $u->save();
        if($res){
            return 1;
        }else{
            return 0;
        }
    }
    //保存栏目
    public function saveunit($uid,$data){
        $catename = $data['catename'];
        $unit = Unit::get($uid);//获取
        $unit->data([
            'catename'=>$catename,
        ]);
        $res = $unit->save();
        if($res){
            return 1;
        }else{
            return 0;
        }
    }

}  
