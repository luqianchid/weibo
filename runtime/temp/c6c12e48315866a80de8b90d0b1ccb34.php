<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:60:"D:\www\weibo\public/../application/admin\view\info\edit.html";i:1553524669;s:52:"D:\www\weibo\application\admin\view\common\head.html";i:1553485941;s:51:"D:\www\weibo\application\admin\view\common\nav.html";i:1553650330;}*/ ?>
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
            <form action="/admin/Info/saveedit" class="form-mt" enctype="multipart/form-data" method="post">
                <?php if(is_array($editinfo) || $editinfo instanceof \think\Collection || $editinfo instanceof \think\Paginator): $i = 0; $__LIST__ = $editinfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$e): $mod = ($i % 2 );++$i;?>
                <div class="form-group">
                    <input value="<?php echo $e['title']; ?>" class="form-title" type="text" name="title" id="art_title" placeholder="请输入标题">
                </div>
                <div class="form-group">
                    <input value="<?php echo $e['infoid']; ?>" class="form-title" type="hidden" name="infoid" id="art_title" readonly>
                </div>               
                <div class="form-group">      
                    <input class="layui-textarea" value='<?php echo $e['content']; ?>' id="editor" name="content" style="display: none">  
                </div>
                <?php endforeach; endif; else: echo "" ;endif; ?>
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



