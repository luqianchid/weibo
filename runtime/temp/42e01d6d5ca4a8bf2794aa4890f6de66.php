<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:61:"D:\www\weibo\public/../application/admin\view\unit\index.html";i:1557418894;s:52:"D:\www\weibo\application\admin\view\common\head.html";i:1553485941;s:51:"D:\www\weibo\application\admin\view\common\nav.html";i:1553650330;s:52:"D:\www\weibo\application\admin\view\common\left.html";i:1553653608;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="stylesheet" href="/static/index/css/bootstrap.min.css">
<link rel="stylesheet" href="/static/index/css/main.css">

    <title>文章管理页面</title>
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
        <a href="<?php echo url('unit/unitadd'); ?>" class="btn btn-default">+ 添加新栏目</a>
        <table class="table table-striped table-bordered">
                <thead class="text-center">
                    <tr>
                        <th class="text-center" width="100px">CateID</th>
                        <th class="text-center">栏目名称</th>                                                   
                        <th class="text-center" width="240px">操作</th>
                    </tr>
                    </thead>
                    <tbody>   
                    <?php if(is_array($unit) || $unit instanceof \think\Collection || $unit instanceof \think\Paginator): $i = 0; $__LIST__ = $unit;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$u): $mod = ($i % 2 );++$i;?>   
                    <tr>
                        <td align="center"><?php echo $u['cateid']; ?></td>
                        <td align="center"><?php echo $u['catename']; ?></a></td>                                                  
                        <td align="center"> 
                            <a href="<?php echo url('unit/unitedit'); ?>?cateid=<?php echo $u['cateid']; ?>" class="btn btn-primary btn-sm shiny">
                                <i class="fa fa-trash-o"></i> 编辑
                            </a>                                   
                            <a href="<?php echo url('unit/del'); ?>?cateid=<?php echo $u['cateid']; ?>" onClick="warning('确实要删除吗')" class="btn btn-danger btn-sm shiny">
                                <i class="fa fa-trash-o"></i> 删除
                            </a>
                        </td>
                    </tr>     
                    <?php endforeach; endif; else: echo "" ;endif; ?>               
                </tbody>
                <div class="page-list">
                    <?php echo $unit->render(); ?>
                </div>
        </table>
  
</div>
<script>
    function warning(str){
        alert(str);
    }
</script>
</body>
</html>