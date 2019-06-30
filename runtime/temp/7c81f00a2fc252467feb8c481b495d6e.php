<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:64:"D:\www\weibo\public/../application/index/view/common/right2.html";i:1553756629;}*/ ?>

		<div class="admin_post">
				<div class="hot_head">
						<a class="pull-left">公告栏</a>

				</div>
				<div class="hot_ul">
						<ul class="list-group">
								<?php if(is_array($infolist) || $infolist instanceof \think\Collection || $infolist instanceof \think\Paginator): $i = 0; $__LIST__ = $infolist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$il): $mod = ($i % 2 );++$i;?>
								<li class="list-group-item"><a href="<?php echo url('info/index',['infoid'=>$il['infoid']]); ?>"><?php echo $il['title']; ?></a><span class="pull-right"><?php echo tranTime($il['create_time']); ?></span></li>
								<?php endforeach; endif; else: echo "" ;endif; ?>
						</ul>
				</div>
		</div>
</div>
