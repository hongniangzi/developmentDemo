<?php /*a:4:{s:59:"D:\WWW\DEMO\application\index\view\article\lists_about.html";i:1614938460;s:57:"D:\WWW\DEMO\application\index\view\base\common-other.html";i:1614939573;s:59:"D:\WWW\DEMO\application\index\view\Public\header-other.html";i:1614929375;s:59:"D:\WWW\DEMO\application\index\view\Public\footer-other.html";i:1601433044;}*/ ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php if(!empty($info)): ?>
<title><?php echo htmlentities($info['title']); ?>-<?php echo C('WEB_SITE_TITLE'); ?></title>
<?php else: ?>
<title><?php echo htmlentities($category['title']); ?>-<?php echo C('WEB_SITE_TITLE'); ?></title>
<?php endif; if($category['site_keywords']): ?>
<meta name="keywords" content="<?php echo htmlentities($category['site_keywords']); ?>" />
<?php else: ?>
<meta name="keywords" content="<?php echo C('WEB_SITE_KEYWORDS'); ?>" />
<?php endif; if($category['site_description']): ?>
<meta name="description" content="<?php echo htmlentities($category['site_description']); ?>" />
<?php else: ?>
<meta name="description" content="<?php echo C('WEB_SITE_DESCRIPTION'); ?>" />
<?php endif; ?>

<!-- <script src="/static/index/js/jquery-3.4.1.min.js"></script> -->
<script type="text/javascript" src="/static/index/js/jquery-1.11.3.min.js"></script>
<script src="/static/index/js/parmies-ajax.js"></script>
<script src="/static/index/js/layui/layui.js"></script>
<link rel="stylesheet" type="text/css" href="/static/index/css/index.css">
</head>

<body>

    <!-- 头部 -->
    <div class="headerbar headerbarhov" style="position: relative;">
	<div class="header">
		<div class="logobox" style="display: block;">
			<a href="/" class="logo02" style="display: block;"><img src="/static/index/images/logo02.png"></a>
		</div>
		<div class="links">
			<ul class="fixed">
				<li>
					<a href="javascript:;" class="name">企业登录</a>
				</li>
				<li><a href="javascript:;" class="name">职业者注册</a></li>
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
    
    
<div class="sbanner">
    <img src="/static/index/images/banner_guanyu.jpg" width="100%">
</div>

<div class="about">
	<div class="l">
		<?php var_dump('<pre>',$category); ?>
		<h2>湖南椒粉科技有限公司</h2>
		<p>湖南椒粉科技有限公司在接受本合同之前，客户应仔细阅读本合同的全部内容，特别是标注为黑色的内容。如果客户对合同条款有疑问，可向甲方提出并可要求解释；如果客户签署了本合同，表示已经接受合同条款的约束，届时客户不应以合同条款“显示公平”或者其他理由主张无效、或者撤销；为维护客户的合法权益，甲方对本合同中影响到客户权益的条款作了特别标注，并对客户做充分解释与说明。乙方签订本合同，表明其对条款所涉相关内容已经完全了解。</p>
		<p>平台：是指由甲方现在或将来拥有合法运营管理的、提供给客户  技术服务的网络服务平台，包括但不限于  平台，以及未来可能新设或者合作的网络平台等；用户：即在甲方平台上注册，并使用其注册账户发布商务服务、灵活用工等信息，通过平台发布的信息获取商品或者服务，取得共享经济利益的法人或者非法人组织；商服信息：是指用户在甲方平台上发布的展示商品、服务以及措施等信息，是用户向不特定的对象发出的要约，一旦相对人接受或者购买用户发布的信息，即构成合同关系成立；灵活用工：是指企业（包括个体工商户）短期或者项目型地用工模式，即企业基于用人的季节性需求，灵活地按实际需求聘用人才，完成企业指定工作，而企业与人才之间不建立劳动关系和劳务关系的用工模式。服务费：是指甲方为乙方提供商品展示以及其他服务后，按本合同约定比例收取的报酬（代缴的税费除外）；</p>
	</div>
	<div class="r">
		<img src="/static/index/images/gy01.jpg">
	</div>
	<div style="clear:both;"></div>
</div>

<div class="i03">
	<div class="t">
		<h2>更多企业共同选择 规范税务管理</h2>
		<p>拥有人资、财税智慧平台技术与产品积累</p>
	</div>
	<div class="b">
		<img src="/static/index/images/i03-1.jpg">
	</div>
</div>


<div class="i04">
	<h1>仅需1步，</h1>
	<h3>即刻预约体验您的税务管理平台</h3>
	<a href="#" class="tijiao">立即提交</a>
</div>

        
    <!-- 底部 -->
    
<div class="footerbar">
	<div class="footer">
		<div class="fl">
			<h2>联系我们</h2>
			<p>邮箱地址：<?php echo C('WEB_COMPANY_EMAIL'); ?></p>
			<p>公司地址：<?php echo C('WEB_COMPANY_ADDRESS'); ?></p>
		</div>
		<div class="fr">
			<ul>
				<li>
					<h2>微信公众号</h2>
					<div class="imgbox"><img src="/static/index/images/wechat.jpg"></div>
				</li>
				<li>
					<h2>微信小程序</h2>
					<div class="imgbox"><img src="/static/index/images/wexcx.jpg"></div>
				</li>
			</ul>
		</div>
		<div style="clear:both"></div>
	</div>
	<div class="copyright">
		<p><?php echo C('WEB_COPYRIGHT'); ?>  <a href="https://beian.miit.gov.cn/" target="_blank"><?php echo C('WEB_CASE_NUMBER'); ?></a> | <a href="#" target="_blank">湘公网安备:11010802250031</a> <span>技术支持：蒲公英<a href="http://www.0731pgy.com/" target="_blank">长沙网站建设</a></span></p>
	</div>
</div>



<script src="/static/index/js/jquery.SuperSlide.sx.js"></script>
<script type="text/javascript"> 
 jQuery(".txtScroll-left").slide({titCell:".hd ul",mainCell:".bd ul",autoPage:true,effect:"leftLoop",autoPlay:true,scroll:1,vis:1,trigger:"click"}); 
</script>
<script type="text/javascript" src="/static/index/js/jquery.flexslider-min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
      $('.flexslider').flexslider({
          directionNav: true,
          pauseOnAction: false
      });
  });

  
</script>

<script type="text/javascript">
  //选项卡 designed by tinisn
  //menus 菜单li的ul id;
  //divs 选项对应div的父级div id;
  //sdivClass 选项对应div的class需要加'.',可为空
  //hovClass 菜单选中时的class
  function scrollBar(menus,divs,sdivClass,hovClass){
    // alert($(menus + ' li').size());
    // alert($(divs + ' div.p-b2').size());
   if($(menus + ' li').size() != $(divs + ' div' + sdivClass).size())
   {
  alert("菜单层数量和内容层数量不一样!");
  return false;
   }
   $(menus + ' li').bind('click', function(e){
    // alert($(this).index());
    $(menus + ' li').removeClass(hovClass).eq($(this).index()).addClass(hovClass);
    $(divs + ' div' + sdivClass).css('display', 'none').eq($(this).index()).css('display', 'block');
   });
  }
  scrollBar('#menus', '#divs', '.box', 'h1');
</script>
    
</body>
</html>