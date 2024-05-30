<?php

$title = "Data Buku";
include '../include/header.php';
?>
<div class="container-fluid px-4">
   <h1 class="mt-4">Data Buku</h1>
   <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item active">Data Buku</li>
   </ol>

   <div class="card mb-4">
      <div class="card-header d-flex justify-content-between align-items-center">
         <div>
            <i class="fas fa-table me-1"></i>
            Data Buku
         </div>
         <a href="#tambahbuku" class="btn btn-outline-success">Tambah Data</a>
      </div>
      <div class="card-body">
         <table id="datatablesSimple">
            <thead>
               <tr>
                  <th>#</th>
                  <th></th>
                  <th>ISBN</th>
                  <th>Judul</th>
                  <th>Penulis</th>
                  <th>Penerbit</th>
                  <th>Tahun</th>
                  <th>Deskripsi</th>
                  <th>Aksi</th>

               </tr>
            </thead>
            <tfoot>
               <tr>
                  <th>#</th>
                  <th></th>
                  <th>ISBN</th>
                  <th>Judul</th>
                  <th>Penulis</th>
                  <th>Penerbit</th>
                  <th>Tahun</th>
                  <th>Deskripsi</th>
                  <th>Aksi</th>

               </tr>
            </tfoot>
            <tbody>
               <?php
               $buku = mysqli_query($conn, "SELECT ISBN, BUKU.NAMA AS NAMA_BUKU, PENULIS.NAMA AS NAMA_PENULIS, PENERBIT, TAHUN, DESKRIPSI, FOTO FROM BUKU, PENULIS WHERE BUKU.ID_PENULIS = PENULIS.ID;");
               $i = 1;
               while ($row = mysqli_fetch_assoc($buku)) {
               ?>
                  <tr>
                     <td><?= $i ?></td>
                     <td>
                        <img src="../img/<?= $row['FOTO'] ?>" alt="" width="50px">
                     </td>
                     <td><?= $row['ISBN'] ?></td>
                     <td><?= $row['NAMA_BUKU'] ?></td>
                     <td><?= $row['NAMA_PENULIS'] ?></td>
                     <td><?= $row['PENERBIT'] ?></td>
                     <td><?= $row['TAHUN'] ?></td>
                     <td><?= $row['DESKRIPSI'] ?></td>
                     <td>
                        <a href="edit_buku.php?id=<?= $row['ISBN'] ?>" class="btn btn-sm btn-warning">Edit</a>
                        <a href="hapus_buku.php?id=<?= $row['ISBN'] ?>" class="btn btn-sm btn-danger">Hapus</a>
                     </td>

                  </tr>
               <?php
                  $i++;
               } ?>
            </tbody>
         </table>
      </div>
   </div>
   <div class="card mb-4" id="tambahbuku">
      <div class="card-header">
         <i class=""></i>
         Tambah Data buku
      </div>
      <div class="card-body">

         <form method="post" action="tambah_buku.php">
            <div class="row mb-3">
               <label for="nama" class="col-sm-1 col-form-label">ISBN</label>
               <div class="col">
                  <input type="text" class="form-control" maxlength="3" id="nama" name="isbn">
               </div>
               -
               <div class="col">
                  <input type="text" class="form-control" maxlength="3" name="isbn1">
               </div>
               -
               <div class="col">
                  <input type="text" class="form-control" maxlength="4" name="isbn2">
               </div>
               -
               <div class="col">
                  <input type="text" class="form-control" maxlength="2" name="isbn3">
               </div>
               -
               <div class="col">
                  <input type="text" class="form-control" maxlength="1" name="isbn4">
               </div>
            </div>
            <div class="row mb-3">
               <label for="nama" class="col-sm-1 col-form-label">Judul</label>
               <div class="col">
                  <input type="text" class="form-control" id="nama" name="judul">
               </div>
            </div>
            <div class="row mb-3">
               <label for="penulis" class="col-sm-1 col-form-label">Penulis</label>
               <div class="col-sm-6">
                  <select class="form-select" id="penulis" name="penulis">
                     <option value="" selected disabled>Choose...</option>
                     <?php
                     $penulis = mysqli_query($conn, "SELECT * FROM penulis");
                     while ($row = mysqli_fetch_assoc($penulis)) {
                     ?>
                        <option value="<?= $row['ID'] ?>"><?= $row['NAMA'] ?></option>
                     <?php } ?>
                  </select>
               </div>
               <label for="penerbit" class="col-sm-1 col-form-label">Penerbit</label>
               <div class="col">
                  <input type="text" class="form-control" id="penerbit" name="penerbit">
               </div>
               <label for="tahun" class="col-sm-1 col-form-label">Tahun</label>
               <div class="col">
                  <input type="text" class="form-control" id="tahun" name="tahun">
               </div>
            </div>
            <div class="row mb-3">
               <label for="deskripsi" class="col-sm-1 col-form-label">Deskripsi</label>
               <div class="col">
                  <textarea class="form-control" id="deskripsi" name="deskripsi"></textarea>
               </div>
            </div>

            <input type="submit" class="btn btn-primary" value="Submit" name="submit" />
         </form>

      </div>
   </div>
   <?php
   include '../include/footer.php';
   ?>