<?php

$title = "Dashboard";
include("../include/header.php");
$result = $conn->query("SELECT COUNT(*) AS total FROM user");
$row = $result->fetch_assoc();
$totalUsers = $row['total'];

// Query to get total of pemustaka
$result = $conn->query("SELECT COUNT(*) AS total FROM pustakawan");
$row = $result->fetch_assoc();
$totalPemustaka = $row['total'];

// Query to get total of buku
$result = $conn->query("SELECT COUNT(*) AS total FROM buku");
$row = $result->fetch_assoc();
$totalBuku = $row['total'];

// Query to get total of peminjaman
$result = $conn->query("SELECT COUNT(*) AS total FROM peminjaman");
$row = $result->fetch_assoc();
$totalPeminjaman = $row['total'];

?>
<div class="container-fluid px-4">
   <h1 class="mt-4">Dashboard</h1>
   <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item active">Dashboard</li>
   </ol>
   <div class="row">
      <div class="col-xl-3 col-md-6">
         <div class="card bg-primary text-white mb-4">
            <div class="card-body">
               <i class="fas fa-users"></i>
               Total Pemustaka: <?= $totalPemustaka ?>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
               <a class="small text-white stretched-link" href="#">View Details</a>
               <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
         </div>
      </div>
      <div class="col-xl-3 col-md-6">
         <div class="card bg-warning text-white mb-4">
            <div class="card-body">
               <i class="fas fa-book"></i>
               Total Buku: <?= $totalBuku ?>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
               <a class="small text-white stretched-link" href="#">View Details</a>
               <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
         </div>
      </div>
      <div class="col-xl-3 col-md-6">
         <div class="card bg-success text-white mb-4">
            <div class="card-body">
               <i class="fas fa-book-reader"></i>
               Total Peminjaman: <?= $totalPeminjaman ?>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
               <a class="small text-white stretched-link" href="#">View Details</a>
               <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
         </div>
      </div>
      <div class="col-xl-3 col-md-6">
         <div class="card bg-danger text-white mb-4">
            <div class="card-body">
               <i class="fas fa-user"></i>
               Total Users: <?= $totalUsers ?>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
               <a class="small text-white stretched-link" href="#">View Details</a>
               <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
         </div>
      </div>
   </div>
   <?php
   include("../include/footer.php");
   ?>