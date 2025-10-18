<?php
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    header('Content-Type: application/json');

    if (isset($_POST['action'], $_POST['id'], $_POST['name'], $_POST['email'], $_POST['phone'])) {

        try {
            $pdo = new PDO("mysql:host=localhost;dbname=test", "root", "", [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);
        } catch (PDOException $e) {
            echo json_encode(["flag" => "error", "message" => "Connection Failed"]);
            exit;
        }

        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $id = $_POST['id'];

        if ($_POST['action'] == "ADD") {
            $stmt = $pdo->prepare("INSERT INTO contacts(id,name,email,phone) VALUES(?,?,?,?)");
            if ($stmt->execute([$id, $name, $email, $phone])) {
                echo json_encode(["flag" => "success", "message" => "Inserted Successfully"]);
            } else {
                echo json_encode(["flag" => "error", "message" => "Failed To Insert the Record"]);
            }
        } elseif ($_POST['action'] == "UPDATE") {
            $stmt = $pdo->prepare("UPDATE contacts SET name= ?, email= ?, phone = ? WHERE id= ?");
            if ($stmt->execute([$name, $email, $phone, $id])) {
                echo json_encode(["flag" => "success", "message" => "Updated Successfully"]);
            } else {
                echo json_encode(["flag" => "error", "message" => "Failed To Update the Record"]);
            }
        } elseif ($_POST['action'] == "DELETE") {
            $stmt = $pdo->prepare("DELETE FROM contacts WHERE id= ?");
            if ($stmt->execute([$id])) {
                echo json_encode(["flag" => "success", "message" => "Deleted Successfully"]);
            } else {
                echo json_encode(["flag" => "error", "message" => "Deletion Failed"]);
            }
        }
    } else {
        echo json_encode(["flag" => "error", "message" => "Incomplete Request"]);
    }
} else {
    echo json_encode(["flag" => "error", "message" => "Invalid Request"]);
}
