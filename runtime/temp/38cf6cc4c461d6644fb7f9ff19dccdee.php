<?php /*a:1:{s:51:"D:\WWW\DEMO\application\index\view\Login\login.html";i:1611888742;}*/ ?>
<!DOCTYPE html>
<html>
<head>
	<title>平台管理登录</title>
	<link rel="stylesheet" type="text/css" href="/static/index/css/style.css">
</head>
<body class="indexbody">
<div class="homebg">
	<div class="header-top">
		<div class="header">
			<a href="/" class="logo"><img src="/static/index/images/logo.png" title="" alt=""></a>
			<div class="hp">
				<span>4008-929-888</span>
			</div>
			<div style="clear:both;"></div>
		</div>
	</div>
	<div class="login">
		<div class="l">
			<h1>- 规范税务税务管理，降低企业成本 -</h1>
			<h2>一站式业务管理、结算、纳税解决方案</h2>
			<p><img src="/static/index/images/login-bg.png"></p>
		</div>
		<div class="r">
			<div class="t">
				<h2>账号登录</h2>
			</div>
			<div class="b">
				<form id="myForm">
					<table>
						<tr>
							<td>
								<div class="name"><input type="text" name="username" class="intxt" placeholder="请输入用户名" name=""></div>
							</td>
						</tr>
						<tr>
							<td>
								<div class="password"><input type="password" name="password" class="intxt" placeholder="请输入密码" name=""></div>
							</td>
						</tr>
						<tr>
							<td>
								<div class="verify">
									<img src="<?php echo url('/login/verify'); ?>" alt="" onclick="$(this).attr('src','/login/verify')">
									<input type="text" class="code" name="code">
								</div>
							</td>
							
						</tr>
						<tr>
							<td>
								<input type="button" class="inbtn" value="登录" id="formButton">
							</td>
						</tr>
					</table>
				</form>
			</div>
		</div>
		<div style="clear:both;"></div>
	</div>
</div>

<div class="footerbar">
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
		<p style="line-height: 32px;"><?php echo C('WEB_COPYRIGHT'); ?> <a href="https://beian.miit.gov.cn/" target="_blank"><?php echo C('WEB_CASE_NUMBER'); ?></a>  技术支持：蒲公英<a href="http://www.0731pgy.com/" target="_blank">长沙网站建设</a></p>
	</div>
</div>
<script src="/static/index/js/jquery-3.4.1.min.js"></script>
<script src="/static/index/js/parmies-ajax.js"></script>
<script src="/static/index/js/layui/layui.js"></script>
<script>
	layui.use(['layer'], function(){
		const layer = layui.layer;

		var active = {
			formSubmit:function(){
				layer.load();
				const formData = new FormData($('#myForm')[0]);
				parimesPost("/login/login",formData).then((res)=>{
					layer.msg(res.Msg);
					if(res.status==1){
						// 跳转
						window.location.href='/user/center.html';
					}
				}).catch((error)=>{
					layer.msg(error);
				})
				layer.closeAll('loading');
			}
		}
		$('#myForm #formButton').click(function(){
			active['formSubmit'].call($(this),this);
		})
		$('#myForm').on('keyup',function(event){
			if(event.originalEvent.keyCode==13){
				active['formSubmit'].call($(this),this);
			}
		})
	})
</script>
</body>
</html>