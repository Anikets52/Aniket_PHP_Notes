<?php

require "vendor/autoload.php";

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

$key = JWT::encode(["name" => "aniket"], "hello", "HS512");
echo $key;
try {
    $OK = JWT::decode($key, new key("hello", "HS512"));
    echo $OK->name;
} catch (Exception $e) {
    echo "error jwt";
}
echo "<pre>";
$ch = curl_init("https://jsonplaceholder.typicode.com/posts/1");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
curl_close($ch);

echo $response;



$data = [
    "title" => "My First Post",
    "body" => "Hello World",
    "userId" => 1
];

$ch = curl_init("https://jsonplaceholder.typicode.com/posts/41");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);

$response = curl_exec($ch);
curl_close($ch);

echo $response;


$ch = curl_init("https://jsonplaceholder.typicode.com/posts/1");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");

$response = curl_exec($ch);
curl_close($ch);
// http_response_code(400);
echo $response;

print_r($_SERVER);
