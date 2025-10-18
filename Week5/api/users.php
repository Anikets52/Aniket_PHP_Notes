<?php

declare(strict_types=1);

namespace App\Api;

use PDO;
use PDOException;
use JsonException;

try {
    $pdo = new PDO('mysql:host=localhost;dbname=ecommerce_db;charset=utf8mb4', 'root', '', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);

    header('Content-Type: application/json; charset=UTF-8');

    $method = $_SERVER['REQUEST_METHOD'];
    $id = isset($_GET['id']) ? (int)$_GET['id'] : null;
    $input = json_decode(file_get_contents('php://input'), true, 512, JSON_THROW_ON_ERROR);

    switch ($method) {
        case 'GET':
            if ($id) {
                $stmt = $pdo->prepare('SELECT id, name, email FROM users WHERE id = :id');
                $stmt->execute(['id' => $id]);
                $user = $stmt->fetch();
                if ($user) {
                    http_response_code(200);
                    echo json_encode($user, JSON_THROW_ON_ERROR);
                } else {
                    http_response_code(404);
                    echo json_encode(['error' => 'User not found']);
                }
            } else {
                $stmt = $pdo->query('SELECT id, name, email FROM users');
                http_response_code(200);
                echo json_encode($stmt->fetchAll(), JSON_THROW_ON_ERROR);
            }
            break;

        case 'POST':
            if (!isset($input['name']) || !isset($input['email'])) {
                http_response_code(400);
                echo json_encode(['error' => 'Name and email required']);
                exit;
            }
            $stmt = $pdo->prepare('INSERT INTO users (name, email) VALUES (:name, :email)');
            $stmt->execute(['name' => $input['name'], 'email' => $input['email']]);
            http_response_code(201);
            echo json_encode(['id' => (int)$pdo->lastInsertId(), 'name' => $input['name'], 'email' => $input['email']]);
            break;

        case 'PUT':
            if (!$id || !isset($input['name']) || !isset($input['email'])) {
                http_response_code(400);
                echo json_encode(['error' => 'ID, name, and email required']);
                exit;
            }
            $stmt = $pdo->prepare('UPDATE users SET name = :name, email = :email WHERE id = :id');
            $stmt->execute(['name' => $input['name'], 'email' => $input['email'], 'id' => $id]);
            if ($stmt->rowCount()) {
                http_response_code(200);
                echo json_encode(['message' => 'User updated']);
            } else {
                http_response_code(404);
                echo json_encode(['error' => 'User not found']);
            }
            break;

        case 'DELETE':
            if (!$id) {
                http_response_code(400);
                echo json_encode(['error' => 'ID required']);
                exit;
            }
            $stmt = $pdo->prepare('DELETE FROM users WHERE id = :id');
            $stmt->execute(['id' => $id]);
            if ($stmt->rowCount()) {
                http_response_code(204);
            } else {
                http_response_code(404);
                echo json_encode(['error' => 'User not found']);
            }
            break;

        default:
            http_response_code(405);
            echo json_encode(['error' => 'Method not allowed']);
    }
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Database error']);
} catch (JsonException $e) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid JSON']);
}
