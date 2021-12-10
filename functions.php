<?php
$host = "localhost";
$username = "root";
$password = "";
$db = "mylibrary";
$conn = mysqli_connect("$host", "$username", "$password", "$db");

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function add_data($data_form)
{
    global $conn;
    // collect data dari form
    $no_isbn = htmlspecialchars($data_form["no_isbn"]);
    $title = htmlspecialchars($data_form["title"]);
    $author = htmlspecialchars($data_form["author"]);
    $publisher = htmlspecialchars($data_form["publisher"]);
    $publication_year = htmlspecialchars($data_form["publication_year"]);
    $language = htmlspecialchars($data_form["language"]);
    $genre = htmlspecialchars($data_form["genre"]);
    $pages = htmlspecialchars($data_form["pages"]);
    $cover = htmlspecialchars($data_form["cover"]);

    // query insert data to db
    $query_insert_data = "INSERT INTO books
      VALUES
      ('', '$no_isbn', '$title', '$author', '$publisher', '$publication_year', '$language', '$genre', '$pages', '$cover')
      ";
    mysqli_query($conn, $query_insert_data);

    return mysqli_affected_rows($conn);
}


function delete($id)
{
    global $conn;

    mysqli_query($conn, "DELETE FROM books WHERE id = $id");
    return mysqli_affected_rows($conn);
}

function edit_data($data)
{
    global $conn;

    $id = $data["id"];
    $no_isbn = htmlspecialchars($data["no_isbn"]);
    $title = htmlspecialchars($data["title"]);
    $author = htmlspecialchars($data["author"]);
    $publisher = htmlspecialchars($data["publisher"]);
    $publication_year = htmlspecialchars($data["publication_year"]);
    $language = htmlspecialchars($data["language"]);
    $genre = htmlspecialchars($data["genre"]);
    $pages = htmlspecialchars($data["pages"]);
    $cover = htmlspecialchars($data["cover"]);

    $update_data = "UPDATE books SET 
                        no_isbn = '$no_isbn',
                        title = '$title',
                        author = '$author',
                        publisher = '$publisher',
                        publication_year = '$publication_year',
                        language = '$language',
                        genre = '$genre',
                        pages = '$pages',
                        cover = '$cover'
                        WHERE id = $id
                        ";
    mysqli_query($conn, $update_data);
    return mysqli_affected_rows($conn);
}

// search
function search($keyword)
{
    $query_search = "SELECT * FROM books
                        WHERE
                        no_isbn LIKE '%$keyword%' OR
                        title LIKE '%$keyword%' OR
                        author LIKE '%$keyword%' OR
                        publisher LIKE '%$keyword%' OR 
                        genre LIKE '%$keyword%'
                        ";
    return query($query_search);
}
