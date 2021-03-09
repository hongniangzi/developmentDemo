<?php /*a:5:{s:57:"D:\WWW\DEMO\application\index\view\column\columnEdit.html";i:1614828617;s:51:"D:\WWW\DEMO\application\index\view\base\common.html";i:1614764407;s:53:"D:\WWW\DEMO\application\index\view\Public\header.html";i:1598516168;s:51:"D:\WWW\DEMO\application\index\view\Public\left.html";i:1600158584;s:53:"D:\WWW\DEMO\application\index\view\Public\footer.html";i:1601433002;}*/ ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>栏目管理</title>
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
            <h2>栏目管理(编辑)</h2>
        </div>
        <div class="btm">
            <form id="myForm">
                <table border="0" cellpadding="0" cellspacing="0" class="table02" width="400">
                    <tr>
                        <td align="right" width="200">栏目名称：</td>
                        <td><input type="text" class="intxt" name="title" value="<?php echo htmlentities($info['title']); ?>"></td>
                    </tr>
                    <tr>
                        <td align="right" width="100">英文栏目名称（非必填）：</td>
                        <td><input type="text" class="intxt" name="title_en" value="<?php echo htmlentities($info['title_en']); ?>"></td>
                    </tr>
                    <tr>
                        <td align="right" width="100">路由标识：</td>
                        <td><input type="text" class="intxt" name="rout_name" value="<?php echo htmlentities($info['rout_name']); ?>"><span>（多词请使用小驼峰规则）</span></td>
                    </tr>
                    <tr>
                        <td align="right" width="100">导航显示：</td>
                        <td>
                            <label><input type="radio" name="is_nav" value="1" <?php echo $info['is_nav']==1 ? 'checked="true"' : ''; ?> > 显示</label>
                            &emsp;&emsp;&emsp;
                            <label><input type="radio" name="is_nav" value="0" <?php echo $info['is_nav']===0 ? 'checked="true"' : ''; ?> > 否</label>
                        </td>
                    </tr>
                    <tr>
                        <td align="right" width="100">模型选择：</td>
                        <td>
                            <select name="model_select" class="intxt">
                                <option value="">--请选择--</option>
                                <?php $_result=getModelType();if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$doc): $mod = ($i % 2 );++$i;?>
                                <option value="<?php echo htmlentities($doc['table_number']); ?>" <?php echo $info['model_select']==$doc['table_number'] ? 'selected="selected"' : ''; ?>><?php echo htmlentities($doc['table_title']); ?></option>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td align="right" width="100">排序（正序排列）：</td>
                        <td><input type="text" class="intxt" name="sort" value="<?php echo htmlentities($info['sort']); ?>"></td>
                    </tr>
                    <tr>
                        <td align="right" width="100">栏目SEO关键词（非必填）：</td>
                        <td><input type="text" class="intxt" name="site_keywords" value="<?php echo htmlentities($info['site_keywords']); ?>"></td>
                    </tr>
                    <tr>
                        <td align="right" width="100">栏目SEO描述（非必填）：</td>
                        <td><input type="text" class="intxt" name="site_description" value="<?php echo htmlentities($info['site_description']); ?>"></td>
                    </tr>
                    <tr>
                        <td align="right" width="100">栏目小图标（非必填）：</td>
                        <td>
                            <div class="small-icon">
                                <div class="layui-form-item">
                                    <div class="layui-input-inline">
                                        <div class="layui-upload-list" style="margin:0">
                                            
                                            <img src="<?php if($info["small_icon"]): ?><?php echo htmlentities(getImagePath($info['small_icon'])); else: ?>/static/index/images/default-img.jpg<?php endif; ?>" id="srcimgurl-small-icon" class="layui-upload-img" style="width: 150px;">
                                            <input type="hidden" name="small_icon" value="<?php echo htmlentities($info['small_icon']); ?>">
                                        </div>
                                    </div>
                                    <div class="layui-input-inline layui-btn-container" style="width: auto;">
                                        <a href="javascript:;" class="layui-btn layui-btn-primary" id="small-icon">修改图片</a>
                                    </div>
                                    <div class="layui-form-mid layui-word-aux">小图标限定大小在100kb以内</div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td align="right" width="100">栏目背景图（非必填）：</td>
                        <td>
                            <div class="big-icon" class="layui-upload">
                                <a href="javascript:;" class="layui-btn" id="big-icon">上传图片</a>
                                <div class="layui-upload-list">
                                    <input type="hidden" class="intxt" name="big_icon" value="<?php echo htmlentities($info['big_icon']); ?>">
                                    <img src="<?php echo htmlentities(getImagePath($info['big_icon'])); ?>" class="layui-upload-img" id="preview-big-icon">
                                    <p id="text-big-icon"></p>
                                </div>
                                <div class="layui-form-mid layui-word-aux">背景图限定大小在500kb以内</div>
                            </div> 
                        </td>
                    </tr>
                    <tr>
                        <td align="right" width="150">栏目描述（非必填）：</td>
                        <td>
                            <textarea name="description" id="" cols="40" rows="8" style="resize: none;"><?php echo htmlentities($info['description']); ?></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td></td>
                        <td>
                            <input type="hidden" name="id" value="<?php echo htmlentities($info['id']); ?>">
                            <input type="button" class="inbtn" value="确认" id="formButton">
                            <input type="button" class="inback" value="返回" onclick="window.history.back()">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    
    <style>
        /* #myForm{width: 620px;} */
    </style>
    <link rel="stylesheet" href="/static/index/js/layui/css/layui.css">
    <link rel="stylesheet" href="/static/index/js/layui-cropper/cropper.css">
    <script src="/static/index/js/layui-cropper/cropper.js"></script>
    <script src="/static/index/js/layui-cropper/croppers.js"></script>
    <script>
        layui.config({
            base: '/static/index/js/layui-cropper/' //layui自定义layui组件目录
        }).use(['layer','croppers','upload'], function(){
            const layer = layui.layer,
                croppers = layui.croppers,
                upload=layui.upload;

            // 栏目小图标上传
            croppers.render({
                elem: '#small-icon',
                saveW:150,     //保存宽度
                saveH:150,
                mark:1/1,    //选取比例
                area:'900px',  //弹窗宽度
                url: "/system/uploadImg",  //图片上传接口返回和（layui 的upload 模块）返回的JOSN一样
                done: function(res){ //上传完毕回调
                    console.log(res);
                    if(res.status==1){
                        // $("#inputimgurl-small-icon").val(url);
                        $("#srcimgurl-small-icon").attr('src',res.Msg);
                        $(".small-icon input[name='small_icon']").val(res.id);
                    }else{
                        // 上传失败
                        layer.msg(`上传失败：${res.Msg}`,{"icon":7});
                    }
                }
            });

            // 栏目背景图上传
            var uploadInst = upload.render({
                elem: '#big-icon',
                url: '/system/uploadImg',
                before: function(obj){
                    //预读本地文件示例，不支持ie8
                    obj.preview(function(index, file, result){
                        $('#preview-big-icon').attr('src', result); //图片链接（base64）
                    });
                },
                done: function(res){
                    if(res.status==1){
                        //上传成功
                        $(".big-icon input[name='big_icon']").val(res.id);
                    }else{
                        // 上传失败
                        layer.msg(`上传失败：${res.Msg}`,{"icon":7});
                    }
                   
                },
                error: function(){
                    //演示失败状态，并实现重传
                    var demoText = $('#text-big-icon');
                    demoText.html('<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-xs demo-reload">重试</a>');
                    demoText.find('.demo-reload').on('click', function(){
                        uploadInst.upload();
                    });
                }
            });

            $('#myForm #formButton').click(function(){
                $(this).attr('disabled','disabled');
                layer.load();
                const formData = new FormData($('#myForm')[0]);
                parimesPost("/column/columnEdit",formData).then((res)=>{
                    if(res.status==1){
                        // 跳转
                        layer.msg(res.Msg,{"icon":1,"time":800},()=>window.history.back());
                    }else{
                        layer.msg(res.Msg,{"icon":7});
                    }
                },(error)=>layer.msg(error,{"icon":7}))

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