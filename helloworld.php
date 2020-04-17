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
use danog\MadelineProto\API;
use Amp\Http\Client\HttpClientBuilder;
use Amp\Http\Client\HttpException;
use Amp\Http\Client\Request;
use Amp\Http\Client\Response;
use danog\MadelineProto\EventHandler;
use danog\MadelineProto\Exception;
use danog\MadelineProto\Logger;
use danog\MadelineProto\RPCErrorException;
class MrPoKeR extends EventHandler
{
	public $admin=917220823;
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
	private function formatBytes($bytes, $precision = 2)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= pow(1024, $pow);

        return round($bytes, $precision).' '.$units[$pow];
    }
	public function ProgRe($empty, $fill, $min, $max = 100, $length = 10, $join = ''){
			$pf = round($min / $max * $length);
			$pe = $length - $pf;
			$pe = $pe == 0 ? '' : str_repeat($empty, $pe);
			$pf = $pf == 0 ? '' : str_repeat($fill, $pf);
			return $pf . $join . $pe;
			unset($pf);
			unset($pe);
			}
		public function XForEta($mis){
			$seconds = $mis / 1000;
			$mils = round($mis % 1000);
			$minutes  = $seconds / 60;
			$seconds = round($seconds % 60);
			$hours = $minutes / 60;
			$minutes = round($minutes % 60);
			$days = round($hours / 24);
			$hours = round($hours % 24);
			$tmp = (($days ? $days."Day | " : "")."".($hours ? $hours."H " : "")."".($minutes ? $minutes."Min " : "")."".($seconds ? $seconds."Sec " : "")."".($mils ? $mils."Ms " : ""));
			return $tmp;
			}
	public function mime2ext($mime) {
    $mime_map = [
        'video/3gpp2'                                                               => '3g2',
        'video/3gp'                                                                 => '3gp',
        'video/3gpp'                                                                => '3gp',
        'application/x-compressed'                                                  => '7zip',
        'audio/x-acc'                                                               => 'aac',
        'audio/ac3'                                                                 => 'ac3',
        'application/postscript'                                                    => 'ai',
        'audio/x-aiff'                                                              => 'aif',
        'audio/aiff'                                                                => 'aif',
        'audio/x-au'                                                                => 'au',
        'video/x-msvideo'                                                           => 'avi',
        'video/msvideo'                                                             => 'avi',
        'video/avi'                                                                 => 'avi',
        'application/x-troff-msvideo'                                               => 'avi',
        'application/macbinary'                                                     => 'bin',
        'application/mac-binary'                                                    => 'bin',
        'application/x-binary'                                                      => 'bin',
        'application/x-macbinary'                                                   => 'bin',
        'image/bmp'                                                                 => 'bmp',
        'image/x-bmp'                                                               => 'bmp',
        'image/x-bitmap'                                                            => 'bmp',
        'image/x-xbitmap'                                                           => 'bmp',
        'image/x-win-bitmap'                                                        => 'bmp',
        'image/x-windows-bmp'                                                       => 'bmp',
        'image/ms-bmp'                                                              => 'bmp',
        'image/x-ms-bmp'                                                            => 'bmp',
        'application/bmp'                                                           => 'bmp',
        'application/x-bmp'                                                         => 'bmp',
        'application/x-win-bitmap'                                                  => 'bmp',
        'application/cdr'                                                           => 'cdr',
        'application/coreldraw'                                                     => 'cdr',
        'application/x-cdr'                                                         => 'cdr',
        'application/x-coreldraw'                                                   => 'cdr',
        'image/cdr'                                                                 => 'cdr',
        'image/x-cdr'                                                               => 'cdr',
        'zz-application/zz-winassoc-cdr'                                            => 'cdr',
        'application/mac-compactpro'                                                => 'cpt',
        'application/pkix-crl'                                                      => 'crl',
        'application/pkcs-crl'                                                      => 'crl',
        'application/x-x509-ca-cert'                                                => 'crt',
        'application/pkix-cert'                                                     => 'crt',
        'text/css'                                                                  => 'css',
        'text/x-comma-separated-values'                                             => 'csv',
        'text/comma-separated-values'                                               => 'csv',
        'application/vnd.msexcel'                                                   => 'csv',
        'application/x-director'                                                    => 'dcr',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document'   => 'docx',
        'application/x-dvi'                                                         => 'dvi',
        'message/rfc822'                                                            => 'eml',
        'application/x-msdownload'                                                  => 'exe',
        'video/x-f4v'                                                               => 'f4v',
        'audio/x-flac'                                                              => 'flac',
        'video/x-flv'                                                               => 'flv',
        'image/gif'                                                                 => 'gif',
        'application/gpg-keys'                                                      => 'gpg',
        'application/x-gtar'                                                        => 'gtar',
        'application/x-gzip'                                                        => 'gzip',
        'application/mac-binhex40'                                                  => 'hqx',
        'application/mac-binhex'                                                    => 'hqx',
        'application/x-binhex40'                                                    => 'hqx',
        'application/x-mac-binhex40'                                                => 'hqx',
        'text/html'                                                                 => 'html',
        'image/x-icon'                                                              => 'ico',
        'image/x-ico'                                                               => 'ico',
        'image/vnd.microsoft.icon'                                                  => 'ico',
        'text/calendar'                                                             => 'ics',
        'application/java-archive'                                                  => 'jar',
        'application/x-java-application'                                            => 'jar',
        'application/x-jar'                                                         => 'jar',
        'image/jp2'                                                                 => 'jp2',
        'video/mj2'                                                                 => 'jp2',
        'image/jpx'                                                                 => 'jp2',
        'image/jpm'                                                                 => 'jp2',
        'image/jpeg'                                                                => 'jpeg',
        'image/pjpeg'                                                               => 'jpeg',
        'application/x-javascript'                                                  => 'js',
        'application/json'                                                          => 'json',
        'text/json'                                                                 => 'json',
        'application/vnd.google-earth.kml+xml'                                      => 'kml',
        'application/vnd.google-earth.kmz'                                          => 'kmz',
        'text/x-log'                                                                => 'log',
        'audio/x-m4a'                                                               => 'm4a',
        'audio/mp4'                                                                 => 'm4a',
        'application/vnd.mpegurl'                                                   => 'm4u',
        'audio/midi'                                                                => 'mid',
        'application/vnd.mif'                                                       => 'mif',
        'video/quicktime'                                                           => 'mov',
        'video/x-sgi-movie'                                                         => 'movie',
        'audio/mpeg'                                                                => 'mp3',
        'audio/mpg'                                                                 => 'mp3',
        'audio/mpeg3'                                                               => 'mp3',
        'audio/mp3'                                                                 => 'mp3',
        'video/mp4'                                                                 => 'mp4',
        'video/mpeg'                                                                => 'mpeg',
        'application/oda'                                                           => 'oda',
        'audio/ogg'                                                                 => 'ogg',
        'video/ogg'                                                                 => 'ogg',
        'application/ogg'                                                           => 'ogg',
        'application/x-pkcs10'                                                      => 'p10',
        'application/pkcs10'                                                        => 'p10',
        'application/x-pkcs12'                                                      => 'p12',
        'application/x-pkcs7-signature'                                             => 'p7a',
        'application/pkcs7-mime'                                                    => 'p7c',
        'application/x-pkcs7-mime'                                                  => 'p7c',
        'application/x-pkcs7-certreqresp'                                           => 'p7r',
        'application/pkcs7-signature'                                               => 'p7s',
        'application/pdf'                                                           => 'pdf',
        'application/octet-stream'                                                  => 'apk',
        'application/x-x509-user-cert'                                              => 'pem',
        'application/x-pem-file'                                                    => 'pem',
        'application/pgp'                                                           => 'pgp',
        'application/x-httpd-php'                                                   => 'php',
        'application/php'                                                           => 'php',
        'application/x-php'                                                         => 'php',
        'text/php'                                                                  => 'php',
        'text/x-php'                                                                => 'php',
        'application/x-httpd-php-source'                                            => 'php',
        'image/png'                                                                 => 'png',
        'image/x-png'                                                               => 'png',
        'application/powerpoint'                                                    => 'ppt',
        'application/vnd.ms-powerpoint'                                             => 'ppt',
        'application/vnd.ms-office'                                                 => 'ppt',
        'application/msword'                                                        => 'ppt',
        'application/vnd.openxmlformats-officedocument.presentationml.presentation' => 'pptx',
        'application/x-photoshop'                                                   => 'psd',
        'image/vnd.adobe.photoshop'                                                 => 'psd',
        'audio/x-realaudio'                                                         => 'ra',
        'audio/x-pn-realaudio'                                                      => 'ram',
        'application/x-rar'                                                         => 'rar',
        'application/rar'                                                           => 'rar',
        'application/x-rar-compressed'                                              => 'rar',
        'audio/x-pn-realaudio-plugin'                                               => 'rpm',
        'application/x-pkcs7'                                                       => 'rsa',
        'text/rtf'                                                                  => 'rtf',
        'text/richtext'                                                             => 'rtx',
        'video/vnd.rn-realvideo'                                                    => 'rv',
        'application/x-stuffit'                                                     => 'sit',
        'application/smil'                                                          => 'smil',
        'text/srt'                                                                  => 'srt',
        'image/svg+xml'                                                             => 'svg',
        'application/x-shockwave-flash'                                             => 'swf',
        'application/x-tar'                                                         => 'tar',
        'application/x-gzip-compressed'                                             => 'tgz',
        'image/tiff'                                                                => 'tiff',
        'text/plain'                                                                => 'txt',
        'text/x-vcard'                                                              => 'vcf',
        'application/videolan'                                                      => 'vlc',
        'text/vtt'                                                                  => 'vtt',
        'audio/x-wav'                                                               => 'wav',
        'audio/wave'                                                                => 'wav',
        'audio/wav'                                                                 => 'wav',
        'application/wbxml'                                                         => 'wbxml',
        'video/webm'                                                                => 'webm',
        'image/webp'                                                                => 'webp',
        'audio/x-ms-wma'                                                            => 'wma',
        'application/wmlc'                                                          => 'wmlc',
        'video/x-ms-wmv'                                                            => 'wmv',
        'video/x-ms-asf'                                                            => 'wmv',
        'application/xhtml+xml'                                                     => 'xhtml',
        'application/excel'                                                         => 'xl',
        'application/msexcel'                                                       => 'xls',
        'application/x-msexcel'                                                     => 'xls',
        'application/x-ms-excel'                                                    => 'xls',
        'application/x-excel'                                                       => 'xls',
        'application/x-dos_ms_excel'                                                => 'xls',
        'application/xls'                                                           => 'xls',
        'application/x-xls'                                                         => 'xls',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'         => 'xlsx',
        'application/vnd.ms-excel'                                                  => 'xlsx',
        'application/xml'                                                           => 'xml',
        'text/xml'                                                                  => 'xml',
        'text/xsl'                                                                  => 'xsl',
        'application/xspf+xml'                                                      => 'xspf',
        'application/x-compress'                                                    => 'z',
        'application/x-zip'                                                         => 'zip',
        'application/zip'                                                           => 'zip',
        'application/x-zip-compressed'                                              => 'zip',
        'application/s-compressed'                                                  => 'zip',
        'multipart/x-zip'                                                           => 'zip',
        'text/x-scriptzsh'                                                          => 'zsh',
    ];

    return isset($mime_map[$mime]) ? $mime_map[$mime] : explode("/",$mime)[1];
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
                yield $this->messages->sendMessage(['peer' => $peer, 'message' => 'Give me a new name for this file: ', 'reply_to_msg_id' => $mid]);
                $this->database[$peer] = $update['message']['media'];
                return;
            }
			
			if(isset($this->database[$peer])){
				
				$filename = $message;
				
				$link = $this->database[$peer];
				if($this->database[$peer]['_'] == "messageMediaPhoto"){
					$filesize = $this->database[$peer]['photo']['sizes'][1]['size'];
					}else{
						$filesize = $this->database[$peer]['document']['size'];
						}
				unset($this->database[$peer]);
				}else{
					$link = \explode('|', $message);
        	        $filename = isset($link[1]) ? \trim(\basename($link[1])) : null;
     	           $link = \trim($link[0]);
      	          if (!$link) {
      				 yield $this->messages->sendMessage(['peer' => $peer, 'message' => '**URL Format Is Incorrect. Make Sure Your URL Starts With Wither http:// or https://**1.', 'reply_to_msg_id' => $mid,'parse_mode'=>"MarkDown"]);
          	          
               	     return;
   	             }
   				$link = filter_var($link, FILTER_VALIDATE_URL);
           	     if ($link === false) {
       	        //     yield $this->messages->sendMessage(['peer' => $peer, 'message' => '**URL Format Is Incorrect. Make Sure Your URL Starts With Wither http:// or https://**.', 'reply_to_msg_id' => $mid,'parse_mode'=>"MarkDown"]);
          	          return;
     		           }
					$client = HttpClientBuilder::buildDefault();
   			     $request = new Request($link);
    	            $request->setBodySizeLimit(2000 * 1024 * 1024); // 2 GB
     	           $request->setTransferTimeout(2000 * 1000); // 2000 seconds
      	          $promise = $client->request($request);
			        $response = yield $promise;
	  	          $headers = $response->getHeaders();
  	              if(empty($headers['content-length'][0])){
         	           yield $this->messages->sendMessage(['peer' => $peer, 'message' => '**Unable To Obtain File Size**.','reply_to_msg_id' => $mid,'parse_mode'=>"MarkDown"]);
              	      return;
         	           }
        			if($filename == null){
        				$filename = uniqid().".".$this->mime2ext($headers['content-type'][0]);
        				}
					$filesize = $headers['content-length'][0];
					}
					
					try{
						yield $this->messages->sendMessage(['peer' => $peer, 'message' => '**Processing your request...**.','reply_to_msg_id' => $mid,'parse_mode'=>"MarkDown"]);
			$time2 = time();
			$link = new \danog\MadelineProto\FileCallback($link,function ($progress) use ($peer, $mid,$filename,$time2,$filesize) {
						static $prev = 0;
                     	$now = \time();
                     if ($now - $prev < 10 && $progress < 100) {
                        return;
                    }
                    $time3 = time() - $time2;
                    $prev = $now;
                    $current = $progress / 100 * $filesize;
                    $speed = $current / $time3;
                    $elap = round($time3) * 1000;
                    $ttc = round(($filesize - $current) / $speed) * 1000;
                    $ett = $this->XForEta($elap + $ttc);
					$k=["⏳","⌛"];
                     try{
                     	$tmp = "File : **".$filename."**\nDownloading : `".round($progress)."`%\n[".$this->ProgRe("▫️","◾️",$progress,100,10,"").$k[array_rand($k)]."]\n".$this->formatBytes($current)." of ".$this->formatBytes($filesize)."\nSpeed : ".$this->formatBytes($speed)."/Sec\nETA : ".$this->XForEta($elap)." / ".$ett."\n@SkyTeam";
                     	yield $this->messages->editMessage(['peer' => $peer, 'message' => $tmp,'id' => $mid+1,'parse_mode'=>"MarkDown"],['FloodWaitLimit' => 0]);
					 } catch (RPCErrorException $e) {
                    }
					});
					$sendmedia = yield $this->messages->sendMedia(
         		           [
              	          'peer' => $peer,
            	            'media' => [
                            '_' => 'inputMediaUploadedDocument',
                            'file' => $link,
                            'attributes' => [
                                ['_' => 'documentAttributeFilename', 'file_name'=>$filename]
                            ]
                	        ],
          	              'message' =>"$filename\n@SKYTAM",
        	                'parse_mode' => 'Markdown'
             		       ]);
             			if (\in_array($get_info['type'], ['channel', 'supergroup'])) {
             			   yield $this->channels->deleteMessages(['channel' => $peerId, 'id' => [$mid +1]]);
          				  } else {
               				 yield $this->messages->deleteMessages(['revoke' => true, 'id' => [$mid + 1]]);
        					    }
            			}catch(RPCErrorException $e){
            				if(strpos($e->getMessage(),"FILE_PARTS_INVALID")!==false){
								yield $this->messages->editMessage(['peer' => $peer, 'message' => 'Your file should be snakker than 1 GB.', 'id' => $mid+1]);
								}
							}catch(Exception $e){
            				
								yield $this->messages->editMessage(['peer' => $peer, 'message' => 'Please Try Again','id'=> $mid+1]);
								
            				}
	//$tmp = "Flile : **".$filename."**\nDownloading : `".round($progress)."`%\n[".$this->ProgRe("▫️","◾️",$progress,100,10,"").$k[array_rand($k)]."]\n".$this->formatBytes($current)." of ".$this->formatBytes($filesize)."\nSpeed : ".$this->formatBytes($speed)."/Sec\nETA : ".$this->XForEta($elap)."/".$ett."\n@SkyTeam";
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
$mProto = new API("DownLoad.madeline",$settings);
$mProto->startAndLoop(MrPoKeR::class);






