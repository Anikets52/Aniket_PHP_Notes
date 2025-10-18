<?php

//Variables Declartion
$var1="String";
$int1=(int)90;
$bol1=true;
var_dump($int1);
$flot=12.12;
var_dump($flot);

//Array Declaration
$arr=["aniket",12,true,300.90];
print_r($arr);
$arr2=array("aniket",12);
var_dump($arr2);

//constant Declaration
const ABC = 12;
var_dump(ABC);

// if(true){
// const BCG=12;
//Displayes a error
// }

if(true){
define("BCG",12);
echo "DEFINE CAN BE USED TO DEFINE A CONSTANT IN ANY CODE BLOCK".BCG;
}


?>


