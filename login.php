<?php
session_start();

if (isset($_SESSION['username'])) {
    if (in_array("admin", $_SESSION['access'])) {
        header("Location: admin/index.php");
        exit();
    } elseif (in_array("pustakawan", $_SESSION['access']) && !in_array("admin", $_SESSION['access'])) {
        header("Location: pustakawan/index.php");
        exit();
    }
}

include("connection.php");
$username = "";
$password = "";
$err = "";
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username == "" || $password == "") {
        $err .= "<div class='alert alert-danger'>Username and Password can't be empty</div>";
    }

    if (empty($err)) {
        $sqlq1 = "SELECT * FROM user WHERE USERNAME = '$username'";
        $q1 = mysqli_query($conn, $sqlq1);
        $r1 = mysqli_fetch_array($q1);
        if ($r1['PASSWORD'] != md5($password)) {
            $err .= "<div class='alert alert-danger'>Username and Password don't match</div>";
        }
    }
    if (empty($err)) {
        $login_id = $r1['ID'];
        $sqlq2 = "SELECT * FROM access WHERE ID = '$login_id' ";
        $q2 = mysqli_query($conn, $sqlq2);
        while ($r1 = mysqli_fetch_array($q2)) {
            $access[] = $r1['ID_ACCESS'];
        }
        if (empty($access)) {
            $err .= "<div class='alert alert-danger'>You don't have access to this page</div>";
        }
    }

    if (empty($err)) {
        $_SESSION['last_login'] = time();
        $_SESSION['username'] = $username;
        $_SESSION['access'] = $access;



        if (in_array("admin", $_SESSION['access'])) {
            header("Location: admin/index.php");
            exit();
        } elseif (in_array("pustakawan", $_SESSION['access']) && !in_array("admin", $_SESSION['access'])) {
            header("Location: pustakawan/index.php");
            exit();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Login - Perpustakaan</title>
    <link href="assets/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="bg-dark">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Login</h3>
                                </div>
                                <div class="card-body">
                                    <form method="post" action="">
                                        <?php if ($err) {
                                            echo $err;
                                        }
                                        ?>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="username" type="text" placeholder="Masukkan username anda" name="username" />
                                            <label for="username">Username</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="password" type="password" placeholder="Password" name="password" />
                                            <label for="password">Password</label>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <input class="btn btn-primary w-100 py-2 mt-3" type="submit" value="Submit" name="login" />
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="assets/js/scripts.js"></script>
</body>

</html>