<?php

namespace app\index\model;
use think\Model;

class Article extends Model{

    public function getRecent($user_id){    //获取用户最近发布             
        $focuslist = db('focus')//查询当前用户的关注
            ->where('user_id', '=', $user_id)                
            ->field('focus_id')
            ->select();
        $list = [];
        foreach($focuslist as $f){
            array_push($list,$f['focus_id']);
        }        
        $topic = db('article')
            ->where(['user_id'=>['in',$list]])
            ->order('create_time','desc')
            ->limit(5)->select();//获取我的关注发布的文章，按时间降序
        $list = db('article')
            ->where(['user_id'=>['in',$list]])
            ->order('create_time','desc')
            ->paginate(4);//获取我的关注发布的文章，按时间降序
        return ['topic'=>$topic,'list'=>$list];        
    }
}
