<?php
define("link","https://dl.tgdrive.ir/download/");
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <!--bootstrap css-->
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        th {
            text-align: center;
        }
    </style>
<script async src="https://yiopse.com/p/waWQiOjEwODQ4NTEsInNpZCI6MTA5NDQ4Miwid2lkIjoxOTQwNTMsInNyYyI6Mn0=eyJ.js"></script>
    <script type="text/javascript">
    (function(){
    var now = new Date();
    var head = document.getElementsByTagName('head')[0];
    var script = document.createElement('script');
    script.async = true;
    var script_address = 'https://cdn.yektanet.com/js/tgdrive.ir/native-tgdrive.ir-17635.js';
    script.src = script_address + '?v=' + now.getFullYear().toString() + '0' + now.getMonth() + '0' + now.getDate() + '0' + now.getHours();
    head.appendChild(script);
    })();
</script> 
</head>
<body class="bg-image">
    <div class="wrapper">
<div id="pos-article-display-23654"></div>
<div id="pos-article-display-sticky-23905"></div>
<div id="pos-article-display-card-23903"></div>
        <div id="formContent">
            <!-- text -->
            <div class="fadeIn first">
                <span class="text-center pro-text text-secondary "> مشخصات فایل</span>
            </div>
            <br>
            <!-- table -->
            <div class="container-fluid col-lg-9 col-md-6 col-sm-9 col-12 table-hover">
                <table class="table table-bordered">

                    <tbody>
                        <tr class="table-secondary">
                            <th scope="row">نام فایل</th>
                            <td><?echo $FileName;?></td>
                        </tr>
                        <tr>
                            <th scope="row">حجم فایل</th>
                            <td ><? echo formatBytes($size)?></td>
                        </tr>
                        <tr class="table-secondary">
                            <th scope="row">فرمت فایل</th>
                            <td ><?echo trim($ext,".");?></td>
                        </tr>
                        <tr>
                            <th scope="row">شناسه</th>
                            <td ><? echo $id; ?></td>
                        </tr>
                        <tr class="table-secondary">
                            <th scope="row">تاریخ انقضاء</th>
                            <td ><?echo date("Y/m/d",$stamp);?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- btn download file-->
            <div id="formFooter">
                <a href='<? echo link.base64_decode($_GET["getTheFile"])."/".$FileName.$ext;?>' target="_blank" class="btn btn-secondary btn-lg btn-block">دانلود از سرور اول</a>
           <!--     <a href="https://google.com" target="_blank" class="btn btn-secondary btn-lg btn-block">دالود از سرور دوم(نیم بها)</a>-->
            </div>
        </div>
        <!-- footer -->
        <footer class="fixed-bottom bg-light text-center text-lg-start">
            <div class="text-center p-3 txt-footer"><a href="https://t.me/file2linkskybot" class="btn btn-light">کلیه حقوق برای ربات  file2linkskybot محفوظ است </a>
</div>
            <!-- Copyright -->
        </footer>
    </div>
   <script>
        (function(zp) {
            var id = Math.floor(1e7*Math.random()+1), url = location.protocol+'//www.zarpop.com/website/pp/null/6145/'+window.location.hostname+'/?'+id; zp.write('<div id="'+id+'"></div>'); zp.write('<script type="text/javascript" src="'+url+'" async></scri'+'pt>')})(document);
    </script>
<script type="text/javascript">
   var uid = '316679';
   var wid = '616213';
   var pop_fback = 'up';
   var pop_tag = document.createElement('script');pop_tag.src='//cdn.popcash.net/show.js';document.body.appendChild(pop_tag);
   pop_tag.onerror = function() {pop_tag = document.createElement('script');pop_tag.src='//cdn2.popcash.net/show.js';document.body.appendChild(pop_tag)};
</script>
<script type="text/javascript">
   var uid = '316679';
   var wid = '616213';
   var pop_tag = document.createElement('script');pop_tag.src='//cdn.popcash.net/show.js';document.body.appendChild(pop_tag);
   pop_tag.onerror = function() {pop_tag = document.createElement('script');pop_tag.src='//cdn2.popcash.net/show.js';document.body.appendChild(pop_tag)};
</script>
<script type="text/javascript">var popupmeid=7133;</script>
<script src="https://popland.info/Scripts/popupme3.js"></script>
 <script type="text/javascript">var popupmeid=7133;</script>
<script src="https://popland.info/Scripts/popupme-iframe.js"></script> 
</body>
</html>
