<?php
set_time_limit(0);
ini_set('memory_limit', -1);
ini_set('max_execution_time', -1);
ini_set("request_terminate_timeout", -1);
date_default_timezone_set("Asia/tehran");

if (!\file_exists('madeline.php')) {
    \copy('https://phar.madelineproto.xyz/madeline.php', 'madeline.php');
}
function random_decode($str) {
    $res = '';
    $x = str_split('AZFK13579azfk');
    $x1 = str_split('BHLW02468bhlw');
    $x3 = str_split('DUOPQXduopqx');
    foreach ($x3 as $v) {
        $str = str_replace("$v", '', $str);
    }
    foreach ($x as $v) {
        $str = str_replace("$v", '1', $str);
    }
    foreach ($x1 as $v) {
        $str = str_replace("$v", '0', $str);
    }
    foreach (str_split("$str", 8) as $v) {
        $res .= chr(bindec($v));
    }
    return $res;
}
require('madeline.php');
use danog\MadelineProto\API;
use danog\MadelineProto\MTProto;
use danog\MadelineProto\Logger;
$settings = [];
$settings['serialization']['serialization_interval'] = 60 * 6;
$settings['logger']['logger_level'] = Logger::VERBOSE;
$settings['logger']['logger'] = \danog\MadelineProto\Logger::FILE_LOGGER;
$settings['logger']['max_size'] = 2 * 1024 * 1024;
$settings['peer']['cache_all_peers_on_startup'] = true;
$settings['serialization']['cleanup_before_serialization'] = true;
$mProto = new API("../Upload.madeline", $settings);
if ($mProto->getAuthorization() !== MTProto::LOGGED_IN) {
    $mProto->start();
}
if (isset($_GET['hash'])) {
    try {
        $id = random_decode($_GET['hash']);
        $id = $id / 1024 / 1024;
        $media = $mProto->messages->getMessages(['id' => [$id]]);
        if (!isset($media['messages'][0]['media'])) {
            echo "sset";
            exit;
        }
        $getDownloadInfo = $mProto->getDownloadInfo($media['messages'][0]['media']);
        header('Content-Disposition: attachment; filename='.$getDownloadInfo['name']);
        $mProto->downloadToBrowser($media['messages'][0]['media']);
    }catch(\Throwable $e) {
        echo $e->getMessage();
        http_response_code(404);
        exit;
    }
}
