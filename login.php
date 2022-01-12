<?php
session_start();
if (isset($_SESSION["login"])) {
    header("Location: index.php");
}

require 'functions.php';

if (isset($_POST["sign-in"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $_SESSION["user"] = $_POST["username"];

    $result = mysqli_query($conn, "SELECT * FROM user where username = '$username'");
    $_SESSION["login"] = true;
    // cek username
    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])) {
            header("Location: index.php");
            exit;
        }
    }
    $error = true;
}

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <script src="https://kit.fontawesome.com/7922542af8.js" crossorigin="anonymous"></script>

    <!-- style -->
    <link rel="stylesheet" href="style/style.css">

    <title>Login</title>
</head>

<body>
    <main>
        <!-- Login -->
        <div class="auth">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-sm-12 col-md-8 col-lg-5">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="mb-5">Sign In</h3>
                                <?php if (isset($error)) : ?>
                                    <p class="fst-italic text-danger">username/password incorrect</p>
                                <?php endif; ?>
                                <form action="" method="POST">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        <input type="text" class="form-control" name="username" placeholder="Username" aria-label="Username">
                                    </div>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                                        <input type="password" class="form-control" name="password" placeholder="Password" aria-label="Password">
                                    </div>

                                    <div class="row mb-2">
                                        <div class="col-md-5 col-sm-1 text-start">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="gridCheck1">
                                                <label class="form-check-label" for="gridCheck1">
                                                    Remember
                                                </label>

                                            </div>
                                        </div>
                                        <div class="col-md-7 col-sm-1 text-sm-start text-md-end ">
                                            <a href="" class="text-decoration-none text-muted">Forgot your password</a>
                                        </div>
                                    </div>

                                    <!-- button -->
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group d-grid col-12 mt-4 mb-2">
                                                <button type="submit" name="sign-in" class="btn btn-primary">Sign In</button>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group d-grid col-12 mt-4 mb-2">
                                                <button type="reset" class="btn btn-secondary">Reset</button>
                                            </div>
                                        </div>
                                    </div>
                                    <p>New Member? <a href="registrasi.php" class="text-decoration-none">Register your Account</a> </p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end login -->
    </main>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>