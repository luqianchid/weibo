<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:59:"D:\www\weibo\public/../application/admin\view\unit\add.html";i:1553652291;s:52:"D:\www\weibo\application\admin\view\common\head.html";i:1553485941;s:51:"D:\www\weibo\application\admin\view\common\nav.html";i:1553650330;s:52:"D:\www\weibo\application\admin\view\common\left.html";i:1553653608;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="stylesheet" href="/static/index/css/bootstrap.min.css">
<link rel="stylesheet" href="/static/index/css/main.css">

    <link rel="stylesheet" href="/static/index/css/layui.css"  media="all">
    <title>编辑公告</title>
</head>
<body>
<nav class="nav navbar-default  navbar-inverse" role="navigation">
		<div class="container">			
				<div class="navbar-header">
						<p style="color:#fff">欢迎使用AB后台管理功能</p>
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#demo-navbar">
								<span class="sr-only">AB后台管理系统</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
						</button>					
				</div>
				<div class="collapse navbar-collapse hidden-md" id="demo-navbar">						
						
						<ul class="nav navbar-nav navbar-right">								
								<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" ><span
												class="glyphicon glyphicon-user"></span>欢迎管理员:<?php echo \think\Request::instance()->session('adminname'); ?></a>
										
								</li>								

								<li class="dropdown">
										<a class="dropdown-toggle" href="<?php echo url('admin/logout'); ?>"><span
												class="glyphicon glyphicon-cog"></span>退出登录</a>
										
								</li>								
						</ul>
				</div><!--navbar-->
		</div>
</nav><!--nav结束-->

<div class="col-md-2 left">
        <div class="col-sm-12 manage">
            <a href="<?php echo url('admin/index'); ?>">管理员管理</a>
        </div>
        <div class="col-sm-12 manage">
            <a href="<?php echo url('article/index'); ?>">文章管理</a>
        </div>
        <div class="col-sm-12 manage">
            <a href="<?php echo url('unit/index'); ?>">栏目管理</a>
        </div>
        <div class="col-sm-12 manage">
            <a href="<?php echo url('talks/index'); ?>">说说管理</a>
        </div>
        <div class="col-sm-12 manage">
            <a href="<?php echo url('info/index'); ?>">发布公告</a>
        </div>
        
</div>      
<div class="col-md-10 right">
    <form action="" class="form-mt" enctype="multipart/form-data" method="post">
        <div class="form-group">
            <input class="form-title" type="text" name="catename" id="art_title" placeholder="请输入栏目名称">
        </div>
        <div class="form-group">      
            <input class="form-title" type="hidden" name="uid" readonly>  
        </div>
        <div class="form-group">
            <div class="btn-box">
                <input type="submit" id="submit" class="btn btn-primary">
            </div>
        </div>
    </form>
</div>




</body>
</html>



