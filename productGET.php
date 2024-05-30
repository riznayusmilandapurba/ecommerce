<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include 'koneksi.php';

$sql = "SELECT p.*, c.name as kategori
        FROM products p 
        JOIN category c ON p.id_category = c.id_category";
$result = $koneksi->query($sql);

$response = array();

if($result->num_rows > 0) {
    $response['isSuccess'] = true;
    $response['message'] = "Berhasil Menampilkan Produk";
    $response['data'] = array();
    while ($row = $result->fetch_assoc()) {
        $response['data'][] = $row;
    }
} else {
    $response['isSuccess'] = false;
    $response['message'] = "Gagal Menampilkan Produk";
    $response['data'] = null;
}

echo json_encode($response);

?>
