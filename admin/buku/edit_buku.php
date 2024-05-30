<?php
include "../../connection.php";
if (isset($_POST['submit'])) {

   $nama = $_POST['nama'];
   $email = $_POST['email'];


   try {
      $sql = mysqli_query($conn, "UPDATE penulis SET NAMA='$nama', EMAIL='$email' WHERE ID='$_GET[id]'");
      if ($sql) {
         echo "<script>alert('Data berhasil diubah!');document.location.href='index.php'</script>";
      } else {
         throw new Exception("Query execution failed");
      }
   } catch (Exception $e) {
      echo "<script>alert('Data gagal ditambahkan!');document.location.href='index.php'</script>";
   }
}
$conn->close();
$title = "Edit Buku";
include "../include/header.php";
?>
<div class="container-fluid px-4">
   <h1 class="mt-4">Edit Data Buku</h1>
   <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item active">Data Buku</li>
      <li class="breadcrumb-item">Edit Buku</li>
   </ol>
   <div class="card mb-4">
      <div class="card-header">
         <i class=""></i>
         Edit Data Buku
      </div>
      <div class="card-body">
         <?php
         $buku = mysqli_query($conn, "SELECT * FROM buku WHERE ISBN='$_GET[id]'");
         $row = mysqli_fetch_assoc($buku);
         ?>
         <form method="post" action="">
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
                  <input type="text" class="form-control" id="nama" name="judul" value="<?= $row['NAMA'] ?>">
               </div>
            </div>
            <div class="row mb-3">
               <label for="penulis" class="col-sm-1 col-form-label">Penulis</label>
               <div class="col-sm-6">
                  <select class="form-select" id="penulis" name="penulis">
                     <option value="" selected disabled>Choose...</option>
                     <?php
                     $penulis = mysqli_query($conn, "SELECT * FROM penulis");
                     while ($rowPenulis = mysqli_fetch_assoc($penulis)) {
                     ?>
                        <option value="<?= $rowPenulis['ID'] ?>"><?= $rowPenulis['NAMA'] ?></option>
                     <?php } ?>
                  </select>
               </div>
               <label for="penerbit" class="col-sm-1 col-form-label">Penerbit</label>
               <div class="col">
                  <input type="text" class="form-control" id="penerbit" name="penerbit" value="<?= $row['PENERBIT'] ?>">
               </div>
               <label for="tahun" class="col-sm-1 col-form-label">Tahun</label>
               <div class="col">
                  <input type="text" class="form-control" id="tahun" name="tahun" value="<?= $row['TAHUN'] ?>">
               </div>
            </div>
            <div class="row mb-3">
               <label for="deskripsi" class="col-sm-1 col-form-label">Deskripsi</label>
               <div class="col">
                  <textarea class="form-control" id="deskripsi" name="deskripsi" ><?= $row['DESKRIPSI'] ?></textarea>
               </div>
            </div>


            <input type="submit" class="btn btn-primary" value="Submit" name="submit" />

         </form>

      </div>
   </div>
   <?php
   include '../include/footer.php';
   ?>