<?php
header("content-security-policy : default-src 'self'; script-src 'self' trusted.cdn.com");
try {
    $DSN = "mysql:host=localhost;dbname=test";
    $pdo = new PDO($DSN, "root", "", [PDO::ATTR_ERRMODE  => PDO::ERRMODE_EXCEPTION]);
    echo "CONNECTED";

    $pdo->beginTransaction();
    $stmt = $pdo->prepare("UPDATE users SET `math`= 600 WHERE id = :id");
    $stmt->bindValue(':id', 3, PDO::PARAM_INT);
    if ($stmt->execute()) {
        echo "Updated";
    }
    $pdo->commit();
    if ($pdo->rollBack()) {
        echo "rolled back";
    }
} catch (PDOException $E) {
    echo "Connection error";
}
