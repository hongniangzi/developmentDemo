<?php /*a:5:{s:58:"D:\WWW\DEMO\application\index\view\Rule\editAuthority.html";i:1600166746;s:51:"D:\WWW\DEMO\application\index\view\base\common.html";i:1599103134;s:53:"D:\WWW\DEMO\application\index\view\Public\header.html";i:1598516168;s:51:"D:\WWW\DEMO\application\index\view\Public\left.html";i:1600158584;s:53:"D:\WWW\DEMO\application\index\view\Public\footer.html";i:1601433002;}*/ ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>路由规则管理(编辑)</title>
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
            
    <!--  -->
    <div class="rbox">
        <div class="top">
            <h2>分组管理(新增)</h2>
        </div>
        <div class="btm">
            <form id="myForm">
                <table border="0" cellpadding="0" cellspacing="0" class="table02" width="400">
                    <tr>
                        <td align="right" width="100">标题：</td>
                        <td><input type="text" name="title" class="intxt" value="<?php echo htmlentities((isset($info['title']) && ($info['title'] !== '')?$info['title']:'')); ?>"></td>
                    </tr>
                    <tr>
                        <td align="right" width="100">路由链接：</td>
                        <td><input type="text" name="route" class="intxt" value="<?php echo htmlentities((isset($info['route']) && ($info['route'] !== '')?$info['route']:'')); ?>"></td>
                    </tr>
                    <tr>
                        <td align="right" width="100">规则类型：</td>
                        <td>
                            <input type="radio" name="route_type" value="1" <?php echo $info['route_type']==1 ? "checked" : ""; ?>>仅栏目&emsp;
                            <input type="radio" name="route_type" value="2" <?php echo $info['route_type']==2 ? "checked" : ""; ?>>仅动作&emsp;
                            <input type="radio" name="route_type" value="3" <?php echo $info['route_type']==3 ? "checked" : ""; ?>>栏目/动作&emsp;
                        </td>
                    </tr>
                    <tr>
                        <td align="right" width="100">图标地址(支持网络地址)：</td>
                        <td><input type="text" name="icon" class="intxt" value="<?php echo htmlentities((isset($info['icon']) && ($info['icon'] !== '')?$info['icon']:'')); ?>"></td>
                    </tr>
                    <tr>
                        <td align="right" width="100">路由类型：</td>
                        <td><input type="text" name="type" class="intxt" value="<?php echo htmlentities((isset($info['type']) && ($info['type'] !== '')?$info['type']:'')); ?>"></td>
                    </tr>
                    <tr>
                        <td align="right" width="100">状态：</td>
                        <td>
                            <input type="radio" name="status" value="1" <?php echo $info['status']==1 ? "checked" : ""; ?>>启用
                            <input type="radio" name="status" value="0" <?php echo $info['status']==0 ? "checked" : ""; ?>>禁用
                        </td>
                    </tr>
                    <tr>
                        <td align="right" width="100">排序优先级：</td>
                        <td><input type="text" name="level" class="intxt" value="<?php echo htmlentities((isset($info['level']) && ($info['level'] !== '')?$info['level']:'')); ?>"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="hidden" value="<?php echo htmlentities((isset($info['id']) && ($info['id'] !== '')?$info['id']:'')); ?>" name="id">
                            <input type="hidden" value="<?php echo htmlentities((isset($info['pid']) && ($info['pid'] !== '')?$info['pid']:0)); ?>" name="pid">
                            <input type="button" value="确认" class="inbtn" id="formButton">
                            <input type="button" value="返回" class="inback" onclick="window.history.back();">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    <!--  -->
    <script>
        layui.use(['layer'], function(){
            const layer = layui.layer;

            $('#myForm #formButton').click(function(){
                $(this).attr('disabled','disabled');
                layer.load();
                const formData = new FormData($('#myForm')[0]);
                parimesPost("/rule/editAuthority",formData).then((res)=>{
                    layer.msg(res.Msg);
                    if(res.status==1){
                        // 跳转
                        window.location.href='/rule/authorityList.html';
                    }
                }).catch((error)=>{
                    layer.msg(error);
                })
                $(this).removeAttr('disabled');
                layer.closeAll('loading');
            })
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