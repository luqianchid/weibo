<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:59:"D:\www\weibo\public/../application/admin\view\info\add.html";i:1557420049;s:52:"D:\www\weibo\application\admin\view\common\head.html";i:1553485941;s:51:"D:\www\weibo\application\admin\view\common\nav.html";i:1553650330;}*/ ?>
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

<div id="Edibox">
    <div class="col-md-8 col-md-offset-2 info-cont">
        <div class="formup">
            <form action="" class="form-mt" enctype="multipart/form-data" method="post">
                <div class="form-group">
                    <input class="form-title" type="text" name="title" id="art_title" placeholder="请输入标题">
                </div>
                <div class="form-group">      
                    <input class="layui-textarea" id="editor" name="content" style="display: none">  
                </div>
                <div class="form-group">
                    <div class="btn-box">
                        <input type="submit" id="submit" class="btn btn-primary">
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>

<script src="/static/index/js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="/static/index/layui.js"></script>
<script type="text/javascript">
    layui.use('layedit', function(){
    var layedit = layui.layedit,$ = layui.jquery;  
    //构建一个默认的编辑器
    var index = layedit.build('editor');      
   
   
    });
</script>

</body>
</html>



