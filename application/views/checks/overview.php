<table border="0" cellspacing="0"  class="checksHeader">
  <tr>
    <td class="checkHeadName">网站</td>
    <td class="status">状态</td>
    <td class="responseTime">响应时间</td>
    <td class="playPause">操作</td>
  </tr>
</table>
<?php foreach($overview as $site => $report) { ?>
<table border="0" cellspacing="0"  class="check c<?php echo $report['http_code'];?>" id="checkID<?php echo $report['check_id']; ?>" onclick="javascript:window.location = '/uptime/alert_log/4206';">
  <tr>
    <td width="200px">
      <div class="checkName" title="<?php echo $report['check_url']; ?>"><?php echo $report['check_name'];?></div>
    </td>
    <td class="checkLinks">

      <table border="0" cellspacing="0"  class="checkDetails" width="100%">
        <tr>
          <td colspan="4" class="summary url">
            <!-- <?php echo $report['detail']['http_code'];?> -->
            <?php echo $report['timestamp'];?>
            <?php echo $report['sensor_name'];?>
            报告：
          </td>
        </tr>

        <tr class="stats">
          <td class="status">
            <strong><?php echo $report['http_code'];?></strong>
          </td>
     <td class="responseTime"><?php printf("%d", $report['detail']['total_time'] * 1000);?> ms</td>
          <td class="playPause">
            <a href="/a/checks/pause/4206"><img src="/a/img/icon/stop.png" class="icon showTip" title="Pause check - this will pause your check and you can resume anytime" alt="" /></a>                       
            

            <a href="/a/checks/index/4206"><img src="/a/img/icon/refresh.png" class="icon showTip showModalMessage" title="Check now - not implemented yet :|" alt="" /></a>
            <a href="/a/uptime/alert_log/4206" class="viewReport showTip" title="View the latest activity and edit this check" onClick="event.stopPropagation();">详情</a>                        
          </td>
        </tr>


      </table>
    </td>
  </tr>
</table>
<?php } ?>
