<?php
$ch = curl_init("https://www.amazon.in/s?k=Laptops");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64)");

$html = curl_exec($ch);
curl_close($ch);
// echo $html;


$dom = new DOMDocument();
libxml_use_internal_errors(true); // prevent HTML warnings
$dom->loadHTML($html);
$xpath = new DOMXPath($dom);
// Get all product titles
$titles = $xpath->query('//span[@class="a-size-medium a-color-base a-text-normal"]');

// Get all whole prices
$prices_whole = $xpath->query('//span[@class="a-price-whole"]');

// Get all fractional prices
$prices_fraction = $xpath->query('//span[@class="a-price-fraction"]');

// Combine title + price
for ($i = 0; $i < $titles->length; $i++) {
    $title = $titles->item($i)->nodeValue ?? "N/A";
    $whole = $prices_whole->item($i)->nodeValue ?? "N/A";
    $fraction = $prices_fraction->item($i)->nodeValue ?? "00";

    $price = $whole . "." . $fraction;

    echo "<b>$title</b> - ₹$price <br><br>";
}
