<?php

use Utils\StringUtility;

require "vendor/autoload.php";

$obj = new StringUtility();
echo $obj->format("Aniket Singh") . "<br>";
echo $obj->toCamelCase("aniket_singh", "_") . "<br>";
echo $obj->reverse("aniketsingh") . "<br>";
