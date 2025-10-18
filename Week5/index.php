<?php
echo "Method: " . $_SERVER['REQUEST_METHOD'] . "<br>\n";


$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$ok = explode("/", trim($uri, "/"));
print_r($ok);

$method = $_SERVER['REQUEST_METHOD'];
echo "<br>\nFiltered URI: \n";
print_r($uri);
echo "<br>\n";
if ($method === 'POST') {
    // print_r($_POST["name"]);
    $ok = file_get_contents("php://input");
    parse_str($ok, $ok1);
    print_r($ok1);
}
if ($uri === '/Week5/users' && $method === 'GET') {
    echo "List all users<br>";
} elseif ($uri === '/users' && $method === 'POST') {
    echo "Create new user<br>";
} elseif (preg_match("#^/Week5/users/(\d+)$#", $uri, $matches) && $method === 'GET') {
    // $id = $matches[1];
    $id = array_shift($matches);
    // print_r($matches);
    echo "Show user with ID $id<br>";
} else {
    http_response_code(404);
    echo "404 Not Found<br>";
}


$data = ["url" => "https://example.com", "text" => "नमस्ते"];

$en = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
echo $en;
print_r(json_decode($en, true));
