<?php /*a:5:{s:60:"D:\WWW\DEMO\application\index\view\rule\accessAuthority.html";i:1600080336;s:51:"D:\WWW\DEMO\application\index\view\base\common.html";i:1599103134;s:53:"D:\WWW\DEMO\application\index\view\Public\header.html";i:1598516168;s:51:"D:\WWW\DEMO\application\index\view\Public\left.html";i:1600158584;s:53:"D:\WWW\DEMO\application\index\view\Public\footer.html";i:1601433002;}*/ ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>用户访问授权设置</title>
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
            
    <div class="rbox">
        <div class="top">
            <h2><?php echo htmlentities((isset($user_group['title']) && ($user_group['title'] !== '')?$user_group['title']:'')); ?></h2>
        </div>
        <div class="btm">
            <form action="" id="myForm_group">
            
                <?php if(is_array($rule) || $rule instanceof \think\Collection || $rule instanceof \think\Paginator): $i = 0; $__LIST__ = $rule;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$doc_1): $mod = ($i % 2 );++$i;?>
                
                <div class="qxbox">
                    <div class="t">
                        <h2><?php echo htmlentities($doc_1['type']); ?></h2>
                    </div>
                    <div class="b">
                        <h3>
                            <label>
                                <input type="checkbox" class="incheck" name="rule[]" value="<?php echo htmlentities($doc_1['id']); ?>" title="<?php echo htmlentities($doc_1['route']); ?>" pid="<?php echo htmlentities($doc_1['pid']); ?>" <?php echo explodeCheck($user_group['rule'],$doc_1['id'])?'checked="checked"':''; ?>><?php echo htmlentities($doc_1['title']); ?>
                                
                            </label>
                        </h3>
                        <ul>
                            <?php if(is_array($doc_1['list']) || $doc_1['list'] instanceof \think\Collection || $doc_1['list'] instanceof \think\Paginator): $i = 0; $__LIST__ = $doc_1['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$doc_2): $mod = ($i % 2 );++$i;?>
                            
                            <li class="o">
                                <h4>
                                    <label>
                                        <input type="checkbox" class="incheck" name="rule[]" value="<?php echo htmlentities($doc_2['id']); ?>" title="<?php echo htmlentities($doc_2['route']); ?>" pid="<?php echo htmlentities($doc_2['pid']); ?>" <?php echo explodeCheck($user_group['rule'],$doc_2['id'])?'checked="checked"':''; ?>><?php echo htmlentities($doc_2['title']); ?>
                                        
                                    </label>
                                </h4>
                                <dl>
                                    <?php if(is_array($doc_2['list']) || $doc_2['list'] instanceof \think\Collection || $doc_2['list'] instanceof \think\Paginator): $i = 0; $__LIST__ = $doc_2['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$doc_3): $mod = ($i % 2 );++$i;?>
                                    
                                    <dd>
                                        <label>
                                            <input type="checkbox" class="incheck" name="rule[]" value="<?php echo htmlentities($doc_3['id']); ?>" title="<?php echo htmlentities($doc_3['route']); ?>" pid="<?php echo htmlentities($doc_3['pid']); ?>" <?php echo explodeCheck($user_group['rule'],$doc_3['id'])?'checked="checked"':''; ?>><?php echo htmlentities($doc_3['title']); ?>
                                        </label>
                                        <ol>
                                            <?php if(is_array($doc_3['list']) || $doc_3['list'] instanceof \think\Collection || $doc_3['list'] instanceof \think\Paginator): $i = 0; $__LIST__ = $doc_3['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$doc_4): $mod = ($i % 2 );++$i;?>
                                            
                                            <li class="ta">
                                                <label>
                                                    <input type="checkbox" class="incheck" name="rule[]" value="<?php echo htmlentities($doc_4['id']); ?>" title="<?php echo htmlentities($doc_4['route']); ?>" pid="<?php echo htmlentities($doc_4['pid']); ?>" <?php echo explodeCheck($user_group['rule'],$doc_4['id'])?'checked="checked"':''; ?>><?php echo htmlentities($doc_4['title']); ?>
                                                </label>
                                            </li>
                                            <?php endforeach; endif; else: echo "" ;endif; ?>
                                        </ol>
                                    </dd>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </dl>
                            </li>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                        </ul>
                    </div>
                </div>
                <?php endforeach; endif; else: echo "" ;endif; ?>

                <div style="margin-left: 80px;">
                    <input type="hidden" name="id" value="<?php echo htmlentities((isset($user_group['id']) && ($user_group['id'] !== '')?$user_group['id']:'')); ?>">
                    <input type="button" class="inbtn" value="确认" id="formButton_group">
                    <input type="button" class="inback" value="返回" onclick="window.history.back();">
                </div>
            </form>

        </div>
    </div>
    
    
    <script>
        layui.use(['layer'], function(){
            const layer = layui.layer;
            $('form #formButton_group').on('click',function(){
                $(this).attr('disabled','disabled');
                const id = $(this).attr('rel-id');
                layer.load();
                const formData = new FormData($('#myForm_group')[0]);
                if(formData.get('rule[]')==null){
                    formData.set('rule[]','');
                }

                parimesPost("/rule/accessAuthority",formData).then((res)=>{
                    layer.msg(res.Msg);
                    if(res.status==1){
                        // 跳转
                        window.location.href="/rule/authorityGroupList.html";
                    }
                }).catch((error)=>{
                    layer.msg(error);
                })
                $(this).removeAttr('disabled');
                layer.closeAll('loading');
            })

            
            $('input[name="rule[]"]').change(function(){
                console.log($(this).val());
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