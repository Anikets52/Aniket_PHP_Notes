<?php
// PHP code to demonstrate Bitwise Operator.

// Bitwise AND
$First = 6;
$second = 2;
$answer = $First & $second;

print_r("Bitwise & of 6 and 2 is $answer");

print_r("\n");

// Bitwise OR
$answer = $First | $second;
print_r("Bitwise | of 6 and 2 is $answer");

print_r("\n");

// Bitwise XOR
$answer = $First ^ $second;
print_r("Bitwise ^ of 6 and 2 is $answer");

print_r("\n");

// Bitwise NOT
$answer = ~$First;
print_r("Bitwise ~ of 6 is $answer");

print_r("\n");

// Bitwise Left shift
$second = 1;
$answer = $First << $second;
print_r("6 << 1 will be $answer");

print_r("\n");

// Bitwise Right shift
$answer = $First >> $second;
print_r("6 >> 1 will be $answer");

print_r("\n");
