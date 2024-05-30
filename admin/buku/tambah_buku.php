<?php
include "../../connection.php";
if (isset($_POST['submit'])) {

    $ISBN = $_POST['isbn'] . "-" . $_POST['isbn1'] . "-" . $_POST['isbn2'] . "-" . $_POST['isbn3'] . "-" . $_POST['isbn4'];
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $penerbit = $_POST['penerbit'];
    $tahun = $_POST['tahun'];
    $deskripsi = $_POST['deskripsi'];

    try {
        $sql = mysqli_query($conn, "INSERT INTO buku (ISBN, NAMA, ID_PENULIS, PENERBIT, TAHUN, DESKRIPSI) VALUES ('$ISBN', '$judul', '$penulis', '$penerbit', '$tahun', '$deskripsi')");
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
