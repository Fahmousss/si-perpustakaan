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
$title = "Edit Penulis";
include "../include/header.php";
?>
<div class="container-fluid px-4">
   <h1 class="mt-4">Edit Data Penulis</h1>
   <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item active">Data Penulis</li>
      <li class="breadcrumb-item">Edit Penulis</li>
   </ol>
   <div class="card mb-4">
      <div class="card-header">
         <i class="fas fa-user"></i>
         Edit Data Penulis
      </div>
      <div class="card-body">
         <?php
         $penulis = mysqli_query($conn, "SELECT * FROM penulis WHERE ID='$_GET[id]'");
         $row = mysqli_fetch_assoc($penulis);
         ?>
         <form method="post" action="">
            <div class="row mb-3">
               <label for="nama" class="col-sm-2 col-form-label">Nama Lengkap</label>
               <div class="col-sm-4">
                  <input type="text" class="form-control" id="nama" name="nama" value="<?= $row['NAMA'] ?>">
               </div>
            </div>
            <div class="row mb-3">
               <label for="email" class="col-sm-2 col-form-label">Email</label>
               <div class="col-sm-4">
                  <input type="email" class="form-control" id="email" name="email" value="<?= $row['EMAIL'] ?>">
               </div>
            </div>


            <input type="submit" class="btn btn-primary" value="Submit" name="submit" />
         </form>

      </div>
   </div>
   <?php
   include '../include/footer.php';
   ?>