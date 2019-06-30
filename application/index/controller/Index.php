<?php
namespace app\index\controller;

use think\Controller;
use app\index\model\User;
use think\Session;
use think\Db;
use app\index\model\Article as A;
class Index extends Base
{
    public function index()
    {
        //返回我的关注，粉丝，说说等信息
        $user = new User();
        $bar = new Common();
        $Frecent = new A();              
        $uid = session('uid');//获取个人id
        $artarray = $Frecent->getRecent($uid);//获取朋友最近文章 
        $artlist = $artarray['topic'];  
        $userInfo =$user->MyInfo($uid);
        $my_post =$user->MyPost($uid);//
        $bar->rightbar();//生成静态页面  
        $bar->leftnav();       
        return view('index/index',[
            'userInfo'=>$userInfo,
            'my_post'=>$my_post,
            'artlist'=>$artlist
        ]);
    }
    public function delpost(){//删除说说
        if(request()->isPost()){
            $pid = input('post.post_id');
            $uid = session('uid');            
            $res = db('post')->where(['user_id'=>$uid,'pid'=>$pid])->delete();
            if ($res == 0){
                return 0;
            }else{
                return 1;
            }    
        }
    }
    public function praiseme(){    //点赞
        $Frecent = new A();  
        $uid = session('uid');        
        $praiselist = db('praise p')            
            ->join('post pt','p.post_id = pt.pid','left')
            ->join('user u','u.id = p.user_id','left')    
            ->where('post_user_id','=',$uid) 
            ->order('p.p_time desc')       
            ->field('p.*,u.username as uname,pt.content,pt.user_id as puid,pt.add_time,pt.username')
            ->paginate(5);
        $uid = session('uid');//获取个人id
        $artarray = $Frecent->getRecent($uid);//获取朋友最近文章 
        $artlist = $artarray['topic'];
        $user = new User();            
        $userInfo =$user->MyInfo($uid);   
        return view('index/praise',[
            'praise'=>$praiselist,
            'userInfo'=>$userInfo,           
            'artlist'=>$artlist
        ]);
    }
    public function collectme(){//收藏我的
        $Frecent = new A();  
        $uid = session('uid');        
        $collectlist = db('collect c')            
            ->join('post pt','c.post_id = pt.pid','left')
            ->join('user u','u.id = c.user_id','left')    
            ->where('post_user_id','=',$uid) 
            ->order('c.co_time desc')       
            ->field('c.*,u.username as uname,pt.content,pt.user_id as puid,pt.add_time,pt.username')
            ->paginate(5);
        $uid = session('uid');//获取个人id
        $artarray = $Frecent->getRecent($uid);//获取朋友最近文章 
        $artlist = $artarray['topic'];
        $user = new User();            
        $userInfo =$user->MyInfo($uid);   
        return view('index/collect',[
            'collect'=>$collectlist,
            'userInfo'=>$userInfo,           
            'artlist'=>$artlist
        ]);
    }
    public function mycollect(){
        $Frecent = new A();  
        $uid = session('uid');//获取个人id
        $collectlist = db('collect c')
            ->join('post p','c.post_id = p.pid','left')
            ->join('user u','u.id = p.user_id')
            ->where('c.user_id','=',$uid)
            ->field('c.*,u.avatar,p.username,p.user_id as puid,p.content,p.add_time')
            ->paginate(5);       
        $artarray = $Frecent->getRecent($uid);//获取朋友最近文章 
        $artlist = $artarray['topic'];
        $user = new User();            
        $userInfo =$user->MyInfo($uid); 
        return view('index/mycollect',[
            'mycollect'=>$collectlist,
            'userInfo'=>$userInfo,           
            'artlist'=>$artlist
        ]);
    }
    public function logout(){
        //退出登陆
        $_SESSION = array();  
        if(isset($_COOKIE[session_name()])){  
            setcookie(session_name(),'',time()-1);
        }
        session_destroy();  //清除服务器的 session 文件
        $this->success('您已退出登录，请重新登录','/');
    }
    public function ChangeInfo(){ //修改个人信息
        $uid = session('uid');
        $user = new User();
        $userInfo =$user->MyInfo($uid);        
        $recent_post = db('post')
                ->alias('p')
                ->join('user u','p.user_id = u.id','left')
                ->order('add_time desc')
                ->limit('3')->select();
        $res = db('user')->where('id','=',$uid)->select();       
        $user = db('user')->where('id','=',$uid)->select();      
        return view('homepage/ChangeInfo',[
            'user'=>$user,
            'userInfo'=>$userInfo,
            'hot_topic'=>$recent_post,
            'userid'=>$uid,
            'res'=>$res
        ]);
    }
    public function message(){
        $Frecent = new A();              
        $uid = session('uid');//获取个人id
        $artarray = $Frecent->getRecent($uid);//获取朋友最近文章 
        $artlist = $artarray['topic'];
        $post = db('post p')
            ->where('parent_user_id','=',$uid)
            ->join('user u','p.user_id=u.id','left')
            ->order('add_time','desc')
            ->paginate(6,false,['query'=>['userid'=>$uid]]);
        $user = new User();            
        $userInfo =$user->MyInfo($uid);        
        return view('index/message',[
            'userInfo'=>$userInfo,
            'message'=>$post,      
            'artlist'=>$artlist
        ]);
    }
   
    public function changeset(){   //修改个人信息并保存
        if (request()->isPost()){
            $uid = session('uid');
            $username = input('post.username');
            $password = input('post.password');
            $email = input('post.email');
            $sex = input('post.sex');
            $phone = input('post.phone');
            $sign = input('post.sign');
            if ($password!=''){
                $flag  = db('user')->where('id','=',$uid)
                ->update([
                    'username'=>$username,
                    'password'=>md5($password),
                    'email'=>$email,
                    'phone'=>$phone,
                    'sex'=>$sex,
                    'signnote'=>$sign
                ]);
                if ($flag == 0){
                    return 0;//修改失败
                }else{
                    return 1;
                }
            }else{
                $flag  = db('user')->where('id','=',$uid)
                    ->update(['username'=>$username,'email'=>$email,'phone'=>$phone,'sex'=>$sex,'signnote'=>$sign]);
                if ($flag == 0){
                    return 0;//修改失败
                }else{
                    return 1;
                }
            }  
        }
    }
    
    public function InsertPost(){//发布说说时
        if (request()->isPost()){
            $uid = session('uid');
            $cont = input('post.cont');
            $uname = session('username');
            $add_time = time();
            //date("Y-m-d H:i:s",time())
            $msg=[
                'content'=>$cont,
                'add_time'=>$add_time,
                'username'=>$uname,
                'user_id'=>$uid,
                'type'=>'0',
                'parent_user_id'=>0,
            ];
            $flag = db('post')->insert($msg);
            if ($flag == 1){
                return 1;//发布成功
            }else{
                return 0;//发布失败
            }
        }else{
            $this->error("非法访问！",'index/index');
        }
    }
    public function TransPost(){
        if (request()->isPost()){
            $uid = session('uid');//转发人id
            $cont = input('post.cont');//转发内容
            $pid = input('post.pid');//被转发id
            $uname = session('username');
            $add_time = time();
            $p_u_id = db('post')->where("pid",'=',$pid)->field('user_id')->find();
            //date("Y-m-d H:i:s",time())
            $msg=[
                'content'=>$cont,
                'add_time'=>$add_time,
                'username'=>$uname,
                'user_id'=>$uid,
                'type'=>'1',//转发
                'parent_id'=>$pid,//转发内容id
                'parent_user_id'=>$p_u_id['user_id'],
            ];
            $flag = db('post')->insert($msg);
            if ($flag == 1){
                return 1;//发布成功
            }else{
                return 0;//发布失败
            }
        }else{
            $this->error("非法访问！",'index/index');
        }
    }
    public function InsertComment(){
        if (request()->isPost()){
            $uid = session('uid');
            $cont = input('post.cont');
            $pid = input('post.post_id');
            $p_u_id = db('post')->where("pid",'=',$pid)->field('user_id')->find();
            $uname = session('username');
            $add_time = time();
            //date("Y-m-d H:i:s",time())
            $msg=[
                'content'=>$cont,
                'add_time'=>$add_time,
                'username'=>$uname,
                'user_id'=>$uid,
                'parent_id'=>$pid,
                'type'=>2,//2 = 评论
                'parent_user_id'=>$p_u_id['user_id'],
            ];
            $flag = db('post')->insert($msg);
            if ($flag == 1){
                return 1;//发布成功
            }else{
                return 0;//发布失败
            }
        }else{
            $this->error("非法访问！",'index/index');
        }
    }
    public function GetComment(){       
        //1.发布的说说。
        //2.他的所有评论
        $uid = session('uid');
        $pid = input('pid');//post_id
        $comment_list = db('post p')
            ->join('user u','p.user_id=u.id','left')
            ->where('parent_id','=',$pid)
            ->paginate(10,false,['query'=>['pid'=>$pid]]);
        $post = db('post p')->join('user u','p.user_id=u.id','left')->where('pid','=',$pid)->select();        
        $user = new User();  
        $Frecent = new A();
        $artarray = $Frecent->getRecent($uid);//获取朋友最近文章 
        $artlist = $artarray['topic'];     
        $isPraise = db('praise')->where(['user_id'=>$uid,'post_id'=>$pid])->select();    
        $isCollect = db('collect')->where(['user_id'=>$uid,'post_id'=>$pid])->select();
        $praise = count($isPraise);
        $collect = count($isCollect);          
        $userInfo =$user->MyInfo($uid);
        $infolist = db('info')->order('create_time desc')->limit(5);//公告
        $this->assign(array(
            'userInfo'=>$userInfo,
            'comments'=>$comment_list,
            'post'=>$post,
            'praise'=>$praise,
            'collect'=>$collect,
            'artlist'=>$artlist,
            'infolist'=>$infolist,
        ));
        return $this->fetch('index/comments');
    }
    public function Forward(){  //转发渲染转发页面
        $pid = input('get.pid');
        $uid = session('uid');
        $post = db('post')->where('pid','=',$pid)->select();
        $name = db('user')->where('id','=',$uid)->select();            
        return view('homepage/Forward',[
            'post'=>$post,
            'name'=>$name
        ]);
    }
    public function Praise(){//点赞
        $post_id = input('post.post_id');
        $parent_id = input('post.parent_id');
        $uid = session('uid');
        $status =  input('post.praise');      
        if ($status == 1){
            $flag = db('praise')->insert(['user_id'=>$uid,'post_id'=>$post_id,'post_user_id'=>$parent_id,'p_time'=>time()]);
            if($flag ==1){
                return 1;
            }else{
                return 0;
            }
        }else{
            $flag = db('praise')->where(['user_id'=>$uid,'post_id'=>$post_id,'post_user_id'=>$parent_id])->delete();
            if($flag == 1){
                return 2;
            }else{
                return 0;
            }
        }        
    }
    public function CollectInfo(){//收藏功能
        $post_id = input('post.post_id');
        $parent_id = input('post.parent_id');
        $status = input('post.collect');
        $uid = session('uid'); 
        if ($status == 1){
            $flag = db('collect')->insert(['user_id'=>$uid,'post_id'=>$post_id,'post_user_id'=>$parent_id,'co_time'=>time()]);        
            if($flag == 1){
                return 1;
            }else{
                return 0;
            }
        }else{
            $flag = db('collect')->where(['user_id'=>$uid,'post_id'=>$post_id,'post_user_id'=>$parent_id])->delete();
            if($flag == 1){
                return 2;
            }else{
                return 0;
            }
        }
    }
}

