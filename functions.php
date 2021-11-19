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
