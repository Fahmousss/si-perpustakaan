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
   <ol class="breadcrumb mt-4">
      <li class="breadcrumb-item active">Riwayat Peminjaman</li>
   </ol>
   <h1 class="mb-3">Riwayat Peminjaman</h1>

   <div class="card mb-4">
      <div class="card-body">
         <table id="datatablesSimple">
            <thead>
               <tr>
                  <th>#</th>
                  <th>ID</th>
                  <th>Nama Buku</th>
                  <th>Tanggal Pinjam</th>
                  <th>Tenggat Kembali</th>
                  <th>Status</th>
                  <th>Denda</th>
               </tr>
            </thead>
            <tfoot>
               <tr>
                  <th>#</th>
                  <th>ID</th>
                  <th>Nama Buku</th>
                  <th>Tanggal Pinjam</th>
                  <th>Tenggat Kembali</th>
                  <th>Status</th>
                  <th>Denda</th>

               </tr>
            </tfoot>
            <tbody>
               <?php
               $peminjaman = mysqli_query($conn, "SELECT peminjaman.ID AS ID_PEMINJAMAN, PENGEMBALIAN.STATUS AS STATUS, 
               BUKU.NAMA AS NAMA_BUKU, TANGGAL_PINJAM, TENGGAT_KEMBALI, PENGEMBALIAN.TANGGAL_KEMBALI AS TANGGAL_KEMBALI, DENDA 
               FROM peminjaman INNER JOIN pustakawan ON peminjaman.ID_PEMINJAM = pustakawan.ID
               INNER JOIN buku ON peminjaman.ISBN = buku.ISBN
               INNER JOIN pengembalian ON peminjaman.ID = pengembalian.ID_PINJAM 
               WHERE ID_PEMINJAM = (SELECT ID FROM USER WHERE USERNAME = '$_SESSION[username]') AND peminjaman.STATUS = 2 ORDER BY ID_PEMINJAMAN DESC");
               $i = 1;
               while ($row = mysqli_fetch_assoc($peminjaman)) {
               ?>
                  <tr>
                     <td><?= $i ?></td>
                     <td><?= $row['ID_PEMINJAMAN'] ?></td>
                     <td><?= $row['NAMA_BUKU'] ?></td>
                     <td><?= date("d, M Y",strtotime($row['TANGGAL_PINJAM'])) ?></td>
                     <td><?php
                           if (time() > strtotime($row['TENGGAT_KEMBALI'])) {
                              echo "
                              <span class='text-danger'>Harap segera kembalikan buku ini</span><br>
                              <span class='text-danger'>" . date("d, M Y",strtotime($row['TENGGAT_KEMBALI'])) . "</span>";
                           } else {
                              echo "<span class='text-success'>" . date("d, M Y",strtotime($row['TENGGAT_KEMBALI'])) . "</span>";
                           } ?></td>
                     <td>
                        <?php 
                        if ($row['STATUS'] == 0) {
                           if (time() > strtotime($row['TENGGAT_KEMBALI'])){
                              echo "<span class='badge bg-danger'>Belum dikembalikan</span>";
                           } else {
                              echo "<span class='badge bg-warning'>Belum dikembalikan</span>";
                           }
                        } elseif ($row['STATUS'] == 1) {
                           if (strtotime($row['TANGGAL_KEMBALI']) > strtotime($row['TENGGAT_KEMBALI'])) {
                              echo "<span class='badge bg-danger'>Terlambat</span>";
                           } else {
                              echo "<span class='badge bg-success'>Sudah dikembalikan</span>";
                           }
                        }
                        ?>
                     </td>
                     <td>
                        <?php
                        if ($row['DENDA'] == 0) {
                           echo "-";
                        } else {
                           echo "Rp " . $row['DENDA'];
                        }
                        ?>
                  </tr>
               <?php
                  $i++;
               } ?>
            </tbody>
         </table>
      </div>
   </div>
</div>
   <?php
   include '../include/footer.php';
   ?>