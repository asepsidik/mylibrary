<?php
require 'functions.php';

if (isset($_POST["register"])) {
    if (registrasi($_POST) > 0) {
        echo "<script>
        alert('New user added successfully');
        </script>";
    } else {
        echo mysqli_error($conn);
    }
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

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

    <!-- style -->
    <link rel="stylesheet" href="style/style.css">

    <title>Register</title>
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
                                <h3 class="mb-5">Register Account</h3>
                                <form action="" method="post">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                                        <input type="text" class="form-control" name="username" placeholder="Username" aria-label="Username">
                                    </div>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text"><i class="bi bi-unlock-fill"></i></span>
                                        <input type="password" class="form-control" name="password" placeholder="Password" aria-label="Password">
                                    </div>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text"><i class="bi bi-unlock-fill"></i></span>
                                        <input type="password" class="form-control" name="confirm-password" placeholder="Confirm Password" aria-label="Confirm Password">
                                    </div>


                                    <!-- <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="checkbox">
                                        <label for="checkbox" class="form-check-label">check me out</label>
                                    </div> -->

                                    <!-- <div class="row">
                                        <div class="col-md-5 col-sm-1 text-start">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="gridCheck1">
                                                <label class="form-check-label" for="gridCheck1">
                                                    Remember
                                                </label>

                                            </div>
                                        </div>
                                    </div> -->

                                    <!-- <button type="submit" class="btn btn-primary">Submit</button> -->
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group d-grid col-12 mt-4 mb-2">
                                                <button type="submit" name="register" class="btn btn-primary">Register</button>
                                            </div>
                                        </div>
                                    </div>
                                    <p> Already have an account? <a href="login.php" class="text-decoration-none">Sign In</a> </p>
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