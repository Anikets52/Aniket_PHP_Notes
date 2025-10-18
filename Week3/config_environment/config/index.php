<?php
$config = require "config.php";
$config2 = parse_ini_file("config.ini", true);
echo "<pre>";
print_r($config);
print_r($config2['database']);
