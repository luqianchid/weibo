<?php

namespace app\index\controller;
use think\Controller;
use think\Db;
use app\index\model\User;
use app\index\model\Article as A;

use think\Session;
class Article extends Controller
{
    public function index(){//文章详情页        
            $artid =input('artid');
            $article = db('article')->alias('a')->where('aid','=',$artid)->join('user u','u.id=a.user_id','left')->field('u.username,a.*')->select();
            $map['aid'] = array('neq',$artid);
            $map['type']= array('eq',1);
            $artlist = db('article')->where($map)->field('aid,user_id,title,intro,username')->limit(5)->select();
            return view('article/Art',[
                'article'=>$article,//文章内容
                'artlist'=>$artlist//文章详情页下列表
            ]);        
    }
    public function Artlist(){
        //文章列表页
        $user = new User();  
        $Frecent = new A();              
        $uid = session('uid');//获取个人id
        $artarray = $Frecent->getRecent($uid);//根据点击数排序，每页四条
        $artlist = $artarray['list'];
        $userInfo =$user->MyInfo($uid);
        return view('article/artlist',[
            'userInfo'=>$userInfo,
            'artlist'=>$artlist
        ]);
    }    


}
