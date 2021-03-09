<?php /*a:5:{s:58:"D:\WWW\DEMO\application\index\view\adminNews\newsList.html";i:1614856202;s:51:"D:\WWW\DEMO\application\index\view\base\common.html";i:1614764407;s:53:"D:\WWW\DEMO\application\index\view\Public\header.html";i:1598516168;s:51:"D:\WWW\DEMO\application\index\view\Public\left.html";i:1600158584;s:53:"D:\WWW\DEMO\application\index\view\Public\footer.html";i:1601433002;}*/ ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>网站栏目</title>
<!-- <script src="/static/index/js/jquery-3.4.1.min.js"></script> -->
<script type="text/javascript" src="/static/index/js/jquery-1.11.3.min.js"></script>
<script src="/static/index/js/parmies-ajax.js"></script>
<script src="/static/index/js/layui/layui.js"></script>
<link rel="stylesheet" type="text/css" href="/static/index/css/style.css">
</head>

<body>
    
    <div class="header-c">
	<a href="/" class="logo"><img src="/static/index/images/logo.png"><i></i><b>规范税务管理，降低企业成本</b></a>
	<div class="r">
        <div class="box">
            <i><img src="/static/index/images/h-tx.png"></i>
            <p><?php echo htmlentities(app('session')->get('Nickname.username')); ?></p>
            <i><img src="/static/index/images/h-icon01.png"></i>
        </div>
        <div class="lists">
            <ul>
                <li><a href="<?php echo url('/user/logOut'); ?>" class="logout">退出</a></li>
            </ul>
        </div>
        
	</div>
	<div style="clear: both;"></div>
</div>

    <div class="contbox">
        <!-- 左侧 -->
        <div class="l">
            <?php echo leftCategory($url); ?>

<!-- <ul>
    <li><a href="<?php echo url('/user/center'); ?>" class="name"><i><img src="/static/index/images/c01.png"></i><b>管理首页</b></a></li>
    <li>
        <a href="javascript:;" class="name down"><i><img src="/static/index/images/c02.png"></i><b>管理员设置</b></a>
        <dl style="display: block;">
            <dd><a href="<?php echo url('/user/addUser'); ?>" class="tits">新增用户</a></dd>
            <dd>
                <a href="javascript:;" class="tits down">权限管理</a>
                <ol style="display: block;">
                    <li><a href="<?php echo url('/rule/authorityGroupList'); ?>" class="tit">权限分组</a></li>
                    <li><a href="<?php echo url('/rule/authorityList'); ?>" class="tit">规则列表</a></li>
                    <li><a href="<?php echo url('/user/listUser'); ?>" class="tit">用户授权</a></li>
                </ol>
            </dd>					
            <dd><a href="<?php echo url('/user/log'); ?>" class="tits">用户行为</a></dd>
        </dl>
    </li>
    <li>
        <a href="javascript:;" class="name down"><i><img src="/static/index/images/c07.png"></i><b>企业端管理</b></a>
        <dl>
            <dd><a href="<?php echo url('/audit/bossAccountList'); ?>" class="tits"><i><img src="/static/index/images/c03.png"></i><b>企业账号审核</b></a></dd>
            <dd><a href="<?php echo url('/audit/bossReleaseList'); ?>" class="tits"><i><img src="/static/index/images/c05.png"></i><b>需求审核</b></a></dd>
            <dd><a href="<?php echo url('/audit/bossContractReviewL'); ?>" class="tits"><i><img src="/static/index/images/c06.png"></i><b>企业签约审核</b></a></dd>
        </dl>
    </li>
    <li>
        <a href="javascript:;" class="name down"><i><img src="/static/index/images/c07.png"></i><b>职业者端管理</b></a>
        <dl>
            <dd><a href="<?php echo url('/audit/workerAccountList'); ?>" class="tits"><i><img src="/static/index/images/c04.png"></i><b>职业者账号审核</b></a></dd>
            <dd><a href="<?php echo url('/audit/workerContractReviewL'); ?>" class="tits"><i><img src="/static/index/images/c07.png"></i><b>职业者签约审核</b></a></dd>
        </dl>
    </li>
    
    <li>
        <a href="javascript:;" class="name down"><i><img src="/static/index/images/c08.png"></i><b>费用结算</b></a>
        <dl style="display:block;">
            <dd><a href="<?php echo url('/money/budgetSalary'); ?>" class="tits">预算所得</a></dd>
        </dl>
    </li>

    <li><a href="javescript:;" class="name"><i><img src="/static/index/images/c08.png"></i><b>发票管理</b></a></li>
    <li>
        <a href="javescript:;" class="name down"><i><img src="/static/index/images/c09.png"></i><b>系统设置</b></a>
        <dl>
            <dd><a href="<?php echo url('/system/platformSettings'); ?>" class="tits">平台设置</a></dd>
            <dd><a href="<?php echo url('/system/configValue'); ?>" class="tits">参数配置</a></dd>
        </dl>
    </li>
</ul> -->
<ul class="out">
    <li><a href="<?php echo url('/user/logOut'); ?>" class="name"><i><img src="/static/index/images/c10.png"></i><b>退出系统</b></a></li>
</ul>
        </div>

        <!-- 右侧 -->
        <div class="r">
            
<link rel="stylesheet" href="/static/index/css/orgchart/jquery.orgchart.css" />
<link rel="stylesheet" href="/static/index/css/orgchart/index.css" />
<script type="text/javascript" src="/static/index/js/jquery.orgchart.js" ></script>

<div class="rbox">
    <div class="top">
        <h2>栏目位置：
            <?php $cate_lenght = count($category); if(is_array($category) || $category instanceof \think\Collection || $category instanceof \think\Paginator): $i = 0; $__LIST__ = $category;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$doc): $mod = ($i % 2 );++$i;?>
            <a href="/admin<?php echo strtoupper(substr($doc['rout_name'],0,1)); ?><?php echo substr($doc['rout_name'],1); ?>/<?php echo htmlentities($doc['rout_name']); ?>List/column_id/<?php echo htmlentities($doc['id']); ?>.thml">【<?php echo htmlentities($doc['title']); ?>】<?php if($cate_lenght!=$i): ?>><?php endif; ?></a>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </h2>
    </div>
    <div class="ctr">
        <?php $rout_url = strtoupper(substr($category[$cate_lenght-1]['rout_name'],0,1)); ?>
        <a href="/admin<?php echo htmlentities($rout_url); ?><?php echo substr($category[$cate_lenght-1]['rout_name'],1); ?>/<?php echo htmlentities($category[$cate_lenght-1]['rout_name']); ?>Add/column_id/<?php echo htmlentities($category[$cate_lenght-1]['id']); ?>.html" class="add">新增数据</a>
        <a href="" class="add">回收站</a>
        <a href="" class="add">草稿箱</a>
        <div class="seach">
            <form id="mySeach">
                <input type="text" class="intext" name="title" value="<?php echo htmlentities((isset($seach['title']) && ($seach['title'] !== '')?$seach['title']:'')); ?>" placeholder="标题 (模糊查询)">
                <select name="status" class="intext" style="height: 40px;">
                    <option value="">全部</option>
                    <?php $status = (isset($seach['status']) && ($seach['status'] !== '')?$seach['status']:''); ?>
                    <option value="1" <?php if($status == '1'): ?>selected<?php endif; ?>>正常</option>
                    <option value="2" <?php if($status == '2'): ?>selected<?php endif; ?>>待审核</option>
                    <option value="3" <?php if($status == '3'): ?>selected<?php endif; ?>>已禁用</option>
                    <option value="4" <?php if($status == '4'): ?>selected<?php endif; ?>>回收站</option>
                    <option value="5" <?php if($status == '5'): ?>selected<?php endif; ?>>草稿</option>
                </select>
                <input type="button" class="inbtn seachButton" value="搜索">
            </form>
        </div>
    </div>
    <div class="btm">
        <table class="table01" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <th>ID</th>
                <th>标题</th>
                <th>封面</th>
                <th>描述</th>
                <th>点击量</th>
                <th>修改时间</th>
                <th>状态</th>
                <th>操作</th>
            </tr>
            <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$doc): $mod = ($i % 2 );++$i;?>
            <tr>
                <td><?php echo htmlentities($doc['id']); ?></td>
                <td align="left"><?php if(mb_strlen($doc['title'])>20): ?><?php echo htmlentities(mb_substr($doc['title'],0,20)); ?>...<?php else: ?><?php echo htmlentities($doc['title']); ?><?php endif; ?></td>
                <td align="center" valign="center"><img src="<?php echo htmlentities(getImagePath($doc['cover_img'])); ?>" width="50" style="display: inline-block;vertical-align: middle;"></td>
                <td><?php if(mb_strlen($doc['description'])>15): ?><?php echo htmlentities(mb_substr($doc['description'],0,15)); ?>...<?php else: ?><?php echo htmlentities($doc['description']); ?><?php endif; ?></td>
                <td><?php echo htmlentities($doc['view']); ?></td>
                <td><?php echo htmlentities(date("Y-m-d",!is_numeric($doc['update_time'])? strtotime($doc['update_time']) : $doc['update_time'])); ?></td>
                <td>
                    <?php if($doc['status']==1): ?>正常
                    <?php elseif($doc['status']==2): ?>待审核
                    <?php elseif($doc['status']==3): ?>已禁用
                    <?php elseif($doc['status']==4): ?>已删除
                    <?php elseif($doc['status']==5): ?>草稿
                    <?php endif; ?>
                </td>
                <td style="line-height:25px;">
                    <p><span class="table-operating" url="/admin<?php echo htmlentities($rout_url); ?><?php echo substr($category[$cate_lenght-1]['rout_name'],1); ?>/<?php echo htmlentities($category[$cate_lenght-1]['rout_name']); ?>Add/column_id/<?php echo htmlentities($category[$cate_lenght-1]['id']); ?>/id/<?php echo htmlentities($doc['id']); ?>.html" onclick="return window.location.href=$(this).attr('url');">编辑</span></p>
                    <p><span class="table-operating">禁用/启用</span></p>
                    <p><span class="table-operating">删除</span></p>
                </td>
            </tr>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </table>
        <?php echo htmlspecialchars_decode($page->render); ?>
    </div>
</div>
<style>
    .btm table .table-operating{cursor:pointer}
    .seach{float: right;}
</style>
<script src="/static/index/js/base.js"></script>
<script>
    layui.use(['layer'], function(){
        const layer = layui.layer;
        // 筛选搜索
        var submit = function(){
            layer.load();
            const formdata      = new FormData($('#mySeach')[0]);
            const title         = formdata.get('title');
            const status        = formdata.get('status');
            
            let url = Base64.encode(`title=${title}&status=${status}`);
            let href = encodeURIComponent(url);
            window.location.href = `${window.location.origin}${window.location.pathname}?seach=${href}`;
        }
        $('#mySeach .seachButton').bind("click",submit)
        $('#mySeach input').bind("keyup",function(e){if(e.keyCode==13){submit()}})
    })
</script>

        </div>
        <div class="clearfix"></div>
    </div>
    
    <!-- <div class="footerbar">
	<div class="ft">
		<ul>
			<li>
				<i class="login01"></i>
				<h2>税务局授权，更权威</h2>
			</li>
			<li>
				<i class="login02"></i>
				<h2>官方平台经营，更安全</h2>
			</li>
			<li>
				<i class="login03"></i>
				<h2>一站式管理，更便捷</h2>
			</li>
			<li>
				<i class="login04"></i>
				<h2>经营所得一键发放，更省心</h2>
			</li>
		</ul>
	</div>
	<div class="fb">
		<p>© 2020 尤尼泰湖南财税集团_尤尼泰（湖南）税务师事务所 All Rights Reserved 湘ICP备17008186号  技术支持：蒲公英<a href="http://www.0731pgy.com/" target="_blank">长沙网站建设</a></p>
	</div>
</div> -->

<script type="text/javascript">
	//获取windows高度并赋值
    
    // var h = 863;
	// $(document).ready(function(){
	// 	var h = $(document).height() - 192;
	// 	$('.contbox .l').css('height', h);
	// 	$('.contbox .r').css('height', h);
	// });

	// 左侧点击展开效果
	$('.contbox .l ul li a.name').on('click', function(){
		$(this).siblings('.contbox .l ul li dl').toggle();
	})
	$('.contbox .l ul li dl dd a.tits').on('click', function(){
		$(this).siblings('.contbox .l ul li dl dd ol').toggle();
	})
</script>
    <script>
        var h = $(window).height();
	    $(document).ready(function(){
		    $('.contbox').css('min-height', h);
	    });
    </script>
</body>
</html>