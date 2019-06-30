<?php
namespace app\index\controller;

use app\index\model\User;

use app\index\model\Article as A;
use think\Controller;

//栏目文章列表
class Cate extends Controller{
    public function index(){   
        $user = new User();     
        $Frecent = new A();    
        $cateid = input('cateid');
        $cateArtile = db('catearticle')->where('cateid','=',$cateid)->where('content != "[]"')->paginate(6);//根据栏目ID查询数据
        $uid = session('uid');
        $artarray = $Frecent->getRecent($uid);//获取朋友最近文章 
        $fArtlist = $artarray['topic']; 
        $userInfo =$user->MyInfo($uid);
        return view('cate/list',[
            'artlist'=>$cateArtile,
            'userInfo'=>$userInfo,
            'fArtlist'=>$fArtlist
        ]);
    }
    // 文章详情
    public function detail(){
        $caid = input('caid');//栏目文章id
        $cateid =  input('cateid');//栏目id
        $detail = db('catearticle')->where('ca_id','=',$caid)->select();//获取文章id并查询数据
        $calist = db('catearticle')->where('cateid','=',$cateid)->where('content != "[]"')->limit(5)->select();
        return view('cate/detail',[
            'detail'=>$detail,
            'calist'=>$calist,
        ]);

    }

}