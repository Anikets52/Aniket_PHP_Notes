<?php
echo "Prime Checker\n";


function primeAll($no)
{
    $count = 1;

    for ($j = 2; $no >= $count; $j++) {
        $flag = false;

        for ($i = 2; $i < $j; $i++) {
            if ($j % $i == 0) {
                $flag = true;
                break;
            }
        }
        if (!$flag) {
            echo $count . " Prime Number is " . $j . "\n";
            $count++;
        }
    }
}

function checker($number)
{
    if ($number <= 1) {
        echo $number . " is Not a Prime Number.\n";
        return;
    }
    for ($i = 2; $i < $number; $i++) {
        if ($number % $i == 0) {
            echo $number . " is Not a Prime Number.\n";
            return;
        }
    }
    echo $number . " is a Prime Number.\n";
    return;
}
// echo "Enter The Number:";
// $input=trim(fgets(STDIN));

// if(checker($input)){
//  echo "Number Is a Prime Number";
// }else{
//     echo "Number Is Not a Prime Number";
// }


echo "1:Checking Wheather the Number is Prime:\n";
echo "2:Enter The Number of Prime to be displayed:\n";

$input = trim(fgets(STDIN));

switch ($input) {
    case 1:
        echo "Enter The Number to be checked:";
        $no = trim(fgets(STDIN));
        checker($no);
        break;
    case 2:
        echo "Enter The Numbers of PrimeNumber to be Displayed:";
        $no = trim(fgets(STDIN));
        primeAll($no);
        break;
    default:
        echo "Invalid Option selected";
}
