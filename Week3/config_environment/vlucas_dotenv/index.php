<?php

use Dotenv\Dotenv;

require "vendor/autoload.php";

$dot = Dotenv::createImmutable(__DIR__);
$dot->load();

echo $_ENV['DB_HOST'];
