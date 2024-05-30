<?php

$title = "Data Pustakawan";
include '../include/header.php';
?>
<div class="container-fluid px-4">
   <h1 class="mt-4">Data Penulis</h1>
   <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item active">Data Penulis</li>
   </ol>

   <div class="card mb-4" >
      <div class="card-header d-flex justify-content-between align-items-center">
         <div>
            <i class="fas fa-table me-1"></i>
            Data Penulis</div>
         <a href="#tambahpenulis" class="btn btn-outline-success ">Tambah Data</a>
      </div>
      <div class="card-body">
         <table id="datatablesSimple">
            <thead>
               <tr>
                  <th>#</th>
                  <th>ID</th>
                  <th>Nama</th>
                  <th>Email</th>
                  <th>Buku</th>
                  <th>Aksi</th>
                  
               </tr>
            </thead>
            <tfoot>
               <tr>
                  <th>#</th>
                  <th>ID</th>
                  <th>Nama</th>
                  <th>Email</th>
                  <th>Buku</th>
                  <th>Aksi</th>
                  
               </tr>
            </tfoot>
            <tbody>
               <?php 
               $penulis = mysqli_query($conn, "SELECT * FROM penulis");
               $i = 1;
               while($row = mysqli_fetch_assoc($penulis)){
               ?>
               <tr>
                  <td><?= $i ?></td>
                  <td><?= $row['ID'] ?></td>
                  <td><?= $row['NAMA'] ?></td>
                  <td><?= $row['EMAIL'] ?></td>
                  <td>
                     <ul>
                     <?php
                     $buku = mysqli_query($conn, "SELECT NAMA FROM buku WHERE ID_PENULIS='$row[ID]'");
                     while($rowbuku = mysqli_fetch_assoc($buku)){
                        ?>
                        <li><?= $rowbuku['NAMA'] ?></li>
                     <?php } ?>
                     </ul>
                  </td>
                  <td>
                     <a href="edit_penulis.php?id=<?= $row['ID'] ?>" class="btn btn-sm btn-warning">Edit</a>
                     <a href="hapus_penulis.php?id=<?= $row['ID'] ?>" class="btn btn-sm btn-danger">Hapus</a>
                  </td>
                  
               </tr>
               <?php 
            $i++; } ?>
            </tbody>
         </table>
      </div>
   </div>
   <div class="card mb-4" id="tambahpenulis">
      <div class="card-header">
         <i class="fas fa-user"></i>
         Tambah Data Penulis
      </div>
      <div class="card-body">

         <form method="post" action="tambah_penulis.php">
            <div class="row mb-3">
               <label for="nama" class="col-sm-2 col-form-label">Nama Lengkap</label>
               <div class="col-sm-4">
                  <input type="text" class="form-control" id="nama" name="nama">
               </div>
            </div>
            <div class="row mb-3">
               <label for="email" class="col-sm-2 col-form-label">Email</label>
               <div class="col-sm-4">
                  <input type="email" class="form-control" id="email" name="email">
               </div>
            </div>
            

            <input type="submit" class="btn btn-primary" value="Submit" name="submit" />
         </form>

      </div>
   </div>
   <?php
   include '../include/footer.php';
   ?>