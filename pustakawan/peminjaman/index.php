<?php

$title = "Riwayat Peminjaman Buku";
include "../include/header.php";

?>
<div class="container mt-5">
   <div class="row">
      <div class="col-lg-8">
         <!-- Post content-->
         <article>
            <!-- Post header-->
            <header class="mb-4">
               <h4 class="fw-bolder mb-2">Riwayat Peminjaman Buku</h4>
               <div class="d-inline">
                  <form action="" method="get">
                     <button type="submit" name="submit" class="btn btn-sm btn-outline-success rounded-pill" style="font-size: xx-small;" value="2">Sedang dipinjam</button>
                     <button type="submit" name="submit1" class="btn btn-sm btn-outline-warning rounded-pill" style="font-size: xx-small;" value="1">Menunggu Konfirmasi</button>
                  </form>
               </div>
            </header>

            <?php
            $status = 2;
            if (isset($_GET['submit'])) {
               $status = $_GET['submit'];
            } elseif (isset($_GET['submit1'])) {
               $status = $_GET['submit1'];
            }
            $query = mysqli_query($conn, "SELECT peminjaman.ID AS ID_PEMINJAMAN, PEMINJAMAN.STATUS AS STATUS, 
               BUKU.NAMA AS JUDUL, TANGGAL_PINJAM, TENGGAT_KEMBALI, BUKU.ISBN AS ISBN, PENGEMBALIAN.STATUS AS STATUS_PENGEMBALIAN,
               PENGEMBALIAN.TANGGAL_KEMBALI AS TANGGAL_KEMBALI, DENDA 
               FROM peminjaman INNER JOIN pustakawan ON peminjaman.ID_PEMINJAM = pustakawan.ID
               INNER JOIN buku ON peminjaman.ISBN = buku.ISBN
               INNER JOIN pengembalian ON peminjaman.ID = pengembalian.ID_PINJAM 
               WHERE ID_PEMINJAM = (SELECT ID FROM USER WHERE USERNAME = '$_SESSION[username]') 
               AND peminjaman.STATUS = $status ORDER BY ID_PEMINJAMAN DESC");

            if ($query->num_rows > 0) {
            ?>
               <?php
               while ($fetch = mysqli_fetch_array($query)) {
               ?>
                  <section class="mb-4">
                     <a class="btn btn-light border-2 text-start px-3 py-3 <?php if ($status == 2 && $fetch['STATUS_PENGEMBALIAN'] == 1) {
                                                                                 echo "disabled";
                                                                              }?> " <?php if ($status == 2) {
                                                                                 echo "disabled";
                                                                              } else {
                                                                                 echo "href='../detail/index.php?isbn=" . $fetch['ISBN'] . "'";
                                                                              } ?> style="border-color: rgba(0, 0, 0, 0.175);">
                        <div class="card-body justify-content-start ">
                           <div class="d-flex">
                              <img class="" width="100" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." />
                              <div class="ms-3">
                                 <div class="fw-bold"><?= $fetch['JUDUL'] ?></div>
                                 <?php
                                 $pesanStatus = "";
                                 if ($status == 2) {
                                    if ($fetch['STATUS_PENGEMBALIAN'] == 1) {
                                       $pesanStatus .= "<span class = 'badge bg-success'>Sudah dikembalikan</span>";
                                    } else {
                                       $pesanStatus .= "<span class = 'badge bg-danger'>Belum dikembalikan</span>";
                                    }
                                 } else {
                                    if ($fetch['STATUS'] == 1) {
                                       $pesanStatus .= "<span class='badge bg-warning'>Menunggu Konfirmasi</span>";
                                    } else {
                                       $pesanStatus .= "<span class='badge bg-success'>Peminjaman Sukses</span>";
                                    }
                                 }
                                 ?>
                                 <div class="small">Status:
                                    <?= $pesanStatus ?>
                                 </div>
                                 <?php
                                 $tanggal = "";
                                 if ($status == 2) {
                                    if ($fetch['STATUS_PENGEMBALIAN'] == 1) {
                                       $tanggal .= "Tanggal kembali :<span class='text-success'> " . date("d, M Y", strtotime($fetch['TANGGAL_KEMBALI'])) . "</span>";
                                    } else {
                                       $tanggal .= "Tenggat kembali :<span class='text-danger'> " . date("d, M Y", strtotime($fetch['TENGGAT_KEMBALI'])) . "</span>";
                                    }
                                 } else {
                                    if ($fetch['STATUS'] == 1) {
                                       $tanggal .= "Tanggal pengajuan :<span class='text-success'> " . date("d, M Y", strtotime($fetch['TANGGAL_PINJAM'])) . "</span>";
                                    }
                                 }
                                 ?>
                                 <div class="small">
                                    <?= $tanggal ?>
                                 </div>
                                 <?php
                                 if ($status == 2) {
                                    if ($fetch['DENDA'] != 0) {
                                       echo "<div class='small'>Denda : <span class='text-danger'>" . $fetch['DENDA'] . "</span></div>";
                                    } else {
                                       echo "<div class='small'>Denda : <span class='text-success'>Tidak ada denda</span></div>";
                                    }
                                 }
                                 ?>
                                 <?php
                                 if ($status == 2) {
                                    if ($fetch['STATUS_PENGEMBALIAN'] == 0) {
                                       echo "
                                       <div>
                                          <span class = 'text-danger'>Harap segera mengembalikan buku sebelum waktu tenggat</span>
                                       </div>";
                                    }
                                 }
                                 ?>

                              </div>
                           </div>
                        </div>
                     </a>
                  </section>
               <?php
               }
               ?>
            <?php }
            ?>


         </article>
      </div>
   </div>
</div>

<?php

include "../include/footer.php";
?>