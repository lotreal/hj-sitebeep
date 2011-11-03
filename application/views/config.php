<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>鸿巨广告效果监测系统_系统配置</title>
<meta name="keywords" content="鸿巨,广告效果监测,系统,系统配置" />
<meta name="description" content="鸿巨广告效果监测系统系统配置" />
<link href="<?php echo base_url();?>images/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="crumb"><?php echo $pathinfo;?></div>
<div class="container mod_form mod_config">
  <form name="myform" id="myform" action="<?php echo site_url('config/update');?>" method="post">
   <ul>
     <li><label for="sitename">系统名称：</label><input type="text" name="sitename" id="sitename" value="<?php echo $data['sitename'];?>" /></li>
   <li><label for="shutdown">关闭系统：</label><input type="radio" name="shutdown" id="shutdown" value="1"  <?php if($data['shutdown'] == 0):?>checked="true"<?php endif;?>/> 是 <input type="radio" name="shutdown" id="shutdown" value="0" <?php if($data['shutdown'] == 0):?>checked="true"<?php endif;?>/> 否</li>
   	<li><table>
   		<tbody>
   			<tr>
   				<td><label for="notice">关闭提示：</label></td>
   				<td><textarea name="notice" id="notice" cols="60" rows="5"><?php echo $data['notice'];?></textarea></td>
   			</tr>
   		</tbody>
   	</table></li>
    <li><label for="number">列表数量：</label><input type="text" name="number" id="number" value="<?php echo $data['number'];?>" /></li>
    <li><label for="gap">防刷间隔：</label><input type="text" name="gap" id="gap" value="<?php echo $data['gap'];?>" /></li>
    <li><label for="offline">离线时间：</label><input type="text" name="offline" id="offline" value="<?php echo $data['offline'];?>" /></li>
    <li><table>
    	<tbody>
    		<tr>
    			<td><label for="allow">登录限制：</label></td>
    			<td>允许列表</td>
    			<td>限制列表</td>
    		</tr>
            <tr>
            	<td></td>
            	<td><textarea name="allow" id="allow" cols="50" rows="5"><?php echo $data['allow'];?></textarea></td>
            	<td><textarea name="astrict" id="astrict" cols="50" rows="5"><?php echo $data['astrict'];?></textarea></td>
            </tr>
    	</tbody>
    </table></li>
    <li><label for="encrypt">加密字符串：</label><input type="text" name="encrypt" id="encrypt" value="<?php echo $data['encrypt'];?>" /></li>
    <li><label for="initialize">初始化密码：</label><input type="text" name="initialize" id="initialize" value="<?php echo $data['initialize'];?>" /></li>
    <li><input type="hidden" name="old" value="<?php echo $data['encrypt'];?>"/><input type="submit" value="确认" class="confirm_btn" /></li>
   </ul>    
  </form>
</div>
</body>
</html>
