<?php
/**
 * Created by PhpStorm.
 * User: MyPC
 * Date: 2019/1/9
 * Time: 17:15
 */
namespace app\index\model;
use think\Model;
use think\Db;
use think\Session;
class Editor extends Model
{
    // 文章模型
    public function publish($uid){
        //已发布文章列表
        $articles = Db::name('article')->where('user_id','=',$uid)->order('create_time desc')->select();//查询数据库中的文章
        return $articles;
    }

}
