<?php
//COOKIEES

//setting a cookie
setcookie('mode', 'dark', time() + 300, "/", "localhost", true, true);

//Accessing
echo $_COOKIE['mode'];


//deleting
setcookie('mode', '', time() - 3600, "/", "localhost", true, true);
