<?php

//database connection
$dbHost = 'localhost';
$dbUser ='root';
$dbPass = 'root'; // need for apple mac (this remain empty on windows)
$dbName = 'coupons';
$link = @mysqli_connect($dbHost,$dbUser, $dbPass, $dbName) or die('hiba az adatbázis kapcsolatban! Keresse a rendszer
üzemeltetőjét: ['.mysqli_connect_error().']');

mysqli_set_charset($link, "utf-8");