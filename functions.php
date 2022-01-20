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
    // upload gambar
    $cover = upload();
    if (!$cover) { //untuk mengecek jika upload gambar gagal, maka fungsi add_data tidak akan dijalankan
        return false;
    }

    // query insert data to db
    $query_insert_data = "INSERT INTO books
      VALUES
      ('', '$no_isbn', '$title', '$author', '$publisher', '$publication_year', '$language', '$genre', '$pages', '$cover')
      ";
    mysqli_query($conn, $query_insert_data);

    return mysqli_affected_rows($conn);
}

function upload()
{
    // ambil data dari $_FILES
    $imgName = $_FILES['cover']['name']; //untuk mendapatkan nama gambar beserta ektensinya
    $imgSize = $_FILES['cover']['size'];
    $error = $_FILES['cover']['error']; //untuk mengecek apakah ada gambar yg diupload/tidak
    $tmpName = $_FILES['cover']['tmp_name']; //tempat penyimpanan sementara

    // cek apakah ada tdk  ada gambar yg diupload
    if ($error === 4) {
        echo "
        <script>
        alert('Image not selected');
        </script>";
        return false;
    }

    //cek apakah yg diupload adalah gambar..?
    // lakukan pengecekan ext pd file yg diupload
    $extentionImgValid = ['jpg', 'jpeg', 'png']; //jenis ext img yg diizinkan diupload
    $extentionImg = explode('.', $imgName); //hasil berupa array contoh : asep.jpg => ['asep','jpg']
    $extentionImg = strtolower(end($extentionImg)); //untuk mendapatkan ekstensi gambar dan dirubah ke huruf kecil
    if (!in_array($extentionImg, $extentionImgValid)) {
        //in_array fungsi untuk mengecek apakah ada string tertentu pada sebuah array
        echo "
        <script>
        alert('the uploaded data is not an image');
        </script>";
        return false;
    }

    // cek ukuran gambar, contoh maksimal gambar 1Mb
    if ($imgSize >= 1000000) {
        echo "<script>
        alert('maximum image size 1 Mb');
        </script>";
        return false;
    }

    // lolos pengecekan/ gambar siap diupload
    //generate name baru untuk gambar dengan cara mmanggil fungsi bilangan random  
    $newImgName = uniqid();
    $newImgName .= ".";
    $newImgName .= $extentionImg;
    move_uploaded_file($tmpName, 'img/' . $newImgName);
    return $newImgName;
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

    $oldImg = $data["oldImg"];
    // cek apakah user pilih gambar baru / tidak
    if ($_FILES['cover']['error'] === 4) {
        $cover = $oldImg;
    } else {
        $cover = upload();
    }


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

function registrasi($data)
{
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $confirm_password = mysqli_real_escape_string($conn, $data["confirm-password"]);

    // cek konfirmasi password
    if ($password !== $confirm_password) {
        echo "<script>
                alert('password does not match');
                </script>";

        return false;
    }
    // cek username, apakah sudah terdaftar di database atau belum
    $check_username = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");
    if (mysqli_fetch_assoc($check_username)) {
        echo "<script>
                alert('Username is already registered');
                </script>";

        return false;
    }

    // enkripsi password yg akan dimasukan ke database
    $password = password_hash($password, PASSWORD_DEFAULT);

    //tambahkan data user ke databse
    mysqli_query($conn, "INSERT INTO user VALUES('','$username','$password')");
    return mysqli_affected_rows($conn);
}
