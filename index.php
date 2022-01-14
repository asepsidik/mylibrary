<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require 'functions.php';
$get_books = query("SELECT * FROM books ORDER BY publication_year DESC");

// add data
if (isset($_POST["submit"])) {
    //cek apakah data berhasil ditambahkan / gagal
    if (add_data($_POST) > 0) {
        echo "<script>
        alert('Data BERHASIL ditambahkan');
        document.location.href = 'index.php';
        </script>";
    } else {
        echo "<script>
        alert('Data GAGAL ditambahkan');
        document.location.href = 'index.php';
        </script>";
    }
}

if (isset($_POST["cancel"])) {
    echo "<script>
        document.location.href = 'index.php';
        </script>";
}


// search data
if (isset($_POST["search"])) {
    $get_books = search($_POST["keyword"]);
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/7922542af8.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style/style.css">
    <title>Main Page</title>
</head>

<body>
    <main class="container">

        <nav class="navbar navbar-light mt-3">
            <div class="container-fluid">
                <div>
                    <h4 class="text-secondary">
                        <i class="fas fa-user mx-2"></i><?= $_SESSION["user"]; ?>
                    </h4>
                </div>
                <a href="logout.php" class="btn btn-outline-secondary btn-sm mt-2"><i class="fas fa-sign-out-alt"> </i> Logout</a>
            </div>
        </nav>



        <h1 class="mt-3 text-center">MyLibrary Collection Books</h1>

        <nav class="navbar mt-5">
            <div class="container-fluid">
                <!-- Add Book -->
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    <i class="fas fa-plus"></i><strong> Add Book</strong>
                </button>

                <!-- form search -->
                <form class="d-flex" action="" method="POST">
                    <input class="form-control form-control-sm me-2" name="keyword" type="search" placeholder="Search book here.." aria-label="Search" size="35" autofocus autocomplete="off">
                    <button class="btn btn-outline-primary btn-sm" type="submit" name="search"><strong>Search</strong></button>
                </form>
            </div>
        </nav>

        <!-- Modal Add Data -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Add New Book</h5>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post" class="m-2" enctype="multipart/form-data">
                            <div class="row mb-3">
                                <label for="no_isbn" class="col-sm-2 col-form-label col-form-label-sm">No ISBN</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control form-control-sm" id="no_isbn" name="no_isbn" placeholder="No ISBN" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="title" class="col-sm-2 col-form-label col-form-label-sm">Title</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control form-control-sm" id="title" name="title" placeholder="Title" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="author" class="col-sm-2 col-form-label col-form-label-sm">Author</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control form-control-sm" id="author" name="author" placeholder="Author" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="publisher" class="col-sm-2 col-form-label col-form-label-sm">Publisher</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control form-control-sm" id="publisher" name="publisher" placeholder="Publisher" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="genre" class="col-sm-2 col-form-label col-form-label-sm">Genre</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control form-control-sm" id="genre" name="genre" placeholder="Genre" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="publication_year" class="col-sm-2 col-form-label col-form-label-sm">Publication</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control form-control-sm" id="publication_year" name="publication_year" placeholder="Publication Year">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="language" class="col-sm-2 col-form-label col-form-label-sm">Language</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control form-control-sm" id="language" name="language" placeholder="Language">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="pages" class="col-sm-2 col-form-label col-form-label-sm">Pages</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control form-control-sm" id="pages" name="pages" placeholder="Pages">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="cover" class="col-sm-2 col-form-label col-form-label-sm">Cover</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control form-control-sm" id="cover" name="cover" placeholder="Cover">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
                                </div>
                            </div>

                    </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
        </div>
        <table class="table table-striped table-hover table-sm">
            <tr>
                <thead class="table-dark text-center">
                    <th>No</th>
                    <th>ISBN</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Publisher</th>
                    <th>Genre</th>
                    <th>Year</th>
                    <th>Language</th>
                    <th>Pages</th>
                    <th>Cover</th>
                    <th>Action</th>
                </thead>
            </tr>
            <?php $i = 1; ?>
            <?php foreach ($get_books as $book) : ?>
                <tr>
                    <td class="text-center"><?= $i; ?>.</td>
                    <td class="text-center"><?= $book["no_isbn"]; ?></td>
                    <td><?= $book["title"]; ?></td>
                    <td><?= $book["author"]; ?></td>
                    <td><?= $book["publisher"]; ?></td>
                    <td><?= $book["genre"]; ?></td>
                    <td class="text-center"><?= $book["publication_year"]; ?></td>
                    <td><?= $book["language"]; ?></td>
                    <td class="text-center"><?= $book["pages"]; ?></td>
                    <td class="text-center"><img src="img/<?= $book["cover"]; ?>" alt="" width="30"></td>
                    <td class="text-center">
                        <a class="btn btn-success btn-sm" href="edit.php?id=<?= $book["id"]; ?>"><i class="fas fa-pencil-alt"></i> Edit</a>
                        <a class="btn btn-danger btn-sm" href="delete.php?id=<?= $book["id"]; ?>" onclick="return confirm('Apakah data akan dihapus..?')"><i class="fas fa-trash-alt"></i> Delete</a>
                    </td>
                </tr>
                <?php $i++; ?>
            <?php endforeach; ?>
        </table>


    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>