<?php
$root_dir = dirname(__FILE__);

$sensors = array(
    'localhost' => 'http://9.5.2.7/sitebeep/sensor.php',
);


$dbfile = "{$root_dir}/db";
if (file_exists($dbfile)) {
    $db = unserialize(file_get_contents($dbfile));
} else {
    $db = array();
}


function collect($name, $url) {
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

function analysis($txt) {
    global $db;
    $data = unserialize($txt);
    var_dump($data);
    foreach($data['report'] as $site => $report) {
        // TODO if null then array()
        $db[$site] = array
            (
                'last_check' => array
                (
                    'id' => $data['sensor']['id'],
                    'type' => $data['sensor']['type'],
                    'time' => $data['time'],
                    'status' => $report['http_code'],
                 )
             );
    }
    echo json_encode($db);
}

foreach($sensors as $name => $url) {
    $report = collect($name, $url);
    analysis($report);
}

file_put_contents($dbfile, serialize($db));