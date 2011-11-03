<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>鸿巨广告效果监测系统_渠道管理_渠道分类</title>
<meta name="keywords" content="鸿巨,广告效果监测,系统,渠道分类" />
<meta name="description" content="鸿巨广告效果监测系统渠道分类" />
<link href="<?php echo base_url();?>images/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="crumb">你的位置：管理系统 >> 渠道管理 >> 渠道分类</div>
<div class="container mod_form">
  <form name="myform" id="myform" action="" method="post">
  <?php if(isset($action)):?>  
   <ul>
     <li><label for="category">分类名称：</label><input type="text" name="category" id="category" value="<?php echo set_value('category');?>" /><?php echo form_error('category');?></li>
    <li><label for="parent_id">上级分类：</label>
	<select name="parent_id" id="parent_id">
	<option value="0">请选择</option>
	<?php foreach($category as $v):?>
	<option value="<?php echo $v['cat_id'];?>"><?php echo $v['category'];?></option>
	<?php endforeach;?>
	</select>
	</li>
    <li><label for="rank">显示排序：</label><input type="text" name="rank" id="rank" value="100"   size="5" maxlength="5"/><?php echo form_error('rank');?></li>
	   <li><label for="status">通过审核：</label><input type="radio" name="status" id="status" value="1" checked="true"/> 是 <input type="radio" name="status" id="status" value="0"/> 否</li>
    <li><input type="submit" value="确认" class="confirm_btn" /></li>
   </ul>
   <?php else:?>
   <ul>
     <li><label for="category">分类名称：</label><input type="text" name="category" id="category" value="<?php echo $data['category'];?>" /><?php echo form_error('category');?></li>
    <li><label for="parent_id">上级分类：</label>
	<select name="parent_id" id="parent_id">
	<option value="0">请选择</option>
	<?php foreach($category as $v):?>
	<option value="<?php echo $v['cat_id'];?>" <?php if($data['parent_id'] == $v['cat_id']):?>selected="true"<?php endif;?>><?php echo $v['category'];?></option>
	<?php endforeach;?>
	</select>
	</li>
    <li><label for="rank">显示排序：</label><input type="text" name="rank" id="rank" value="<?php echo $data['rank'];?>" size="5" maxlength="5"/><?php echo form_error('rank');?></li>
	   <li><label for="status">通过审核：</label><input type="radio" name="status" id="status" value="1" <?php if($data['status'] == 1):?>checked="true"<?php endif;?>/> 是 <input type="radio" name="status" id="status" value="0" <?php if($data['status'] == 0):?>checked="true"<?php endif;?>/> 否</li>
    <li><input type="hidden" name="cat_id" value="<?php echo $data['cat_id'];?>"/><input type="submit" value="确认" class="confirm_btn" /></li>
   </ul>
   <?php endif;?>
  </form>
</div>
</body>
</html>
