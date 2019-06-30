<?php

namespace app\admin\model;
use think\Model;
use think\Db;
//文章模型
class Article extends Model{
    public function del($aid){
        $Art = Article::get($aid);
        $res = $Art->delete($aid);
        $flag = count($res);
        if ($flag == 0){
            return 0;//删除失败
        }else{
            return 1;//删除成功
        }
    }

}
