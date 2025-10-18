<?php
// SESSION LIFESCYCLE
// session_start();
// session_unset();
// session_destroy();
// setcookie(session_name(), '', time() - 3600); // Delete session cookie


//Session security (regenerate id, cookie flags)

ini_set('session.gc_maxlifetime', 1800); // session data lifetime set to 15min
ini_set('session.cookie_lifetime', 1800); // Client-side cookie lifetime

//  security settings
ini_set('session.use_only_cookies', 1);
ini_set('session.use_strict_mode', 1);
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_secure', 1); // Requires HTTPS
ini_set('session.cookie_samesite', 'Strict');


//Cookie Flag
session_set_cookie_params([
    'lifetime' => 1800,
    'domain' => 'localhost',
    'path' => '/',
    'secure' => true,
    'httponly' => true,
    'samesite' => 'Strict'
]);


// Start the session
session_start();
echo "<BR>Session_id:" . session_id();
// echo "<br>".$_SERVER['HTTP_USER_AGENT'];

$idleTime = 60 * 3;

//  timeout check
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $idleTime)) {
    session_unset();
    session_destroy();
    echo "
    <script>
    alert('Session expired!!');
    </script>
    ";
    exit;
}

// Update activity time
$_SESSION['last_activity'] = time();

// Regenerate session ID every 3 minutes
if (!isset($_SESSION['last_regeneration']) || (time() - $_SESSION['last_regeneration'] > 180)) {
    session_regenerate_id(true);
    $_SESSION['last_regeneration'] = time();
}
