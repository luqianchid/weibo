<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:62:"D:\www\weibo\public/../application/index/view/common/left.html";i:1553744628;}*/ ?>
<div class="col-md-2">
		<ul class="list-group hidden-md hidden-sm hidden-xs">
				<!--这里最好建一个数据表，根据表添加栏目，循环-->
				<li class="list-group-item"><a href="<?php echo url('index/index'); ?>">首页</a></li>
				<?php if(is_array($catelist) || $catelist instanceof \think\Collection || $catelist instanceof \think\Paginator): $i = 0; $__LIST__ = $catelist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$c): $mod = ($i % 2 );++$i;?>
				<li class="list-group-item"><a href="<?php echo url('cate/index',['cateid'=>$c['cateid']]); ?>"><?php echo $c['catename']; ?></a></li>
				<?php endforeach; endif; else: echo "" ;endif; ?>
		</ul>
</div>
