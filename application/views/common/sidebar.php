<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>鸿巨广告效果监测系统_功能导航</title>
<meta name="Keywords" content="鸿巨,广告效果监测,系统,功能导航" />
<meta name="Description" content="鸿巨广告效果监测系统功能导航" />
<link href="<?php echo base_url();?>images/style.css" rel="stylesheet" type="text/css" />
<style type="text/css">
html, body { background:#CDE4F0 url(<?php echo base_url();?>images/sidebar_bg.jpg) repeat-y right 0;}
</style>
</head>
<body>
<div class="sidebar">
  <div class="site">
    <label for="sid">推广站点：</label>
    <select name="sid" id="sid">
	<?php if($data):?>
	<?php foreach($data as $v):?>
		<option value="<?php echo $v['sid'];?>"><?php echo $v['sitename'];?></option>
    <?php endforeach;?>
	<?php else:?>
		<option value="0">请选择</option>
	<?php endif;?>
    </select>
  </div>
  <div class="menu">
    <ul>
      <li>
        <dl>
          <dt><a href="javascript:void(0)" class="config" title="系统配置">系统配置</a></dt>
          <dd><a href="<?php echo site_url('config');?>" title="系统配置" target="main">&#8250; 系统配置</a></dd>
        </dl>
      </li>
      <li>
        <dl>
          <dt class="current"><a href="javascript:void(0)" class="user" title="用户管理">用户管理</a></dt>
          <dd><a href="<?php echo site_url('user');?>" title="用户信息" target="main">&#8250; 用户信息</a></dd>
          <dd><a href="javascript:void(0)" title="部门管理">&#8250; 部门管理</a></dd>
          <dd><a href="javascript:void(0)" title="职位管理">&#8250; 职位管理</a></dd>
          <dd><a href="javascript:void(0)" title="角色管理">&#8250; 角色管理</a></dd>
          <dd><a href="javascript:void(0)" title="用户日志">&#8250; 用户日志</a></dd>
        </dl>
      </li>
      <li>
        <dl>
          <dt><a href="javascript:void(0)" class="channel" title="渠道管理">渠道管理</a></dt>
          <dd><a href="<?php echo site_url('channel');?>" title="渠道信息" target="main">&#8250; 渠道信息</a></dd>
          <dd><a href="<?php echo site_url('channel/category');?>" title="渠道分类" target="main">&#8250; 渠道分类</a></dd>
        </dl>
      </li>
      <li>
        <dl>
          <dt><a href="javascript:void(0)" class="website" title="网站管理">网站管理</a></dt>
          <dd><a href="<?php echo site_url('website');?>" title="网站信息" target="main">&#8250; 网站信息</a></dd>
          <dd><a href="<?php echo site_url('website/category');?>" title="网站分类" target="main">&#8250; 网站分类</a></dd>
        </dl>
      </li>
      <li>
      	<dl>
      		<dt><a href="javascript:void(0)" class="transform" title="转化项目">转化项目</a></dt>
      		<dd><a href="<?php echo site_url('transform');?>" title="转化项目" target="main">&#8250; 转化项目</a></dd>
      	</dl>
      </li>
      <li>
        <dl>
          <dt><a href="javascript:void(0)" class="report" title="报表统计">报表统计</a></dt>
          <dd><a href="<?php echo site_url('report/transform');?>" title="转化分析" target="main">&#8250; 转化分析</a></dd>
          <dd><a href="<?php echo site_url('report/order');?>" title="订单分析" target="main">&#8250; 订单分析</a></dd>
        </dl>
      </li>
    </ul>
  </div>
  <a href="javascript:void(0)" class="trigger" title="关闭侧边栏">关闭侧边栏</a>
</div>
<script type="text/javascript" src="<?php echo base_url();?>images/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>images/js/common.js"></script>
<script type="text/javascript">
$(function() {
    $('.menu dd').hide();
    $('.menu dt').showMenu();
    $('.trigger').sideBar();
    $('#sid').change(function() {
		var sid = $(this).val();
		if(sid)
		{
			$.ajax({
				type: "POST",
				cache: false,
				url: "<?php echo site_url('admin/changeSid');?>",
				data: {
					sid: sid
				},
				success: function(data) {
					if(data == 0)
					{
						alert('数据更新失败!');
					}
					window.top.frames['main'].location.reload();	
				},
				error:function(){
					alert('服务器连接失败!');
				}
			});
		}
    });
})
</script>
</body>
</html>
