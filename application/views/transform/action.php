<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>鸿巨广告效果监测系统_项目转化</title>
<meta name="keywords" content="鸿巨,广告效果监测,系统,项目转化" />
<meta name="description" content="鸿巨广告效果监测系统项目转化" />
<link href="<?php echo base_url();?>images/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="crumb">你的位置：管理系统 >> 转化项目</div>
<div class="container mod_form">
<form name="myform" id="myform" action="" method="post">
<?php if(isset($action)):?>  
   <ul>
    <li><label for="transform">项目转化：</label><input type="text" name="transform" id="transform" value="<?php echo set_value('transform');?>" /><?php echo form_error('transform'); ?></li>
	<li><label for="rank">显示排序：</label><input type="text" name="rank" id="rank" value="100" size="5" maxlength="5"/><?php echo form_error('rank');?></li>
	<li><table>
		<tbody>
			<tr>
				<td><label for="describe">描述信息：</label></td>
				<td><textarea name="describe" id="describe" cols="50" rows="5"></textarea></td>
			</tr>
		</tbody>
	</table></li>
	<li><label for="status">审核状态：</label><input type="radio" name="status" id="stauts" value="1" checked="true"/> 是 <input type="radio" name="status" id="stauts" value="0"/> 否 </li>
    <li><input type="submit" value="确认" class="confirm_btn" /></li>
   </ul>
<?php else:?>
   <ul>
    <li><label for="transform">项目转化：</label><input type="text" name="transform" id="transform" value="<?php echo $data['transform'];?>" /><?php echo form_error('transform'); ?></li>
	<li><label for="rank">显示排序：</label><input type="text" name="rank" id="rank" value="<?php echo $data['rank'];?>" size="5" maxlength="5"/><?php echo form_error('rank');?></li>
	<li><table>
		<tbody>
			<tr>
				<td><label for="describe">描述信息：</label></td>
				<td><textarea name="describe" id="describe" cols="50" rows="5"><?php echo $data['describe'];?></textarea></td>
			</tr>
		</tbody>
	</table></li>
	<li><label for="status">审核状态：</label><input type="radio" name="status" id="stauts" value="1" <?php if($data['status'] == 1):?>checked="true"<?php endif;?>/> 是 <input type="radio" name="status" id="stauts" value="0" <?php if($data['status'] == 0):?>checked="true"<?php endif;?>/> 否 </li>
    <li><input type="hidden" name="tid" value="<?php echo $data['tid'];?>"/><input type="submit" value="确认" class="confirm_btn" /></li>
   </ul>
<?php endif;?>
  </form>
</div>
</body>
</html>
