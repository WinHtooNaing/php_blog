<?php

//username 
define('MYSQL_USER','winhtoonaing');

//password
define('MYSQL_PASSWORD','root');

// hostname
define('MYSQL_HOST','localhost');

//database name
define('MYSQL_DATABASE','blog');

$pdoOptions = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
);

// CONNECTION CODE

$pdo = new PDO(
    'mysql:host=' .MYSQL_HOST.';dbname='.MYSQL_DATABASE,
    MYSQL_USER,MYSQL_PASSWORD,
    $pdoOptions
);




?>