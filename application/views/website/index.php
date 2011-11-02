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
<div class="crumb"><?php echo $pathinfo;?></div>
<div class="container mod_list">
  <form name="myform" id="myform" action="" method="get">
    <div class="operation"><span class="right">
      <input type="text" name="sitename" id="keyword" />
      <input type="submit" value="搜索" class="btn"/>
      </span>
      <a href="<?php echo site_url('website/add');?>" title="添加新网站" class="add_btn colorbox">添加</a>
    </div>
    <table class="showlist">
      <thead>
        <tr>
          <th class="w50"><a href="javascript:void(0)" id="checkall" title="全选/不选">选择</a></th>
          <th class="w15">网站名称</th>
          <th class="wauto">访问地址</th>
          <th class="w10">显示排序</th>
          <th class="w8">操作人员</th>
          <th class="w15">操作时间</th>
          <th class="w8">审核状态</th>
          <th class="w12">操作</th>
        </tr>
      </thead>
      <tbody>
		<?php if(!empty($data)):?>
		<?php foreach($data as $v):?>
        <tr>
          <td class="w50"><input type="checkbox" name="sid[]" value="<?php echo $v['sid'];?>"/></td>
          <td><?php echo $v['sitename'];?><?php if($v['category']):?> - [<?php echo $v['category'];?>]<?php endif;?></td>
          <td><?php echo $v['pageurl'];?></td>
          <td><?php echo $v['rank'];?></td>
          <td><?php echo ($v['operation']) ? $v['operation'] : '无';?></td>
          <td><?php echo ($v['dateline']) ? date('Y-m-d H:i:s',$v['dateline']) : '无';?></td>
          <td>
		  <?php if($v['status']):?>
		  <span class="icon1" title="已审核">已审核</span>
		  <?php else:?>
		  <span class="icon2" title="未审核">未审核</span>
		  <?php endif;?>
		  </td>
          <td><a href="<?php echo site_url('website/update/'.$v['sid']);?>" title="修改" class="colorbox">修改</a> <?php if($v['status']):?><a href="<?php echo site_url('website/getcode/'.$v['sid']);?>" title="获取代码" class="colorbox">代码</a><?php endif;?> <a href="<?php echo site_url('website/verify/'.$v['sid'].'/'.$v['status']);;?>" title="审核" class="confirm">审核</a> <a href="<?php echo site_url('website/delete/'.$v['sid']);;?>" title="删除" class="confirm">删除</a></td>
        </tr>
        <?php endforeach;?>
		<?php else:?>
		<tr>
			<td colspan="8">暂无相关数据</td>
		</tr>
		<?php endif;?>
      </tbody>
    </table>
    <?php echo (isset($link)) ? $link : '';?>
  </form>
</div>
<script type="text/javascript" src="<?php echo base_url();?>images/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>images/js/common.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>images/js/jquery.colorbox-min.js"></script>
<script type="text/javascript">
$(function() {
	$('tbody > tr').highlight();
	$('tbody tr:even').addClass('even');
	$('tbody tr:odd').addClass('odd');
    $('#checkall').checkAll();
	$(".colorbox").colorbox({iframe:true, innerWidth:"65%", innerHeight:"55%",onClosed:function(){ window.location.reload();}});
	$('.confirm').click(function(){
		var action = false;		
		if (confirm("确认要执行当前的操作？")) {
			action = true;
		}
		return action;
	})
})
</script>
</body>
</html>
