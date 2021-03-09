<?php /*a:3:{s:51:"D:\WWW\DEMO\application\index\view\index\index.html";i:1614002549;s:57:"D:\WWW\DEMO\application\index\view\base\common-index.html";i:1614939243;s:59:"D:\WWW\DEMO\application\index\view\Public\header-index.html";i:1614929406;}*/ ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php if(!(empty($title) || (($title instanceof \think\Collection || $title instanceof \think\Paginator ) && $title->isEmpty()))): ?><?php echo htmlentities($title); ?><?php endif; ?></title>
<meta name="keywords" content="<?php if(!(empty($keywords) || (($keywords instanceof \think\Collection || $keywords instanceof \think\Paginator ) && $keywords->isEmpty()))): ?><?php echo htmlentities($keywords); ?><?php endif; ?>" />
<meta name="description" content="<?php if(!(empty($description) || (($description instanceof \think\Collection || $description instanceof \think\Paginator ) && $description->isEmpty()))): ?><?php echo htmlentities($description); ?><?php endif; ?>" />

<!-- <script src="/static/index/js/jquery-3.4.1.min.js"></script> -->
<script type="text/javascript" src="/static/index/js/jquery-1.11.3.min.js"></script>
<script src="/static/index/js/parmies-ajax.js"></script>
<script src="/static/index/js/layui/layui.js"></script>
<link rel="stylesheet" type="text/css" href="/static/index/css/index.css">
</head>

<body>

    <!-- 头部 -->
    <div class="headerbar">
	<div class="header">
		<div class="logobox">
			<a href="/" class="logo"><img src="/static/index/images/logo01.png"></a>
			<a href="/" class="logo02"><img src="/static/index/images/logo02.png"></a>
		</div>
		<div class="links">
			<ul class="fixed">
				<li>
					<a href="javascript:;" class="name">企业登录</a>
				</li>
				<li><a href="javascript:;" class="name">职业者登录</a></li>
			</ul>
		</div>
		<div class="nav">
			<ul>
				<?php if(is_array($nav) || $nav instanceof \think\Collection || $nav instanceof \think\Paginator): $i = 0; $__LIST__ = $nav;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$doc): $mod = ($i % 2 );++$i;?>
				<li <?php if($doc['hov'] == '1'): ?>class="hov"<?php endif; ?>><a href="<?php echo url('/'.$doc['url']); ?>"><?php echo htmlentities($doc['title']); ?></a></li>
				<?php endforeach; endif; else: echo "" ;endif; ?>
				
			</ul>
		</div>
		<div style="clear:both;"></div>
	</div>
</div>

<div class="banner">
    <div class="flexslider">
        <ul class="slides">
            <li>
              <a href="#">
                 <img src="/static/index/images/banner.jpg" width="100%">
              </a>
            </li>
            <li>
              <a href="#">
                 <img src="/static/index/images/banner.jpg" width="100%">
              </a>
            </li>            
        </ul>
    </div>
</div>
    
    
    <div>
        测试开发模板
    </div>
    <div>
        @王伦
        573075930@qq.com
    </div>
    
    <script type="text/javascript" src="/static/index/js/jquery.flexslider-min.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        $('.flexslider').flexslider({
            directionNav: true,
            pauseOnAction: false
        });
    });
    </script>
    <script src="/static/index/js/jquery.SuperSlide.sx.js"></script>
    <script type="text/javascript"> 
    //  jQuery(".txtScroll-left").slide({titCell:".hd ul",mainCell:".bd ul",autoPage:true,effect:"topLoop",autoPlay:true,scroll:1,vis:5,trigger:"click"}); 
    </script>
    <script>
        $(window).scroll(function() {
        var scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
        
        // if (scrollTop>0){
        //     $('.headerbar').addClass('headerbarhov');
        //     $('.headerbar .logo').css('display','none');
        //     $('.headerbar .logo02').css('display','block');
        //     $('.headerbar .links ul.fixed').css('display','none');
        //     $('.headerbar .links ul.hover').css('display','block');
        // }else{
        //     // $('.headerbar').attr('hov','0');
        //     $('.headerbar').removeClass('headerbarhov');
        //     $('.headerbar .logo').css('display','block');    
        //     $('.headerbar .logo02').css('display','none');
        //     $('.headerbar .links ul.fixed').css('display','block');
        //     $('.headerbar .links ul.hover').css('display','none');
        // }
    });

    </script>

        
    
</body>
</html>