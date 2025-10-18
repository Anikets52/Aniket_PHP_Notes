<?php
$page = 2;
$limit = 10;
$total = 100;
$pages = 10;
$js0ndata = [
    "Pagination" => [
        "page" => $page,
        "limit" => $limit,
        "total" => $total,
        "pages" => $pages
    ]
];

echo json_encode($js0ndata, JSON_PRETTY_PRINT);
