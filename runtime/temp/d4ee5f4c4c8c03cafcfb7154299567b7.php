<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:65:"D:\www\weibo\public/../application/index\view\editor\ArtEdit.html";i:1554545918;s:52:"D:\www\weibo\application\index\view\common\head.html";i:1548331519;s:51:"D:\www\weibo\application\index\view\common\nav.html";i:1554475637;s:50:"D:\www\weibo\application\index\view\common\js.html";i:1553754266;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
		<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="stylesheet" href="/static/index/css/bootstrap.min.css">
<link rel="stylesheet" href="/static/index/css/main.css">

		<title>编辑我的文章</title>
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

<div class="col-md-12 h100">
		<div class="col-md-3">
				<div class="bar-title">管理我的文章</div>
				<div class="new-art-list">
						<ul class="art-list">
								<?php if(is_array($artlist) || $artlist instanceof \think\Collection || $artlist instanceof \think\Paginator): $i = 0; $__LIST__ = $artlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$art): $mod = ($i % 2 );++$i;?>
								<li class="art-list-item">
									<div class="art-title-url">
										<a href="<?php echo url('Editor/index',['artid'=>$art['aid']]); ?>"><?php echo $art['title']; ?></a>
										<div class="edited-time"><?php echo date("m-d",$art['create_time']); ?></div>
									</div>
									<div class="art-ctrl">
											<a href="<?php echo url('Editor/DelArt',['artid'=>$art['aid']]); ?>">删除</a>
											<a href="<?php echo url('Editor/EditArt',['artid'=>$art['aid']]); ?>">编辑</a>
									</div>
								</li>
								<?php endforeach; endif; else: echo "" ;endif; ?>
						</ul>
				</div>
		</div>
		<div class="col-md-8 right-cont">
				<div class="formup">

						<form action="/index/Editor/saveEdit" class="form-mt" enctype="multipart/form-data" method="post">
								<?php if(is_array($article) || $article instanceof \think\Collection || $article instanceof \think\Paginator): $i = 0; $__LIST__ = $article;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$a): $mod = ($i % 2 );++$i;?>
								<div class="form-group">
										<input class="form-title" type="text" name="title" id="art_title" value="<?php echo $a['title']; ?>">
								</div>
								<div class="form-group">
										<input class="form-intro" type="text" name="intro" id="art_intro" value="<?php echo $a['intro']; ?>">
								</div>
								<div class="form-group">
										<input class="form-check" type="hidden" name="id" value="<?php echo $a['aid']; ?>" readonly>
								</div>
								<div class="form-group">
										<div id="edi" class="form-check" style="height:350px;"><?php echo $a['content']; ?></div>
										<textarea id="editor" class="form-check" name="editor" style="display: none;"></textarea>
								</div>
								<div class="form-group">
									<label for="imgPreview">上传你的封面(比例为10:3)</label>
									<div id="imgPreview">
										<div id="prompt3">
										<span id="imgSpan">
										点击上传
											<br />
										<i class="glyphicon glyphicon-plus"></i>
											<!--AUI框架中的图标-->
										</span>
										<input type="file" id="file" name="cover" class="filepath" onchange="changepic(this)" accept="image/jpg,image/jpeg,image/png,image/PNG">
											<!--当vaule值改变时执行changepic函数，规定上传的文件只能是图片-->
										</div>
										<img src="#" id="img3" />
									</div> 									
								</div>								
								<?php endforeach; endif; else: echo "" ;endif; ?>								
								<div class="form-group">
									<div class="form-send">
										选择发布方式:
										<select id="subtype" name="subtype">
												<option value="1">发布</option>
												<option value="0">存草稿</option>
										</select>
									</div>
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

<script type="text/javascript" src="/static/index/js/myAnimate.js"></script>

<script src="/static/index/js/bootstrap.js"></script>

<script src="/static/index/js/layer/layer.js"></script>


<script type="text/javascript" src="/static/index/js/wangEditor.min.js"></script>
<script type="text/javascript">
    var E = window.wangEditor;
    var edi = new E('#edi');
	var $editor = $('#editor');
	edi.customConfig.menus = [
        'bold',  // 粗体
        'fontSize',  // 字号 
        'link',  // 插入链接
        'justify',  // 对齐方式
        'image',  // 插入图片
    ]
    edi.customConfig.onchange = function (html) {
        // 监控变化，同步更新到 textarea
        $editor.val(html)
    }
    edi.create()
    // 初始化 textarea 的值
    $editor.val(edi.txt.html())
</script>
<script type="text/javascript">
	function changepic() {
        $("#prompt3").css("display", "none");
        var reads = new FileReader();
        f = document.getElementById('file').files[0];
        reads.readAsDataURL(f);
        reads.onload = function(e) {
        document.getElementById('img3').src = this.result;
        $("#img3").css("display", "block");
        };
    }
</script>
</body>
</html>



