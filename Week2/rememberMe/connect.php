<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user2";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    echo "error" . $conn->error;
    die("Connection failed.");
} else {
    // echo "<br>connection done!!";
}
