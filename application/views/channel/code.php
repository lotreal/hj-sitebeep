<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>鸿巨广告效果监测系统_渠道管理_代码调用</title>
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
        <td><label for="click">推广代码：</label></td>
        <td>
		<textarea name="click" id="click" cols="60" rows="5"><?php echo $url;?></textarea></td>
      </tr>
      <tr>
        <td></td>
        <td><fieldset>
            <legend>提示说明：</legend>
            <div>
              <p>参数说明：adcad - 渠道ID adsub - 子渠道ID aduid - 推广人员ID adsid - 推广网站ID。</p>
              <p>推广人员ID请复制以上代码用于推广,必须使用自己的帐号登录而必须在左侧选择对应的推广网站。</p>
            </div>
          </fieldset></td>
      </tr>
    </tbody>
  </table>
</div>
</body>
</html>
