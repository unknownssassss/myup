<?php
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
    echo "<script>alert('😕')</script>";
    http_response_code(404);
    exit;
}
if ($stamp < time()) {
    echo "<script>alert('Expired')</script>";
    http_response_code(404);
    exit;
}
?>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="x-ua-compatible" content="ie=edge" />


    <!--bootstrap css-->

    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">

</head>
<body>

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
                            <td>name</td>
                        </tr>
                        <tr>
                            <th scope="row">حجم فایل</th>
                            <td>5235</td>
                        </tr>
                        <tr class="table-secondary">
                            <th scope="row">نوع فایل</th>
                            <td>file</td>
                        </tr>
                        <tr>
                            <th scope="row">شناسه</th>
                            <td>2153</td>
                        </tr>
                        <tr class="table-secondary">
                            <th scope="row">تعداد فایل</th>
                            <td>0</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- btn download file-->
            <div id="formFooter">
                <button type="button" class="btn btn-secondary btn-lg btn-block" onclick="window.open('https://google.com','_blank)">دانلود از سرور اول</button>
                <a href="https://google.com" target="_blank" class="btn btn-secondary btn-lg btn-block">دانلود از سرور دوم(نیم بها)</a>
            </div>

        </div>
        <!-- footer -->
        <footer class="  fixed-bottom bg-light text-center text-lg-start">
            <div class="text-center p-3 txt-footer">
                file2linkskybot@ کلیه حقوق محفوظ است به ربات
            </div>
            <!-- Copyright -->
        </footer>
    </div>

</body>
</html>