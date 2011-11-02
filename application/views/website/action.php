<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>鸿巨广告效果监测系统_网站管理</title>
<meta name="keywords" content="鸿巨,广告效果监测,系统,网站管理" />
<meta name="description" content="鸿巨广告效果监测系统网站管理" />
<link href="<?php echo base_url();?>images/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="crumb">你的位置：管理系统 >> 网站管理</div>
<div class="container mod_form">
  <form name="myform" id="myform" action="" method="post">
  <?php if(isset($action)):?>
   <ul>
     <li><label for="sitename">系统名称：</label><input type="text" name="sitename" id="sitename" value="<?php echo set_value('sitename');?>" /><?php echo form_error('sitename');?></li>
	<li>
	<label for="cat_id">网站分类</label>
	<select name="cat_id" id="cat_id">
	<?php foreach($category as $v):?>
	<option value="<?php echo $v['cat_id'];?>"><?php echo $v['category'];?></option>
	<?php endforeach;?>	
	</select><?php echo form_error('cat_id');?>
	</li>
	<li><label for="pageurl">访问地址：</label><input type="text" name="pageurl" id="pageurl" value="<?php echo set_value('pageurl');?>" size="50" maxlength="50"/><?php echo form_error('pageurl');?></li>
	<li><table>
		<tbody>
			<tr>
				<td><label for="describe">描述信息：</label></td>
				<td><textarea name="describe" id="describe" cols="50" rows="5"></textarea></td>
			</tr>
		</tbody>
	</table></li>
	<li><label for="rank">显示排序：</label><input type="text" name="rank" id="rank" value="100" size="5" maxlength="5"/><?php echo form_error('rank');?></li>
	<li><label for="status">通过审核：</label><input type="radio" name="status" id="status" value="1" checked="true"/> 是 <input type="radio" name="status" id="status" value="0"/> 否</li>
    <li><input type="submit" value="确认" class="confirm_btn" /></li>
   </ul>
    <?php else:?>
   <ul>
     <li><label for="sitename">系统名称：</label><input type="text" name="sitename" id="sitename" value="<?php echo $data['sitename'];?>" /><?php echo form_error('sitename');?></li>
	<li>
	<label for="cat_id">网站分类</label>
	<select name="cat_id" id="cat_id">
	<?php foreach($category as $v):?>
	<option value="<?php echo $v['cat_id'];?>" <?php if($data['cat_id'] == $v['cat_id']):?>selected="true"<?php endif;?>><?php echo $v['category'];?></option>
	<?php endforeach;?>	
	</select><?php echo form_error('cat_id');?>
	</li>
	<li><label for="pageurl">访问地址：</label><input type="text" name="pageurl" id="pageurl" value="<?php echo $data['pageurl'];?>" size="50" maxlength="50"/><?php echo form_error('pageurl');?></li>
	<li><table>
		<tbody>
			<tr>
				<td><label for="describe">描述信息：</label></td>
				<td><textarea name="describe" id="describe" cols="50" rows="5"><?php echo $data['describe'];?></textarea></td>
			</tr>
		</tbody>
	</table></li>
	<li><label for="rank">显示排序：</label><input type="text" name="rank" id="rank" value="<?php echo $data['rank'];?>" size="5" maxlength="5"/><?php echo form_error('rank');?></li>
	<li><label for="status">通过审核：</label><input type="radio" name="status" id="status" value="1" <?php if($data['status'] == 1):?>checked="true"<?php endif;?>/> 是 <input type="radio" name="status" id="status" value="0"  <?php if($data['status'] == 0):?>checked="true"<?php endif;?>/> 否</li>
    <li><input type="hidden" name= "sid" value ="<?php echo $data['sid'];?>"/><input type="submit" value="确认" class="confirm_btn" /></li>
   </ul>
	<?php endif;?>
  </form>
</div>
</body>
</html>
