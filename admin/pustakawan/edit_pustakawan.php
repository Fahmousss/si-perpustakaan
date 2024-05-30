<?php
include "../../connection.php";
if (isset($_POST['submit'])) {

   $nama = $_POST['nama'];
   $alamat = $_POST['alamat'];

    
    try{
        $sql = mysqli_query($conn, "UPDATE pustakawan SET NAMA='$nama', ALAMAT='$alamat' WHERE ID='$_GET[id]'");
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
$title = "Edit Pustakawan";
include "../include/header.php";
?>
<div class="container-fluid px-4">
   <h1 class="mt-4">Edit Data Pemustaka</h1>
   <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item active">Data Pemustaka</li>
      <li class="breadcrumb-item">Edit Pemustaka</li>
   </ol>
   <div class="card mb-4" >
      <div class="card-header">
         <i class="fas fa-user"></i>
         Edit Data Pemustaka
      </div>
      <div class="card-body">
         <?php
         $pustakawan = mysqli_query($conn, "SELECT * FROM pustakawan WHERE ID='$_GET[id]'");
         $row = mysqli_fetch_assoc($pustakawan);
         ?>
         <form method="post" action="">
            <div class="row mb-3">
               <label for="nama" class="col-sm-2 col-form-label">Nama Lengkap</label>
               <div class="col-sm-4">
                  <input type="text" class="form-control" id="nama" name="nama" value="<?= $row['NAMA'] ?>">
               </div>
            </div>
            <div class="row mb-3">
               <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
               <div class="col-sm-8">
                  <textarea class="form-control" id="alamat" name="alamat"><?= $row['ALAMAT'] ?></textarea>
               </div>
            </div>
            

            <input type="submit" class="btn btn-primary" value="Submit" name="submit" />
         </form>

      </div>
   </div>
   <?php
   include '../include/footer.php';
   ?>
