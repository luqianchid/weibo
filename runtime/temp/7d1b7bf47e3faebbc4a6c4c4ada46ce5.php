<?php if (!defined('THINK_PATH')) exit(); /*a:7:{s:66:"D:\www\weibo\public/../application/index\view\homepage\artlst.html";i:1553762122;s:52:"D:\www\weibo\application\index\view\common\head.html";i:1548331519;s:51:"D:\www\weibo\application\index\view\common\nav.html";i:1554475637;s:56:"D:\www\weibo\application\index\view\common\homepage.html";i:1553483775;s:56:"D:\www\weibo\application\index\view\common\homeleft.html";i:1553756198;s:54:"D:\www\weibo\application\index\view\common\footer.html";i:1553476963;s:50:"D:\www\weibo\application\index\view\common\js.html";i:1553754266;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="stylesheet" href="/static/index/css/bootstrap.min.css">
<link rel="stylesheet" href="/static/index/css/main.css">


    <title>我的文章</title>
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
		<!--主分区 封面-->
		<div class="row">
				<div class="col-lg-4 col-md-offset-4 text-center">
								
					<?php if(is_array($user) || $user instanceof \think\Collection || $user instanceof \think\Paginator): $i = 0; $__LIST__ = $user;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$user): $mod = ($i % 2 );++$i;?>
					<img class="per-image" src="/static/uploads/<?php echo $user['avatar']; ?>" alt="<?php echo $user['username']; ?>">
					<p class="per-name"><?php echo $user['username']; ?></p>
					<?php if(\think\Request::instance()->session('uid')!=$user['id']): if($flag!=0): ?>
							<div class="focus-friends-w" isFocus="1" data-user="<?php echo $user['id']; ?>">取消关注</div>
							<p class="per-sign"><?php echo $user['signnote']; ?></p>
						<?php else: ?>	
							<div class="focus-friends" isFocus="0" data-user="<?php echo $user['id']; ?>">关注</div>
							<p class="per-sign"><?php echo $user['signnote']; ?></p>
						<?php endif; else: ?>
						<p class="reg-name">注册于<?php echo tranTime($user['create_time']); ?></p>
						<p class="per-sign"><?php echo $user['signnote']; ?></p>
					<?php endif; endforeach; endif; else: echo "" ;endif; ?>
				</div>
		</div>
		<div class="row">
				<div class="tab-content" >
						<div class="tab-pane active" id="home">
								<div class="col-md-4 col-md-offset-1">
        <div class="per-show">
                <div class="focus-area">
                        <ul class="f-list">
                                <li class="f-list-item"><a href="<?php echo url('homepage/focus',['u'=>$userInfo['uid']]); ?>"><?php echo $userInfo['focus']; ?></a><span>关注</span></li>
                                <li class="f-list-item"><a href="<?php echo url('homepage/fans',['u'=>$userInfo['uid']]); ?>"><?php echo $userInfo['fans']; ?></a><span>粉丝</span></li>
                                <li class="f-list-item"><a href="<?php echo url('homepage/index',['u'=>$userInfo['uid']]); ?>"><?php echo $userInfo['posts']; ?></a><span>说说</span></li>
                        </ul>
                </div>
        </div>
    
        <div class="hots-list">
    
                <div class="hot_head">
                        <a class="pull-left" href="<?php echo url('index/index'); ?>">最近微博</a>
                </div>
    
                <ul class="fri-list">
                        <!--{最近微博开始，限定5条,点击更多跳转列表页}-->
                    <?php if(is_array($hot_topic) || $hot_topic instanceof \think\Collection || $hot_topic instanceof \think\Paginator): $i = 0; $__LIST__ = $hot_topic;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$h): $mod = ($i % 2 );++$i;?>
                    <li>
                        <div class="fri-img"><img src="/static/uploads/<?php echo $h['avatar']; ?>" alt="<?php echo $h['username']; ?>"></div>
                        <div class="fri-cont">
                            <div class="fri-name">
                                <a href="<?php echo url('Homepage/index',['u'=>$h['user_id']]); ?>"><?php echo $h['username']; ?></a>
                            </div>
                            <div class="cont-text">
                                <a href="<?php echo url('Index/getcomment',['pid'=>$h['pid']]); ?>">
                                        <?php echo $h['content']; ?>
                                </a>
                            </div>
                        </div>
                    </li>
                    <?php endforeach; endif; else: echo "" ;endif; ?>                  
                                            
                                            <!--{高热微博结束}-->
                </ul>
                <!--点击更多跳转列表页-->
                <a class="hot_bot" href="<?php echo url('index/index'); ?>">查看更多</a>
        </div>
    
    
    </div>
								<div class="col-md-6 per-send">
										<div class="curr-bar">
												<ul class="nav nav-tabs per-nav" role="tablist" id="tab-list2">
														<li><a href="<?php echo url('Homepage/index',['u'=>$userid]); ?>" >说说</a></li>
														<li><a href="<?php echo url('Homepage/Article',['u'=>$userid]); ?>">文章</a></li>
														<li><a href="<?php echo url('Homepage/Focus',['u'=>$userid]); ?>">关注</a></li>
												</ul>
										</div>

                <?php if(is_array($artlist) || $artlist instanceof \think\Collection || $artlist instanceof \think\Paginator): $i = 0; $__LIST__ = $artlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$a): $mod = ($i % 2 );++$i;?>
                <div class="article-box">
                    <div class="article-body">
                        <div class="article-content">
                            <div class="art-img"><a href="<?php echo url('Article/index',['artid'=>$a['aid']]); ?>"><img src="/static/upcover/<?php echo $a['cover']; ?>" alt="<?php echo $a['title']; ?>"></a></div>
                            <div class="art-title">
                                <a href="<?php echo url('Article/index',['artid'=>$a['aid']]); ?>" class="a_t"><?php echo $a['title']; ?></a>
                                <div class="time"><?php echo tranTime($a['create_time']); ?></div>
                                <div class="desc">
                                    <?php echo $a['intro']; ?>
                                    <a href="<?php echo url('Article/index',['artid'=>$a['aid']]); ?>" style="color: darkgray">阅读全文</a>
                                </div>
                            </div>
                        </div>
                     </div>
                </div>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            <div class="page-list">
                <?php echo $artlist->render(); ?>
            </div>
            </div>
        </div>
    </div>
</div>
    <div class="h_25"></div>

</div>
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

<script src="/static/index/js/jquery-2.1.1.min.js"></script>

<script type="text/javascript" src="/static/index/js/myAnimate.js"></script>

<script src="/static/index/js/bootstrap.js"></script>

<script src="/static/index/js/layer/layer.js"></script>

</body>
</html>

