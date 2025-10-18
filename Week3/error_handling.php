<?php

//Centralized Error Handler

// ini_set("display_errors", 0);
// ini_set('log_errors', 1);
// ini_set('error_log', 'log.txt');

set_error_handler(function ($errno, $errstr, $errfile, $errline) {
    if ($errno === E_WARNING) {
        error_log($errstr, 3, __DIR__ . "/errors.log");
        throw new Exception("File Not Found error: $errstr in $errfile on line $errline");
    }
    return false;
});

set_exception_handler(function (Throwable $e) {

    error_log($e); // log details
    // http_response_code(500);
    // echo "Something went wrong. Please try again later.";

    $status = 500;
    $message = "Something went wrong";

    if ($e instanceof ValidException) {
        $status = 400;
        $message = $e->getMessage();
    }
    http_response_code($status);
    echo json_encode([
        "error" => $message
    ]);
});


//Custom error handler
class ValidException extends Exception
{
    private array $error;
    public function __construct($message, array $error, $code = 0, $prev = null)
    {
        parent::__construct($message, $code, $prev);
        $this->error = $error;
    }
    public function showError()
    {
        print_r($this->error);
    }
}

function Validate($arr)
{
    $error = [];
    if (empty($arr['name'])) {
        $error[] = "NAME IS REQUIRED!!";
    }
    if (!filter_var($arr['email'], FILTER_VALIDATE_EMAIL)) {
        $error[] = "Email Format invalid!!";
    }
    if (!empty($error)) {
        throw new ValidException("Invalid Detail", $error);
    }
}


try {

    // echo $ani[2];
    // include "ok.php";
    // $a = 10 / 0;
    Validate(["name" => 'aniket', "email" => 'ajay']);
    // Validate(["name" => 'aniket', "email" => 'ajay']);
} catch (ValidException $e) {
    echo "ValidException caught:<br>";
    $e->getMessage();
    $e->showError();
} catch (Exception $e) {
    echo "<br>Errors: " . $e->getMessage();
} finally {
    echo "<br>Clean-up Executed";
}
