<?php
echo "<h4>String Utilities Operations</h4>";

//Explode String using an Delimiter
$str1 = "Hello MY self aniket";
echo "Original String: <b>".$str1."</b><br>";
echo "Creating Array of string using a Delimiter: <br>";
print_r(explode(" ", $str1));


echo "<br><br>";
$str1 = "Hello MY self aniket";
echo "Original String: <b>".$str1."</b><br>";
echo "TO UpperCase:<br><b>";
print_r(strtoupper($str1));
echo "<br></b>";
echo "TO LowerCase:<br><b>";
print_r(strtolower($str1));


echo "</b><br><br>";
echo "Original String: <b>".$str1."</b><br>";
echo "Reversing the String:<b>";
print_r(strrev($str1));
echo "</b><br>";
echo "<br>";

echo "String Repeat Function For String <br>";
$str="HelloBoss";
echo "String: <b>".$str."</b><br>";
echo str_repeat($str, 4);
echo "<br>";

echo "<br><br>";
echo "Original String: <b>".$str1."</b><br>";
echo "Replaced aniket with Ajay <br><b>".str_replace("aniket", "Ajay",$str1)."</b><br>";

echo "<br><br>";
$str2="AniketSingh";
echo "Original String: <b>".$str2."</b><br>";
echo "Spliting the string into an array of 2 character each<br> ";
print_r(str_split($str2, 2));
echo "<br>";

echo "<br><br>";
$str3="hello world";
echo "Original String: <b>".$str3."</b><br>";
echo "Counting the number of words in The sentence: ";
print_r(str_word_count($str3));

