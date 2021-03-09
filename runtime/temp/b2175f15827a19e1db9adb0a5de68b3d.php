<?php /*a:5:{s:63:"D:\WWW\DEMO\application\index\view\system\platformSettings.html";i:1602833990;s:51:"D:\WWW\DEMO\application\index\view\base\common.html";i:1614764407;s:53:"D:\WWW\DEMO\application\index\view\Public\header.html";i:1598516168;s:51:"D:\WWW\DEMO\application\index\view\Public\left.html";i:1600158584;s:53:"D:\WWW\DEMO\application\index\view\Public\footer.html";i:1601433002;}*/ ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>平台设置</title>
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
            <h2>平台设置</h2>
            <div class="links">
                [
                <?php $_result=getConfigGroup();if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$group): $mod = ($i % 2 );++$i;?>
                    <a href="<?php echo url('/system/platformSettings',array('group'=>$group[0])); ?>" <?php if($group[0] == $group_id): ?>class="hov"<?php endif; ?>><?php echo htmlentities($group[1]); ?></a>
                <?php endforeach; endif; else: echo "" ;endif; ?> 
                ]
            </div>
        </div>
        <div class="btm">
            <form id="myForm">
                <table border="0" cellpadding="0" cellspacing="0" class="table02">
                    <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$doc): $mod = ($i % 2 );++$i;switch($doc['type']): case "textarea": ?>
                                <tr>
                                    <td><?php echo htmlentities($doc['title']); ?>（<?php echo htmlentities(htmlspecialchars_decode($doc['description'])); ?>）：</td>
                                </tr>
                                <tr>
                                    <td><textarea class="inarea" name="<?php echo htmlentities($doc['name']); ?>|<?php echo htmlentities($doc['id']); ?>" <?php if($doc['name'] == 'WEB_INDUSTRY'): ?>style="width: 800px;"<?php endif; ?>><?php echo htmlentities((isset($doc['value']) && ($doc['value'] !== '')?$doc['value']:'')); ?></textarea></td>
                                </tr>
                            <?php break; case "string": ?>
                                <tr>
                                    <td><?php echo htmlentities($doc['title']); ?>（<?php echo htmlspecialchars_decode($doc['description']); ?>）：</td>
                                </tr>
                                <tr>
                                    <td><input type="text" class="intxt" name="<?php echo htmlentities($doc['name']); ?>|<?php echo htmlentities($doc['id']); ?>" value="<?php echo htmlentities((isset($doc['value']) && ($doc['value'] !== '')?$doc['value']:'')); ?>"></td>
                                </tr>
                            <?php break; case "int": ?>
                                <tr>
                                    <td><?php echo htmlentities($doc['title']); ?>（<?php echo htmlspecialchars_decode($doc['description']); ?>）：</td>
                                </tr>
                                <tr>
                                    <td><input type="text" class="intxt" name="<?php echo htmlentities($doc['name']); ?>|<?php echo htmlentities($doc['id']); ?>" value="<?php echo htmlentities((isset($doc['value']) && ($doc['value'] !== '')?$doc['value']:'')); ?>"></td>
                                </tr>
                            <?php break; case "boolean": ?>
                                <tr>
                                    <td><?php echo htmlentities($doc['title']); ?>（<?php echo htmlspecialchars_decode($doc['description']); ?>）：</td>
                                </tr>
                                <tr>
                                    <?php $_result=strInArr($doc['extra']);if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$extra): $mod = ($i % 2 );++$i;?>
                                    <td><input type="radio" class="inradio" name="<?php echo htmlentities($doc['name']); ?>|<?php echo htmlentities($doc['id']); ?>" value="<?php echo htmlentities($extra[0]); ?>" <?php if($extra[0] == $doc['value']): ?>checked<?php endif; ?>><?php echo htmlentities($extra[1]); ?></td>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </tr>
                            <?php break; case "select": ?>
                                <tr>
                                    <td><?php echo htmlentities($doc['title']); ?>（<?php echo htmlspecialchars_decode($doc['description']); ?>）：</td>
                                </tr>
                                <tr>
                                    <td>
                                        <select name="<?php echo htmlentities($doc['name']); ?>|<?php echo htmlentities($doc['id']); ?>"class="insele">
                                        <?php $_result=strInArr($doc['extra']);if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$extra): $mod = ($i % 2 );++$i;?>
                                            <option value="<?php echo htmlentities($extra[0]); ?>" <?php if($extra[0] == $doc['value']): ?>selected<?php endif; ?>><?php echo htmlentities($extra[1]); ?></option>
                                        <?php endforeach; endif; else: echo "" ;endif; ?>
                                        </select>
                                    </td>
                                </tr>
                            <?php break; case "file": ?>
                                <tr>
                                    <td><?php echo htmlentities($doc['title']); ?>（<?php echo htmlspecialchars_decode($doc['description']); ?>）：</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="layui-upload">
                                            <?php $file = getImagePath($doc['value']); ?>
                                            <input type="file" class="layui-btn" name="file">
                                            <span class="file-name" title="<?php echo htmlentities($file); ?>"><?php echo htmlentities($file); ?></span>
                                            <span class="inbtn file-inbtn" style="width: 70px;height: 36px;line-height: 36px;">上传</span>
                                            <input type="hidden" class="hidden-name" name="<?php echo htmlentities($doc['name']); ?>|<?php echo htmlentities($doc['id']); ?>" value="<?php echo htmlentities((isset($doc['value']) && ($doc['value'] !== '')?$doc['value']:'')); ?>">
                                            <div class="layui-upload-list">
                                                <?php if(!(empty($file) || (($file instanceof \think\Collection || $file instanceof \think\Paginator ) && $file->isEmpty()))): ?>
                                                <a href="<?php echo htmlentities($file); ?>" target="_blank">
                                                    <img src="<?php echo htmlentities($file); ?>" class="layui-upload-img">
                                                </a>
                                                <?php endif; ?>
                                            </div>
                                          </div>
                                    </td>
                                </tr>
                            <?php break; ?>
                        <?php endswitch; ?>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                    <tr>
                        <td><a href="javascript:;" class="inbtn formButton">确认</a></td>
                    </tr>
                   
                </table>
            </form>
        </div>
    </div>
    <!--  -->
    <style>
        input.layui-btn{width: 4.5%;}
        .layui-upload-img{width: 92px; height: 92px; margin: 0 10px 10px 0;}
        .file-name{display: inline-block;vertical-align: middle;font-size: 15px;color: #333;line-height: 30px;text-align: center;width: 146px;text-overflow: ellipsis;white-space: nowrap;overflow: hidden;}
    </style>
    <script>
        layui.use(['layer'], function(){
            const layer = layui.layer;
            layer.load();

            layer.closeAll('loading');

            $('#myForm').on('click','.formButton',function(){
                $(this).attr('disabled','disabled');
                layer.load();
                const formData = new FormData($('#myForm')[0]);
                parimesPost("/system/platformSettings",formData).then((res)=>{
                    layer.msg(res.Msg);
                    if(res.status==1){
                        // 跳转
                        setTimeout(() => {
                            window.location.reload();
                        }, 1500);
                        
                    }
                }).catch((error)=>{
                    layer.msg(error);
                })
                $(this).removeAttr('disabled');
                layer.closeAll('loading');
            })


            // 文件选择
            $('.layui-upload').on('change','input[name="file"]',function(){
                const files = $(this).prop('files');
                if(!files[0]){
                    console.log(files);
                    return false;
                }
                const src = window.URL.createObjectURL(files[0]);
                const size = (files[0].size/1024/1024).toFixed(2)+'M';
                const img = `<a href="${src}" target="_blank">
                                <img src="${src}" class="layui-upload-img">
                            </a>`;
                $(this).siblings('.file-name').text(`【${size}】${files[0].name}`);
                $(this).siblings('.file-name').prop('title',`【${size}】${files[0].name}`);
                $(this).siblings('.layui-upload-list').children('a').remove();
                $(this).siblings('.layui-upload-list').append(img);
            })
            // 文件上传
            $('.layui-upload').on('click','.file-inbtn',function(){
                $(this).attr('disabled','disabled');
                layer.load();
                const that = $(this);
                const formData = new FormData();
                const files = $(this).siblings('input[name="file"]').prop('files');
                if(!files[0]){
                    layer.closeAll('loading');
                    layer.msg('文件数据丢失,请刷新重选');
                    return false;
                }
                formData.set('file',files[0]);
                parimesPost("/system/uploadImg",formData).then((res)=>{
                    if(res.status==1){
                        layer.msg('上传成功');
                        that.siblings('.hidden-name').val(res.id);
                    }else{
                        layer.msg(res.Msg);
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