<?php

use Database\Connection;

require "vendor/autoload.php";
echo "<script>
alert('hello');
</script>";
if (empty($_REQUEST['id'])) {
    header("Refresh: 0.5; url=index.php?page=1");
    exit;
}

$id = base64_decode($_REQUEST['id']);
$page = $_GET['page'] ?? 1;
$pdo = (new Connection())->getConnnection();
$stmt = $pdo->prepare("DELETE FROM users WHERE id = :id ");
$stmt->bindValue(":id", $id);
if ($stmt->execute()  && $stmt->rowCount() > 0) {
    echo "
    <script>
    alert('User Deleted Successfully');
    </script>
    ";
    header("Refresh: 0.5; url=index.php?page={$page}");
} else {
    echo "
    <script>
    alert('Failed To Delete the user');
    </script>
    ";
    header("Refresh: 0.5; url=index.php?page={$page}");
}
