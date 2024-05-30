<?php

header("Access-Control-Allow-Origin: *");
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $response = array();

    $name = $_POST['name'];
    $description = $_POST['description'];

    $insert = "INSERT INTO category (name, description) 
               VALUES ('$name', '$description')";

    if (mysqli_query($koneksi, $insert)) {
        $response['value'] = 1;
        $response['message'] = "Berhasil Tambah Data";
    } else {
        $response['value'] = 0;
        $response['message'] = "Tambah Data: " . mysqli_error($koneksi);
    }
} else {
    $response['value'] = 0;
    $response['message'] = "Metode permintaan tidak valid";
}

echo json_encode($response);

?>
