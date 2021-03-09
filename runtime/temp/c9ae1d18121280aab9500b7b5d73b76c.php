<?php /*a:5:{s:61:"D:\WWW\DEMO\application\admin\view\system\addConfigValue.html";i:1600074222;s:51:"D:\WWW\DEMO\application\admin\view\base\common.html";i:1614764407;s:53:"D:\WWW\DEMO\application\admin\view\Public\header.html";i:1614912062;s:51:"D:\WWW\DEMO\application\admin\view\Public\left.html";i:1600158584;s:53:"D:\WWW\DEMO\application\admin\view\Public\footer.html";i:1601433002;}*/ ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>新增参数配置</title>
<!-- <script src="/static/index/js/jquery-3.4.1.min.js"></script> -->
<script type="text/javascript" src="/static/index/js/jquery-1.11.3.min.js"></script>
<script src="/static/index/js/parmies-ajax.js"></script>
<script src="/static/index/js/layui/layui.js"></script>
<link rel="stylesheet" type="text/css" href="/static/index/css/style.css">
</head>

<body>
    
    <div class="header-c">
	<a href="/" target="_blank" class="logo"><img src="/static/index/images/logo.png"><i></i><b>规范税务管理，降低企业成本</b></a>
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
            

    <div class="rbox">
        <div class="top">
            <h2>企业需求详情</h2>
        </div>
        <div class="btm">
            <form action="" id="myForm">
                <table border="0" cellpadding="0" cellspacing="0" class="table02" width="400">
                    <tr>
                        <td>参数名称（用于C函数调用，只能使用英文或下滑线且不能重复）: </td>
                    </tr>
                    <tr>
                        <td><input type="text" class="intxt" name="name" value="<?php echo htmlentities((isset($info['name']) && ($info['name'] !== '')?$info['name']:'')); ?>"></td>
                    </tr>

                    <tr>
                        <td>标题（用于后台显示的配置标题）: </td>
                    </tr>
                    <tr>
                        <td><input type="text" class="intxt" name="title" value="<?php echo htmlentities((isset($info['title']) && ($info['title'] !== '')?$info['title']:'')); ?>"></td>
                    </tr>

                    <tr>
                        <td>排序（用于分组显示的顺序）: </td>
                    </tr>
                    <tr>
                        <td><input type="text" class="intxt" name="sort" value="<?php echo htmlentities((isset($info['sort']) && ($info['sort'] !== '')?$info['sort']:'')); ?>"></td>
                    </tr>
                    <tr>
                        <td>配置类型（系统会根据不同类型解析配置值）: </td>
                    </tr>
                    <tr>
                        <td>
                            <select name="type">
                                <?php $_result=getConfigType();if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$doc): $mod = ($i % 2 );++$i;?>
                                    <option value="<?php echo htmlentities($doc['type']); ?>" <?php if(!empty($info['type']) && $info['type']==$doc['type']): ?>selected<?php endif; ?>><?php echo htmlentities($doc['des']); ?></option>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>配置分组（配置分组 用于批量设置 不分组则不会显示在系统设置中）:</td>
                    </tr>
                    <tr>
                        <td>
                            <select name="group">
                                <?php $_result=getConfigGroup();if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$doc): $mod = ($i % 2 );++$i;?>
                                    <option value="<?php echo htmlentities($doc['0']); ?>" <?php if(!empty($info['group']) && $info['group']==$doc[0]): ?>selected<?php endif; ?>><?php echo htmlentities($doc['1']); ?></option>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>配置值: </td>
                    </tr>
                    <tr>
                        <td><textarea name="value" class="inarea" cols="30" rows="10"><?php echo htmlentities((isset($info['value']) && ($info['value'] !== '')?$info['value']:'')); ?></textarea></td>
                    </tr>
                    <tr>
                        <td>配置项（如果是枚举型 需要配置该项）: </td>
                    </tr>
                    <tr>
                        <td><textarea name="extra" class="inarea" cols="30" rows="10"><?php echo htmlentities((isset($info['extra']) && ($info['extra'] !== '')?$info['extra']:'')); ?></textarea></td>
                    </tr>
                    <tr>
                        <td>配置说明（配置详细说明）: </td>
                    </tr>
                    <tr>
                        <td><textarea name="description" class="inarea" cols="30" rows="10"><?php echo htmlentities((isset($info['description']) && ($info['description'] !== '')?$info['description']:'')); ?></textarea></td>
                    </tr>
                    <tr>
                        <td>
                            <input type="hidden" name="id" value="<?php echo htmlentities((isset($info['id']) && ($info['id'] !== '')?$info['id']:'')); ?>">
                            <input type="button" class="formButton inbtn" value="确认">
                            <input type="button" class="inback" value="返回" onclick="return window.history.back();">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>


    <script>
        layui.use(['layer'], function(){
            const layer = layui.layer;

            $('#myForm').on('click','.formButton',function(){
                $(this).attr('disabled','disabled');
                layer.load();
                const formData = new FormData($('#myForm')[0]);
                parimesPost("/system/addConfigValue",formData).then((res)=>{
                    layer.msg(res.Msg);
                    if(res.status==1){
                        // 跳转
                        setTimeout(() => {
                            window.location.href='/system/configValue.html';
                        }, 1500);
                        
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