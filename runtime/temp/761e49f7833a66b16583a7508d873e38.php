<?php /*a:5:{s:51:"D:\WWW\DEMO\application\index\view\User\center.html";i:1598577758;s:51:"D:\WWW\DEMO\application\index\view\base\common.html";i:1599103134;s:53:"D:\WWW\DEMO\application\index\view\Public\header.html";i:1598516168;s:51:"D:\WWW\DEMO\application\index\view\Public\left.html";i:1600158584;s:53:"D:\WWW\DEMO\application\index\view\Public\footer.html";i:1601433002;}*/ ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>管理中心首页</title>
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
            
	
<div class="r01">
	<div class="left">
			<div class="t01">
			<ul>
				<li class="tc01">
					<a href="javascript:;">
						<h2>企业签约审核</h2>
						<p>分担经营风险</p>
					</a>
				</li>
				<li class="tc02">
					<a href="javascript:;">
						<h2>职业者签约审核</h2>
						<p>共享经济、兼职经营</p>
					</a>
				</li>
				<li class="tc03">
					<a href="javascript:;">
						<h2>费用结算</h2>
						<p>一键费用结算</p>
					</a>
				</li>
			</ul>
			</div>
			<div class="t02">
			<div class="top">
				<h2>平台流水（元）</h2>
				<a href="javascript:;" class="more">更多</a>
				<div style="clear:both;"></div>
			</div>
			<div class="btm">
				<p>共<span>5</span>个签约服务商，平台流水<b>￥</b><span>88900.00</span></p>
			</div>
			</div>
			<div style="clear:both;"></div>
	</div>
	<div class="right">
		<div class="top">
			<h2>通知公告</h2>
			<a href="javascript:;" class="more">更多</a>
			<div style="clear:both;"></div>
		</div>
		<div class="btm">
			<ul>
				<li><a href="#">万达集团 用工 500 次</a></li>
				<li><a href="#">振华石油 用工 500 次</a></li>
				<li><a href="#">首汽集团 用工 200 次</a></li>
				<li><a href="#">中国建设银行 用工 300 次</a></li>
				<li><a href="#">北京同仁堂 用工 240 次</a></li>
				<li><a href="#">SOHO房地产 用工 260 次</a></li>
			</ul>
		</div>
	</div>
	<div style="clear:both;"></div>
</div>
<div class="r02">
	<div class="left">
		<div class="top">
			<h2>企业用工次数</h2>
			<a href="#" class="more">更多</a>
			<div style="clear:both;"></div>
		</div>
		<div class="btm">
			<div id="container" style="height: 100%"></div>
		</div>
	</div>
	<div class="right">
		<div class="top">
			<h2>企业所在行业用工次数</h2>
			<a href="#" class="more">更多</a>
			<div style="clear:both;"></div>
		</div>
		<div class="btm">
			<div id="container1" style="height: 100%"></div>
		</div>
	</div>
	<div style="clear:both;"></div>
</div>
<div class="r03">
	<div class="left">
		<div class="top">
			<h2>用工人数</h2>					
			<a href="#" class="more">更多</a>
			<ul id="menus">
				<li class="h1"><a href="javascript:;">本次项目</a></li>
				<li><a href="javascript:;">今年</a></li>
			</ul>
			<div style="clear:both;"></div>
		</div>
		<div class="btm" id="divs">
			<div class="box" style="display: block;">
				<div id="container2" style="height: 100%"></div>						
			</div>
			<div class="box" style="display: block;">
				<div id="container3" style="height: 100%"></div>						
			</div>
		</div>
	</div>
	<div class="right">
		<div class="top">
			<h2>项目费用</h2>
			<a href="#" class="more">更多</a>
			<ul id="menus2">
				<li class="h1"><a href="javascript:;">本次项目</a></li>
				<li><a href="javascript:;">今年</a></li>
			</ul>
			<div style="clear:both;"></div>
			<div style="clear:both;"></div>
		</div>
		<div class="btm" id="divs2">
			<div class="box" style="display: block;">
				<div id="container4" style="height: 100%"></div>
			</div>
			<div class="box" style="display: block;">
				<div id="container5" style="height: 100%"></div>
			</div>
		</div>
	</div>
	<div style="clear:both;"></div>
</div>
<script type="text/javascript">
  //选项卡 designed by tinisn
  //menus 菜单li的ul id;
  //divs 选项对应div的父级div id;
  //sdivClass 选项对应div的class需要加'.',可为空
  //hovClass 菜单选中时的class
  function scrollBar(menus,divs,sdivClass,hovClass){
    // alert($(menus + ' li').size());
    // alert($(divs + ' div.p-b2').size());
    if($(menus + ' li').size() != $(divs + ' div' + sdivClass).size()){
        alert("菜单层数量和内容层数量不一样!");
        return false;
    }
    $(menus + ' li').bind('mouseover', function(e){
        // alert($(this).index());
        $(menus + ' li').removeClass(hovClass).eq($(this).index()).addClass(hovClass);
        $(divs + ' div' + sdivClass).css('display', 'none').eq($(this).index()).css('display', 'block');
    });
  }
  scrollBar('#menus', '#divs', '.box', 'h1');
  scrollBar('#menus2', '#divs2', '.box', 'h1');
</script>
<script type="text/javascript" src="/static/index/js/echarts/echarts.min.js"></script>
<script type="text/javascript" src="/static/index/js/echarts/echarts-gl.min.js"></script>
<script type="text/javascript" src="/static/index/js/echarts/ecStat.min.js"></script>
<script type="text/javascript" src="/static/index/js/echarts/dataTool.min.js"></script>
<script type="text/javascript" src="/static/index/js/echarts/china.js"></script>
<script type="text/javascript" src="/static/index/js/echarts/world.js"></script>
<script type="text/javascript" src="/static/index/js/echarts/bmap.min.js"></script>
<script>
    layui.use(['layer'], function(){
        const layer = layui.layer;

        
    })
</script>
<script type="text/javascript">
    // 饼图0 
    var dom = document.getElementById("container");
	var myChart = echarts.init(dom);
	var app = {};
	option = null;
	option = {
	    tooltip: {
	        trigger: 'none',
	        formatter: '{a} <br/>{b}: {c} ({d}%)',
	    },
	    legend: {
	        orient: 'vertical',
	        right: 10,
	        top: 'middle',
	        data: ['万达集团     500次     25%', '振华集团     500次     25%', '首汽集团     200次     10%', '中国建行     300次     15%', '北京同仁堂   240次     12%', 'SOHO        260次     13%']
	    },
	    textStyle:{
	    	color: '#222',
	    	fontSize: '14',	    	
	    },
	    series: [
	        {
	            name: '',
	            type: 'pie',	            
	            radius: ['50%', '65%'],
	            left: -185,
	            avoidLabelOverlap: false,
	            label: {
	                show: false,
	                position: 'center'
	            },
	            emphasis: {
	                label: {
	                    show: true,
	                    fontSize: '12',
	                    fontWeight: 'normal'
	                }
	            },
	            labelLine: {
	                show: false
	            },
	            data: [
	                {value: 500, name: '万达集团     500次     25%'},
	                {value: 500, name: '振华集团     500次     25%'},
	                {value: 200, name: '首汽集团     200次     10%'},
	                {value: 300, name: '中国建行     300次     15%'},
	                {value: 240, name: '北京同仁堂   240次     12%'},
	                {value: 260, name: 'SOHO        260次     13%'},
	            ]
	        }
	    ]
	};
	;
	if (option && typeof option === "object") {
	    myChart.setOption(option, true);
	}
    // 饼图1
	var dom = document.getElementById("container1");
	var myChart = echarts.init(dom);
	var app = {};
	option = null;
	option = {
	    tooltip: {
	        trigger: 'none',
	        formatter: '{a} <br/>{b}: {c} ({d}%)',
	    },
	    legend: {
	        orient: 'vertical',
	        right: 10,
	        top: 'middle',
	        data: ['信息科技     500次     25%', '生命健康     500次     25%', '传媒娱乐     200次     10%', '节能环保     300次     15%', '地产金融     240次     12%', '传统产业     260次     13%']
	    },
	    textStyle:{
	    	color: '#222',
	    	fontSize: '14',	    	
	    },
	    series: [
	        {
	            name: '',
	            type: 'pie',	            
	            radius: ['50%', '65%'],
	            left: -185,
	            avoidLabelOverlap: false,
	            label: {
	                show: false,
	                position: 'center'
	            },
	            emphasis: {
	                label: {
	                    show: true,
	                    fontSize: '12',
	                    fontWeight: 'normal'
	                }
	            },
	            labelLine: {
	                show: false
	            },
	            data: [
	                {value: 500, name: '信息科技     500次     25%'},
	                {value: 500, name: '生命健康     500次     25%'},
	                {value: 200, name: '传媒娱乐     200次     10%'},
	                {value: 300, name: '节能环保     300次     15%'},
	                {value: 240, name: '地产金融     240次     12%'},
	                {value: 260, name: '传统产业     260次     13%'},
	            ]
	        }
	    ]
	};
	;
	if (option && typeof option === "object") {
	    myChart.setOption(option, true);
	}


	// 柱状图2
	var dom = document.getElementById("container2");
	var myChart = echarts.init(dom);
	var app = {};
	option = null;
	option = {
	    color: ['#3398DB'],
	    tooltip: {
	        trigger: 'none',
	        axisPointer: {            // 坐标轴指示器，坐标轴触发有效
	            type: 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
	        }
	    },
	    grid: {
	        left: '3%',
	        right: '4%',
	        bottom: '3%',
	        containLabel: true
	    },
	    xAxis: [
	        {
	            type: 'category',
	            data: ['10月', '11月', '12月', '1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月'],
	            axisTick: {
	                alignWithLabel: true
	            }
	        }
	    ],
	    yAxis: [
	        {
	            type: 'value'
	        }
	    ],
	    series: [
	        {
	            name: '直接访问',
	            type: 'bar',
	            barWidth: '60%',
	            data: [10, 52, 200, 334, 390, 330, 220, 360, 180, 150, 270, 320]
	        }
	    ]
	};
	;
	if (option && typeof option === "object") {
	    myChart.setOption(option, true);
	}

	// 柱状图3
	var dom = document.getElementById("container3");
	var myChart = echarts.init(dom);
	var app = {};
	option = null;
	option = {
	    color: ['#3398DB'],
	    tooltip: {
	        trigger: 'none',
	        axisPointer: {            // 坐标轴指示器，坐标轴触发有效
	            type: 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
	        }
	    },
	    grid: {
	        left: '3%',
	        right: '4%',
	        bottom: '3%',
	        containLabel: true
	    },
	    xAxis: [
	        {
	            type: 'category',
	            data: ['10月', '11月', '12月', '1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月'],
	            axisTick: {
	                alignWithLabel: true
	            }
	        }
	    ],
	    yAxis: [
	        {
	            type: 'value'
	        }
	    ],
	    series: [
	        {
	            name: '直接访问',
	            type: 'bar',
	            barWidth: '60%',
	            data: [160, 52, 200, 58, 390, 330, 30, 360, 180, 150, 80, 20]
	        }
	    ]
	};
	;
	if (option && typeof option === "object") {
	    myChart.setOption(option, true);
	}

	// 柱状图4
	var dom = document.getElementById("container4");
	var myChart = echarts.init(dom);
	var app = {};
	option = null;
	option = {
	    color: ['#3398DB'],
	    tooltip: {
	        trigger: 'none',
	        axisPointer: {            // 坐标轴指示器，坐标轴触发有效
	            type: 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
	        }
	    },
	    grid: {
	        left: '3%',
	        right: '4%',
	        bottom: '3%',
	        containLabel: true
	    },
	    xAxis: [
	        {
	            type: 'category',
	            data: ['10月', '11月', '12月', '1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月'],
	            axisTick: {
	                alignWithLabel: true
	            }
	        }
	    ],
	    yAxis: [
	        {
	            type: 'value'
	        }
	    ],
	    series: [
	        {
	            name: '直接访问',
	            type: 'bar',
	            barWidth: '60%',
	            data: [10, 52, 200, 334, 390, 330, 220, 360, 180, 150, 270, 320]
	        }
	    ]
	};
	;
	if (option && typeof option === "object") {
	    myChart.setOption(option, true);
	}

	// 柱状图5
	var dom = document.getElementById("container5");
	var myChart = echarts.init(dom);
	var app = {};
	option = null;
	option = {
	    color: ['#3398DB'],
	    tooltip: {
	        trigger: 'none',
	        axisPointer: {            // 坐标轴指示器，坐标轴触发有效
	            type: 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
	        }
	    },
	    grid: {
	        left: '3%',
	        right: '4%',
	        bottom: '3%',
	        containLabel: true
	    },
	    xAxis: [
	        {
	            type: 'category',
	            data: ['10月', '11月', '12月', '1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月'],
	            axisTick: {
	                alignWithLabel: true
	            }
	        }
	    ],
	    yAxis: [
	        {
	            type: 'value'
	        }
	    ],
	    series: [
	        {
	            name: '直接访问',
	            type: 'bar',
	            barWidth: '60%',
	            data: [100, 52, 200, 334, 390, 10, 220, 360, 90, 356, 20, 80]
	        }
	    ]
	};
	;
	if (option && typeof option === "object") {
	    myChart.setOption(option, true);
	}
	
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