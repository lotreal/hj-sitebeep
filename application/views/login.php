<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>鸿巨广告效果监测系统_用户登录</title>
<meta name="keywords" content="鸿巨,广告效果监测,系统,用户登录" />
<meta name="description" content="鸿巨广告效果监测系统用户登录" />
<link href="<?php echo base_url();?>images/style.css" rel="stylesheet" type="text/css" />
<style type="text/css">
html,body{ background:#33A1DC;}
</style>
</head>
<body>
<div class="login">
<form name="myform" id="myform" action="" method="post">
<ul>
<li><label for="username">用户名：</label><input type="text" name="username" id="username" value="<?php echo set_value('username'); ?>" size="20" maxlength="20"/></li>
<li><label for="password">密码：</label><input type="password" name="password" id="password" value="<?php echo set_value('password'); ?>" size="20" maxlength="20"/></li>
<li><label for="captcha">验证码：</label><input type="text" name="captcha" id="captcha" value="" size="6" maxlength="6"/> <img src="<?php echo site_url('login/captcha');?>" onclick="javascript:this.src = '<?php echo site_url('login/captcha');?>?t='+ Math.random()" title="更换验证码"/></li>
<li><input type="submit" value="登录" class="login_btn"/></li>
</ul>
</form>
</div>
<script type="text/javascript">
document.getElementById("username").focus();
</script>
</body>
</html>
