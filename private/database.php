<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$db_name = "accounting";

$db = mysqli_connect('localhost', 'root', '', $db_name);

if (!$db) {
    die("Connection failed: ". mysqli_connect_error());
}

?>
