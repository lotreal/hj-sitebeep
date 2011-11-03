<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>鸿巨广告效果监测系统_网站管理_代码调用</title>
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
        <td><label for="getto">到达量监测代码：</label></td>
        <td><input type="text" name="getto" id="getto" value="<?php echo $pageurl.'?adsid='.$sid;?>"/></td>
      </tr>
      <tr>
        <td><label for="click">点击量监测代码：</label></td>
        <td><textarea name="click" id="click" cols="60" rows="5">http://www.adtracker.com.cn/api/click?sid=<?php echo $sid.'&pageurl='.$pageurl;?></textarea></td>
      </tr>
      <tr>
        <td></td>
        <td><fieldset>
            <legend>获取代码：</legend>
            <div>
              <p>把该渠道的到达量监测代码或者点击量监测代码提供给渠道网站商，复制到其网页上，即可实现点击量或到达量的监测，您可根据需要选择监测到达量或者点击量。</p>
              <p>点击量是统计访客点击了广告、搜索引擎、其它链接的次数，页面是否成功转向了相关链接地址（着陆页面）是不作统计的。</p>
              <p>到达量是指访客通过点击广告、搜索引擎、其它链接等方式，真正到达了着陆页面的数量。点击量监测代码可以同时监测点击量数据和到达量数据，而到达量监测代码只监测到达量数据。</p>
            </div>
          </fieldset></td>
      </tr>
    </tbody>
  </table>
</div>
</body>
</html>
