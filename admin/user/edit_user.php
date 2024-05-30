<?php
include "../../connection.php";
if (isset($_POST['submit'])) {

   $username = $_POST['username'];
   $password = $_POST['password'];
   $confirm_password = $_POST['confirm-password'];
   $password = md5($password);
   $confirm_password = md5($confirm_password);

   if ($password != $confirm_password) {
      echo "<script>alert('Password tidak sama!');document.location.href='index.php'</script>";
      exit;
   }

   try {
      $sql = mysqli_query($conn, "UPDATE user SET USERNAME='$username', PASSWORD='$password' WHERE ID='$_GET[id]'");
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
$title = "Edit User";
include "../include/header.php";
?>
<div class="container-fluid px-4">
   <h1 class="mt-4">Edit Data User</h1>
   <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item active">Data User</li>
      <li class="breadcrumb-item">Edit User</li>
   </ol>
   <div class="card mb-4">
      <div class="card-header">
         <i class="fas fa-user"></i>
         Edit Data User
      </div>
      <div class="card-body">
         <?php
         $user = mysqli_query($conn, "SELECT * FROM user WHERE ID='$_GET[id]'");
         $row = mysqli_fetch_assoc($user);
         ?>
         <form method="post" action="">
            <div class="row mb-3">
               <label for="username" class="col-sm-2 col-form-label">Username</label>
               <div class="col-sm-4">
                  <input type="text" class="form-control" id="username" name="username" value="<?= $row['USERNAME'] ?>">
               </div>
            </div>
            <div class="row mb-3">
               <label for="password" class="col-sm-2 col-form-label">Password Baru</label>
               <div class="col-sm-4">
                  <input type="password" class="form-control" id="password" name="password">
               </div>
            </div>
            <div class="row mb-3">
               <label for="confirm-password" class="col-sm-2 col-form-label">Konfirmasi Password</label>
               <div class="col-sm-4">
                  <input type="password" class="form-control" id="confirm-password" name="confirm-password">
               </div>
            </div>


            <input type="submit" class="btn btn-primary" value="Submit" name="submit" />
         </form>

      </div>
   </div>
   <?php
   include '../include/footer.php';
   ?>