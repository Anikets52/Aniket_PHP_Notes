<?php

//Curl for calling the REST API

$data = ["title" => "homework"];
$ch = curl_init("http://localhost:3000/tasks/1");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type:application/json", "X-API-KEY:1234564"]);
$response = curl_exec($ch);
curl_close($ch);
echo $response;
