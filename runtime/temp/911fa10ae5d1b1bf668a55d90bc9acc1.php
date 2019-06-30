<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:62:"D:\www\weibo\public/../application/index\view\article\Art.html";i:1557420606;s:52:"D:\www\weibo\application\index\view\common\head.html";i:1548331519;s:51:"D:\www\weibo\application\index\view\common\nav.html";i:1554475637;s:54:"D:\www\weibo\application\index\view\common\footer.html";i:1553476963;s:50:"D:\www\weibo\application\index\view\common\js.html";i:1553754266;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
		<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="stylesheet" href="/static/index/css/bootstrap.min.css">
<link rel="stylesheet" href="/static/index/css/main.css">


		<title>文章页</title>
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

		<!--nav结束-->

		<hr class="h_10">

		<div class="container">
				<div class="col-md-10 col-md-offset-1 article">
						<?php if(is_array($article) || $article instanceof \think\Collection || $article instanceof \think\Paginator): $i = 0; $__LIST__ = $article;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$art): $mod = ($i % 2 );++$i;?>
						<div class="art-bg"><img src="/static/upcover/<?php echo $art['cover']; ?>"/></div>
						<div class="article-bd">
								<div class="article-head">
										<?php echo $art['title']; ?>
								</div>
								<div class="article-info">
										<ul class="art-info">
											<li><a href="<?php echo url('homepage/index',['u'=>$art['user_id']]); ?>"><?php echo $art['username']; ?></a></li>
											<li><a>发布于<?php echo date("m-d",$art['create_time']); ?></a></li>												
										</ul>
								</div>
								<div class="article-cont">
									<div class="article-detail">
										<div class="article-intro">
												<div class="article-i-style"><?php echo $art['intro']; ?></div>
										</div>
										<div class="article-richtext">
											<?php echo $art['content']; ?>
										</div>												
									</div>
								</div>
								</div>								
								<?php endforeach; endif; else: echo "" ;endif; ?>

						<div class="h_25"></div>
						<div class="article-nominate">
								<div class="title-bar">推荐阅读</div>
								<div class="article-no-list">
										<ul class="art-no-list">
												<?php if(is_array($artlist) || $artlist instanceof \think\Collection || $artlist instanceof \think\Paginator): $i = 0; $__LIST__ = $artlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$li): $mod = ($i % 2 );++$i;?>
												<li class="art-no-li-item">
														<a class="nomi-title" href="<?php echo url('Article/index',['artid'=>$li['aid']]); ?>"><?php echo $li['title']; ?></a>
														<p><a href="<?php echo url('Homepage/index',['artid'=>$li['aid']]); ?>"><?php echo $li['username']; ?></a> <?php echo $li['intro']; ?></p>
												</li>
												<?php endforeach; endif; else: echo "" ;endif; ?>
										</ul>
										<a class="ul-bot" href="<?php echo url('Article/artlist'); ?>">查看更多</a>
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
