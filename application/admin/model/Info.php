<?php
namespace app\admin\model;
use think\Model;
use think\Db;
//公告模型
class Info extends Model{
    public function delInfo($Iid){
        // 删除公告
        $Info = Info::get($Iid);
        $res = $Info->delete($Iid);
        $flag = count($res);
        if ($flag == 0){
            return 0;//删除失败
        }else{
            return 1;//删除成功
        }
    }   
    public function addInfo($data) {
        // 添加公告
        $title = $data['title'];
        $admin_name = session('adminname');
        $admin_id = session('adminid');
        $content = $data['content'];
        $I= new Info;
        $I->data([
            'title' => $title,
            'content' => $content,
            'create_time' => time(),
            'admin_id' => $admin_id,
            'admin_name' => $admin_name
        ]);
        $res = $I->save();
        if ($res){
            return 1;
        }else{
            return 0;
        }
    }
    public function saveInfo($infoid,$data){
        // 保存公告
        $editinfo = Info::get($infoid);
        $title = $data['title'];
        $admin_name = session('adminname');
        $admin_id = session('adminid');
        $content = $data['content'];
        $editinfo->data([
            'title' => $title,
            'content' => $content,
            'create_time' => time(),
            'admin_id' => $admin_id,
            'admin_name' => $admin_name
        ]);
        $res = $editinfo->save();
        if ($res){
            return 1;
        }else{
            return 0;
        }
        
    }

}
