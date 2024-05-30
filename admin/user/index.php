<?php

$title = "Data User";
include '../include/header.php';
?>
<div class="container-fluid px-4">
   <h1 class="mt-4">Data User</h1>
   <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item active">Data User</li>
   </ol>

   <div class="card mb-4">
      <div class="card-header d-flex justify-content-between align-items-center">
         <div>
            <i class="fas fa-table me-1"></i>
            Data User
         </div>
         <a href="#tambahUser" class="btn btn-outline-success ">Tambah Data</a>
      </div>
      <div class="card-body">
         <table id="datatablesSimple">
            <thead>
               <tr>
                  <th>#</th>
                  <th>ID</th>
                  <th>Nama</th>
                  <th>Username</th>
                  <th>Aksi</th>

               </tr>
            </thead>
            <tfoot>
               <tr>
                  <th>#</th>
                  <th>ID</th>
                  <th>Nama</th>
                  <th>Username</th>
                  <th>Aksi</th>

               </tr>
            </tfoot>
            <tbody>
               <?php
               $user = mysqli_query($conn, "SELECT pustakawan.ID as ID_PUSTAKAWAN, NAMA, USERNAME FROM user, pustakawan WHERE user.ID = pustakawan.ID");
               $i = 1;
               while ($row = mysqli_fetch_assoc($user)) {
               ?>
                  <tr>
                     <td><?= $i ?></td>
                     <td><?= $row['ID_PUSTAKAWAN'] ?></td>
                     <td><?= $row['NAMA'] ?></td>
                     <td><?= $row['USERNAME'] ?></td>
                     <td>
                        <a href="edit_user.php?id=<?= $row['ID_PUSTAKAWAN'] ?>" class="btn btn-sm btn-warning">Edit</a>
                        <a href="hapus_user.php?id=<?= $row['ID_PUSTAKAWAN'] ?>" class="btn btn-sm btn-danger">Hapus</a>
                     </td>

                  </tr>
               <?php
                  $i++;
               } ?>
            </tbody>
         </table>
      </div>
   </div>
   <div class="card mb-4" id="tambahUser">
      <div class="card-header">
         <i class="fas fa-user"></i>
         Tambah Data Penulis
      </div>
      <div class="card-body">

         <form method="post" action="tambah_penulis.php">
            <div class="row mb-3">
               <label for="nama" class="col-sm-2 col-form-label">Pemustaka</label>
               <div class="col-sm-4">
                  <select class="form-select" id="nama" name="nama">
                     <option value="" selected disabled>Choose...</option>
                     <?php
                     $pustakawan = mysqli_query($conn, "SELECT * FROM pustakawan WHERE ID NOT IN (SELECT ID FROM user)");
                     while ($row = mysqli_fetch_assoc($pustakawan)) {
                     ?>
                        <option value="<?= $row['ID'] ?>"><?= $row['NAMA'] ?></option>
                     <?php } ?>
                  </select>
               </div>
            </div>
            <div class="row mb-3">
               <label for="username" class="col-sm-2 col-form-label">Username</label>
               <div class="col-sm-4">
                  <input type="text" class="form-control" id="username" name="username">
               </div>
            </div>
            <div class="row mb-3">
               <label for="password" class="col-sm-2 col-form-label">Password</label>
               <div class="col-sm-4">
                  <input type="password" class="form-control" id="password" name="password">
               </div>
            </div>


            <input type="submit" class="btn btn-primary" value="Submit" name="submit" />
         </form>

      </div>
   </div>
   <?php
   include '../include/footer.php';
   ?>