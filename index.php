<?php
require 'functions.php';
$get_books = query("SELECT * FROM books");

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


        <h1>MyLibrary Collection Books</h1>

        <table class="table table-striped table-hover">
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
                    <td><?= $i; ?>.</td>
                    <td><?= $book["no_isbn"]; ?></td>
                    <td><?= $book["title"]; ?></td>
                    <td><?= $book["author"]; ?></td>
                    <td><?= $book["publisher"]; ?></td>
                    <td><?= $book["genre"]; ?></td>
                    <td><?= $book["publication_year"]; ?></td>
                    <td><?= $book["language"]; ?></td>
                    <td><?= $book["pages"]; ?></td>
                    <td><img src="img/<?= $book["cover"]; ?>" alt="" width="50"></td>
                    <td><strong><a href="">Edit </a> | <a href="">Delete</a></strong> </td>
                </tr>
                <?php $i++; ?>
            <?php endforeach; ?>
        </table>


    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>