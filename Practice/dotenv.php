<?php
require "vendor/autoload.php";

use Dotenv\Dotenv;
use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\ValidationException;
use Valitron\Validator;

$dot = Dotenv::createImmutable(__DIR__);

$data = ["name" => ["aniket1", "piAyush1"], "age" => 20];
$valid = v::email()->validate("ok@gmail.com");
// echo $valid;
try {
    $valiadtor = v::key("name", v::stringType()->notEmpty()->length(2, 10))->assert($data);
} catch (ValidationException $e) {
    // echo "error" . $e->getMessage();
}
// print_r($valiadtor);

$dot->load();
// echo $_ENV['DB_USERNAME'];


$validator = new Validator($data);
$validator->rule("required", ["name"]);
// Apply regex to each name (must start with "a")
$validator->rule("regex", "name.*", "/a/");

if ($validator->validate()) {
    echo "<br>EveryThings good!!";
} else {
    print_r($validator->errors());
}
