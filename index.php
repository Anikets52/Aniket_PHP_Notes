<?php
// --- REST API in vanilla PHP ---

header("Content-Type: application/json");

//API KEY
// $headers = getallheaders();
// echo json_encode((int)$_SERVER['HTTP_X_API_KEY']);
// echo "\n" . json_encode((int)$headers['X-API-KEY']);


$tasks = [
    1 => ["id" => 1, "title" => "Learn PHP", "done" => false],
    2 => ["id" => 2, "title" => "Build REST API", "done" => false],
];


$uri = $_SERVER["REQUEST_URI"];
echo "\n" . json_encode($uri) . "\n";
$method = $_SERVER["REQUEST_METHOD"];

// Extract resource and ID if present
$parts = explode("/", trim(parse_url($uri, PHP_URL_PATH), "/"));
$resource = $parts[0] ?? null;
$id = $parts[1] ?? null;

if ($resource !== "tasks") {
    http_response_code(404);
    echo json_encode(["error" => "Resource not found"]);
    exit;
}

// --- Handle requests ---
switch ($method) {
    case "GET":
        if ($id) {
            if (isset($tasks[$id])) {
                echo json_encode($tasks[$id]);
            } else {
                http_response_code(404);
                echo json_encode(["error" => "Task not found"]);
            }
        } else {
            echo json_encode(array_values($tasks), JSON_PRETTY_PRINT);
        }
        break;

    case "POST":
        $data = json_decode(file_get_contents("php://input"), true);
        if (!$data || !isset($data["title"])) {
            http_response_code(400);
            echo json_encode(["error" => "Invalid input"]);
            break;
        }
        $newId = max(array_keys($tasks)) + 1;
        $task = ["id" => $newId, "title" => $data["title"], "done" => false];
        $tasks[$newId] = $task;
        http_response_code(201);
        echo json_encode($task);
        break;

    case "PUT":
        if (!$id || !isset($tasks[$id])) {
            http_response_code(404);
            echo json_encode(["error" => "Task not found"]);
            break;
        }
        $data = json_decode(file_get_contents("php://input"), true);
        if (!$data) {
            http_response_code(400);
            echo json_encode(["error" => "Invalid input"]);
            break;
        }
        $tasks[$id] = array_merge($tasks[$id], $data);
        echo json_encode($tasks[$id]);
        break;

    case "DELETE":
        if (!$id || !isset($tasks[$id])) {
            http_response_code(404);
            echo json_encode(["error" => "Task not found"]);
            break;
        }
        unset($tasks[$id]);
        http_response_code(204); // No Content
        break;

    default:
        http_response_code(405);
        echo json_encode(["error" => "Method not allowed"]);
}
