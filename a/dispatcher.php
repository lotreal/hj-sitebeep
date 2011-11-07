<?php
$root_dir = dirname(__FILE__);

$sites = array(
    // 'pinjiu' => 'http://www.pinjiu.com',
    // 'cqq' => 'http://www.cqq.com',
    '鸿巨' => 'http://www.hongju.cc',
    '趣网' => 'http://www.qu.cc',
    '品酒网' => 'http://www.pinjiu.com',
    '图虎' => 'http://www.tuhu.com',
    'Google' => 'http://www.google.com',
    '网易' => 'http://www.163.com',
    '新浪' => 'http://www.sina.com',
    'QQ' => 'http://www.qq.com',
    '百度' => 'http://www.baidu.com',
    '测试机' => 'http://9.5.2.7',
    '测试 A' => 'http://wiki.hj.com',
    '测试 B' => 'http://wiki.hj.com',
    '测试 C' => 'http://wiki.hj.com',
    '鸿巨 JIRA' => 'http://www.hj.com',
               );

$sensors = array(
    'test-sensor-01' => array(
        'name' => '重庆',
        'desc' => '1号测试探针',
        'type' => 'curl',
        'url' => 'http://sitebeep.local.host/a/sensor.php',
                         ),
    'test-sensor-02' => array(
        'name' => '北京',
        'desc' => '2号测试探针',
        'type' => 'curl',
        'mock' => true,
        'url' => 'http://sitebeep.local.host/a/sensor.php',
                         ),
                 );

$dbfile = "{$root_dir}/db";

if (file_exists($dbfile)) {
    $db = unserialize(file_get_contents($dbfile));
} else {
    $db = array();
}
// 测试用, 每次都清空
$db = array();

function collect($url) {
    $ch = curl_init(); // create cURL handle (ch)
    if (!$ch) {
        die("Couldn't initialize a cURL handle");
    }

    $options = array
        (
            CURLOPT_URL => $url,
            CURLOPT_HEADER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_USERAGENT => 'WWWBEEP Sensor'
         );
    curl_setopt_array($ch, $options);
    $server_output = curl_exec($ch);

    if(!curl_errno($ch)) {
        return $server_output;
    } else {
        die(curl_error($ch));
    }

    curl_close($ch);
}

function analysis($sid, $txt) {
    global $db, $sensors;
    $data = unserialize($txt);
    $sensor = $sensors[$sid];
    // var_dump($data);
    foreach($data['report'] as $site => $report) {
        // TODO if null then array()
        $db[$site] = array
            (
                'last_check' => array
                (
                    'time' => $data['time'],
                    // 'status' => $report['http_code'],
                    'sensor' => $sensor,
                    'detail' => $report,
                 )
             );
    }
    // echo json_encode($db);
}

$url = $sensors['test-sensor-01']['url'].'?c='.rawurlencode($sites['QQ']).'&c='.rawurlencode($sites['鸿巨 JIRA']);

$report = collect($url);
var_dump($report);
die();
foreach($sensors as $sid => $sensor) {
    $report = collect($sensor['url']);
    analysis($sid, $report);
}

var_dump($db);

file_put_contents($dbfile, serialize($db));