<?php
include "../../connection.php";
if (isset($_POST['submit'])) {

   $nama = $_POST['nama'];
   $alamat = $_POST['alamat'];

    
    try{
        $sql = mysqli_query($conn, "INSERT INTO pustakawan (nama, alamat) VALUES ('$nama', '$alamat')");
        if ($sql) {
            echo "<script>alert('Data berhasil ditambahkan!');document.location.href='index.php'</script>";
        } else {
            throw new Exception("Query execution failed");
        }
    } catch (Exception $e) {
        echo "<script>alert('Data gagal ditambahkan!');document.location.href='index.php'</script>";
    }

}

// Close the database connection
$conn->close();
