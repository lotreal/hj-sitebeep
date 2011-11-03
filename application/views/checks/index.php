<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>siteBeep - 主面板</title>
    <meta name="description" content="site uptime monitoring" />
    <meta name="keywords" content="uptime, uptime monitoring, response time, website speed" />
    
    <link href="/a/img/icon/favicon.ico" type="image/x-icon" rel="icon" /><link href="/a/img/icon/favicon.ico" type="image/x-icon" rel="shortcut icon" />

    <link rel="stylesheet" type="text/css" href="/a/css/theme/style3.css" />
    <link rel="stylesheet" type="text/css" href="/a/css/theme/custom5.css" />      
    <!-- <link rel="stylesheet" type="text/css" href="/a/css/msgbox/jquery.msgbox.css" /> -->
    <!--[if IE 7]><link rel="stylesheet" type="text/css" href="/a/css/theme/ie7.css" /><![endif]-->

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
    <!-- <script type="text/javascript" src="/a/js/swfobject.js"></script> -->
    <!-- <script type="text/javascript" src="/a/js/msgbox/jquery.msgbox.min.js"></script> -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
  </head>

  <body>

    <p><a class="skiplink" href="#maincontent">跳过导航区</a></p>
    <div id="container">
      <div id="wrapheader">
        <div id="wrapshadow">
          <div id="wrapper">
            <div id="header">
              <a href="/checks" class="replace" id="logo0">
                <span></span><h1 style="float:left;">siteBeep</h1>
              </a>

              <div class="topUserInfo" title="上次登录时间：<?php echo date('Y-m-d H:i:s',$lastdate);?> 登录IP：<?php echo $lastip;?>">
                <?php echo $username;?>
                <span class="pipe">|</span>
                <a href="/users/logout">退出</a>
              </div>
            </div>


            <div id="placemainmenu">
              <ul id="mainmenu">
                <li class="active">
                  <a href="/checks">监控列表</a>
                </li>

                <li >
                  <a href="/settings">选项</a>
                </li>
              </ul>                               
            </div>

            <div id="content">
              <div id="maincontent">
                <h1>网站概览</h1>

                <?php $this->load->view('checks/overview'); ?>

                <div class="latestActivityMainPage latestActivity" >
                  <div class="contentTabs">
                    <span>警报:</span>
                    <a class="selected" href="/checks">全部</a>
                    <a  href="/checks/index/404">404</a>
                    <a  href="/checks/index/502">502</a>
                  </div>
                  <script>
                    $(document).ready(function(){
                    $(".aj_check_status_list").load("/aj_elements/aj_check_status_list");
                    });
                  </script>
                  <div class="aj_check_status_list">
                    <center>
                      <img src="/a/img/custom/loading.gif" style="margin-top:100px;" alt="" />                    </center>
                  </div>
                  
                </div> 
                
                

              </div>

              <div id="nav">
                <div class="boxnav_trans">

                  <ul class="menunav">
                    <li><a href="/uptime/add">添加监控</a></li>
                    <!-- <li><a href="/uptime/add_bulk">批量添加</a></li> -->
                  </ul>
                  <div class="clear"></div>
                </div>

                <div class="boxnav">
                  <h3><span>监控</span>说明</h3>
                  <p>
                    多机房监控
                  </p>
                  <div class="clear"></div>
                </div>

                <!-- <div class="preloader" style="display:none"> -->
                <!--   <iframe allowtransparency="true" src="http://tagbeep.com/preload_graph.php" width="1" height="1" style="display:none" frameborder="0" scrolling="no"></iframe> -->
                <!-- </div> -->
                <!-- <div class="clear"></div> -->

              </div>
            </div>

            <div id="footer">
              <div class="clear"></div>
              <h5>
                &copy; 2011 <a title="首页" href="/">siteBeep</a>
                <span class="pipe">|</span>
                <a title="帮助" href="/">帮助</a>
                
                <!--
                    <br/> 
                    <strong>server time: </strong> October 26 2011 / 6:05 am                                             - 
                    <strong>your time: </strong> October 26 2011 / 12:05 pm                                            -->
              </h5>
	    </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
