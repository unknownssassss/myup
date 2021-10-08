<?php
set_time_limit(0);
ini_set('memory_limit', '512M');
ini_set('max_execution_time', -1);
date_default_timezone_set("Asia/tehran");
ini_set("request_terminate_timeout",-1);
if (!\file_exists('madeline.php')) {
    \copy('https://phar.madelineproto.xyz/madeline.php', 'madeline.php');
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
if (isset($_GET['hash']) && isset($_GET['name'])) {
    try {
        $media = $mProto->messages->getMessages(['id' => [$id]]);
        if (!isset($media['messages'][0]['media'])) {
            http_response_code(404);
    exit;
        }
        $getDownloadInfo = $mProto->getDownloadInfo($media['messages'][0]['media']);
        $mProto->downloadToBrowser($media['messages'][0]['media']);
    }catch(\Throwable $e) {
        echo $e->getMessage();
        http_response_code(404);
    exit;
    }
}