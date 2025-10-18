<?php
//declartion


//one Dimentional array
$single_arr = ["aniket", 12, true];

echo "<b>Original Array:</b><pre>";
print_r($single_arr);
echo "Indexing a single dimentional array[0]:" . $single_arr[0];
echo "<br>";
echo "<br>";

//Multi-Dimentional array
$multidimension_array = array(
    array("aniket", 12, false),
    array("Ajay", 23, true, 500.90)
);
echo "<b>Original 2D Array:</b><pre>";
print_r($multidimension_array);
echo "Indexing a Multi-dimentional Array[0][2]" . $multidimension_array[0][2];
echo "<br>";
echo "<br>";

//Associative array
$associative_array = ["name" => "Aniket Singh", "age" => 20, "Income" => 20000];
echo "<b>Original Associative Array:</b><pre>";
print_r($associative_array);
echo "Indexing a Associative array['name']:" . $associative_array["name"];
echo "<br>";
echo "<br>";


//Array Function
echo "Count of elements in the multidimentional Array:" . count($multidimension_array) . "<BR>";
echo "<br>";

//Inserting Elemets at the end
$arr1 = ["aniket", "rahul", "ajay"];
array_push($arr1, "Anuj", "Lalit");
echo "2 extra elements added to the original array at the end:";
echo "<br>";
print_r($arr1);
echo "<br>";

//Inserting Elemets in between
array_splice($arr1, 2, 0, "Hemlalait");
echo "One extra elements added in between the 2nd position of the original array :";
echo "<br>";
print_r($arr1);

//retreating a section of array:
echo "Temporary extracting 2 elements from the 2nd position:";
echo "<br>";
print_r(array_slice($arr1, 2, 2, true));

echo "Permanent extracting 2 elements from the 2nd position:";
echo "<br>";
print_r(array_splice($arr1, 2, 2));
echo "<br>Array After extraction<br>";
print_r($arr1);

//Array Merge
$arr1 = ["aniket", "rahul", "Ajay"];
$arr2 = [20, 30, 40];
$merged_array = array_merge($arr1, $arr2);
echo "<br>Original array1:<br>";
print_r($arr1);
echo "<br>Original array2:<br>";
print_r($arr2);
echo "<br>Merged array:<br>";
print_r($merged_array);


//deleting array elements
array_pop($merged_array);
echo "<br> Delete's the Last element of the array:<br>";
print_r($merged_array);

array_splice($merged_array, 2, 1);
echo "<br>Deletes the 2nd index element from the array:<br>";
print_r($merged_array);

unset($merged_array[2]);
echo "<br>Deletes the 2nd index element from the array without affecting the indexing:<br>";
print_r($merged_array);
echo "<br>Re-Indexing affecting indexing in order:<br>";
$merged_array = array_values($merged_array);
print_r($merged_array);

// Checking wheather the specified value exits in an array
$single_arr = ["aniket", 12, true];
echo "<br>  <b>Original Array:</b><pre>";
print_r($single_arr);
echo "Value 12 Exist:" . in_array(12, $single_arr, true);

$associative_array = ["name" => "Aniket Singh", "age" => 20, "Income" => 20000];
echo "<br><b>Original Associative Array:</b><pre>";
print_r($associative_array);
echo "<br>Chcek wheather key 'name' exist:" . array_key_exists("name", $associative_array);

//display all the keys and value of an array
echo "<br><BR><b>All the Keys Of THE Array:</b><pre>";
print_r(array_keys($associative_array));

echo "<br><b>All the VALUES Of THE Array:</b><pre>";
print_r(array_values($associative_array));



//COUNTING THE REPEATED ELEMENTS
$array1 = ["aniket", "aniket", 12, 13];
print_r(array_count_values($array1));


//Sorting
echo "<br>  <b>Original Array:</b><br>";
print_r($array1);
sort($array1);
echo "<br> Sorted array:<br>";
print_r($array1);



$associative_array = ["name" => "Aniket Singh", "age" => 20, "Income" => 20000];
echo "<br><b>Original Associative Array:</b><pre>";
print_r($associative_array);

asort($associative_array);
echo "<br> Sorted Associative array using values:<br>";
print_r($associative_array);

ksort($associative_array);
echo "<br> Sorted Associative array using keys:<br>";
print_r($associative_array);
