<table border="0" cellspacing="0"  class="checksHeader">
  <tr>
    <td class="checkHeadName">网站</td>
    <td class="status">状态</td>
    <td class="responseTime">响应时间</td>
    <td class="playPause">操作</td>
  </tr>
</table>
<?php 
foreach($overview as $site => $report) { 
     $lc = $report['last_check'];
     $tdiff = time() - $lc['time'];

     $sum = "{$site}: ". ($report['last_check']['status'] == 200 ? '在线' : '离线'). "<p>上次检测：{$lc['id']} 在 {$tdiff} 秒前通过 {$lc['type']} 方式检测。</p>";
?>
<table border="0" cellspacing="0"  class="check" id="checkID4206" onclick="javascript:window.location = '/uptime/alert_log/4206';">
  <tr>
    <td width="200px">
      <div class="checkName" title="http://www.cqq.com">重庆圈</div>
    </td>
    <td class="checkLinks">

      <table border="0" cellspacing="0"  class="checkDetails" width="100%">
        <tr class="stats">
          <td class="status">
            <strong>在线</strong> (2011-10-32 16:02:20)
          </td>
          <td class="responseTime">1585 ms</td>
          
          <td class="playPause">
            <a href="/a/checks/pause/4206"><img src="/a/img/icon/stop.png" class="icon showTip" title="Pause check - this will pause your check and you can resume anytime" alt="" /></a>                       
            

            <a href="/a/checks/index/4206"><img src="/a/img/icon/refresh.png" class="icon showTip showModalMessage" title="Check now - not implemented yet :|" alt="" /></a>
            <a href="/a/uptime/alert_log/4206" class="viewReport showTip" title="View the latest activity and edit this check" onClick="event.stopPropagation();">详情</a>                        
          </td>
        </tr>

        <tr>
          <td colspan="4" class="url">
            http://www.cqq.com
            <?php echo $sum;?>
          </td>
        </tr>

      </table>
    </td>
  </tr>
</table>
<?php } ?>
