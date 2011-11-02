<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>鸿巨广告效果监测系统_项目转化_代码调用</title>
<meta name="keywords" content="鸿巨,广告效果监测,系统,代码调用" />
<meta name="description" content="鸿巨广告效果监测系统代码调用" />
<link href="<?php echo base_url();?>images/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="crumb">获取代码</div>
<div class="container mod_code">
  <table>
    <tbody>
      <tr>
        <td><label for="click">转化代码：</label></td>
        <td><textarea name="click" id="click" cols="60" rows="5"><?php $str = '<script type="text/javascript">var _had = _had || [];_had.push([\'site\','.$sid.']);_had.push([\'trans\','.$data['tid'].', \'openChat\']);</script>';echo htmlspecialchars($str)?>"</textarea></td>
      </tr>
      <tr>
        <td><label for="click">订单统计：</label></td>
        <td><textarea name="click" id="click" cols="60" rows="5"><?php $str = '<script type="text/javascript">var _had = _had || [];_had.push([\'site\','.$sid.']);_had.push([\'order\', \'订单号\']);;</script>';echo htmlspecialchars($str)?></textarea></td>
      </tr>
      <tr>
        <td></td>
        <td><fieldset>
            <legend>提示信息：</legend>
            <div>
              <p>本接口被调用一次，代表一次转化，传入的数值型参数就是每次转化的价值，系统可以统计出转化次数和转化价值的分析数据。</p>
              <p>请在页面底部body标签之前加入<?php echo htmlspecialchars('<script src="'.base_url().'t.js"></script>');?>js调用代码</p>
			  <p>订单统计中的订单号请使用真实的订单号替换(可使用JS或者php自动生成)。</p>
            </div>
          </fieldset></td>
      </tr>
    </tbody>
  </table>
</div>
</body>
</html>
