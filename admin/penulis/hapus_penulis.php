<?php

include '../../connection.php';

if(isset($_GET['id'])) {
   $id = $_GET['id'];
   
   try{
      $sql = mysqli_query($conn, "DELETE FROM penulis WHERE ID='$id'");
      if ($sql) {
          echo "<script>alert('Data berhasil dihapus!');document.location.href='index.php'</script>";
      } else {
          throw new Exception("Query execution failed");
      }
  } catch (Exception $e) {
      echo "<script>alert('Data gagal dihapus!');document.location.href='index.php'</script>";
  }
}