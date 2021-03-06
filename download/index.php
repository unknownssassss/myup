<?php

set_time_limit(0);
ini_set('memory_limit', '512M');
ini_set('max_execution_time', -1);
date_default_timezone_set("Asia/tehran");
ini_set("request_terminate_timeout",-1);
if (!\file_exists('../madeline.php')) {
    \copy('https://phar.madelineproto.xyz/madeline.php', '../madeline.php');
}
require('../madeline.php');
use danog\MadelineProto\API;
use danog\MadelineProto\MTProto;
use danog\MadelineProto\Logger;
$settings = [];
$mProto = new API("../Upload.madeline", $settings);
if ($mProto->getAuthorization() !== MTProto::LOGGED_IN) {
    $mProto->start();
}
if (isset($_GET['hash']) && isset($_GET['name'])) {
    try {
        $hashdecode = explode("_",str_replace(range('a','z'),range(0,9),strrev($_GET['hash'])));
    	        $id = $hashdecode[1] / 1024 / 1024;
    	        $stamp = $hashdecode[0]; 
    	        if(!is_numeric($id) or !is_numeric($stamp)){
    	            http_response_code(404);
    exit;
    	        }
    	        if($stamp < time()){
    	                     http_response_code(404);
    exit;
    	        }
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
