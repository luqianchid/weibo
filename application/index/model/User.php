<?php
/**
 * Created by PhpStorm.
 * User: MyPC
 * Date: 2019/1/1
 * Time: 13:59
 */
namespace app\index\model;
use think\Model;
use think\Db;


class User extends Model
{

    public function login($data){//登陆
        $user=db('user')->where('username','=',$data['username'])->find();//查询用户名是否存在
        if($user){
            if($user['password'] == md5($data['password'])){
                session('username',$user['username']);
                session('uid',$user['id']);
                return 3; //信息正确
            }else{
                return 2; //密码错误
            }
        }else{
            return 1; //用户不存在
        }
    }
    public function register($data){
        $user = new User();
        $user->username = $data['username'];
        $user->password = md5($data['password']);
        $user->create_time = $data['create_time'];
        $user->email = $data['email'];
        $user->phone = $data['phone'];
        $user->avatar = "imgs/header.jpg";// 默认头像
        $res = $user->save();
        if ($res){
            return 1;//成功
        }else{
            return 0;// 失败
        }
    }
    public function MyInfo($uid){
        // 获取我发布的信息
        $fans = db('focus')->where('focus_id','=',$uid)->count();//我的粉丝/关注我的
        $posts = db('post')->where('user_id','=',$uid)->count();//我的发布
        $focus = db('focus')->where('user_id','=',$uid)->count();//我的关注
        $avatar = db('user')->where('id','=',$uid)->field('avatar')->find();
        $user = [
            'fans'=>$fans,
            'posts'=>$posts,
            'focus'=>$focus,
            'uid'=>$uid,
            'avatar'=>$avatar['avatar'],
        ];
        return $user;
    }

    //头像
    public function ChangeHeadImg($data){
        $user = new User();
        $user->avatar = $data['avatar'];
        $res = $user->save();
        if ($res){
            return 1;//成功
        }else{
            return 0;// 失败
        }
    }
    public function MyPost($uid){
        //查询我及我的关注发布的内容，返回数组。
        $focuslist = db('focus')->where('user_id','=',$uid)->field('focus_id')->select();
        $flist = [];
        foreach($focuslist as $f){
            array_push($flist,$f['focus_id']);
        }
        array_push($flist,$uid);
       
        $focus_post = db('post p')
            ->where(['p.user_id'=>['in',$flist]])
            ->join('user u','p.user_id=u.id','left')
            ->join('post p2','p2.pid = p.parent_id','left')            
            ->field('p.pid,p.user_id,p.username,p.content,p.add_time,p.parent_id,u.avatar,p2.user_id as uid,p2.username as uname,p2.pid as tid,p2.content as tcont,p2.add_time as ttime')
            ->order('p.add_time desc')->paginate(10);
        return $focus_post;
    }
    


}
