<?php

$title = "Data Peminjaman";
include '../include/header.php';

if (isset($_POST['status'])) {
   $tanggalKembali = new DateTime(date('Y-m-d',strtotime($_POST['tanggalKembali'])));
   $id = $_POST['id'];
   $status = $_POST['status'];
   $denda = 0; 
   $interval = $tanggalKembali->diff(new DateTime());
   if ($interval->days < 0) {
      for ($i = 0; $i < $interval->days; $i++) {
         $denda += 1000;
      }
   }
   $update = mysqli_query($conn, "UPDATE pengembalian SET STATUS='$status', TANGGAL_KEMBALI = CURRENT_DATE(), DENDA = $denda WHERE ID_PINJAM='$id'");
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
                  <th>ID Pinjam</th>
                  <th>Tanggal Kembali</th>
                  <th>Status</th>
                  <th>Denda</th>

               </tr>
            </thead>
            <tfoot>
               <tr>
                  <th>#</th>
                  <th>ID</th>
                  <th>ID Pinjam</th>
                  <th>Tanggal Kembali</th>
                  <th>Status</th>
                  <th>Denda</th>
               </tr>
            </tfoot>
            <tbody>
               <?php
               $peminjaman = mysqli_query($conn, "SELECT * FROM pengembalian");
               $i = 1;
               while ($row = mysqli_fetch_assoc($peminjaman)) {
               ?>
                  <tr>
                     <td><?= $i ?></td>
                     <td><?= $row['ID'] ?></td>
                     <td><?= $row['ID_PINJAM'] ?></td>
                     <td>
                        <?php
                        if ($row['TANGGAL_KEMBALI'] == null) {
                           echo "Belum dikembalikan";
                        } else {
                           echo $row['TANGGAL_KEMBALI'];
                        }
                        ?>
                     </td>
                     <td>
                        <form action="" method="post">
                           <input type="hidden" name="tanggalKembali" value="<?= $row['TENGGAT_KEMBALI'] ?>">
                           <input type="hidden" name="id" value="<?= $row['ID_PINJAM'] ?>">
                           <select class="form-select" name="status" onchange="this.form.submit()">
                              <option value="0">Belum dikembalikan</option>
                              <?php if ($row['STATUS'] == 1) { ?>
                                 <option value="1" selected>Sudah dikembalikan</option>
                              <?php } else { ?>
                              <option value="1">Sudah dikembalikan</option>
                              <?php } ?>
                           </select>
                        </form>
                     </td>
                     <td><?= $row['DENDA'] ?></td>
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