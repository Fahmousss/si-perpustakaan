<?php
session_start();
include("../../connection.php");

if (!isset($_SESSION['username'])) {
  header("Location: ../../login.php");
  exit();
}


if (!in_array("admin", $_SESSION['access'])) {
  header("Location: ../../include/404.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <?php global $title; ?>
  <title><?php echo isset($title) ? "SIPUS · " . $title : "Sistem Informasi Perpustakaan"; ?></title>
  <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
  <link href="../../assets/css/styles.css" rel="stylesheet" />
  <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
  <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="#">Start Bootstrap</a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    <!-- Navbar Search-->
    <small class="d-none text-secondary text-uppercase d-md-inline-block ms-auto me-0 me-md-3 my-2 my-md-0">
      <?= $_SESSION['username'] ?>
    </small>
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
          
          <li><a class="dropdown-item" href="../../logout.php">Logout</a></li>
        </ul>
      </li>
    </ul>
  </nav>

  <div id="layoutSidenav">
    <div id="layoutSidenav_nav">
      <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
          <div class="nav">
            <div class="sb-sidenav-menu-heading">Core</div>
            <a class="nav-link" href="../dashboard/">
              <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
              Dashboard
            </a>
            <a class="nav-link" href="../user">
              <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
              Assign User
            </a>
            <div class="sb-sidenav-menu-heading">Master Data</div>
            <a class="nav-link" href="../pustakawan">
              <div class="sb-nav-link-icon"><i class="fa-solid fa-book-open-reader"></i></div>
              Data Pemustaka
            </a>
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
              <div class="sb-nav-link-icon"><i class="fa-solid fa-book"></i></div>
              Data Buku
              <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
              <nav class="sb-sidenav-menu-nested nav">
                <a class="nav-link" href="../penulis/">Data Penulis</a>
                <a class="nav-link" href="../buku/">Data Buku</a>
              </nav>
            </div>
            <a class="nav-link" href="../peminjaman/">
              <div class="sb-nav-link-icon"><i class="fa-solid fa-bookmark"></i></div>
              Data Peminjaman
            </a>
            <a class="nav-link" href="../pengembalian/">
              <div class="sb-nav-link-icon"><i class="fa-solid fa-right-left"></i></div>
              Data Pengembalian
            </a>


          </div>
        </div>
        <div class="sb-sidenav-footer">
          <div class="small">Last log in:</div>
          <span class=" text-capitalize"><?= date('H:i:s',$_SESSION['last_login']) ?></span>

        </div>
      </nav>
    </div>
    <div id="layoutSidenav_content">
      <main>