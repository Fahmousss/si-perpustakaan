<?php

$title = "Data Peminjaman";
include '../include/header.php';

if (isset($_POST['status'])) {
   $id = $_POST['id'];
   $status = $_POST['status'];
   $update = mysqli_query($conn, "UPDATE peminjaman SET STATUS='$status' WHERE ID='$id'");
   if ($update) {
      echo "<script>alert('Status berhasil diubah!');document.location.href='index.php'</script>";
   } else {
      echo "<script>alert('Status gagal diubah!');document.location.href='index.php'</script>";
   }
}
?>
<div class="container-fluid px-4">
   <h1 class="mt-4">Data Peminjaman</h1>
   <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item active">Data Peminjaman</li>
   </ol>

   <div class="card mb-4">
      <div class="card-header">

         <i class="fas fa-table me-1"></i>
         Data Peminjaman
      </div>
      <div class="card-body">
         <table id="datatablesSimple">
            <thead>
               <tr>
                  <th>#</th>
                  <th>ID</th>
                  <th>Nama</th>
                  <th>Tanggal Pinjam</th>
                  <th>Buku</th>
                  <th>Tenggat Kembali</th>
                  <th>Status</th>

               </tr>
            </thead>
            <tfoot>
               <tr>
                  <th>#</th>
                  <th>ID</th>
                  <th>Nama</th>
                  <th>Tanggal Pinjam</th>
                  <th>Buku</th>
                  <th>Tenggat Kembali</th>
                  <th>Status</th>

               </tr>
            </tfoot>
            <tbody>
               <?php
               $peminjaman = mysqli_query($conn, "SELECT peminjaman.ID AS ID_PEMINJAMAN, TANGGAL_PINJAM, ISBN, peminjaman.STATUS, PUSTAKAWAN.NAMA AS NAMA_PEMINJAM, TANGGAL_KEMBALI FROM peminjaman INNER JOIN pustakawan ON peminjaman.ID_PEMINJAM = pustakawan.ID  WHERE peminjaman.ID IN (SELECT ID_PINJAM FROM pengembalian WHERE pengembalian.STATUS='0')");
               $i = 1;
               while ($row = mysqli_fetch_assoc($peminjaman)) {
               ?>
                  <tr>
                     <td><?= $i ?></td>
                     <td><?= $row['ID_PEMINJAMAN'] ?></td>
                     <td><?= $row['NAMA_PEMINJAM'] ?></td>
                     <td><?= $row['TANGGAL_PINJAM'] ?></td>
                     <td><?= $row['ISBN'] ?></td>
                     <td><?php
                           if (time() > strtotime($row['TANGGAL_KEMBALI'])) {
                              echo "<span class='text-danger'>" . $row['TANGGAL_KEMBALI'] . "</span>";
                           } else {
                              echo $row['TANGGAL_KEMBALI'];
                           } ?></td>
                     <td>
                        <form action="" method="post">
                           <input type="hidden" name="id" value="<?= $row['ID_PEMINJAMAN'] ?>">
                           <select class="form-select" name="status" onchange="this.form.submit()">
                              <option value="1">Belum Konfirmasi</option>
                              <?php if ($row['STATUS'] == 2) { ?>
                                 <option value="2" selected>Sudah Konfirmasi</option>
                              <?php } else { ?>
                              <option value="2">Sudah Konfirmasi</option>
                              <?php } ?>
                           </select>
                        </form>
                     </td>
                  </tr>
               <?php
                  $i++;
               } ?>
            </tbody>
         </table>
      </div>
   </div>
   <?php
   include '../include/footer.php';
   ?>