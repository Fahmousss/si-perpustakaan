<?php

$title = "List Buku";
include "../include/header.php";

?>
<div class="container mt-5">
   <div class="row">
      <div class="col-lg-8">
         <!-- Post content-->
         <article>
            <!-- Post header-->
            <header class="mb-4">

               <h1 class="fw-bolder mb-1">Selamat Datang <?= $_SESSION['username'] ?>!</h1>
               <div class="text-muted fst-italic mb-2">Ayo cari buku yang anda inginkan</div>
            </header>
            <?php
            if (isset($_POST['search'])) {
               $keyword = $_POST['keyword'];
            ?>
               <?php

               $query = mysqli_query($conn, "SELECT ISBN, BUKU.NAMA as JUDUL, penulis.NAMA as NAMA_PENULIS, PENERBIT, TAHUN, DESKRIPSI, FOTO FROM buku INNER JOIN penulis ON buku.ID_PENULIS = penulis.ID WHERE buku.NAMA LIKE '%$keyword%' OR penulis.NAMA LIKE '%$keyword%' ORDER BY `JUDUL`");

               if ($query->num_rows > 0) {
               ?>

                  <?php
                  while ($fetch = mysqli_fetch_array($query)) {
                  ?>
                     <section class="mb-4">
                        <a class="btn btn-light border-2 text-start px-3 py-3" href="../detail/index.php?isbn=<?= $fetch['ISBN'] ?>" style="border-color: rgba(0, 0, 0, 0.175);">
                           <div class="card-body justify-content-start ">
                              <div class="d-flex">
                                 <img class="" width="100" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." />
                                 <div class="ms-3">
                                    <div class="fw-bold"><?= $fetch['JUDUL'] ?></div>
                                    <div class="small fst-italic"><?= $fetch['NAMA_PENULIS'] ?></div>
                                    <?= $fetch['DESKRIPSI'] ?>
                                 </div>
                              </div>
                           </div>
                        </a>
                     </section>
                  <?php
                  } ?>

               <?php } else {
               ?>

                  <div class="alert alert-dark" role="alert">
                     Oops! No Result for "<?php echo $keyword ?>"
                  </div>

               <?php } ?>
            <?php
            } else {
            ?>
               <?php
               $query = mysqli_query($conn, "SELECT ISBN, buku.NAMA as JUDUL, penulis.NAMA as NAMA_PENULIS, PENERBIT, TAHUN, DESKRIPSI, FOTO FROM buku INNER JOIN penulis ON buku.ID_PENULIS = penulis.ID");
               ?>

               <?php
               while ($fetch = mysqli_fetch_array($query)) {
               ?>
                  <section class="mb-4">
                     <a class="btn btn-light border-2 text-start px-3 py-3" href="../detail/index.php?isbn=<?= $fetch['ISBN'] ?>" style="border-color: rgba(0, 0, 0, 0.175);">
                        <div class="card-body justify-content-start ">
                           <div class="d-flex">
                              <img class="" width="100" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." />
                              <div class="ms-3">
                                 <div class="fw-bold"><?= $fetch['JUDUL'] ?></div>
                                 <div class="small fst-italic"><?= $fetch['NAMA_PENULIS'] ?></div>
                                 <?= $fetch['DESKRIPSI'] ?>
                              </div>
                           </div>
                        </div>
                     </a>
                  </section>
               <?php
               }
               ?>
            <?php } ?>


         </article>
         <!-- Comments section-->
      </div>
      <!-- Side widgets-->
      <div class="col-lg-4">
         <!-- Search widget-->
         <div class="card mb-4">
            <div class="card-header">Cari</div>
            <div class="card-body">
               <form action="" method="post">
                  <div class="input-group">
                     <input class="form-control" type="text" placeholder="Enter search term..." aria-label="Enter search term..." aria-describedby="button-search" name="keyword" />
                     <button class="btn btn-primary" name="search" id="button-search" type="submit">Go!</button>
                  </div>
               </form>
            </div>
         </div>
         <!-- Categories widget-->
         <div class="card mb-4">
            <div class="card-header">Kategori</div>
            <div class="card-body">
               <div class="row">
                  <div class="col-sm-6">
                     <ul class="list-unstyled mb-0">
                        <li><a href="#!">Jurnal</a></li>
                        <li><a href="#!">Komik</a></li>
                        <li><a href="#!">Pendidikan</a></li>
                     </ul>
                  </div>
                  <div class="col-sm-6">
                     <ul class="list-unstyled mb-0">
                        <li><a href="#!">Agama</a></li>
                        <li><a href="#!">Fantasi</a></li>
                        <li><a href="#!">Kehidupan</a></li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<?php

include "../include/footer.php";
?>