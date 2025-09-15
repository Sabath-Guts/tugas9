<?php
$host = "localhost";
$user = "xirpl1-5";
$pass = "0089644869";
$db   = "db_xirpl1-5_1";

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>

