<?php

header("Access-Control-Allow-Origin: header");
header("Access-Control-Allow-Origin: *");

include 'koneksi.php';

// Ambil data yang dikirimkan melalui metode POST
$id_category = $_POST['id_category'];
$name = $_POST['name'];
$description = $_POST['description'];

// Lakukan kueri untuk mengupdate data pegawai
$sql = "UPDATE category SET name = '$name', description = '$description' WHERE id_category=$id_category";
$isSuccess = $koneksi->query($sql);


$res = [];
if ($isSuccess) {
    $cek = "SELECT * FROM category WHERE id_category = $id_category";
    $result = mysqli_fetch_assoc(mysqli_query($koneksi, $cek));

    $res['is_success'] = true;
    $res['value'] = 1;
    $res['message'] = "Berhasil edit data pegawai";
    $res['name'] = $result['name'];
    $res['description'] = $result['description'];
    $res['id_category'] = $result['id_category'];
} else {
    $res['is_success'] = false;
    $res['value'] = 0;
    $res['message'] = "Gagal edit data pegawai";
}

echo json_encode($res);

?>
