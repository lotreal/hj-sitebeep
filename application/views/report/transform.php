<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>鸿巨广告效果监测系统_报表统计_转化分析</title>
<meta name="keywords" content="鸿巨,广告效果监测,系统,转化分析" />
<meta name="description" content="鸿巨广告效果监测系统转化分析" />
<link href="<?php echo base_url();?>images/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="crumb">你的位置：管理系统 >> 报表统计 >> 转化分析</div>
<div class="container mod_list">
	<?php if(!isset($action)):?>
	<div class="chart">
	<h2>adTracker 转化分析示意图</h2>
	<span id="pid" class="left">数据加载中,请稍候...</span><span id="column" class="right">数据加载中,请稍候...</span>
	<div class="clear"></div>
	</div>
    <table class="showlist">
      <thead>
        <tr>
          <th class="w50">转化ID</th>
          <th class="wauto">转化项目</th>
          <th class="w15">转化总数</th>
          <th class="w15">转化比例</th>
          <th class="w5">操作</th>
        </tr>
      </thead>
      <tbody>
		<?php if(!empty($data)):?>
		<?php foreach($data as $v):?>
        <tr>
          <td class="w50"><?php echo $v['tid'];?></td>
          <td><?php echo $v['transform'];?></td>
          <td><?php echo $v['number'];?></td>
          <td><?php echo round($v['number']/$rows,2)*100;?>%</td>
          <td><a href="<?php echo site_url('report/transformlist/'.$v['tid']);?>" title="查看<?php echo $v['transform'];?>转化趋势" class="colorbox">趋势</a></td>
        </tr> 
        <?php endforeach;?>
		<?php else:?>
		<tr>
			<td colspan="5">暂无相关数据</td>
		</tr>
		<?php endif;?>
      </tbody>
    </table>
	<?php echo (isset($link)) ? $link : '';?>
	<?php elseif(isset($action) && $action == 1):?>
	<div class="chart">
	<h2>adTracker 转化分析示意图</h2>
	<span id="line">数据加载中,请稍候...</span>
	<div class="clear"></div>
	</div>
    <table class="showlist">
      <thead>
        <tr>
          <th class="w50">ID</th>
          <th>来源渠道</th>
          <th>推广人员</th>
		  <th>来源页面</th>
		  <th>关键字</th>
		  <th>IP地址</th>	
		  <th>来源地区</th>
		  <th>浏览器</th>	
          <th class="w15">记录时间</th>
		  <th class="w5">操作</th>
        </tr>
      </thead>
      <tbody>
		<?php if(!empty($data)):?>
		<?php foreach($data as $v):?>
        <tr>
          <td class="w50"><?php echo $v['id'];?></td>
          <td>
		  <?php $str = $v['channel'];$str.= ($v['childer']) ? '['.$v['childer'].']' : ''; echo ($str) ? $str : '无';?>
		  </td>
          <td><?php echo ($v['username']) ? $v['username'] : '无';?></td>
          <td><a href="<?php echo $v['referer'];?>" title="<?php echo $v['referer'];?>" target="_blank"><?php echo ($v['referer']) ? newsubstr($v['referer'],18) : '无';?></a></td>
		  <td><?php echo ($v['keyword']) ? $v['keyword'] : '无';?></td>
		  <td><?php echo ($v['ipaddress']) ? $v['ipaddress'] : '无';?></td>
          <td>
		  <?php $str = $v['area'];$str.= ($v['isp']) ? '['.$v['isp'].']' : ''; echo $str;?>
		  </td>
          <td>
		  <?php $str = $v['brower'];$str.= ($v['version']) ? '['.$v['version'].']' : ''; echo $str;?>
		  </td>
          <td><?php echo ($v['dateline']) ? date('Y-m-d H:i:s',$v['dateline']) : '';?></td>
		  <td><a href="<?php echo site_url('report/transformdetail/'.$v['id']);?>" title="查看<?php echo $v['channel'];?>详情" class="colorbox">详情</a></td>
        </tr> 
        <?php endforeach;?>
		<?php else:?>
		<tr>
			<td colspan="10">暂无相关数据</td>
		</tr>
		<?php endif;?>
      </tbody>
    </table>
	<?php echo (isset($link)) ? $link : '';?>
	<?php else:?>
	<table>
		<tbody>
			<tr>
				<td>网站名称：</td>
				<td><?php echo $sitename;?></td>
				<td>代理上网：</td>
				<td><?php echo ($is_agent) ? '是' : '否';?></td>
				<td>手机访问：</td>
				<td><?php echo ($is_mobile) ? '是' : '否';?></td>
				<td>设备名称：</td>
				<td><?php echo ($terminal) ? $terminal : '无';?></td>
			</tr>
			<tr>
				<td>操作系统：</td>
				<td><?php echo ($platform) ? $platform : '无';?></td>
				<td>IP地址：</td>
				<td><?php echo ($ipaddress) ? $ipaddress : '无';?></td>
				<td>来源地区：</td>
				<td><?php echo ($area) ? $area : '无';?></td>
				<td>上网方式：</td>
				<td><?php echo ($isp) ? $isp : '无';?></td>
			</tr>
			<tr>
				<td>浏览器：</td>
				<td><?php $str = ($brower) ? $brower : ''; $str .= ($version) ? ' ['.$version.']' : '';echo $str;?></td>
				<td>语言：</td>
				<td><?php echo ($language) ? $language : '无';?></td>
				<td>分辨率：</td>
				<td><?php echo $screen_w.' x '.$screen_h;?></td>
				<td>屏幕色彩：</td>
				<td><?php echo ($screen_c) ? $screen_c.' 位真彩色' : '无';?></td>
			</tr>
			<tr>
				<td>支持Flash：</td>
				<td><?php echo ($is_flash) ? '是' : '否';?></td>
				<td>支持Cookie：</td>
				<td><?php echo ($is_cookie) ? '是' : '否';?></td>
				<td>支持Java：</td>
				<td><?php echo ($is_java) ? '是' : '否';?></td>
				<td>所在时区：</td>
				<td><?php echo ($timezone) ? $timezone : '无';?></td>
			</tr>
			<tr>
				<td>插件数量：</td>
				<td><?php echo ($plugin) ? $plugin.' 个' : '0';?></td>
				<td>窗口大小：</td>
				<td><?php echo $window_w.' x '.$window_h;?></td>
				<td>页面大小：</td>
				<td><?php echo $page_w.' x '.$page_h;?></td>
				<td>页面编码：</td>
				<td><?php echo ($charset) ? $charset : '无';?></td>
			</tr>
			<tr>
				<td>点击坐标：</td>
				<td><?php echo $click_x.' x '.$click_y;?></td>
				<td>点击位置：</td>
				<td>第 <?php echo ($screen_n) ? $screen_n : '1';?> 屏</td>
				<td>来源渠道：</td>
				<td>
				<?php
				$str = ($channel) ? $channel : '无';
				
				if($channel)
				{
					$str .= ' [主渠道：';$str .= ($parent) ? $parent : '无';$str .= ' 子渠道：';$str .= ($childer) ? $childer : '无';$str .=']';
				}
				
				echo $str;
				?>
				</td>
				<td>推广人员：</td>
				<td><?php echo ($username) ? $username : '无';?></td>
			</tr>
			<tr>
				<td>转化项目：</td>
				<td><?php echo ($transform) ? $transform : '无';?></td>
				<td>记录时间：</td>
				<td><?php echo ($dateline) ? date('Y-m-d H:i:s',$dateline) : '无';?></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>来源页面：</td>
				<td colspan="7"><?php echo ($referer) ? $referer : '无';?></td>
			</tr>
			<tr>
				<td>关键字：</td>
				<td colspan="7"><?php echo ($keyword) ? $keyword : '无';?></td>
			</tr>
			<tr>
				<td>点击页面：</td>
				<td colspan="7"><?php echo ($current)? $current : '无';?></td>
			</tr>
		</tbody>
	</table>
	<?php endif;?>    
</div>
<script type="text/javascript" src="<?php echo base_url();?>images/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>images/js/common.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>images/js/jquery.colorbox-min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>charts/FusionCharts.js"></script>
<script type="text/javascript">
$(function() {
	$('tbody > tr').highlight();
	$('tbody tr:even').addClass('even');
	$('tbody tr:odd').addClass('odd');
	$(".colorbox").colorbox({iframe:true, innerWidth:"90%", innerHeight:"85%"});
})
<?php if(!isset($action)):?>
var myChart = new FusionCharts("<?php echo base_url() ?>charts/Column2D.swf", "Column2D", "100%", "300", "0", "1" );
myChart.setJSONData('<?php echo $column ?>');
myChart.render("column");
var myChart = new FusionCharts("<?php echo base_url() ?>charts/Pie2D.swf", "Pie2D", "100%", "300", "0", "1" );
myChart.setJSONData('<?php echo $pid ?>');
myChart.render("pid");
<?php elseif(isset($action) && $action == 1):?>
var myChart = new FusionCharts("<?php echo base_url() ?>charts/Line.swf", "Line", "100%", "300", "0", "1" );
myChart.setJSONData('<?php echo $line ?>');
myChart.render("line");
<?php endif;?>
</script>
</body>
</html>
