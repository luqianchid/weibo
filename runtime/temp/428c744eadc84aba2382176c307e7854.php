<?php if (!defined('THINK_PATH')) exit(); /*a:8:{s:60:"D:\www\weibo\public/../application/index\view\cate\list.html";i:1553756932;s:52:"D:\www\weibo\application\index\view\common\head.html";i:1548331519;s:51:"D:\www\weibo\application\index\view\common\nav.html";i:1554475637;s:55:"D:\www\weibo\application\index\view\common\leftbar.html";i:1557536120;s:54:"D:\www\weibo\application\index\view\common\right1.html";i:1553487091;s:56:"D:\www\weibo\application\index\view\common\rightbar.html";i:1557536120;s:54:"D:\www\weibo\application\index\view\common\footer.html";i:1553476963;s:50:"D:\www\weibo\application\index\view\common\js.html";i:1553754266;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="stylesheet" href="/static/index/css/bootstrap.min.css">
<link rel="stylesheet" href="/static/index/css/main.css">


    <title>热门推荐</title>
</head>
<body>
<div id="content">
    <nav class="nav navbar-default  navbar-inverse" role="navigation">
		<div class="container">
				<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#demo-navbar">
								<span class="sr-only">ALen Blog</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="#">Alen Blog</a>
				</div>
				<div class="collapse navbar-collapse hidden-md" id="demo-navbar">
						<ul class="nav navbar-nav">
								<li class="active"><a href="<?php echo url('index/index'); ?>">首页</a></li>
								<!--栏目循环-->							
						</ul>
						<form class="navbar-form navbar-left" action="/index/search/index" method="POST" role="search">
								<div class="form-group">
									<input type="text" id="keywords" name="keywords" class="form-control" placeholder="Search">
								</div>
								<button type="submit" class="btn btn-default" id='search'>搜索</button>
						</form>
						<ul class="nav navbar-nav navbar-right">
								<?php if(\think\Request::instance()->session('username')): ?>
								<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="Personal.html"><span
												class="glyphicon glyphicon-user"></span><?php echo \think\Request::instance()->session('username'); ?></a>
										<ul class="dropdown-menu" role="menu">
											<li><a href="<?php echo url('image/index'); ?>">修改头像</a></li>
											<li><a href="<?php echo url('Editor/index'); ?>">发布文章</a></li>
											<li><a href="<?php echo url('homepage/index'); ?>">个人主页</a></li>
										</ul>
								</li>
								<li class="dropdown">
										<a class="dropdown-toggle" data-toggle="dropdown" href="">
											<span class="glyphicon glyphicon-envelope"></span>我的消息
										</a>
										<ul class="dropdown-menu" role="menu">
												<li><a href="<?php echo url('index/message'); ?>">转发和评论</a></li>	
												<li><a href="<?php echo url('index/praiseme'); ?>">点赞我的</a></li>	
												<li><a href="<?php echo url('index/collectme'); ?>">收藏我的</a></li>	
												<li><a href="<?php echo url('index/mycollect'); ?>">我的收藏</a></li>												
										</ul>										
								</li>

								<li class="dropdown">
										<a class="dropdown-toggle " data-toggle="dropdown" href="setting.html"><span
												class="glyphicon glyphicon-cog"></span>设置</a>
										<ul class="dropdown-menu" role="menu">
												<li><a href="<?php echo url('index/ChangeInfo'); ?>">修改信息</a></li>
											
												<li><a href="<?php echo url('index/logout'); ?>">退出登录</a></li>
										</ul>
								</li>
								<?php else: ?>
								<li><a href="<?php echo url('Register/index'); ?>">注册</a></li>
								<li><a href="<?php echo url('Login/index'); ?>">登录</a></li>
								<?php endif; ?>
						</ul>
				</div><!--navbar-->
		</div>
</nav><!--nav结束-->

    <hr class="h_10">
    <div class="container">
        <!--主分区-->
        <div class="row">
            <!--左导航-->
            <div class="col-md-2">
		<ul class="list-group hidden-md hidden-sm hidden-xs">
				<!--这里最好建一个数据表，根据表添加栏目，循环-->
				<li class="list-group-item"><a href="/index/index/index.html">首页</a></li>
								<li class="list-group-item"><a href="/index/cate/index/cateid/2.html">娱乐圈</a></li>
								<li class="list-group-item"><a href="/index/cate/index/cateid/3.html">军事</a></li>
								<li class="list-group-item"><a href="/index/cate/index/cateid/4.html">科技</a></li>
								<li class="list-group-item"><a href="/index/cate/index/cateid/5.html">国际</a></li>
								<li class="list-group-item"><a href="/index/cate/index/cateid/6.html">国内</a></li>
						</ul>
</div>

            <!--内容区域-->
            <div class="col-md-7">
               <div class="title-bar"><i class="glyphicon glyphicon-fire"></i><span>热门推荐</span></div>
                <!--开始文章列表-->
                <?php if(is_array($artlist) || $artlist instanceof \think\Collection || $artlist instanceof \think\Paginator): $i = 0; $__LIST__ = $artlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$art): $mod = ($i % 2 );++$i;?>
                <div class="article-box">
                    <div class="article-body">
                        <div class="article-content">
                            <div class="art-img"><a href="<?php echo url('Cate/detail',['cateid'=>$art['cateid'],'caid'=>$art['ca_id']]); ?>"><img src="<?php echo $art['img_url']; ?>" alt="<?php echo $art['title']; ?>"></a></div>
                            <div class="art-title">
                                <a href="<?php echo url('Cate/detail',['cateid'=>$art['cateid'],'caid'=>$art['ca_id']]); ?>" class="a_t"><?php echo $art['title']; ?></a>
                                <div class="time"><?php echo $art['create_time']; ?></div>
                                <div class="desc">
                                    <?php echo intro($art['content']); ?>
                                    <a href="<?php echo url('Cate/detail',['cateid'=>$art['cateid'],'caid'=>$art['ca_id']]); ?>" style="color: darkgray">阅读全文</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; endif; else: echo "" ;endif; ?>
                <!--结束文章列表-->
                <!--if li <8 :不显示-->
                <div class="page-list">
                    <?php echo $artlist->render(); ?>
                </div>
                <!--else:-->
                <!--显示-->

            </div>
            <!--右侧信息-->
            <div class="col-md-3">
		<div class="user_show">
				<div class="cover">
						<a href="<?php echo url('Homepage/index',['u'=>$userInfo['uid']]); ?>"><img class="head-image" src="/static/uploads/<?php echo $userInfo['avatar']; ?>" alt="{<?php echo \think\Request::instance()->session('username'); ?>"></a>
				</div>
				<div class="user-info">
						<?php if(\think\Request::instance()->session('username')!=null): ?>
						<div class="name-show"><?php echo \think\Request::instance()->session('username'); ?></div>
						<div class="focus-area">
								<ul class="f-list">										
									<li class="f-list-item"><a href="<?php echo url('homepage/focus',['u'=>$userInfo['uid']]); ?>"><?php echo $userInfo['focus']; ?></a><span>关注</span></li>
									<li class="f-list-item"><a href="<?php echo url('homepage/fans',['u'=>$userInfo['uid']]); ?>"><?php echo $userInfo['fans']; ?></a><span>粉丝</span></li>
									<li class="f-list-item"><a href="<?php echo url('Homepage/index',['u'=>$userInfo['uid']]); ?>"><?php echo $userInfo['posts']; ?></a><span>说说</span></li>									
								</ul>
						</div>
						<?php else: ?>
						<div class="name-show">游客</div>
						<div class="focus-area">
								<ul class="f-list">
										<li class="f-list-item"><a href="">0</a><span>关注</span></li>
										<li class="f-list-item"><a href="">0</a><span>粉丝</span></li>
										<li class="f-list-item"><a href="">0</a><span>说说</span></li>
								</ul>
						</div>
						<?php endif; ?>
				</div>
		</div>

            <div class="hot_topic">
                    <div class="hot_head">
                        <a class="pull-left" href="">好友头条</a>						
                    </div>
                    <div class="hot_ul">
                        <ul class="list-group">
                            <?php if(is_array($fArtlist) || $fArtlist instanceof \think\Collection || $fArtlist instanceof \think\Paginator): $i = 0; $__LIST__ = $fArtlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$t): $mod = ($i % 2 );++$i;?>
                            <li class="list-group-item"><a href="<?php echo url('Article/index',['artid'=>$t['aid']]); ?>"><?php echo $t['title']; ?></a><span class="pull-right"><?php echo tranTime($t['create_time']); ?></span>
                            </li>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </ul>
                    </div>
                    <a class="hot_bot" href="<?php echo url('Article/artlist'); ?>">查看更多</a>
            </div>
            
		<div class="admin_post">
				<div class="hot_head">
						<a class="pull-left">公告栏</a>

				</div>
				<div class="hot_ul">
						<ul class="list-group">
																<li class="list-group-item"><a href="/index/info/index/infoid/7.html">一二三四</a><span class="pull-right">8分钟前</span></li>
																<li class="list-group-item"><a href="/index/info/index/infoid/2.html">新学期计划发表集合</a><span class="pull-right">昨天 05-10 00:31:19</span></li>
																<li class="list-group-item"><a href="/index/info/index/infoid/6.html">xingnggao</a><span class="pull-right">昨天 05-09 16:13:21</span></li>
																<li class="list-group-item"><a href="/index/info/index/infoid/5.html">2018-2019-2学期专门重修班教学通知</a><span class="pull-right">03-27 09:16:00</span></li>
																<li class="list-group-item"><a href="/index/info/index/infoid/1.html">教务公告</a><span class="pull-right">03-25 22:36:40</span></li>
														</ul>
				</div>
		</div>
</div>

        </div>
    </div>
    <div class="h_25"></div>
    <footer class="nav navbar-inverse navbar-static-bottom">
		<div class="container">
				<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#demo-navbar">
								<span class="sr-only">ALen Blog</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="#">Alen Blog</a>
				</div>				
		</div>
		<p class="text-center" style="color: #fff">@yfs COPYRIGHT@2018</p>

</footer>

</div>

<script src="/static/index/js/jquery-2.1.1.min.js"></script>

<script type="text/javascript" src="/static/index/js/myAnimate.js"></script>

<script src="/static/index/js/bootstrap.js"></script>

<script src="/static/index/js/layer/layer.js"></script>

</body>
</html>
