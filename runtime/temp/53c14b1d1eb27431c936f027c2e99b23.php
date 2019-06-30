<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:63:"D:\www\weibo\public/../application/index\view\index\search.html";i:1553756112;s:52:"D:\www\weibo\application\index\view\common\head.html";i:1548331519;s:51:"D:\www\weibo\application\index\view\common\nav.html";i:1554475637;s:54:"D:\www\weibo\application\index\view\common\footer.html";i:1553476963;s:50:"D:\www\weibo\application\index\view\common\js.html";i:1553754266;}*/ ?>
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

<div id="content">
    <div class="col-md-6 col-md-offset-3">
    <div><p>根据您的关键词<?php echo $keywords; ?>,为您找到如下内容：</p></div>
                <?php if(is_array($ArticleRes) || $ArticleRes instanceof \think\Collection || $ArticleRes instanceof \think\Paginator): $i = 0; $__LIST__ = $ArticleRes;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$a): $mod = ($i % 2 );++$i;?>
                <div class="article-box">
                    <div class="article-body">
                        <div class="article-content">
                            <div class="art-img"><a href="<?php echo url('Article/index',['artid'=>$a['aid']]); ?>"><img src="/static/index/<?php echo $a['cover']; ?>" alt="<?php echo $a['title']; ?>"></a></div>
                            <div class="art-title">
                                <a href="<?php echo url('Article/index',['artid'=>$a['aid']]); ?>" class="a_t"><?php echo $a['title']; ?></a>
                                <div class="time"><?php echo $a['create_time']; ?></div>
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
                <?php echo $ArticleRes->render(); ?>
            </div>
            <?php if(is_array($TalksRes) || $TalksRes instanceof \think\Collection || $TalksRes instanceof \think\Paginator): $i = 0; $__LIST__ = $TalksRes;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$t): $mod = ($i % 2 );++$i;?>
            <div class="sendbox">
                <div class="head-bar">
                    <div class="head-image"></div>
                    <div class="head-name m_15"><?php echo $t['username']; ?></div>
                    <div class="head-time"><?php echo tranTime($t['add_time']); ?></div>                                
                </div>
                <div class="content-text">
                    <?php echo $t['content']; ?>
                </div>                           

                <div class="func-action">
                        <ul class="list-func">
                            <li class="list-func-item trans-send"><span class="glyphicon glyphicon-share-alt"></span><i>转发</i></li>
                            <li class="list-func-item comment" post="<?php echo $t['pid']; ?>"><a href="<?php echo url('index/getcomment',['pid'=>$t['pid']]); ?>"><span class="glyphicon glyphicon-list-alt"></span><i>评论</i></a></li>
                        </ul>
                </div>                            
            </div>                   
            <?php endforeach; endif; else: echo "" ;endif; ?>
            <!--{循环结束}-->                        
            <div class="page-list">
                <?php echo $TalksRes->render(); ?>
            </div>

            <?php if(is_array($UsersRes) || $UsersRes instanceof \think\Collection || $UsersRes instanceof \think\Paginator): $i = 0; $__LIST__ = $UsersRes;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$u): $mod = ($i % 2 );++$i;?>
            <div class="focus-row">
                <div class="focus-cell">
                    <div class="focus-img"><a href="<?php echo url('Homepage/index',['u'=>$u['id']]); ?>"><img src="/static/uploads/<?php echo $u['avatar']; ?>" alt=""></a></div>
                    <div class="re-focus">
                        <div class="focus-name"><?php echo $u['username']; ?></div>
                    </div>
                </div>
                <div class="focus-cell">
                    <div class="re-focus">
                        <div class="focus-name"><?php echo $u['email']; ?></div>
                        <div class="focus-sign"><?php echo $u['signnote']; ?></div>                                    
                    </div>
                </div>
            </div>
            <?php endforeach; endif; else: echo "" ;endif; ?>
            <div class="page-list">
                    <?php echo $UsersRes->render(); ?>
            </div>
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

