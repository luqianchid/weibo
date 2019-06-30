<?php
namespace app\index\controller;
use think\Controller;
class Search extends Controller
{
    public function index()
    {   
        $keywords=input('post.keywords');//获取搜索关键词
        if($keywords == ""){
            $this->error("必须输入搜索内容！",'\\');
        }
        if($keywords){//如果存在
            $map['title'] = ['like','%'.$keywords.'%'];
            //文章标题匹配
            $SearchArticleRes = db('article')
                ->where($map)
                ->order('aid desc')
                ->paginate(5,false,[
                    'query' => array('keywords'=>$keywords),
                ]);
            // 用户post内容匹配
            $SearchTalksRes = db('post')
                ->where(['content'=>['like','%'.$keywords.'%']])
                ->order('add_time desc')
                ->paginate(5,false,[
                    'query' => array('keywords'=>$keywords),
                ]);
            //用户名匹配
            $SearchUsersRes = db('user')
                    ->where(['username'=>['like','%'.$keywords.'%']])
                    ->order('create_time desc')
                    ->paginate(5,false,[
                        'query' => array('keywords'=>$keywords),
                    ]);
            $this->assign(array(
                'ArticleRes'=>$SearchArticleRes,
                'TalksRes'=>$SearchTalksRes,
                'UsersRes'=>$SearchUsersRes,
                'keywords'=>$keywords
                ));
        }else{
            $this->assign(array(
                'search_res'=>null,
                'keywords'=>'暂无数据'
                ));
        }

        return $this->fetch('index/search');
    }




}
