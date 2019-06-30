<?php
/**
 * Created by PhpStorm.
 * User: MyPC
 * Date: 2019/1/10
 * Time: 18:55
 */
namespace app\index\controller;
use think\Controller;
use think\Db;
Use app\index\model\User;
use think\Session;

class Homepage extends Base
{
    //个人主页模块
    public function index(){        
        $uid = session('uid');
        $user_id = input('u');//获取传参
        if (!$user_id){
            $user_id = $uid;
        }
        $user = db('user')->where('id','=',$user_id)->select();  
        $talks = db('post p')->where(['p.user_id'=>$user_id])
            ->join('user u','p.user_id=u.id','left')
            ->join('post p2','p2.pid = p.parent_id','left')            
            ->field('p.pid,p.user_id,p.username,p.content,p.add_time,p.parent_id,u.avatar,p2.user_id as uid,p2.username as uname,p2.pid as tid,p2.content as tcont,p2.add_time as ttime')
            ->order('p.add_time desc')
            ->paginate(5,false,['query'=>['userid'=>$user_id]]);
            //查询发布的说说
        $users = new User();            
        $userInfo =$users->MyInfo($user_id);//用户信息
        $recent_post = db('post')
            ->alias('p')
            ->join('user u','p.user_id = u.id','left')
            ->order('add_time desc')
            ->limit('3')->select();//热门话题
        $res = db('focus')->where(['user_id'=>$uid,'focus_id'=>$user_id])->select();
        $flag = count($res); 
        return view('homepage/home',[
            'user'=>$user,
            'userid'=>$user_id,
            'talk'=>$talks,
            'userInfo'=>$userInfo,
            'hot_topic'=>$recent_post,
            'flag'=>$flag
        ]);
        
    }
    public function Article(){//文章页面
              
        $user_id = input('u');
        $user = db('user')->where('id','=',$user_id)->select();
        $articlelist = db('article')->where('user_id','=',$user_id)->paginate(3,false,['query'=>['userid'=>$user_id]]);
        $users = new User();            
        $userInfo =$users->MyInfo($user_id);
        $recent_post = db('post')
            ->alias('p')
            ->join('user u','p.user_id = u.id','left')
            ->order('add_time desc')
            ->limit('3')->select();
        $uid = session('uid');
        $res = db('focus')->where(['user_id'=>$uid,'focus_id'=>$user_id])->select();
        $flag = count($res);
        $this->assign('flag',$flag);
        return view('homepage/artlst',[
            'user'=>$user,
            'userid'=>$user_id,
            'artlist'=>$articlelist,
            'userInfo'=>$userInfo,
            'hot_topic'=>$recent_post,
            'flag'=>$flag
        ]);
        
    }
    public function FocusSbd(){//关注某人
        if (request()->isPost()) {
            $uid = session('uid');
            $status =  input('post.focus');      
            $fid = input('post.fid');  
            if ($status == 1){
                $flag = db('focus')->insert(['user_id'=>$uid,'focus_id'=>$fid]);
                
                if($flag == 1){
                    return 1;
                }else{
                    return 0;
                }
            }else{
                $flag = db('focus')->where(['user_id'=>$uid,'focus_id'=>$fid])->delete();
                if($flag == 1){
                    return 2;
                }else{
                    return 0;
                }
            }        
        }
    }
    public function Focus(){//关注页面
       
        $user_id = input('u');
        $user = db('user')->where('id', '=', $user_id)->select();            
        $focuslist = db('focus')
            ->where('user_id', '=', $user_id)                
            ->field('focus_id')
            ->select();
        $list = [];
        foreach($focuslist as $f){
            array_push($list,$f['focus_id']);
        }
        $focus_info = db('user')->where(['id'=>['in',$list]])->paginate(5,false,['query'=>['userid'=>$user_id]]);           
        $users = new User();            
        $userInfo =$users->MyInfo($user_id);
        $recent_post = db('post')
            ->alias('p')
            ->join('user u','p.user_id = u.id','left')
            ->order('add_time desc')
            ->limit('3')->select();            
        $uid = session('uid');
        $res = db('focus')->where(['user_id'=>$uid,'focus_id'=>$user_id])->select();
        $flag = count($res);          
        return view('homepage/focuslst',[
            'user'=>$user,
            'userid'=>$user_id,
            'focus'=> $focus_info,
            'userInfo'=>$userInfo,
            'hot_topic'=>$recent_post,
            'flag'=>$flag
        ]);
        
    }
   
    public function fans(){//粉丝页面        
        $user_id = input('u');
        $user = db('user')->where('id', '=', $user_id)->select();            
        $fanslist = db('focus')->where('focus_id','=',$user_id)->field('user_id')->select();
        $flist = [];
        foreach($fanslist as $f){
            array_push($flist,$f['user_id']);
        }
        $fans_info = db('user')->where(['id'=>['in',$flist]])->paginate(5,false,['query'=>['userid'=>$user_id]]);            
        $users = new User();            
        $userInfo =$users->MyInfo($user_id);
        $recent_post = db('post')
            ->alias('p')
            ->join('user u','p.user_id = u.id','left')
            ->order('add_time desc')
            ->limit('3')->select();            
        $uid = session('uid');
        $res = db('focus')->where(['user_id'=>$uid,'focus_id'=>$user_id])->select();
        $flag = count($res);           
        return view('homepage/fanslst',[
            'user'=>$user,
            'userid'=>$user_id,
            'fans'=>$fans_info,
            'userInfo'=>$userInfo,
            'hot_topic'=>$recent_post,
            'flag'=>$flag
        ]);
        
    }  
    public function DisFocus(){    //取消关注
        if(request()->isPost()){
            $uid = Session::get('uid');
            $focus_id = input('post.fid');            
            $flag = db('focus')->where(['focus_id'=>$focus_id,'user_id'=>$uid])               
                ->delete();
            if($flag!=0){
                return 1;//删除成功
            }else{
                return 0;
            }
        }
    }
}
