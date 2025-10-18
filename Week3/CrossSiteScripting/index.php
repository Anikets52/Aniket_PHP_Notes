<?php

// declare(strict_types=1);

namespace App\Security;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $comment = $_POST['comment'] ?? '';

    $sanatizedComment = htmlspecialchars($comment, ENT_QUOTES, 'UTF-8');
    echo "Your comment: { $sanatizedComment}";

    // <script>alert('XSS');</script>
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>XSS Prevention</title>

    <meta http-equiv="Content-Security-Policy" content="script-src 'self'">
</head>

<body>
    <form method="post">
        <label for="comment">Comment:</label>
        <textarea name="comment" id="comment"></textarea>
        <input type="submit" value="Submit">
    </form>
</body>

</html>