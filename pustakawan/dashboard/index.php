<?php

$title = "Home";
include "../include/header.php";
?>
<!-- Header-->
<header class="bg-light pt-5 pb-2">
   <div class="container px-4 px-lg-5 my-5">
      <div class="text-center text-white">
         <img src="../../assets/img/logo.png" width="70%" alt="">
         <p class="lead fw-normal text-black-50 mb-5">Tingkatkan literasi menuju Indonesia maju</p>
      </div>
      <form class="form-inline ms-auto me-0 me-md-3 my-2 my-md-0" action="" method="post">
         <div class="input-group">
            <input class="form-control" type="text" placeholder="Search for..." name="keyword" aria-label="Search for..." aria-describedby="btnNavbarSearch" />
            <button class="btn btn-primary btn-lg" type="submit" name="search"><i class="fas fa-search"></i></button>
         </div>
      </form>
   </div>
</header>
<!-- Section-->
<section class="py-5">
   <div class="container px-4 px-lg-5 mt-5">
      <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">

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
                  <div class="col mb-5">
                     <div class="card h-100">
                        <!-- Gambar Buku -->
                        <?php
                        if (is_null($fetch['FOTO']) === false) {
                        ?>
                           <img class="card-img-top" src="uploads/<?php echo $fetch['img'] ?>" alt="..." />
                        <?php } else { ?>
                           <img class="card-img-top" src="https://dummyimage.com/450x300/3d3d3d/ffffff&text=no+image" alt="..." />
                        <?php } ?>
                        <!-- Detail Buku -->
                        <div class="card-body p-4">
                           <div class="text-center">
                              <!-- Judul Buku-->
                              <h5 class="fw-bolder"><?php
                                                      if (strlen($fetch['JUDUL']) > 35) {
                                                         echo substr($fetch['JUDUL'], 0, 35) . "...";
                                                      } else {
                                                         echo $fetch['JUDUL'];
                                                      } ?></h5>
                              <!-- Pengarang Buku -->
                              <small class="text-muted">Penulis: <?php echo substr($fetch['NAMA_PENULIS'], 0, 100) ?></small>
                              <small class="mt-5"><?php echo substr($fetch['DESKRIPSI'], 0, 80) ?>...</small>
                           </div>
                        </div>
                        <!-- Action -->
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                           <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="../detail/index.php?isbn=<?php echo  $fetch['ISBN'] ?>">Detail buku</a></div>
                        </div>
                     </div>
                  </div>
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

               <div class="col mb-5">
                  <div class="card h-100">
                     <!-- Gambar Buku -->
                     <?php
                     if (is_null($fetch['FOTO']) === false) {
                     ?>
                        <img class="card-img-top" src="uploads/<?php echo $fetch['FOTO'] ?>" alt="..." />
                     <?php } else { ?>
                        <img class="card-img-top" src="https://dummyimage.com/450x300/3d3d3d/ffffff&text=no+image" alt="..." />
                     <?php } ?>

                     <!-- Detail Buku -->
                     <div class="card-body p-4">
                        <div class="text-center">
                           <!-- Judul Buku-->
                           <h5 class="fw-bolder"><?php
                                                   if (strlen($fetch['JUDUL']) > 35) {
                                                      echo substr($fetch['JUDUL'], 0, 35) . "...";
                                                   } else {
                                                      echo $fetch['JUDUL'];
                                                   } ?></h5>
                           <!-- Pengarang Buku -->
                           <small class="text-muted mb-5"><?php echo substr($fetch['NAMA_PENULIS'], 0, 100) ?></small>
                        </div>
                        <small class="mt-5"><?php echo substr($fetch['DESKRIPSI'], 0, 80) ?>...</small>
                     </div>
                     <!-- Action -->
                     <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="../detail/index.php?isbn=<?php echo  $fetch['ISBN'] ?>">Detail buku</a></div>
                     </div>
                  </div>
               </div>
            <?php
            }
            ?>
         <?php } ?>

      </div>
   </div>
</section>
<?php
include "../include/footer.php";
?>