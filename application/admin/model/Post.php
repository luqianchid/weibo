<?php

namespace app\admin\model;
use think\Model;
use think\Db;
//说说模型
class Post extends Model{
    public function delpost($pid){
        //删除说说
        $Talk = Post::get($pid);
        $res = $Talk->delete($pid);
        $flag = count($res);
        if ($flag == 0){
            return 0;//删除失败
        }else{
            return 1;//删除成功
        }
    }
    

}
