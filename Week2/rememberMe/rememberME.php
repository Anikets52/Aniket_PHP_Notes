<?php
include("connect.php");
session_start();
// echo $_SESSION['user_id'];
if (isset($_SESSION['user_id'])) {
    echo "
                    <script>
                    alert('Already Logged In');
                    </script>
                    ";
    header('Refresh: 0.5; url=TRY1.php');
}
// unset($_SESSION['user_id']);
if (isset($_COOKIE['remeberMe']) && !isset($_SESSION['user_id'])) {

    list($userId, $token) = explode(':', $_COOKIE['remeberMe']);

    $sql = "SELECT * FROM logintoken WHERE `token`= ? ORDER BY `expiration` DESC;";
    $smt = $conn->prepare($sql);
    $smt->bind_param(
        "s",
        $token
    );
    if ($smt->execute()) {
        $result = $smt->get_result();
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $expiration = $row['expiration'];
            if ($expiration > time()) {

                echo "
                    <script>
                    alert('Already Logged in..');
                    </script>
                    ";
                $_SESSION['user_id'] = $userId;
                header('Refresh: 0.5; url=TRY1.php');
            } else {
                echo "
                    <script>
                    alert('Cookie Expired ;/');
                    </script>
                    ";
                setcookie("remeberMe", "", time() - 3200, "/");

                $sql2 = "DELETE FROM logintoken WHERE `user_id`= ? ;";
                $smt2 = $conn->prepare($sql2);
                $smt2->bind_param(
                    "i",
                    $userId
                );
                $smt2->execute();
            }
        } else {
            echo "
                    <script>
                    alert('No record Found!!');
                    </script>
                    ";
            setcookie("remeberMe", "", time() - 3200, "/");
        }
    } else {
        echo "Sql Execution Failed!!";
        exit;
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Header -->
    <meta charSet="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="My Express JS website">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body class="bg-gray-100 h-screen flex items-center justify-center">
    <!-- component -->
    <div class="h-screen bg-gradient-to-br from-blue-600 to-cyan-300 flex justify-center items-center w-full">

        <form method='POST' action='<?php $_PHP_SELF ?>' method="POST">
            <div class="bg-white px-10 py-8 rounded-xl w-screen shadow-xl max-w-sm">
                <div class="space-y-4">
                    <h1 class="text-center text-2xl font-semibold text-gray-600">Login</h1>
                    <hr>
                    <div class="flex items-center border-2 py-2 px-3 rounded-md mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                        </svg>
                        <input class="pl-2 outline-none border-none w-full" type="email" name="email" value="" placeholder="Email" required />

                    </div>
                    <div class="flex items-center border-2 py-2 px-3 rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                        </svg>
                        <input class="pl-2 outline-none border-none w-full" type="password" name="password" id="" placeholder="Password" required />

                    </div>
                </div>
                <!-- Remember Me checkbox -->
                <div class="flex justify-center items-center mt-4">
                    <p class="inline-flex items-center text-gray-700 font-medium text-xs text-center">
                        <input type="checkbox" id="rememberMeCheckbox" name="rememberMe" class="mr-2">
                        <span class="text-xs font-semibold">Remember me?</span>
                    </p>
                </div>

                <input type="submit" name="submit" value="login" id="login" class="mt-6 w-full shadow-xl bg-gradient-to-tr from-blue-600 to-red-400 hover:to-red-700 text-indigo-100 py-2 rounded-md text-lg tracking-wide transition duration-1000" />
                <hr>
            </div>

        </form>
    </div>
</body>
<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['submit'])) {

        // print_r($_SERVER);
        $password = $_POST['password'];
        $password = htmlspecialchars(trim($password), ENT_QUOTES, "UTF-8");
        $email = $_POST['email'];
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // echo "Valid email: $email";
        } else {
            die("Invalid email.");
        }


        function verify($email, $password, $conn)
        {

            $sql = "SELECT * FROM user WHERE email= ? AND password= ? ;";
            $smt = $conn->prepare($sql);
            $smt->bind_param(
                "ss",
                $email,
                $password
            );
            if ($smt->execute()) {
                $result = $smt->get_result();
                if ($result->num_rows == 1) {
                    $row = $result->fetch_assoc();
                    return $row['user_id'];
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }


        if ($UserId = verify($email, $password, $conn)) {

            if (isset($_POST['rememberMe'])) {
                $token = bin2hex(random_bytes(32));
                $expires = time() + (60 * 1);
                $email64 = base64_encode($email);
                setcookie("remeberMe", "$email64:$token", $expires, "/", "", true, true);
                // echo "cookies:".$_COOKIE['remeberMe'];

                $sql = "INSERT INTO `logintoken` (`user_id`,`token`, `expiration`) VALUES (?, ?, ?);";
                $smt = $conn->prepare($sql);
                $smt->bind_param(
                    "isi",
                    $UserId,
                    $token,
                    $expires
                );

                if ($smt->execute()) {
                    echo "
                    <script>
                    alert('SuccessFully Logged In Rm');
                    </script>
                    ";
                    $_SESSION['user_id'] = $UserId;
                    header('Refresh: 0.5; url=TRY1.php');
                } else {
                    echo "Token Insertion Failed";
                }
            } else {
                echo "
                    <script>
                    alert('SuccessFully Logged In Rm');
                    </script>
                    ";
                $_SESSION['user_id'] = $UserId;
                header('Refresh: 0.5; url=TRY1.php');
            }
        } else {
            echo "
            <script>
            alert('Invalid Email and Password');
            </script>
            ";
        }
    }
}
?>

</html>