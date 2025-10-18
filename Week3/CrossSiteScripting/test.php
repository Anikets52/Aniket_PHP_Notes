<?php
// $start = microtime(true);
// $hash = password_hash("test", PASSWORD_BCRYPT, ['cost' => 12]);
// $time = microtime(true) - $start;
// echo "Hashing took $time seconds";
// echo "<br>";
// print_r(strlen($hash));

$password = "user_password123";
$start = microtime(true);
$hash = password_hash($password, PASSWORD_ARGON2ID, [
    'memory_cost' => 65536, // 64MB (in kibibytes)
    'time_cost' => 4,       // Number of iterations
    'threads' => 2          // Parallelism factor
]);
$time = microtime(true) - $start;
echo "Hashing took $time seconds";
echo "<br>" . strlen($hash);
