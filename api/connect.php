<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

function connect() {
    $db_host = 'localhost';
    $db_name = 'portfolio';
    $db_user = 'root';
    $db_pass = '';

    // $db_host = 'srv-pleskdb26.ps.kz:3306';
    // $db_name = 'sunwerkz_wp_1lpxs';
    // $db_user = 'sunwerkz_sunwe_wp_91iev';
    // $db_pass = 'PerfecT123!@#';

    $dsn = "mysql:host=$db_host; dbname=$db_name";
    $opt = [
        PDO::ATTR_ERRMODE               => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE    => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES      => false,
    ];

    return new PDO($dsn, $db_user, $db_pass, $opt);
}
