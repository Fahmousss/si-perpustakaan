<?php
include "../../connection.php";
if (isset($_POST['submit'])) {

    $id = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password = md5($password);

    try {
        $sql = mysqli_query($conn, "INSERT INTO user (ID, USERNAME, PASSWORD) VALUES ('$id', '$username', '$password')");
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
