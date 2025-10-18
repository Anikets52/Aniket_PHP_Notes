<?php

require "vendor/autoload.php";

use App\User;
use Models\Database\Connection;
use View\Repository;
use Name\name2\Trial;
use App\Services\Validator;
use Models\ContactValidator;
// spl_autoload_register(function (string $class) {

//     $path = "src/" . str_replace("\\", "/", $class) . ".php";
//     // var_dump($path);
//     if (file_exists($path)) {
//         require $path;
//     }
// });

$obj = new User();
$obj->display();
//Simple Dependency Injection
$conn = new Connection();
echo "<br><h4>Aniket Database Data:</h4>";
$repo = new Repository($conn, "aniket");
echo "<br><h6>User Table Data:</h6>";
$data = $repo->display('user');
echo "<pre>";
print_r($data);
echo "<br><h6>Address Table Data:</h6>";
print_r($repo->display('address'));
echo "<br><h4>User2 Database Data:</h4>";
$repo2 = new Repository($conn, "user2");
echo "<br><h6>LoginToken Table Data:</h6>";
print_r($repo2->display('logintoken'));
echo "<br><h6>User Table Data:</h6>";
print_r($repo2->display('user'));
// Using Different Namespace and mapping it
$obj3 = new Trial();
//Simple Dependency Injection 2

try {
    $validator = new Validator();
    $contact = new ContactValidator("1234567890", $validator);
    // $contact = new ContactValidator("123abc4567", $validator); // Throws Exception
    echo "<br>" . $contact->getContactNumber();
} catch (Exception $e) {
    echo "<br>" . $e->getMessage();
}


// class MockValidator
// {
//     public function isValidContactNumber($contactNumber)
//     {
//         // Simulate validation for testing
//         return strlen($contactNumber) === 10;
//     }
// }

// $validator2 = new MockValidator();
// $contact = new ContactValidator("1234567890", $validator2);
// echo $contact->getContactNumber(); // Output: 1234567890
