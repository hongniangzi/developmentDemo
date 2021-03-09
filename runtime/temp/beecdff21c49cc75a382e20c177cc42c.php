<?php /*a:5:{s:57:"D:\WWW\DEMO\application\index\view\column\columnData.html";i:1614827574;s:51:"D:\WWW\DEMO\application\index\view\base\common.html";i:1614764407;s:53:"D:\WWW\DEMO\application\index\view\Public\header.html";i:1598516168;s:51:"D:\WWW\DEMO\application\index\view\Public\left.html";i:1600158584;s:53:"D:\WWW\DEMO\application\index\view\Public\footer.html";i:1601433002;}*/ ?>
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
            <a href="/column/columnData/id/<?php echo htmlentities($doc['id']); ?>/.html">【<?php echo htmlentities($doc['title']); ?>】<?php if($cate_lenght!=$i): ?>><?php endif; ?></a>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </h2>
    </div>
    <div class="ctr">
        <a href="/<?php echo htmlentities($category[$cate_lenght-1]['rout_name']); ?>Admin/<?php echo htmlentities($category[$cate_lenght-1]['rout_name']); ?>Add" class="add">新增数据</a>
    </div>
    <div class="btm">
        <table class="table01" border="0" cellpadding="0" cellspacing="0">
            
        </table>
    </div>
</div>
<style>
    
</style>
<script>

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