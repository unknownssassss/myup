<?php
define("link","https://dl2.tgdrive.ir/download/");
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
$hashdecode = explode("_", str_replace(range('a', 'z'), range(0, 9), strrev($_GET['getTheFile'])));
$id = $hashdecode[1];
$stamp = $hashdecode[0];
if (!is_numeric($id) or !is_numeric($stamp)) {
    http_response_code(404);
    exit;
}
if ($stamp < time()) {
    echo "<script>alert('Link Expired')</script>";
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
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <!--bootstrap css-->

    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <script>
        (function(zp) {
            var id = Math.floor(1e7*Math.random()+1), url = location.protocol+'//www.zarpop.com/website/pp/null/6145/'+window.location.hostname+'/?'+id; zp.write('<div id="'+id+'"></div>'); zp.write('<script type="text/javascript" src="'+url+'" async></scri'+'pt>')})(document);
    </script>
</head>
<body>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">🔥</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        سرورهای جدید به زودی اضافه میشوند😻<br>منتظر خبرهای خوب باشیدد😁❤
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>
      </div>
    </div>
  </div>
</div>
    <div class="wrapper">

        <div id="formContent">
            <!-- text -->
            <div class="fadeIn first">
                <span class="text-center pro-text text-secondary "> مشخصات </span>
            </div>
            <br>
            <!-- table -->
            <div class="container-fluid col-lg-9 col-md-6 col-sm-9 col-12 table-hover">
                <table class="table table-sm">

                    <tbody>
                        <tr class="table-secondary ">
                            <th scope="row">نام فایل :</th>
                            <td class="text-right"><?echo $FileName;?></td>
                        </tr>
                        <tr>
                            <th scope="row">حجم فایل</th>
                            <td class="text-right"><? echo formatBytes($size)?></td>
                        </tr>
                        <tr class="table-secondary">
                            <th scope="row">فرمت فایل</th>
                            <td class="text-right"><?echo $ext;?></td>
                        </tr>
                        <tr>
                            <th scope="row">شناسه</th>
                            <td class="text-right"><? echo $id; ?></td>
                        </tr>
                        <tr class="table-secondary">
                            <th scope="row">تاریخ انقضاء</th>
                            <td class="text-right"><?echo date("Y/m/d",$stamp);?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- btn download file-->
            <div id="formFooter">
                <a href='<? echo link.$_GET["getTheFile"]."/".$FileName.$ext;?>' target="_blank" class="btn btn-secondary btn-lg btn-block">دانلود از سرور اول</a>
           <!--     <a href="https://google.com" target="_blank" class="btn btn-secondary btn-lg btn-block">دالود از سرور دوم(نیم بها)</a>-->
            </div>

        </div>
        <!-- footer -->
        <footer class="fixed-bottom bg-light text-center text-lg-start">
            <div class="text-center p-3 txt-footer">
                file2linkskybot@ کلیه حقوق محفوظ است به ربات
            </div>
            <!-- Copyright -->
        </footer>
    </div>

</body>
</html>