<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include 'koneksi.php';

$sql = "SELECT c.*, u.fullname as 'User', p.name as 'Nama Produk', p.description as Deskrispi, p.price as Harga
        FROM myfavorite c 
        JOIN users u ON c.id_user = u.id_user
        JOIN products p ON c.id_product = p.id_product";

$result = $koneksi->query($sql);

$response = array();

if ($result) {
    if ($result->num_rows > 0) {
        $response['isSuccess'] = true;
        $response['message'] = "Berhasil Menampilkan Data Chart";
        $response['data'] = array();
        while ($row = $result->fetch_assoc()) {
            $response['data'][] = $row;
        }
    } else {
        $response['isSuccess'] = false;
        $response['message'] = "Tidak Ada Data Chart";
        $response['data'] = null;
    }
} else {
    $response['isSuccess'] = false;
    $response['message'] = "Gagal Menampilkan Data Chart: " . $koneksi->error;
    $response['data'] = null;
}

echo json_encode($response);

?>
