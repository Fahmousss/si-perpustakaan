<?php
date_default_timezone_set('Asia/Jakarta');

$conn = mysqli_connect("localhost", "root", "", "si_perpustakaan");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}