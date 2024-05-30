<?php

$title = "Data Pustakawan";
include '../include/header.php';
?>
<div class="container-fluid px-4">
   <h1 class="mt-4">Data Pemustaka</h1>
   <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item active">Data Pemustaka</li>
   </ol>

   <div class="card mb-4" >
      <div class="card-header d-flex justify-content-between align-items-center">
         <div>
            <i class="fas fa-table me-1"></i>
            Data Pemustaka</div>
         <a href="#tambahkaryawan" class="btn btn-outline-success ">Tambah Data</a>
      </div>
      <div class="card-body">
         <table id="datatablesSimple">
            <thead>
               <tr>
                  <th>#</th>
                  <th>ID</th>
                  <th>Nama</th>
                  <th>Alamat</th>
                  <th>Aksi</th>
                  
               </tr>
            </thead>
            <tfoot>
               <tr>
                  <th>#</th>
                  <th>ID</th>
                  <th>Nama</th>
                  <th>Alamat</th>
                  <th>Aksi</th>
                  
               </tr>
            </tfoot>
            <tbody>
               <?php 
               $pemustaka = mysqli_query($conn, "SELECT * FROM pustakawan");
               $i = 1;
               while($row = mysqli_fetch_assoc($pemustaka)){
               ?>
               <tr>
                  <td><?= $i ?></td>
                  <td><?= $row['ID'] ?></td>
                  <td><?= $row['NAMA'] ?></td>
                  <td><?= $row['ALAMAT'] ?></td>
                  <td>
                     <a href="edit_pustakawan.php?id=<?= $row['ID'] ?>" class="btn btn-sm btn-warning">Edit</a>
                     <a href="hapus_pustakawan.php?id=<?= $row['ID'] ?>" class="btn btn-sm btn-danger">Hapus</a>
                  </td>
                  
               </tr>
               <?php 
            $i++; } ?>
            </tbody>
         </table>
      </div>
   </div>
   <div class="card mb-4" id="tambahkaryawan">
      <div class="card-header">
         <i class="fas fa-user"></i>
         Tambah Data Pemustaka
      </div>
      <div class="card-body">

         <form method="post" action="tambah_pustakawan.php">
            <div class="row mb-3">
               <label for="nama" class="col-sm-2 col-form-label">Nama Lengkap</label>
               <div class="col-sm-4">
                  <input type="text" class="form-control" id="nama" name="nama">
               </div>
            </div>
            <div class="row mb-3">
               <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
               <div class="col-sm-8">
                  <textarea class="form-control" id="alamat" name="alamat"></textarea>
               </div>
            </div>
            

            <input type="submit" class="btn btn-primary" value="Submit" name="submit" />
         </form>

      </div>
   </div>
   <?php
   include '../include/footer.php';
   ?>