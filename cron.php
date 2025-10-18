<?php
date_default_timezone_set("Asia/Kolkata");
try {
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=ajax;charset=utf8mb4", "root", "");
    } catch (PDOException $e) {
        error_log(
            "\n PDO::Exception Connection failed on : " . date("l dS M Y h:i:s")
                . " error : " . $e->getMessage() . " code: " . $e->getCode(),
            3,
            __DIR__ . "/errors.log"
        );
    }

    $smt = $pdo->prepare("INSERT INTO user(`username`,`password`) VALUES('ABC','112121212')");
    if ($smt->execute()) {
        $id = $pdo->lastInsertId() ?? null;
        // echo "Inserted";
        error_log("\n Attempted Insert SuccessFull at index: $id at: " . date("l dS M Y h:i:s"), 3, __DIR__ . "/errors.log");
    } else {
        error_log(
            "\n Attempted Insert Failed at: " . date("l dS M Y h:i:s")
                . "error" . $smt->errorInfo(),
            3,
            __DIR__ . "/errors.log"
        );
    }
} catch (PDOException $e) {
    error_log(
        "\n PDO::Exception on : " . date("l dS M Y h:i:s")
            . " error : " . $e->getMessage() . " code: " . $e->getCode(),
        3,
        __DIR__ . "/errors.log"
    );
}
