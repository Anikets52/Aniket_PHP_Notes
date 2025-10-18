<?php
error_reporting(0);
//FLASH
session_start();


function setFlash($key, $message)
{
    $_SESSION['flash'][$key] = $message;
}

function getFlash($key)
{
    $message = $_SESSION['flash'][$key];
    unset($_SESSION['flash'][$key]);
    return $message;
}

// Example: Set flash message and redirect
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    setFlash('success', 'Form submitted successfully!');
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}
// Display flash message
if ($message = getFlash('success')) {
    echo '<div style="color: green;">' . htmlspecialchars($message) . '</div>';
} else {
    echo '<div style="color: red;">Please Submit The Form !!!</div>';
}
?>
<form method="post">
    <input type="text" name="dummy" placeholder="Test input">
    <input type="submit" value="Submit">
</form>