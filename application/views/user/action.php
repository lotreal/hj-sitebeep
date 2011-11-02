<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>鸿巨广告效果监测系统_用户管理</title>
<meta name="keywords" content="鸿巨,广告效果监测,系统,用户管理" />
<meta name="description" content="鸿巨广告效果监测系统用户管理" />
<link href="<?php echo base_url();?>images/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="crumb">你的位置：管理系统 >> 用户管理</div>
<div class="container mod_form">
<form name="myform" id="myform" action="" method="post">
<?php if(isset($action)):?>  
   <ul>
    <li><label for="username">用户名：</label><input type="text" name="username" id="username" value="" /><?php echo form_error('username'); ?></li>
	<li><label for="password">密码：</label><input type="password" name="password" id="password" value="<?php echo $password;?>" /><?php echo form_error('password'); ?></li>
	<li><label for="confirm">确认密码：</label><input type="password" name="confirm" id="confirm" value="<?php echo $password;?>" /><?php echo form_error('confirm'); ?></li>
	<li><label for="status">允许登录：</label><input type="radio" name="status" id="stauts" value="1" checked="true"/> 是 <input type="radio" name="status" id="stauts" value="0"/> 否 </li>
    <li><input type="submit" value="确认" class="confirm_btn" /></li>
   </ul>
<?php else:?>
   <ul>
    <li><label for="username">用户名：</label><input type="text" name="username" id="username" value="<?php echo $username;?>" readonly="true"/></li>
	<li><label for="password">密码：</label><input type="password" name="password" id="password" value="" /><?php echo form_error('password'); ?></li>
	<li><label for="confirm">确认密码：</label><input type="password" name="confirm" id="confirm" value="" /><?php echo form_error('confirm'); ?></li>
	<li><label for="status">允许登录：</label><input type="radio" name="status" id="stauts" value="1" <?php if($status == 1):?>checked="true"<?php endif;?>/> 是 <input type="radio" name="status" id="stauts" value="0" <?php if($status == 0):?>checked="true"<?php endif;?>/> 否 </li>
    <li><input type="hidden" name="uid" value="<?php echo $uid;?>"/><input type="submit" value="确认" class="confirm_btn" />
	</li>
   </ul>
<?php endif;?>
  </form>
</div>
</body>
</html>
