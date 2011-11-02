<?php
$sites = array
    (
        // 'pinjiu' => 'http://www.pinjiu.com',
        // 'cqq' => 'http://www.cqq.com',
        'test' => 'http://9.5.2.7',
        'www.hj.com' => 'http://www.hj.com',
     );

$report = array
    (
        'time' => time(),
        'sensor' => array
        (
            'id' => 'localhost',
            'type' => 'curl',
         ),
        'report' => array(),
     );

function check_site($name, $url) {
    $ch = curl_init(); // create cURL handle (ch)
    if (!$ch) {
        return array('error' => "Couldn't initialize a cURL handle");
    }

    $ret = curl_setopt($ch, CURLOPT_URL,            $url);
    $ret = curl_setopt($ch, CURLOPT_HEADER,         1);
    $ret = curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    $ret = curl_setopt($ch, CURLOPT_RETURNTRANSFER, 0);
    $ret = curl_setopt($ch, CURLOPT_TIMEOUT,        30);

    ob_start();
    curl_exec ($ch);
    ob_end_clean();

    if(!curl_errno($ch)) {
        $info = curl_getinfo($ch);
        return $info;
    } else {
        return array('error' => curl_error($ch));
    }

    curl_close($ch);
}

foreach($sites as $name => $url) {
    $report['report'][$name] = check_site($name, $url);
}


function output_json($report) {
    header("Content-Type: application/json; charset=utf-8");
    echo json_encode($report);
}

function output_ps($report) {
    // header("Content-Type: application/text; charset=utf-8");
    echo serialize($report);
}

$type = isset($_GET["t"]) ? $_GET["t"] : 'ps';
if (in_array($type, array('ps', 'json'))) {
    $out_func = 'output_'.$type;
    $out_func($report);
}

