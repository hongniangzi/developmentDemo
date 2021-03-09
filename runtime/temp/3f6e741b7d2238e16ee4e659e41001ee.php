<?php /*a:5:{s:57:"D:\WWW\DEMO\application\index\view\Adminnews\newsAdd.html";i:1614852995;s:51:"D:\WWW\DEMO\application\index\view\base\common.html";i:1614764407;s:53:"D:\WWW\DEMO\application\index\view\Public\header.html";i:1598516168;s:51:"D:\WWW\DEMO\application\index\view\Public\left.html";i:1600158584;s:53:"D:\WWW\DEMO\application\index\view\Public\footer.html";i:1601433002;}*/ ?>
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
            <h2>新增/编辑
                <?php $cate_lenght = count($category); if(is_array($category) || $category instanceof \think\Collection || $category instanceof \think\Paginator): $i = 0; $__LIST__ = $category;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$doc): $mod = ($i % 2 );++$i;?>
                <a href="/admin<?php echo strtoupper(substr($doc['rout_name'],0,1)); ?><?php echo substr($doc['rout_name'],1); ?>/<?php echo htmlentities($doc['rout_name']); ?>List/column_id/<?php echo htmlentities($doc['id']); ?>/.html">【<?php echo htmlentities($doc['title']); ?>】<?php if($cate_lenght!=$i): ?>><?php endif; ?></a>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </h2>
        </div>
        <div class="btm">
            <form id="myForm">
                <table border="0" cellpadding="0" cellspacing="0" class="table02" width="400">
                    <tr>
                        <td align="right" width="200">所属栏目</td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" class="intxt" value="<?php echo htmlentities($category[$cate_lenght-1]['title']); ?>" disabled="disabled">
                        </td>
                    </tr>
                    <tr>
                        <td align="right" width="100">操作者</td>
                    </tr>
                    <tr>
                        <td><input type="text" class="intxt" name="operator" value="<?php echo htmlentities((isset($info['operator']) && ($info['operator'] !== '')?$info['operator']:app('session')->get('Nickname.username'))); ?>" disabled="disabled"></td>
                    </tr>
                    <tr>
                        <td align="right" width="100">标题</td>
                    </tr>
                    <tr>
                        <td><input type="text" class="intxt" name="title" value="<?php echo htmlentities((isset($info['title']) && ($info['title'] !== '')?$info['title']:'')); ?>"></td>
                    </tr>
                    <tr>
                        <td align="right" width="100">排序（倒叙排列）</td>
                    </tr>
                    <tr>
                        <td><input type="text" class="intxt" name="sort" value="<?php echo htmlentities((isset($info['sort']) && ($info['sort'] !== '')?$info['sort']:'')); ?>"></td>
                    </tr>
                    <tr>
                        <td align="right" width="100">封面</td>
                    </tr>
                    <tr>
                        <td>
                            <div class="cover-img">
                                <div class="layui-form-item">
                                    <div class="layui-input-inline">
                                        <div class="layui-upload-list" style="margin:0">
                                            <img src="<?php if(!(empty($info['cover_img']) || (($info['cover_img'] instanceof \think\Collection || $info['cover_img'] instanceof \think\Paginator ) && $info['cover_img']->isEmpty()))): ?><?php echo htmlentities(getImagePath($info['cover_img'])); else: ?>/static/index/images/default-img.jpg<?php endif; ?>" id="srcimgurl-cover-img" class="layui-upload-img" style="width: 150px;">
                                            <input type="hidden" name="cover_img" value="<?php echo htmlentities((isset($info['cover_img']) && ($info['cover_img'] !== '')?$info['cover_img']:'')); ?>">
                                        </div>
                                    </div>
                                    <div class="layui-input-inline layui-btn-container" style="width: auto;">
                                        <a href="javascript:;" class="layui-btn layui-btn-primary" id="cover-img">修改图片</a>
                                    </div>
                                    <div class="layui-form-mid layui-word-aux">封面图建议大小在100kb以内</div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td align="right" width="100">文本内容</td>
                    </tr>
                    <tr>
                        <td>
                            <div style="width: 90%;">
                                <textarea name="content" id="edit-1"><?php echo htmlentities((isset($info['content']) && ($info['content'] !== '')?$info['content']:'')); ?></textarea>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td align="right" width="150">描述（非必填）</td>
                    </tr>
                    <tr>
                        <td>
                            <textarea name="description" cols="40" rows="7" style="resize: none;"><?php echo htmlentities((isset($info['description']) && ($info['description'] !== '')?$info['description']:'')); ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td align="right" width="150">点击量（非必填）</td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" class="intxt" name="view" value="<?php echo htmlentities((isset($info['view']) && ($info['view'] !== '')?$info['view']:'')); ?>">
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td>
                            <input type="hidden" name="id" value="<?php echo htmlentities((isset($info['id']) && ($info['id'] !== '')?$info['id']:'')); ?>">
                            <input type="hidden" name="column_id" value="<?php echo htmlentities($cate['id']); ?>">
                            <input type="button" class="inbtn" value="确认" id="formButton">
                            <input type="button" class="inback" value="返回" onclick="window.history.back()">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    
    <style>
    </style>
    <link rel="stylesheet" href="/static/index/js/layui/css/layui.css">
    <link rel="stylesheet" href="/static/index/js/layui-cropper/cropper.css">
    <script src="/static/index/js/layui-cropper/cropper.js"></script>
    <script src="/static/index/js/layui-cropper/croppers.js"></script>
    <script>
        
        layui.extend({
            tinymce: '../tinymce/tinymce'
        }).config({
            base: '/static/index/js/layui-cropper/' //layui自定义layui组件目录
        }).use(['layer','croppers','upload','tinymce','util'], function(){
            const layer = layui.layer,
                croppers = layui.croppers,
                upload=layui.upload,
                util=layui.util,
                tinymce = layui.tinymce;


            tinymce.render({
                elem: "#edit-1",
                height: 600,
                width:'100%',
                images_upload_handler:function(blobInfo, succFun, failFun){
                    var file = blobInfo.blob();
                    formData = new FormData();
                    formData.append('file', file, file.name);//此处与源文档不一样
                    parimesPost('/system/uploadImg',formData).then(res=>{
                        if(res.status!=1){
                            layer.msg(res.Msg,{'icon':7});
                        }else{
                            succFun(res.Msg);
                        }
                    },error=>layer.msg(error,{'icon':7}))
                },
                file_picker_callback: function(callback, value, meta) {
                    if (meta.filetype == 'file') {
                        callback('mypage.html', {text: 'My text'});
                    }
                    // Provide image and alt text for the image dialog
                    if (meta.filetype == 'image') {
                        callback('myimage.jpg', {alt: 'My alt text'});
                    }
                    // Provide alternative source and posted for the media dialog
                    if (meta.filetype == 'media') {
                        callback('movie.mp4', {source2: 'alt.ogg', poster: 'image.jpg'});
                    }
                }

            });

            // 栏目小图标上传
            croppers.render({
                elem: '#cover-img',
                saveW:150,     //保存宽度
                saveH:150,
                mark:1/1,    //选取比例
                area:'900px',  //弹窗宽度
                url: "/system/uploadImg",  //图片上传接口返回和（layui 的upload 模块）返回的JOSN一样
                done: function(res){ //上传完毕回调
                    if(res.status==1){
                        $("#srcimgurl-cover-img").attr('src',res.Msg);
                        $(".cover-img input[name='cover_img']").val(res.id);
                    }else{
                        // 上传失败
                        layer.msg(`上传失败：${res.Msg}`,{"icon":7});
                    }
                }
            });

            $('#myForm #formButton').click(function(){
                $(this).attr('disabled','disabled');
                layer.load();
                const formData = new FormData($('#myForm')[0]);
                formData.set('content',tinymce.get('#edit-1').getContent());
                var url = `/admin${`<?php echo htmlentities($cate['rout_name']); ?>`.slice(0,1).toUpperCase()}${`<?php echo htmlentities($cate['rout_name']); ?>`.slice(1)}/<?php echo htmlentities($cate['rout_name']); ?>Add`;
                parimesPost(url,formData).then((res)=>{
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