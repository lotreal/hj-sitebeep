<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>鸿巨广告效果监测系统_框架头部</title>
<meta name="keywords" content="鸿巨,广告效果监测,系统" />
<meta name="description" content="鸿巨广告效果监测系统" />
<link href="<?php echo base_url();?>images/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="header">
<h1>鸿巨广告效果监测系统</h1>
<div class="topbar">用户名：<?php echo $username;?> 上次登录时间：<?php echo date('Y-m-d H:i:s',$lastdate);?> 登录IP：<?php echo $lastip;?> <a href="<?php echo site_url('user?username='.$username);?>" title="修改密码" target="main">修改密码</a> 【<a href="<?php echo site_url('login/logout');?>" title="注销登录">注销登录</a>】</div>
</div>
</body>
</html>