<?php


$title = "Detail Buku";
include "../include/header.php";

if (isset($_GET['isbn'])) {
   $isbn = $_GET['isbn'];
   $query = mysqli_query($conn, "SELECT buku.ISBN as ISBN, BUKU.NAMA as JUDUL, penulis.NAMA as NAMA_PENULIS, PENERBIT, TAHUN, DESKRIPSI, FOTO FROM buku INNER JOIN penulis ON buku.ID_PENULIS = penulis.ID WHERE buku.ISBN = '$isbn'");
   $query2 = mysqli_query($conn, "SELECT STATUS FROM peminjaman WHERE ISBN = '$isbn'  AND ID_PEMINJAM = (SELECT ID FROM user WHERE USERNAME = '$_SESSION[username]') ");
   if ($query->num_rows > 0) {
      $fetch = mysqli_fetch_array($query);
   } else {
      header("Location: ../404.php");
      exit();
   }
} else {
   header("Location: ../404.php");
   exit();
}

// Get count of IDs that borrowed the book in a week
$weekCountQuery = mysqli_query($conn, "SELECT COUNT(ID_PEMINJAM) as COUNT FROM peminjaman WHERE ID_PEMINJAM = (SELECT ID FROM USER WHERE USERNAME = '$_SESSION[username]') AND TANGGAL_PINJAM >= DATE_SUB(NOW(), INTERVAL 7 DAY) AND (SELECT COUNT(ID_PINJAM) FROM PENGEMBALIAN WHERE STATUS = 0) > 2");
$weekCount = mysqli_fetch_array($weekCountQuery)['COUNT'];

if ($query2->num_rows > 0) {
   $row = mysqli_fetch_array($query2);
} else {
   $row['STATUS'] = 0;
}

$err = "";
if (isset($_POST['submit'])) {
   if ($weekCount >= 3) {
      $err .= "<div class='alert alert-danger' role='alert'>Anda telah meminjam lebih dari 3 buku dalam seminggu</div>";
   }else{
      $query = mysqli_query($conn, "INSERT INTO peminjaman (ID_PEMINJAM, ISBN, TANGGAL_KEMBALI) VALUES ((SELECT ID FROM user WHERE USERNAME = '$_SESSION[username]'), '$isbn', DATE_ADD(NOW(), INTERVAL 30 DAY))");
      header("Location: Refresh:0");
   }
}

?>
<section class="py-5">
   <div class="container px-4 px-lg-5 my-5">
      <div class="row gx-4 gx-lg-5 align-items-center">
         <div class="col-md-6"><?php
                                 if (is_null($fetch['FOTO']) === false) {
                                 ?>
               <img class="card-img-top" src="uploads/<?php echo $fetch['img'] ?>" alt="..." />
            <?php } else { ?>
               <img class="card-img-top" src="https://dummyimage.com/450x300/3d3d3d/ffffff&text=no+image" alt="..." />
            <?php } ?>
         </div>
         <div class="col-md-6">
            <div class="small mb-1">ISBN: <?php echo $fetch['ISBN'] ?></div>
            <h1 class="display-5 fw-bolder"><?php echo $fetch['JUDUL'] ?></h1>
            <div class="fs-5 mb-5">
               <span><?php echo $fetch['NAMA_PENULIS'] ?></span><br>
               <small class="text-muted"><?php echo $fetch['PENERBIT'] . ", " . $fetch["TAHUN"] ?></small>
            </div>
            <p class="lead"><?php echo $fetch['DESKRIPSI'] ?></p>
            <?php echo isset($err) ? $err : "" ?>
            <div class="d-flex mb-5">
               <?php if ($row['STATUS'] == null) { ?>
                  <form action="" method="post">
                     <button class="btn btn-outline-dark flex-shrink-0" name="submit" type="submit">
                        <i class="bi-cart-fill me-1" onclick="history.go(0)"></i>
                        Pinjam Buku
                     </button>
                  </form>
                  
               <?php } else if ($row['STATUS'] == 1) { ?>
                  <button class="btn btn-outline-warning flex-shrink-0" type="button" disabled>
                     <i class="bi-cart-fill me-1"></i>
                     Menunggu Konfirmasi
                  </button>
               <?php } else if ($row['STATUS'] == 2) { ?>
                  <button class="btn btn-outline-success flex-shrink-0" disabled type="button">
                     <i class="bi-cart-fill me-1"></i>
                     Peminjaman Sukses
                  </button>
               <?php } ?>

            </div>
            <div class="d-flex justify-content-end mt-5">
               <a class="text-black" href="../dashboard/"><i class="bi bi-arrow-left-short"></i>Back</a>
            </div>
         </div>
      </div>
   </div>
</section>
<?php

include "../include/footer.php";
?>