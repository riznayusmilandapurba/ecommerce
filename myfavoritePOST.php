<?php

header("Access-Control-Allow-Origin: *");

include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {

$response = array();

$id_user = $_POST['id_user'];
$id_product = $_POST['id_product'];

$insert = "INSERT INTO myfavorite (id_user, id_product) 
               VALUES ('$id_user', '$id_product')";

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
