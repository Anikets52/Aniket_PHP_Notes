<?php

// Read
$handler = fopen('ok.txt', 'r');
echo fread($handler, 7);
// echo fgets($handler);

$content = file_get_contents('ok.txt'); #STRING
echo $content;

$lines = file('ok.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES); #ARRAY
print_r($lines);


// //Write
$handler = fopen('ok.txt', 'w');
fwrite($handler, "hello world");

$handler = fopen('ok.txt', 'a'); #Append
fwrite($handler, "hello world2");

file_put_contents('ok.txt', "\nhabibi", FILE_APPEND);

//CSV
$handlercsv = fopen('okay.csv', 'r');
print_r(fgetcsv($handlercsv));

$handlercsv2 = fopen('okay.csv', 'w');
fputcsv($handlercsv2, [30, 'AJAY']);

//Other Operations
// rename('super.txt', 'super2.txt');
//unlink('super2.txt');
// copy('ok.txt', 'okay2.txt');