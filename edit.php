<?php
require 'functions.php';

// amil data dari url
$id = $_GET["id"];

$get_books = query("SELECT * FROM books WHERE id = $id")[0];

if (isset($_POST["submit"])) {
    // cek apakah data berhasil diedit / gagal
    if (edit_data($_POST) > 0) {
        echo "<script>
        alert('Data BERHASIL diedit');
        document.location.href = 'index.php';
        </script>";
    } else {
        echo "<script>
        alert('Data GAGAL diedit');
        document.location.href = 'index.php';
        </script>";
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Main Page</title>
</head>

<body>
    <main class="container">


        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Edit Data Book</h5>
                </div>
                <div class="modal-body">
                    <form action="" method="post" class="m-2" enctype="multipart/form-data">
                        <input type="hidden" name="oldImg" value="<?= $get_books["cover"]; ?>">
                        <div class="row mb-3">
                            <label for="id" class="col-sm-2 col-form-label col-form-label-sm">ID</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control-sm" id="id" name="id" value="<?= $get_books["id"]; ?>" readonly>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="no_isbn" class="col-sm-2 col-form-label col-form-label-sm">No ISBN</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control-sm" id="no_isbn" name="no_isbn" value="<?= $get_books["no_isbn"]; ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="title" class="col-sm-2 col-form-label col-form-label-sm">Title</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control-sm" id="title" name="title" value="<?= $get_books["title"]; ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="author" class="col-sm-2 col-form-label col-form-label-sm">Author</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control-sm" id="author" name="author" value="<?= $get_books["author"]; ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="publisher" class="col-sm-2 col-form-label col-form-label-sm">Publisher</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control-sm" id="publisher" name="publisher" value="<?= $get_books["publisher"]; ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="genre" class="col-sm-2 col-form-label col-form-label-sm">Genre</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control-sm" id="genre" name="genre" value="<?= $get_books["genre"]; ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="publication_year" class="col-sm-2 col-form-label col-form-label-sm">Publication</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control form-control-sm" id="publication_year" name="publication_year" value="<?= $get_books["publication_year"]; ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="language" class="col-sm-2 col-form-label col-form-label-sm">Language</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control-sm" id="language" name="language" value="<?= $get_books["language"]; ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="pages" class="col-sm-2 col-form-label col-form-label-sm">Pages</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control form-control-sm" id="pages" name="pages" value="<?= $get_books["pages"]; ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="cover" class="col-sm-2 col-form-label col-form-label-sm">Cover</label>
                            <img src="img/<?= $get_books["cover"]; ?>" alt="" width="30">
                            <div class="col-sm-10">
                                <input type="file" class="form-control form-control-sm" id="cover" name="cover">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <button type="submit" name="submit" class="btn btn-primary">Update</button>
                                <button type="cancel" value="cancel" class="btn btn-primary">Cancel</button>
                            </div>
                        </div>

                </div>
                </form>
            </div>
        </div>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>