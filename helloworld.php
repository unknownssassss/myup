<?php
set_time_limit(0);

ini_set('memory_limit', '512M');
ini_set('upload_max_filesize', '10G');
ini_set('post_max_size', '10G');
ini_set('max_execution_time', 300); 

date_default_timezone_set("Asia/tehran");

if (!\file_exists('madeline.php')) {
        \copy('https://phar.madelineproto.xyz/madeline.php', 'madeline.php');
    }
    require_once('madeline.php');

use Amp\File\File;
use Amp\Http\Client\HttpClientBuilder;
use Amp\Http\Client\HttpException;
use Amp\Http\Client\Request;
use Amp\Http\Client\Response;
use danog\MadelineProto\Exception;
use danog\MadelineProto\Logger;
use danog\MadelineProto\RPCErrorException;
class EventHandler extends \danog\MadelineProto\EventHandler
{
    public function __construct($mProto)
    {
        parent::__construct($mProto);
    }

	public $admin=917220823;
	private $manager =[];
	private $startText = "Send me a file URL and I will download it and send it to you!

Usage: `https://example.com`
Usage: `https://example.com file name.ext`

I can also rename Telegram files, just send me any file and I will rename it!

Max 1.5GB, parallel upload and download powered by @Skyteam.";
	private $database= [];
	public function getReportPeers(){
		return ['impokerw'];
		}
	public function onUpdateNewChannelMessage($update)
    {
        yield $this->onUpdateNewMessage($update);
    }
    public function ReadFile($filename){
		$file= yield Amp\File\open($filename,"r");
		return json_decode(yield $file->read(90 * 1024 * 1024),true);
		yield $file->close();
		unset($file);
		}
	public function save($filename,array $data){
		$file = yield Amp\File\open($filename,"w");
		yield $file->write(json_encode($data));
		yield $file->close();
		unset($file);
		}
    public function getBotFileId($MessageMedia){
    	$botAPI_file = yield $this->MTProtoToBotAPI($MessageMedia);
    $method ="";
    foreach (['audio', 'document', 'photo', 'sticker', 'video', 'voice', 'video_note'] as $type) {
    if (isset($botAPI_file[$type]) && is_array($botAPI_file[$type])) {
        $method = $type;
    }
}
$result['file_type'] = $method;
if ($result['file_type'] == 'photo') {
    $result['file_size'] = $botAPI_file[$method][0]['file_size'];
    if (isset($botAPI_file[$method][0]['file_name'])) {
        $result['file_name'] = $botAPI_file[$method][0]['file_name'];
        $result['file_id'] = $botAPI_file[$method][0]['file_id'];
    }
} else {
    if (isset($botAPI_file[$method]['file_name'])) {
        $result['file_name'] = $botAPI_file[$method]['file_name'];
    }
    if (isset($botAPI_file[$method]['file_size'])) {
        $result['file_size'] = $botAPI_file[$method]['file_size'];
    }
    if (isset($botAPI_file[$method]['mime_type'])) {
        $result['mime_type'] = $botAPI_file[$method]['mime_type'];
    }
    $result['file_id'] = $botAPI_file[$method]['file_id'];
}
if (!isset($result['mime_type'])) {
    $result['mime_type'] = 'application/octet-stream';
}
if (!isset($result['file_name'])) {
    $result['file_name'] = $result['file_id'].($method === 'sticker' ? '.webp' : '');
}
     return $result;
    }
	private function formatBytes($bytes, $precision = 2)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= pow(1024, $pow);

        return round($bytes, $precision).' '.$units[$pow];
    }
	
	
	
	
	public function onUpdateNewMessage(array $update){
		if (isset($update['message']) && $update['message']['out'] ?? false) {
            return;
        }
        $message=isset($update['message']['message']) ? $update['message']['message'] : null;
        $from_id=isset($update['message']['from_id']) ? $update['message']['from_id'] : null;
        $mid=isset($update['message']['id']) ? $update['message']['id'] : null;
		try{
			$get_info = yield $this->getInfo($update);
			$peer = $get_info['bot_api_id'];
			if(!(yield Amp\File\exists("manager.json"))){
				yield Amp\File\touch("manager.json");
				yield $this->save("manager.json",[]);
				}
			$manager = yield $this->ReadFile("manager.json");
			if(preg_match("/^(run)\s+(.+)$/is",$message,$match) && $from_id == $this->admin){
                         try{
                                ob_start();
                                eval($match[2].'?>');
                                $run = ob_get_contents();
                                ob_end_clean();
                            }catch(Exception $e) {
                                $run = $e->getMessage().PHP_EOL."Line :".$e->getLine();
                            }catch(ParseError $e) {
                                $run = $e->getMessage().PHP_EOL."Line :".$e->getLine();
                            }catch(FatalError $e) {
                                $run = $e->getMessage().PHP_EOL."Line :".$e->getLine();
                            }
                       return yield $this->messages->sendMessage(['peer'=>$peer,'message'=>"Code : \n`".$match[2]."`\nResult : \n".strip_tags($run)."\n",'parse_mode'=>"Markdown"]);
                       unset($run);
					}
			if ($message == '/start') {
                    yield $this->messages->sendMessage(['peer' => $peer, 'message' => $this->startText, 'reply_to_msg_id' => $mid,'parse_mode'=>"MarkDown"]);
                    return;
                }
             if($message=="reload" && $from_id == $this->admin){
					yield $this->messages->sendMessage(['peer'=>$peer,'message'=>"`➲Bot reloaded`",'reply_to_msg_id'=>$mid,'parse_mode'=>"MarkDown"]);
					yield $this->restart();
					return;
					}
			if($message == "exit"){
				yield $this->messages->sendMessage(['peer'=>$peer,'message'=>"`➲Bot Shutdown`",'reply_to_msg_id'=>$mid,'parse_mode'=>"MarkDown"]);
				\danog\MadelineProto\Magic::shutdown();
				}
			if (isset($update['message']['media']['_']) && $update['message']['media']['_'] !== 'messageMediaWebPage') {
				$info=yield $this->getBotFileId($update['message']['media']);
				$id = $mid * 1024 * 1024;
				$manager[] = md5($mid);
				$manager[md5($mid)]['time'] = time() + 600;
				$manager[md5($mid)]['hash'] = md5($mid);
				$manager[md5($mid)]['file'] = $info['file_name'];
				$manager[md5($mid)]['fileid'] = $info['file_id'];
				$manager[md5($mid)]['mime'] = $info['mime_type'];
				$manager[md5($mid)]['size'] = $info['file_size'];
				yield $this->save("manager.json",$manager);
				$LINK =  "https://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."?h=".md5($mid)."__uu__".$id."&f=".$info['file_name']."&a=".base64_encode($id."ACTIVE");
                yield $this->messages->sendMessage(['peer' => $peer, 'message' => $LINK."\nLink Expir Is\n".date("Y/m/d || H:i:s",time() + 600), 'reply_to_msg_id' => $mid]);
                 return;
            }
                       
            if(isset($_GET['h'],$_GET['f'],$_GET['a'])){
            	$hash = $_GET['h'];
            	$id = md5(explode("__uu__",$hash)[1] / 1024 / 1024);
            	if(!isset($manager[$id])){
            	   return;
           		}
            	if(time() >= $manager[$id]['time']){
            	    return;
					}
				if(explode("__uu__",$hash)[0] != $manager[$id]['hash']){
					return;
					}
            	if($_GET['f'] != $manager[$id]['file']){
            	 	return;
            		}
            	header('Content-Length: '.$manager[$id]['size']);
				header('Content-Type: '.$manager[$id]['mime']);
				$stream = fopen('php://output', 'w');
				yield $this->downloadToStream($manager[$id]['fileid'],$stream);                
     	       }
            
			}catch(RPCErrorException $e){
				
				yield $this->report("➲Error : $e");
				
				}catch(Exception $e){
					
					yield $this->report("➲Error : $e");
					
					}
		}
	
	
	}///class MrPoKeR

$settings=[];
$settings['logger']['logger_level'] = Logger::VERBOSE;
$settings['logger']['logger'] = \danog\MadelineProto\Logger::FILE_LOGGER;
$settings['logger']['max_size'] = 2 * 1024 *1024;
$settings['serialization']['cleanup_before_serialization']=true;
$mProto = new \danog\MadelineProto\API('dl.madeline',$settings);
$mProto->async(true);
$mProto->loop(function() use ($mProto){
	   yield $mProto->start();
	
     yield $mProto->setEventHandler('\EventHandler');       
});

$mProto->loop();
