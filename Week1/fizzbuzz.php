<?php


function fizzbuzzchecker($number){
    if($number%15==0){
        echo $number."is a FizzBuzz";
    }
    elseif($number%3==0){
        echo $number."is a Fizz";
    }elseif($number%5==0){
        echo $number."is a Buzz";
    }else{
        echo "Neither a fizz Nor a Buzz!!!!";
    }
}

function fizzbuzzall($number){
    for($i=1;$i<=$number;$i++){
            if($i%15==0){
                echo $i."is a FizzBuzz\n";
            }
            elseif($i%3==0){
                echo $i."is a Fizz\n";
            }elseif($i%5==0){
                echo $i."is a Buzz\n";
            }
    }
   
}


echo "1:Checking Wheather a Number is a Fizzbuzz:\n";
echo "2:Get Fizzbuzz for Number specified:";

$input=trim(fgets(STDIN));

switch($input){
 case 1:echo "Enter The Number to be checked:";$no=trim(fgets(STDIN));fizzbuzzchecker($no);break;
 case 2: echo "Enter The Numbers of Fizzbuzz to check:";$no=trim(fgets(STDIN));fizzbuzzall($no);break;
 default: echo "Invalid Option selected";
}



?>