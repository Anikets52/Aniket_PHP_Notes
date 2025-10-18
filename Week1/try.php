<?php

echo "Enter the 1st Number:";
$input1 = trim(fgets(STDIN));
echo "Enter the 2nd Number:";
$input2 = trim(fgets(STDIN));
echo "Enter The Operation:(+ - / % )";
$operation = trim(fgets(STDIN));
switch ($operation) {
    case "+":
        echo "Answer: " . $input1 + $input2;
        break;
    case "-":
        echo "Answer: " . $input1 - $input2;
        break;
    case "/":
        echo "Answer: " . $input1 / $input2;
        break;
    case "%":
        echo "Answer: " . $input1 % $input2;
        break;
    default:
        echo "Invalid Operator Entered";
}

class Aniket
{
    public static int $a = 10;

    public static function add()
    {
        echo self::$a;
    }
}

Aniket::add(); // Outputs: 10