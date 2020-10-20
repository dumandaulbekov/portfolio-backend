<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'portfolio');

// PROD 
// define('DB_HOST', 'srv-pleskdb26.ps.kz:3306');
// define('DB_NAME', 'sunwerkz_wp_1lpxs');
// define('DB_USER', 'sunwerkz_sunwe_wp_91iev');
// define('DB_PASS', 'PerfecT123!@#');

function connect() {
    $connect = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if (mysqli_connect_errno($connect)) {
        die("Failed to connect" . mysqli_connect_error());
    }

    mysqli_set_charset($connect, "utf8");

    return $connect;
}
