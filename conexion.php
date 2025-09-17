<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$host     = "db4free.net";
$username = "fortis";
$password = "S0P0RT3*-";
$database = "festival_flores_";

$koneksi = mysqli_connect($host, $username, $password, $database);

if (!$koneksi) {
    die("Error de conexión: " . mysqli_connect_error());
}


?>
