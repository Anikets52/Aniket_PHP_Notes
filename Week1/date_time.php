<?php

//setting the tize zone to india
date_default_timezone_set("Asia/Kolkata");

echo "Date Time Script:<br>";
echo "<br><b>";
$today = date("l, jS F, Y: g:ia");
echo $today;

$today_time = time();
echo "<br>Todays Time In Unix Since 1 jan,1970 :" . $today_time;

//Date Object
$date = new DateTime();
echo "<br><br>Date Object value:" . $date->format("l, jS F, Y: g:ia");
$date->setTimezone(new DateTimeZone("Asia/Kolkata"));
echo "<br><br>Date Object value Time Zone Changed: " . $date->format("l, jS F, Y: g:ia");
$date->modify("+1 day");
echo "<br>Added One More Day To Today: " . $date->format("l, jS F, Y: g:ia");

echo "<br>String to Time Convesion:" . strtotime("next saturday");
