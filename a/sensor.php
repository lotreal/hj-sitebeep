<?php
// 输出类型
$type = isset($_GET["t"]) ? $_GET["t"] : 'ps';
$type = in_array($type, array('ps', 'json')) ? $type : 'ps';
$out_func = 'output_'.$type;

function output_json($report) {
    header("Content-Type: application/json; charset=utf-8");
    echo json_encode($report);
}

function output_ps($report) {
    // header("Content-Type: application/text; charset=utf-8");
    echo serialize($report);
}

function output($out) {
    global $out_func;
    $out_func($out);
}

function error($e) {
    global $out_func;
    $out_func(array('error' => $e));
    die();
}

// TODO handle error
function check_site($url) {
    $ch = curl_init(); // create cURL handle (ch)
    if (!$ch) {
        error("Couldn't initialize a cURL handle");
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
        error(curl_error($ch));
    }

    curl_close($ch);
}


if ( !(isset($_GET['u']) && isset($_GET['s']) && isset($_GET['c'])) ) {
    error('Sensor: missing arguments');
}

$url    = $_GET['u'];
$sensor = $_GET['s'];
$check  = $_GET['c'];

$report = array(
    'sensor' => $sensor,
    'check' => $check,

    't1' => time(),
    'report' => check_site($url),
    't2' => time(),
                );

output($report);