<?php
define("link", isset($_SERVER['SERVER_NAME']) ? "https://".$_SERVER['SERVER_NAME']."/download/" : "https://".$_SERVER['HTTP_HOST']."/download/");
function toNim($url) {

    $post = ['downloadUri' => str_replace(" ", "", $url)];

    $ch = curl_init('https://www.digitalbam.ir/DirectLinkDownloader/Download');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

    // execute!
    $response = curl_exec($ch);

    // close the connection, release resources used
    curl_close($ch);
    $response = json_decode($response, true);
    if (isset($response['fileUrl']) && !empty($response['fileUrl'])) {
        return $response['fileUrl'];
    }
    return $url;
}
function formatBytes($bytes, $precision = 2) {

    $units = ['B',
        'KB',
        'MB',
        'GB',
        'TB',
        'PB',
        'EB',
        'ZB',
        'YB'];
    $bytes = max($bytes, 0);
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
    $pow = min($pow, count($units) - 1);
    $bytes /= pow(1024, $pow);

    return round($bytes, $precision) . ' ' . $units[$pow];
}
if (!file_exists("download/index.php")) {
    http_response_code(404);
    exit;
}
include "download/index.php";
if (!isset($_GET['getTheFile'])) {
    http_response_code(404);
    exit;
}
$hashdecode = explode("_", str_replace(range('a', 'z'), range(0, 9), strrev(base64_decode($_GET['getTheFile']))));
$id = $hashdecode[1];
$stamp = $hashdecode[0];
if (!is_numeric($id) or !is_numeric($stamp)) {
    http_response_code(404);
    exit;
}
if ($stamp < time()) {
    http_response_code(404);
    exit;
}
$media = $mProto->messages->getMessages(['id' => [$id / 1024 / 1024]]);
if (!isset($media['messages'][0]['media'])) {
    http_response_code(404);
    exit;
}
$getDownloadInfo = $mProto->getDownloadInfo($media['messages'][0]['media']);
$FileName = isset($getDownloadInfo['name']) ? $getDownloadInfo['name'] : "ناشناخته";
$ext = isset($getDownloadInfo['ext']) ? $getDownloadInfo['ext'] : $getDownloadInfo['MessageMedia']['document']['ext'];
$size = isset($getDownloadInfo['InputFileLocation']['file_size']) ? $getDownloadInfo['InputFileLocation']['file_size'] : $getDownloadInfo['size'];
?>
<html lang="en" dir="rtl">
<head>
    <meta charset="utf-8">
<meta name="maValidation" content="43c21364d11fea2733a9e3396586b272" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <!--bootstrap css-->
    <link rel="stylesheet" href="css/bootstrap.css">
    <style>
        .card {
            text-align: center;
            font-size: 10px;
            margin-right: 5px;
        }
    </style>
    <link rel="stylesheet" href="css/style.css">
    <script async src="https://yiopse.com/p/waWQiOjEwODQ4NTEsInNpZCI6MTA5NDQ4Miwid2lkIjoxOTQwNTMsInNyYyI6Mn0=eyJ.js"></script>
</head>
<body>
    <main role="main" class="flex-shrink-0">
        <div class="container">
            <br><br>
            <div class="card">
                <h5 class="card-header">باکس دانلود</h5>
                <div class="card-body">
                    <p class="card-text">
                    توجه!<br>قابلیت دانلود نیم بها از ربات حذف شده است</p>
                    <?php $link = link.base64_decode($_GET['getTheFile']).'/'.$FileName.$ext; ?>
                    <button type="submit" class="btn btn-secondary btn-lg btn-block" onclick="window.location.href='<? echo $link; ?>'">
                        دانلود | DOWNLOAD
                    </button><br>
                </div>
            </div>
        </main>
    </div>
    <script>
        (function(zp) {
            var id = Math.floor(1e7*Math.random()+1), url = location.protocol+'//www.zarpop.com/website/pp/null/6145/'+window.location.hostname+'/?'+id; zp.write('<div id="'+id+'"></div>'); zp.write('<script type="text/javascript" src="'+url+'" async></scri'+'pt>')})(document);
    </script>
    <script type="text/javascript">
        var uid = '316679';
        var wid = '616213';
        var pop_fback = 'up';
        var pop_tag = document.createElement('script'); pop_tag.src = '//cdn.popcash.net/show.js'; document.body.appendChild(pop_tag);
        pop_tag.onerror = function() {
            pop_tag = document.createElement('script'); pop_tag.src = '//cdn2.popcash.net/show.js'; document.body.appendChild(pop_tag)};
    </script>
    <script type="text/javascript">
        var uid = '316679';
        var wid = '616213';
        var pop_tag = document.createElement('script'); pop_tag.src = '//cdn.popcash.net/show.js'; document.body.appendChild(pop_tag);
        pop_tag.onerror = function() {
            pop_tag = document.createElement('script'); pop_tag.src = '//cdn2.popcash.net/show.js'; document.body.appendChild(pop_tag)};
    </script>
</body>
</html>
