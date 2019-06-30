<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:67:"D:\www\weibo\public/../application/index\view\homepage\Forward.html";i:1553486733;s:52:"D:\www\weibo\application\index\view\common\head.html";i:1548331519;s:50:"D:\www\weibo\application\index\view\common\js.html";i:1553754266;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>    
    <title>转发</title>
    <meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="stylesheet" href="/static/index/css/bootstrap.min.css">
<link rel="stylesheet" href="/static/index/css/main.css">

</head>
<body>
    <div class="sendbox">
        <!-- <div class="head-bar">
            <?php if(is_array($name) || $name instanceof \think\Collection || $name instanceof \think\Paginator): $i = 0; $__LIST__ = $name;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$n): $mod = ($i % 2 );++$i;?>
            <div class="head-image"><img src="/static/index/<?php echo $n['avatar']; ?>"></div>
            <div class="head-name m_15"><?php echo $n['username']; ?></div>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </div> -->
        <div class="trans-content-text">
            <?php if(is_array($post) || $post instanceof \think\Collection || $post instanceof \think\Paginator): $i = 0; $__LIST__ = $post;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$p): $mod = ($i % 2 );++$i;?>
            <div class="quotes_cont">
                <div class="quotes-head-bar" data-resource="<?php echo $p['pid']; ?>">
                    <div class="quotes-head-name"><a href="<?php echo url('Homepage/index',['u'=>$p['user_id']]); ?>">@<?php echo $p['username']; ?></a></div>
                </div>
                <div class="quotes-content-text">
                    <p><?php echo $p['content']; ?></p>
                </div>
                <div class="quotes_func">
                    <div class="quotes-head-time pull-left"><?php echo tranTime($p['add_time']); ?></div>                    
                </div>
            </div>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </div>    
        <div class="sendbox_trans">
            <div class="input-area">
                <textarea name="send-weibo" id="transcont"></textarea>
            </div>
            <div class="func-area">
                <div class="kind">                   
                        <input class="btn btn-primary" value="转发" type="button" id="trans">
                </div>
            </div>          
        </div>
        
    </div>
    <script src="/static/index/js/jquery-2.1.1.min.js"></script>

<script type="text/javascript" src="/static/index/js/myAnimate.js"></script>

<script src="/static/index/js/bootstrap.js"></script>

<script src="/static/index/js/layer/layer.js"></script>

    <script type="text/javascript">
        $("#trans").click(function () {
            let pid  = $('.quotes-head-bar').attr('data-resource');
            console.log(pid);
            let cont = $("#transcont").val();
            $.ajax({
                url:'/index/Index/TransPost',
                    data:{'pid':pid,'cont':cont},
                    type:"post",
                success:function(data){
                                    if(data===1){
                        layer.alert('转发成功！',function () {
                                window.parent.location.reload();
                                parent.layer.close();
                        })
                                    }else{
                        layer.alert('转发失败！',function () {
                            window.parent.location.reload();
                            parent.layer.close();
                        })
                                    }
                },
            });
        });
    </script>          
</body>
</html>
