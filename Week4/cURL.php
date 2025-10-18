<?php
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://www.amazon.in/s?k=Laptops");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64)");

$response = curl_exec($ch);
// echo $response;

curl_close($ch);

preg_match_all(
    '!https://m\.media-amazon\.com/images/I/[^\s"]+\.(jpg|png|webp)!',
    $response,
    $data
);
$finalarr = array_values(array_unique($data[0]));

echo "<pre>";
// print_r($finalarr);

foreach ($finalarr as $key => $name) {
    echo "
    <div style='float:left;margin:10 0 0 0;'>
    <img src='{$name}'/><br>
    </div>

";
    // echo $name . "<br>";
}



// 4. Download one image and save as image.jpg
$path = "https://m.media-amazon.com/images/I/51Q8DUDT2eL._AC_SX296_SY426_FMwebp_QL65_.jpg";
$img  = fopen("image.jpg", "w+");

$curl = curl_init($path);
curl_setopt($curl, CURLOPT_FILE, $img);
// curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
curl_exec($curl);

curl_close($curl);
fclose($img);

echo "<br>✅ Image downloaded as image.jpg";
