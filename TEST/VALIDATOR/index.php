<?php

use App\Validate;

require "vendor/autoload.php";

$obj = new Validate();
echo $obj->validate();
