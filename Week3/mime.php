<?php
error_reporting(0);
ini_set("display_errors", 0);
ini_set('log_errors', 1);
ini_set('error_log', 'log.txt');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_FILES['file']) && isset($_POST['submit'])) {
        $file = $_FILES['file'];
        print_r($_FILES['file']);
    }
    echo "<br>  " . mime_content_type($file['tmp_name']);
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $MIME = finfo_file($finfo, $file['tmp_name']);
    echo "<br>" . $MIME;
}

?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form method="POST" action="<?php $_PHP_SELF ?>" enctype="multipart/form-data">
        <input type="file" name="file" />
        <input type="submit" value="Upload" name="submit">
    </form>
</body>

</html>