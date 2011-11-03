<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>鸿巨广告效果监测系统_订单分析</title>
<meta name="keywords" content="鸿巨,广告效果监测,系统,订单分析" />
<meta name="description" content="鸿巨广告效果监测系统订单分析" />
<link href="<?php echo base_url();?>images/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="crumb"><?php echo $pathinfo;?></div>
<div class="container mod_list">
	<div class="chart">
	<h2>adTracker 订单分析示意图</h2>
	<span id="pid" class="left">数据加载中,请稍候...</span><span id="column" class="right">数据加载中,请稍候...</span>
	<div class="clear"></div>
	</div>
	<form name="myform" id="myform" action="" method="get">
    <div class="operation"><span class="right">
      <input type="text" name="channel" id="keyword" />
      <input type="submit" value="搜索" class="btn"/>
      </span>提示信息：点击同步按钮获取订单最新状态，输入渠道名称可以检索该渠道的订单
    </div>
    <table class="showlist">
      <thead>
        <tr>
          <th class="w50">ID</th>
          <th class="wauto">订单号</th>
		  <th class="w15">网站名称</th>
          <th class="w15">渠道</th>
          <th class="w10">子渠道</th>
          <th class="w8">推广人员</th>
          <th class="w15">下单时间</th>
          <th class="w8">签收状态</th>
          <th class="w8">操作</th>
        </tr>
      </thead>
      <tbody>
		<?php if(!empty($data)):?>
		<?php foreach($data as $v):?>
        <tr>
          <td class="w50"><?php echo $v['id'];?></td>
          <td><?php echo $v['order_sn'];?></td>
		  <td><?php echo $v['sitename'];?></td>
          <td><?php echo $v['channel'];?></td>
          <td><?php echo $v['childer'];?></td>
		  <td><?php echo $v['username'];?></td>
          <td><?php echo date('Y-m-d H:i:s',$v['addtime']);?></td>
		  <td>
		  <?php if($v['signin'] == 2):?>
		  <span class="icon1" title="已签收">已签收</span>
		  <?php elseif($v['signin'] == 1):?>
		  <span class="icon2" title="未签收">未签收</span>
		  <?php else:?>
		  <span class="icon2" title="未同步">未同步</span>
		  <?php endif;?>
		  </td>
          <td>
		  <?php if($v['signin'] == 2):?>
		  已签收
		  <?php else:?>
		  <a href="#" title="同步订单">同步</a>
		  <?php endif;?>
		  </td>
        </tr> 
        <?php endforeach;?>
		<?php else:?>
		<tr>
			<td colspan="9">暂无相关数据</td>
		</tr>
		<?php endif;?>
      </tbody>
    </table>
    <?php echo (isset($link)) ? $link : '';?>
  </form>
</div>
<script type="text/javascript" src="<?php echo base_url();?>images/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>images/js/common.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>charts/FusionCharts.js"></script>
<script type="text/javascript">
$(function() {
	$('tbody > tr').highlight();
	$('tbody tr:even').addClass('even');
	$('tbody tr:odd').addClass('odd');
})
var myChart = new FusionCharts("<?php echo base_url() ?>charts/Column2D.swf", "Column2D", "100%", "300", "0", "1" );
myChart.setJSONData('<?php echo $column ?>');
myChart.render("column");
var myChart = new FusionCharts("<?php echo base_url() ?>charts/Pie2D.swf", "Pie2D", "100%", "300", "0", "1" );
myChart.setJSONData('<?php echo $pid ?>');
myChart.render("pid");
</script>
</body>
</html>
