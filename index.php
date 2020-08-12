<?php
set_time_limit(0);
ini_set('memory_limit', '512M');
ini_set('max_execution_time',-1); 
date_default_timezone_set("Asia/tehran");

if (!\file_exists('madeline.php')) {
        \copy('https://phar.madelineproto.xyz/madeline.php', 'madeline.php');
    }
    require_once('madeline.php');			 
use Amp\File\File;
use danog\MadelineProto\API;
use danog\MadelineProto\EventHandler;
use danog\MadelineProto\Exception;
use danog\MadelineProto\Logger;
use danog\MadelineProto\MTProto;
use danog\MadelineProto\RPCErrorException;
$settings=[];
$settings['serialization']['serialization_interval'] = 60 * 6;
$settings['logger']['logger_level'] = Logger::VERBOSE;
$settings['logger']['logger'] = \danog\MadelineProto\Logger::FILE_LOGGER;
$settings['logger']['max_size'] = 2 * 1024 * 1024;
$settings['peer']['cache_all_peers_on_startup'] = true;
$settings['serialization']['cleanup_before_serialization']=true;
$mProto = new API("dl.madeline",$settings);
if ($mProto->API->authorized !== MTProto::LOGGED_IN) {
    $mProto->start();
    }
$mProto->loop(function() use ($mProto){
$mProto->async(true);
if(isset($_GET['id'],$_GET['name'],$_GET['stamp'])){
    	    try{
    	        if(!is_numeric($_GET['id']) or !is_numeric(base64_decode(strrev($_GET['stamp'])))){
    	            echo "<html><body><h1><p>Somthing Wrong Please Check Link</p></h1><h1><p>مشکلی رخ داد لطفا لینک را چک کنید</p></h1></body></html>";
    	            exit;
    	        }
    	        if(base64_decode(strrev($_GET['stamp'])) < time()){
    	                     echo "<html><body><h1><p>Somthing Wrong Please Check Link</p></h1><h1><p>مشکلی رخ داد لطفا لینک را چک کنید</p></h1></body></html>";
    	            exit;
    	        }
    	        $media = yield $mProto->messages->getMessages(['id'=>[$_GET['id'] / 1024 / 1024]]);
    	        if(!isset($media['messages'][0]['media'])){
    	                        echo "<html><body><h1><p>Somthing Wrong Please Check Link</p></h1><h1><p>مشکلی رخ داد لطفا لینک را چک کنید</p></h1></body></html>";
    	            exit;
    	        }
    	        $getDownloadInfo = yield $mProto->getDownloadInfo($media['messages'][0]['media']);
    	        if(urldecode($_GET['name']) != $getDownloadInfo['name'].$getDownloadInfo['ext']){
    	                        echo "<html><body><h1><p>Somthing Wrong Please Check Link</p></h1><h1><p>مشکلی رخ داد لطفا لینک را چک کنید</p></h1></body></html>";
    	            exit;
    	        }
      $FileName = isset($getDownloadInfo['name']) ? $getDownloadInfo['name'] : "ناشناخته";
      $mime = isset($getDownloadInfo['mime']) ? $getDownloadInfo['mime'] : $getDownloadInfo['MessageMedia']['document']['mimetype'];
      $size = isset($getDownloadInfo['InputFileLocation']['file_size']) ? $getDownloadInfo['InputFileLocation']['file_size'] : $getDownloadInfo['size'];
    	        header('Content-Length: '.$size);
    	        header('Content-Description: File Transfer');
				header('Content-Type: '.$mime);
				header('Content-Disposition: attachment; filename='.$FileName);
            header('Pragma: public');
				flush();
    	        				yield $mProto->downloadToBrowser($getDownloadInfo['MessageMedia']);  
    	    }catch(\Throwable $e){
    	                    echo "<html><body><h1><p>Somthing Wrong Please Check Link</p></h1><h1><p>مشکلی رخ داد لطفا لینک را چک کنید</p></h1><h1><?php $e->getMessage().$e->getLine();?></h1></body></html>";
    	            exit;
    	    }
}
});