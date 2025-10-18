<?php

use Database\Connection;

require "vendor/autoload.php";
try {
    $pdo = (new Connection())->getConnnection();
    // echo "Connection Successfull<BR>";
} catch (PDOException $e) {
    echo "Error:Connecting The Database:" . $e->getMessage();
}

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$perpage = 5;
$offset = ($page - 1) * $perpage;

try {
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM users");
    $stmt->execute();
    $totalRows = (int)$stmt->fetchColumn();
    // echo $totalRows;
    $totalPages = (int)ceil($totalRows / $perpage);
    // echo $totalPages;
} catch (PDOException $e) {
    echo "Error:Fetching Total Records" . $e->getMessage();
}

try {

    $stmt = $pdo->prepare("SELECT* FROM users LIMIT {$perpage} OFFSET {$offset}");
    $stmt->execute();
    $users = $stmt->fetchAll();
    // echo "FETCH Successfull<BR>";
} catch (PDOException $e) {
    echo "Error:Fetching user deatils failed:" . $e->getMessage();
}
