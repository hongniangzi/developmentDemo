<?php /*a:5:{s:57:"D:\WWW\DEMO\application\admin\view\column\columnList.html";i:1615018712;s:51:"D:\WWW\DEMO\application\admin\view\base\common.html";i:1615018562;s:53:"D:\WWW\DEMO\application\admin\view\Public\header.html";i:1614912062;s:51:"D:\WWW\DEMO\application\admin\view\Public\left.html";i:1600158584;s:53:"D:\WWW\DEMO\application\admin\view\Public\footer.html";i:1601433002;}*/ ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>栏目设置</title>
<!-- <script src="/static/index/js/jquery-3.4.1.min.js"></script> -->
<script type="text/javascript" src="/static/index/js/jquery-1.11.3.min.js"></script>
<script src="/static/index/js/promise-ajax.js"></script>
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
            
<link rel="stylesheet" href="/static/index/css/orgchart/jquery.orgchart.css" />
<link rel="stylesheet" href="/static/index/css/orgchart/index.css" />
<script type="text/javascript" src="/static/index/js/jquery.orgchart.js" ></script>

<div class="rbox">
    <div class="top">
        <h2>栏目设置</h2>
    </div>
    <div class="ctr">
        <a href="<?php echo url('/column/columnAdd'); ?>" class="add">新增一级栏目</a>
    </div>
    <div id="chart-container"></div>
</div>
<style>
    .r{background-color: #fff;}
    #layerDemo1 .tips p{margin: 10px 0;font-size: 14px;}
</style>
<script type="text/javascript">
    $(function(){
        $(".title:not(':first')").each(function(){
            var tit = $(this).html();
            if(strlen(tit)>20){
                $(this).addClass("special_prouduct")
            }
        })
        //判断字节长度
        function strlen(str){  
            var len = 0;  
            for (var i=0; i<str.length; i++) {   
            var c = str.charCodeAt(i);   
            //单字节加1   
            if ((c >= 0x0001 && c <= 0x007e) || (0xff60<=c && c<=0xff9f)) {   
                    len++;   
                }   
                else {   
                    len+=2;   
                }   
            }   
            return len;  
        } 
        //绝对居中
        resize_view();
        function resize_view(){
           var ww = $(".orgchart").width();
           var wh = $(".orgchart").height();
           var f_height = $(".orgchart>table>tr>td> .node .title").height();	
           
           $(".orgchart").css({
            //    "left":"50%",
            //    "top":"50%",
            //    "margin-left":-((wh/2)+(f_height/2)),
            //    "margin-top":-(ww/2)
           })	
            if(ww > 750){
                $(".orgchart").addClass("scale")
            }
        }

        $(window).resize(function(){
            resize_view();		
        })

        layui.use(['layer'], function(){
            const layer = layui.layer;
            var avtion = {
                install:function(){
                    promisePost("/column/columnList",new FormData()).then((res)=>{
                        if(res.status==1){
                            $('#chart-container').orgchart({
                                'data' : res.Msg,
                                'nodeContent': 'title',
                                'direction': 'l2r'
                            });	
                        }else{
                            layer.msg(res.Msg,{'icon':7});
                        }
                    },error=>layer.msg(error,{'icon':7}))
                },
                enlargeTitleprompt:function(){
                    layer.tips($(this).text(),$(this),{tips: 1});
                },
                // 新增子栏目
                addChildColunm:function(){
                    const id=$(this).data('id');
                    window.location.href = `/column/columnAdd/pid/${id}`;
                },
                goList:function(){
                    const id = $(this).data('id');
                    const rout_name = $(this).data('routname');
                    const is_release = $(this).data('isrelease');
                    const list_mouth = `/admin${rout_name.slice(0,1).toUpperCase() + rout_name.slice(1)}/${rout_name}List/column_id/${id}.html`;
                    var str = `<div class="tips">
                            <p>可前往<a href="${is_release==1? list_mouth:`javascript:;`}">&nbsp;<strong>列表入口${is_release==1? ``:`【禁言】`}</strong><a/></p>
                            <p>可前往<a href="/column/columnEdit/id/${id}">&nbsp;<strong>编辑栏目</strong><a/></p>
                            <p>可前往<a href="javascript:;">&nbsp;<strong>其他(开发中...)</strong><a/></p> 
                        </div>`;
                    layer.open({
                        title: '栏目入口提示',
                        type: 1,
                        offset: 'auto', //具体配置参考：http://www.layui.com/doc/modules/layer.html#offset
                        id: 'layerDemo1', //防止重复弹出
                        content: '<div style="padding: 20px 100px;">'+ str +'</div>',
                        btn: '关闭全部',
                        btnAlign: 'c', //按钮居中
                        shade: 0,//不显示遮罩
                        yes: function(){
                            layer.closeAll();
                        }
                    });
                },
                // 栏目状态修改
                statusOperating:function(){
                    var that = $(this);
                    const status=$(this).data('status'),id=$(this).data('id');
                    const formData = new FormData();
                    formData.set('id',id);
                    formData.set('status',status);
                    promisePost('/column/columnStatus',formData).then(res=>{
                        if(res.status==1){
                            layer.msg(res.Msg,{'icon':1,'time':600},()=>window.location.reload());
                        }else{
                            layer.tips(res.Msg,that,{'tips':2});
                        }
                    },error=>layer.msg(error,{'icon':7}))
                },
            };
            // 初始化递归栏目
            avtion['install'].call($(this),this);
            // 点击事件集
            $('body').on('click','.layui-click',function(){
                const method = $(this).data('method');
                avtion[method]? avtion[method].call($(this),this):layer.msg('没有这个事件');
            })
            // 滑过事件集
            $('body').on('mouseover','.layui-mouseover',function(){
                const method = $(this).data('methods');
                avtion[method]? avtion[method].call($(this),this):layer.msg('没有这个事件');
            })
            // 右击事件集
            // $('body').on('mousedown','.layui-mousedown',function(e){
            //     document.oncontextmenu = function() {return false;};
            //     if(e.button == 2 ) {
            //         const mousedown = $(this).data('mousedown');
            //         avtion[mousedown]? avtion[mousedown].call($(this),this):layer.msg('没有这个事件');
            //     }
            // })
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