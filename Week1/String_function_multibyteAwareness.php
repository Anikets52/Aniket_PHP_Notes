<?php
// String Function and Multi-byte Awareness:

//finding the length of the string
$str="HELLO My Self Aniket";
echo "Original string:".$str."<br>";
echo "<br>String Size:".strlen($str)."<br>";

//To Upper and ToLower Case Convertion
echo "<br>ToUpperCase Convertion:".strtoupper($str);
echo "<br>ToLowerCase Convertion:".strtolower($str);

//Replacing a part of the string
echo "<br>Replacing Aniket With Ajay Text: ".str_replace("Aniket","Ajay",$str);

echo "<br>Replacing a Part of the string using its index: ";
echo substr_replace($str,"Hiii",0,5);


//extracting a part of the string 
echo  "<br>Extrating Characters from 6th index till the last: ".substr($str,6,strlen($str)-6);


//Deleting WhiteSpaces and Characters From the start and end
echo "<BR><BR>Triming HELLO from the start: ".trim($str,"HELLO");

$string = "aniket singh";
$start = 4;
$length = 4;

echo "<br>Original string:".$string."<br>";

$chars = str_split($string); // Convert to array of characters
array_splice($chars, $start, $length); // Remove section
$result = implode("", $chars); // Join back to string

echo "<br>Removing elements starting from the 4th index till 8th index: ".$result;


//Spliting string into  array using a delimiter
$arr=explode(" ",$str);
echo "<br> exploding the string into a array of characters using a delimiter ' ' : <br>";
print_r($arr);

//Find the Position of a character from a string
echo "<br>[Case-Sensitive] The First Occurance of 'e' in the string is: ".strpos($str,"e");
echo "<br>[Case In-Sensitive] The First Occurance of 'e' in the string is: ".stripos($str,"e");
echo "<br>[Case Sensitive] The Last Occurance of 'e' in the string is: ".strrpos($str,"e");


//Multi-Byte Awareness
echo "<br><h4>Multi-Byte Awareness</h4>";
$text = "こんにちは"; // Japanese for "Hello"
echo "Normal Byte Size of ".$text." is : ".strlen($text);
echo "<br>UTF-8 Multi-Byte Size of ".$text." is : ".mb_strlen($text, "UTF-8"); 


$text="HÉLLÔ";
echo "<br><br>Original Non Laten string:".$text;
echo "<br>ToLowerCase Byte Convertion: ".strtolower($text);
echo "<br>ToLowerCase Multi-Byte Convertion: ".mb_strtolower($text, "UTF-8");

echo "<br>Extracting string From index 0 to 3: ".mb_substr($text,0,3, "UTF-8");


?>