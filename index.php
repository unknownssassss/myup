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
$mProto->start();
if(isset($_GET['hash'],$_GET['name'])){
    	    try{
    	        $hashdecode = explode("_",str_replace(range('a','z'),range(0,9),strrev($_GET['hash'])));
    	        $id = $hashdecode[1];
    	        $stamp = $hashdecode[0]; 
    	        if(!is_numeric($id) or !is_numeric($stamp)){
    	            echo "<html><body><h1><p>Somthing Wrong Please Check Link<br/>Is Num</p></h1><h1><p>مشکلی رخ داد لطفا لینک را چک کنید</p></h1></body></html>";
    	            exit;
    	        }
    	        if($stamp < time()){
    	                     echo "<html><body><h1><p>Somthing Wrong Please Check Link<br/>Stamp</p></h1><h1><p>مشکلی رخ داد لطفا لینک را چک کنید</p></h1></body></html>";
    	            exit;
    	        }
    	        $media =  $mProto->messages->getMessages(['id'=>[$id / 1024 / 1024]]);
    	        if(!isset($media['messages'][0]['media'])){
    	                        echo "<html><body><h1><p>Somthing Wrong Please Check Link<br/>Media</p></h1><h1><p>مشکلی رخ داد لطفا لینک را چک کنید</p></h1></body></html>";
    	            exit;
    	        }
    	        $getDownloadInfo =  $mProto->getDownloadInfo($media['messages'][0]['media']);
      $FileName = isset($getDownloadInfo['name']) ? $getDownloadInfo['name'] : "ناشناخته";
      $mime = isset($getDownloadInfo['mime']) ? $getDownloadInfo['mime'] : $getDownloadInfo['MessageMedia']['document']['mimetype'];
      $size = isset($getDownloadInfo['InputFileLocation']['file_size']) ? $getDownloadInfo['InputFileLocation']['file_size'] : $getDownloadInfo['size'];
    	         $mProto->downloadToBrowser($media['messages'][0]['media']);  
    	    }catch(\Throwable $e){
    	                    echo "<html><body><h1><p>Somthing Wrong Please Check Link</p></h1><h1><p>مشکلی رخ داد لطفا لینک را چک کنید</p></h1><h1>".$e->getMessage().$e->getLine()."</h1></body></html>";
    	            exit;
    	    }
}
