<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include 'koneksi.php';

$id_user = $_GET['id'];

$sql = "SELECT c.*, u.fullname as 'User', p.*, k.name as 'kategori'
        FROM charts c 
        JOIN users u ON c.id_user = u.id_user
        JOIN products p ON c.id_product = p.id_product
        JOIN category k ON p.id_category=k.id_category
        WHERE c.id_user = $id_user";

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
